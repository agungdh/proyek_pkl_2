<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	var $tabel;

	function __construct(){
		parent::__construct();
		$this->tabel = "mkategori";
	}

	function index() {
		$data['isi'] = "kategori/index";
		$data['data']['kategori'] = $this->db->get($this->tabel)->result();
		$this->load->view("template/template", $data);
	}

	function tambah() {
		$data['isi'] = "kategori/tambah";

		$this->load->view("template/template", $data);
	}

	function aksi_tambah() {
		$data['cnmkategori'] = $this->input->post('kategori');
		$data['cnokategori'] = $this->input->post('nokategori');
		$this->db->insert(
			$this->tabel,
			$data
		);

		redirect(base_url('kategori'));
	}

	function ubah($nokategori) {
		$data['isi'] = "kategori/ubah";
		$where['cnokategori'] = $nokategori;
		$data['data']['kategori'] = $this->db->get_where(
			$this->tabel,
			$where
		)->row();

		$this->load->view("template/template", $data);
	}

	function aksi_ubah() {
		$data['cnokategori'] = $this->input->post('nokategori');
		$data['cnmkategori'] = $this->input->post('kategori');
		$where['cnokategori'] = $data['cnokategori'];
		
		$this->db->update(
			$this->tabel,
			$data,
			$where
		);

		redirect(base_url('kategori'));
	}

	function aksi_hapus($nokategori) {
		$where['cnokategori'] = $nokategori;
		$this->db->delete(
			$this->tabel,
			$where
		);

		redirect(base_url('kategori'));
	}

}
