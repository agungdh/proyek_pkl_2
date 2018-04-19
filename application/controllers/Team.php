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
		if ($this->input->get('cnokegiatan') == null || $this->input->get('cnokegiatan') == "null" || $this->input->get('cnokegiatan') == "") {
			
		} else {
			$this->db->where('cnokegiatan', $this->input->get('cnokegiatan'));
		}
		$data['data']['team'] = $this->db->get($this->tabel)->result();
		$data['data']['ai'] = $this->m_universal->ai($this->tabel);
		$data['data']['team_id'] = $this->db->get_where($this->tabel, array('cnoteam' => $cnoteam))->row();
		$this->load->view("template/template", $data);
	}

	function ambil_detail_kegiatan($cnokegiatan) {
		$kegiatan = $this->db->get_where('mkegiatan', array('cnokegiatan' => $cnokegiatan))->row();
		switch ($kegiatan->ctingkat) {
			case 'l':
				$tingkat = 'Lokal';
				break;
			
			case 'n':
				$tingkat = 'Nasional';
				break;
			
			case 'i':
				$tingkat = 'Internasional';
				break;
			
			default:
				$tingkat = 'ERROR !!!';
				break;
		}
		$kategori = $this->db->get_where('mkategori', array('cnokategori' => $kegiatan->cnokategori))->row()->cnmkategori;
		echo json_encode(array('tingkat' => $tingkat,
					 'kategori' => $kategori));
	}

	function aksi_tambah_anggota() {
		foreach ($this->input->post('data') as $key => $value) {
			$data[$key] = $value;
		}
		
		$bukti = $_FILES['cbukti'];
		if ($bukti['size'] != 0) {
			$data['cbukti'] = 'uploads/bukti/' . $data['cnoteam'] . '_' . $data['cnim'] . '_' . $bukti['name'];			
		}

		if ($this->db->insert('tagtteam', $data)) {
			move_uploaded_file($bukti['tmp_name'], $data['cbukti']);
		}

		redirect(base_url('team/index/' . $data['cnoteam']));
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

	function aksi_hapus_anggota($noteam, $nim) {
		$where['cnoteam'] = $noteam;
		$where['cnim'] = $nim;
		$this->db->delete(
			'tagtteam',
			$where
		);

		redirect(base_url('team/index/' . $noteam));
	}

	function aksi_ubah_anggota() {
		$noteam = $this->input->post('noteam');
		$nim = $this->input->post('nim');
		$data['cprestasi'] = $this->input->post('prestasi');

		if ($_FILES['bukti']['size'] != 0) {
			$data['cbukti'] = 'uploads/bukti/' . $noteam . '_' . $nim . '_' . $_FILES['bukti']['name'];
			move_uploaded_file($_FILES['bukti']['tmp_name'], $data['cbukti']);
		}
		
		$where['cnoteam'] = $noteam;
		$where['cnim'] = $nim;
		$this->db->update('tagtteam', $data, $where);
		

		redirect(base_url('team/index/' . $noteam));
	}


}
