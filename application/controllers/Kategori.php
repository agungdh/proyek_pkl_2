<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	var $tabel;

	function __construct(){
		parent::__construct();
		$this->tabel = "mkategori";
	}

	function index($cnokategori = null) {
		$data['isi'] = "kategori/index";
		$data['data']['kategori'] = $this->db->get($this->tabel)->result();
		$data['data']['kategori_id'] = $this->db->get_where($this->tabel, array('cnokategori' => $cnokategori))->row();
		$data['data']['ai'] = $this->m_universal->ai($this->tabel);
		
		$this->load->view("template/template", $data);
	}

	function tambah() {
		$data['isi'] = "kategori/tambah";

		$this->load->view("template/template", $data);
	}

	function aksi_tambah() {
		$data['cnmkategori'] = $this->input->post('kategori');
		
		$this->db->insert(
			$this->tabel,
			$data
		);
		
		$data['cnokategori'] = str_pad($this->db->insert_id(),3,"0",STR_PAD_LEFT);
		$this->db->update($this->tabel, $data, array('ai' => $this->db->insert_id()));

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
