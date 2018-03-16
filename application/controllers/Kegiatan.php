<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends CI_Controller {
	var $tabel;

	function __construct(){
		parent::__construct();
		$this->tabel = "mkegiatan";
	}

	function index() {
		$data['isi'] = "kegiatan/index";
		$data['data']['kegiatan'] = $this->db->get($this->tabel)->result();
		$this->load->view("template/template", $data);
	}

	function tambah() {
		$data['isi'] = "kegiatan/tambah";

		$this->load->view("template/template", $data);
	}

	function aksi_tambah() {
		$data['cnokegiatan'] = $this->input->post('nokegiatan');
		$data['cnmkegiatan'] = $this->input->post('kegiatan');
		$data['ctingkat'] = $this->input->post('tingkat');
		$data['cnokategori'] = $this->input->post('nokategori');
		$this->db->insert(
			$this->tabel,
			$data
		);

		redirect(base_url('kegiatan'));
	}

	function ubah($nokegiatan) {
		$data['isi'] = "kegiatan/ubah";
		$where['cnokegiatan'] = $nokegiatan;
		$data['data']['kegiatan'] = $this->db->get_where(
			$this->tabel,
			$where
		)->row();

		$this->load->view("template/template", $data);
	}

	function aksi_ubah() {
		$data['cnokegiatan'] = $this->input->post('nokegiatan');
		$data['cnmkegiatan'] = $this->input->post('kegiatan');
		$data['ctingkat'] = $this->input->post('tingkat');
		$data['cnokategori'] = $this->input->post('nokategori');
		$where['cnokegiatan'] = $data['cnokegiatan'];
		
		$this->db->update(
			$this->tabel,
			$data,
			$where
		);

		redirect(base_url('kegiatan'));
	}

	function aksi_hapus($nokegiatan) {
		$where['cnokegiatan'] = $nokegiatan;
		$this->db->delete(
			$this->tabel,
			$where
		);

		redirect(base_url('kegiatan'));
	}

}
