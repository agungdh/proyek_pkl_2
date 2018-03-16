<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller {
	var $tabel;

	function __construct(){
		parent::__construct();
		$this->tabel = "mteammhs";
	}

	function index($nokegiatan) {
		$data['isi'] = "team/index";
		$data['data']['kegiatan'] = $this->db->get_where('mkegiatan', array('cnokegiatan' => $nokegiatan))->row();
		$data['data']['team'] = $this->db->get_where($this->tabel, array('cnokegiatan' => $nokegiatan))->result();
		$this->load->view("template/template", $data);
	}

	function tambah($nokegiatan) {
		$data['isi'] = "team/tambah";
		$data['data']['kegiatan'] = $this->db->get_where('mkegiatan', array('cnokegiatan' => $nokegiatan))->row();

		$this->load->view("template/template", $data);
	}

	function aksi_tambah($nokegiatan) {		
		$data['cnoteam'] = $this->input->post('noteam');
		$data['cnmteam'] = $this->input->post('team');
		$data['cjmlagt'] = $this->input->post('jumlah');
		$data['csmt'] = $this->input->post('semester');
		$data['cthnajar'] = $this->input->post('tahunajar1') . $this->input->post('tahunajar2');
		$data['ctglawallomba'] = $this->input->post('tanggalawal');
		$data['ctglakhirlomba'] = $this->input->post('tanggalakhir');
		$data['ctempatlomba'] = $this->input->post('tempatlomba');
		$data['cprestasi'] = $this->input->post('prestasi');
		$data['cbukti'] = $this->input->post('bukti');
		$data['cfoto'] = $this->input->post('foto');
		$data['cuserentri'] = $this->session->cuserentri;
		$data['ctglentri'] = date('Y-m-d');
		$data['cnokegiatan'] = $nokegiatan;
		$this->db->insert(
			$this->tabel,
			$data
		);

		redirect(base_url('team/index/' . $nokegiatan));
	}

	function ubah($nokegiatan, $noteam) {
		$data['isi'] = "team/ubah";
		$data['data']['kegiatan'] = $this->db->get_where('mkegiatan', array('cnokegiatan' => $nokegiatan))->row();
		$where['cnoteam'] = $noteam;
		$data['data']['team'] = $this->db->get_where(
			$this->tabel,
			$where
		)->row();

		$this->load->view("template/template", $data);
	}

	function aksi_ubah($nokegiatan) {
		$data['data']['kegiatan'] = $this->db->get_where('mkegiatan', array('cnokegiatan' => $nokegiatan))->row();
		$data['cnoteam'] = $this->input->post('noteam');
		$data['cnmteam'] = $this->input->post('team');
		$where['cnoteam'] = $data['cnoteam'];
		
		$this->db->update(
			$this->tabel,
			$data,
			$where
		);

		redirect(base_url('team/index/' . $nokegiatan));
	}

	function aksi_hapus($nokegiatan, $noteam) {
		$where['cnoteam'] = $noteam;
		$this->db->delete(
			$this->tabel,
			$where
		);

		redirect(base_url('team/index/' . $nokegiatan));
	}

}
