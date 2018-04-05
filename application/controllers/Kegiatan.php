<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends CI_Controller {
	var $tabel;

	function __construct(){
		parent::__construct();
		$this->tabel = "mkegiatan";
	}

	function index($cnokegiatan = null) {
		$data['isi'] = "kegiatan/index";
		$data['data']['kegiatan'] = $this->db->get($this->tabel)->result();
		$data['data']['ai'] = $this->m_universal->ai($this->tabel);
		$data['data']['kegiatan_id'] = $this->db->get_where($this->tabel, array('cnokegiatan' => $cnokegiatan))->row();
		$this->load->view("template/template", $data);
	}

	function detail($id) {
		$data['isi'] = "kegiatan/detail";
		$data['data']['kegiatan'] = $this->db->get_where($this->tabel, array('cnokegiatan' => $id))->row();
		// var_dump($data); exit();
		$this->load->view("template/template", $data);
	}

	function tambah() {
		$data['isi'] = "kegiatan/tambah";
		$sql = "SELECT cnokegiatan
				FROM mkegiatan
				ORDER BY cnokegiatan DESC
				LIMIT 1";
		$last_id = $this->db->query($sql, array())->row();
		if ($last_id != null) {
			$data['data']['cnokegiatan'] = $last_id->cnokegiatan;
		} else {
			$data['data']['cnokegiatan'] = "001";
		}

		$this->load->view("template/template", $data);
	}

	function aksi_tambah() {
		$data['cnmkegiatan'] = $this->input->post('kegiatan');
		$data['ctingkat'] = $this->input->post('tingkat');
		$data['cnokategori'] = $this->input->post('nokategori');
				
		$this->db->insert(
			$this->tabel,
			$data
		);
		
		$data['cnokegiatan'] = str_pad($this->db->insert_id(),3,"0",STR_PAD_LEFT);
		$this->db->update($this->tabel, $data, array('ai' => $this->db->insert_id()));

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
