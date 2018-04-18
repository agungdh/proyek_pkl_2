<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_user');	
	}

	function index() {
		$data['isi'] = "profil/index";
		$data['data']['user'] = $this->db->get_where('user', array('id' => $this->session->id))->row();

		$this->load->view("template/template", $data);
	}

		function aksi_ubah() {
		$this->m_user->ubah_user(
			hash("sha512", $this->input->post('password')),
			$this->input->post('id')
		);

		redirect(base_url());
	}

}
