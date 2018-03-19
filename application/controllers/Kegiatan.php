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
		$data['cnokegiatan'] = $this->input->post('nokegiatan');
		$data['cnmkegiatan'] = $this->input->post('kegiatan');
		$data['ctingkat'] = $this->input->post('tingkat');
		$data['cnokategori'] = $this->input->post('nokategori');
		
		if ($this->db->get_where('mkegiatan', array('cnokegiatan' => str_pad($data['cnokegiatan'], 3, '0', STR_PAD_LEFT))) != null) {
			$sql = "SELECT cnokegiatan
					FROM mkegiatan
					ORDER BY cnokegiatan DESC
					LIMIT 1";
			$data['cnokegiatan'] = $this->db->query($sql, array())->row()->cnokegiatan + 1;
		} 
		$this->db->insert($this->tabel, $data);
		$data1 = $this->db->get_where('mkegiatan', array('cnokegiatan' => $data['cnokegiatan']))->row();	
		
		redirect(base_url('kegiatan/detail/' . $data1->cnokegiatan));
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
