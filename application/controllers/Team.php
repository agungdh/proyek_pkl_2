<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller {
	var $tabel;

	function __construct(){
		parent::__construct();
		$this->tabel = "mteammhs";
	}

	function index($cnoteam = null) {
		$data['isi'] = "team/index";
		$data['data']['team'] = $this->db->get($this->tabel)->result();
		$data['data']['ai'] = $this->m_universal->ai($this->tabel);
		$data['data']['team_id'] = $this->db->get_where($this->tabel, array('cnoteam' => $cnoteam))->row();
		$this->load->view("template/template", $data);
	}

	function detail($id) {
		$data['isi'] = "team/detail";
		$data['data']['team'] = $this->db->get_where($this->tabel, array('cnoteam' => $id))->row();
		// var_dump($data); exit();
		$this->load->view("template/template", $data);
	}

	function aksi_tambah() {
		$data['cnmteam'] = $this->input->post('nmteam');
		$data['cjmlagt'] = $this->input->post('jumlah');
		$data['csmt'] = $this->input->post('semester');
		$data['cthnajar'] = $this->input->post('tahun_ajar_awal') . $this->input->post('tahun_ajar_akhir');
		$data['dtglawallomba'] = $this->input->post('tanggal_lomba_awal');
		$data['dtglakhirlomba'] = $this->input->post('tanggal_lomba_akhir');
		$data['ctempatlomba'] = $this->input->post('tempat_lomba');
		$data['cuserentri'] = $this->input->post('userentri');
		$data['dtglentri'] = $this->input->post('tglentri');
		$data['cnokegiatan'] = $this->input->post('nokegiatan');
				
		$this->db->insert(
			$this->tabel,
			$data
		);
		
		$data['cnoteam'] = 'T' . str_pad($this->db->insert_id(),4,"0",STR_PAD_LEFT);
		$foto = $_FILES['foto'];
		if ($foto['size'] != 0) {
			$data['cfoto'] = 'uploads/foto/' . $data['cnoteam'] . '_' . $foto['name'];			
			move_uploaded_file($foto['tmp_name'], $data['cfoto']);
		}
		$this->db->update($this->tabel, $data, array('ai' => $this->db->insert_id()));

		redirect(base_url('team'));
	}

	function aksi_ubah() {
		$data['cnmteam'] = $this->input->post('nmteam');
		$data['cjmlagt'] = $this->input->post('jumlah');
		$data['csmt'] = $this->input->post('semester');
		$data['cthnajar'] = $this->input->post('tahun_ajar_awal') . $this->input->post('tahun_ajar_akhir');
		$data['dtglawallomba'] = $this->input->post('tanggal_lomba_awal');
		$data['dtglakhirlomba'] = $this->input->post('tanggal_lomba_akhir');
		$data['ctempatlomba'] = $this->input->post('tempat_lomba');
		$data['cuserentri'] = $this->input->post('userentri');
		$data['dtglentri'] = $this->input->post('tglentri');
		$data['cnokegiatan'] = $this->input->post('nokegiatan');
		$data['cnoteam'] = $this->input->post('noteam');
		$where['cnoteam'] = $this->input->post('noteam');
		
		$foto = $_FILES['foto'];
		if ($foto['size'] != 0) {
			$data['cfoto'] = 'uploads/foto/' . $data['cnoteam'] . '_' . $foto['name'];			
			move_uploaded_file($foto['tmp_name'], $data['cfoto']);
		}

		$this->db->update(
			$this->tabel,
			$data,
			$where
		);

		// echo $this->db->last_query();
		// redirect(base_url('team/index/' . $data['cnoteam']));
		redirect(base_url('team'));
	}

	function aksi_hapus($noteam) {
		$where['cnoteam'] = $noteam;
		$this->db->delete(
			$this->tabel,
			$where
		);

		redirect(base_url('team'));
	}

}
