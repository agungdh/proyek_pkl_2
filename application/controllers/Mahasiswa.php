<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
	var $tabel;

	function __construct(){
		parent::__construct();
		$this->tabel = "mmhs";
	}

	function index() {
		$data['isi'] = "mahasiswa/index";
		$data['data']['mahasiswa'] = $this->db->get($this->tabel)->result();
		$this->load->view("template/template", $data);
	}

	function tambah() {
		$data['isi'] = "mahasiswa/tambah";

		$this->load->view("template/template", $data);
	}

	function aksi_tambah() {
		$data['cnim'] = $this->input->post('nim');
		$data['cnama'] = $this->input->post('nama');
		$this->db->insert(
			$this->tabel,
			$data
		);

		redirect(base_url('mahasiswa'));
	}

	function ubah($nim) {
		$data['isi'] = "mahasiswa/ubah";
		$where['cnim'] = $nim;
		$data['data']['mahasiswa'] = $this->db->get_where(
			$this->tabel,
			$where
		)->row();

		$this->load->view("template/template", $data);
	}

	function aksi_ubah() {
		$data['cnim'] = $this->input->post('nim');
		$data['cnama'] = $this->input->post('nama');
		$where['cnim'] = $data['cnim'];
		
		$this->db->update(
			$this->tabel,
			$data,
			$where
		);

		redirect(base_url('mahasiswa'));
	}

	function aksi_hapus($nim) {
		$where['cnim'] = $nim;
		$this->db->delete(
			$this->tabel,
			$where
		);

		redirect(base_url('mahasiswa'));
	}

}
