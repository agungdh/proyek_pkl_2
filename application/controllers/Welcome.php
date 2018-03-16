<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();
	}

	function index() {
		$this->session->login != true ? $this->load->view("template/halaman_login") : $this->load->view('template/template',array("isi" => "template/halaman_utama"));;
	}

	function aksi_login() {
		$where['username'] = $this->input->post('username');
		$where['password'] = hash('sha512', $this->input->post('password'));
		$data_user = $this->db->get_where(
			'user',
			$where
		)->row();
		if ($data_user != null) {
			
			$array_data_user = array(
				'cuserentri'  => $data_user->cuserentri,
				'username'  => $data_user->username,
				'login'  => true
			);

			$this->session->set_userdata($array_data_user);

			redirect(base_url());
		} else {
			redirect(base_url('?error=1'));
		}
	}
}
