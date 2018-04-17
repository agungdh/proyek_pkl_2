<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	function index(){
		$data['isi'] = "dashboard/index";
		$data['kategori'] = $this->db->get('v_gak')->result();
		$data['jlh'] = $this->db->get('v_gak')->result();
		// print_r($data);
		$this->load->view("template/template", $data);
	}
}