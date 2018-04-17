<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobil extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('dompdf_gen');
        if ($this->session->logged_in != "yes" || $this->session->stts != "admin") {
            redirect(base_url());
        }
    }

    public function tampil_mobil(){
    	$data = array(
    		"header"		=> $this->load->view("admin/include/header",array(),true),
    		"sidebar"		=> $this->load->view("admin/include/sidebar",array(),true),
			"topnav"		=> $this->load->view("admin/include/topnav",array(),true),
			"content_mobil"	=> $this->content_mobil(),
			"footer"		=> $this->load->view("admin/include/footer",array(),true),
    	);
    	$this->load->view("admin/menu/mobil",$data);
    }

    public function content_mobil(){
    	$data = array(
    		"mobil"	=> $this->Model_mobil->tampil_mobil()->result_array(),
    		"tipe"	=> $this->Model_mobil->tampil_tmobil()->result_array(),
    	);
    	return $this->load->view("admin/include/content_mobil",$data,true);
    }

   //menampilkan form add mobil
   public function add_mobil(){
        $data = array(
            "header"        => $this->load->view("admin/include/header",array(),true),
            "sidebar"       => $this->load->view("admin/include/sidebar",array(),true),
            "topnav"        => $this->load->view("admin/include/topnav",array(),true),
            "form_addmobil" => $this->form_addmobil(),
            "footer"        => $this->load->view("admin/include/footer",array(),true),
        );
        $this->load->view("admin/tambah/tambah_mobil",$data);
    }

    public function form_addmobil(){
        $data =  array(
        "tipe"  => $this->Model_mobil->tampil_tmobil()->result_array(),
        );
        return $this->load->view("admin/include/form_addmobil",$data,true);
    }

    //delete mobil
    public function delete_mobil($nopol){
        $this->Model_mobil->delete_mobil($nopol);
        redirect("Mobil/tampil_mobil");
    }

    //menampilkan edit form mobil
    public function edit_mobil($nopol){
        $data = $this->Model_mobil->ambil_data_mobil($nopol);
        $data2 = array(
            "header"            => $this->load->view("admin/include/header",array(),true),
            "sidebar"           => $this->load->view("admin/include/sidebar",array(),true),
            "topnav"            => $this->load->view("admin/include/topnav",array(),true),
            "form_editmobil"    => $this->form_editmobil(),
            "footer"            => $this->load->view("admin/include/footer",array(),true),
        );
        $this->load->view("admin/edit/edit_mobil",array("data" => $data));
    }

    public function form_editmobil(){
        $data =  array(
        "tipe"  => $this->Model_mobil->tampil_tmobil()->result_array(),
        );
        return $this->load->view("admin/include/form_editmobil",$data,true);
    }

    //ACTION edit MOBIL 
    public function get_editmobil(){
        $nopol      = $this->input->post('nopol');
        $jmobil     = $this->input->post('jmobil');
        $merek      = $this->input->post('merek');
        $tproduk    = $this->input->post('tproduk');
        $kapasitas  = $this->input->post('kapasitas');
        $stts       = $this->input->post('stts');
        $nopol      = strtoupper(str_replace(" ", "", $nopol));

        $this->Model_mobil->edit_mobil($nopol, $jmobil, $merek, $tproduk, $kapasitas, $stts);
        redirect("Mobil/tampil_mobil");

        echo $tproduk;
        
    }

    //ACTION TAMBAH MOBIL 
    public function get_mobil(){
        $nopol      = $this->input->post('nopol');
        $jmobil     = $this->input->post('jmobil');
        $merek      = $this->input->post('merek');
        $tproduk    = $this->input->post('tproduk');
        $kapasitas  = $this->input->post('kapasitas');
        $stts       = $this->input->post('stts');
        $nopol      = strtoupper(str_replace(" ", "", $nopol));

        $this->Model_mobil->tambah_mobil($nopol, $jmobil, $merek, $tproduk, $kapasitas, $stts);
        redirect("Mobil/tampil_mobil");
        
    }

    //read mobil
    public function read_mobil($nopol){
        $data = $this->Model_mobil->ambil_data_mobil($nopol);
        $this->load->view("admin/read/read_mobil", array("data" => $data));
    }

    


   //menampilkan jenis mobil
   public function add_tmobil(){
        $this->load->view("admin/tambah/tambah_tmobil");
   }

   //action tambha jenis mobil
   public function get_tmobil(){
        $jmobil      = $this->input->post('jmobil');
        $this->Model_mobil->tambah_tmobil($jmobil);
        redirect("Mobil/tampil_mobil");
   }

    //delete tmobil
    public function delete_tmobil($id_tipe_kendaraan){
        $this->Model_mobil->delete_tmobil($id_tipe_kendaraan);
        redirect("Mobil/tampil_mobil");
    }

    //edit tmobil
    public function edit_tmobil($id_tipe_kendaraan){
        $data = $this->Model_mobil->ambil_data_jmobil($id_tipe_kendaraan);
        $this->load->view("admin/edit/edit_tmobil", array("data" => $data));
    }

    //edit tmobil
    public function get_edittmobil(){
        $jmobil       = $this->input->post('jmobil');
        $id           = $this->input->post('id_tipe_kendaraan');
        $day = $this->Model_mobil->edit_tmobil($id, $jmobil);
        redirect("Mobil/tampil_mobil");
    }  

    public function get_pdf(){
        //$data['title'] = 'cetak PDF Mobil';
        //$data['mobil'] = $this->Model_mobil->getallmobil();

        $data = array(
            "mobil" => $this->Model_mobil->getallmobil()->result_array(),
        );
        $this->load->view('admin/cetak/pdf/allmobil',$data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->output();
        $this->dompdf->stream("Data Mobil Mobilku.pdf", array('Attachment'=>0));
    }

     public function surat_tugas($id){
        //$data['title'] = 'cetak PDF Mobil';
        $data['surat'] = $this->Model_mobil->surat_tugas($id);
        $this->load->view('admin/cetak/pdf/surat_tugas',$data);

        $paper_size = 'A4';
        $orientation = 'portrait';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->output();
        $this->dompdf->stream("Surat Tugas Sopir.pdf", array('Attachment'=>0));
    }

    public function laporan_peminjaman(){
        //$data['title'] = 'cetak PDF Mobil';
        $data = array(
            "pengajuan"     => $this->Model_admin->tampil_laporan()->result_array(),
        );
        $this->load->view('pimpinan/cetak/pdf/laporan_peminjaman',$data);

        $paper_size = 'A4';
        $orientation = 'portrait';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->output();
        $this->dompdf->stream("Laporan Peminjaman.pdf", array('Attachment'=>0));
     }

     
     public function get_sopir(){
        $data = array(
            "sopir" => $this->Model_mobil->getallsopir()->result_array(),
        );
        $this->load->view('admin/cetak/pdf/allsopir',$data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->output();
        $this->dompdf->stream("Data sopir Mobilku.pdf", array('Attachment'=>0));
    }

    public function get_tujuan(){
        $data = array(
            "tujuan" => $this->Model_mobil->getalltujuan()->result_array(),
        );
        $this->load->view('admin/cetak/pdf/alltujuan',$data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->output();
        $this->dompdf->stream("Data Tujuan Mobilku.pdf", array('Attachment'=>0));
    }


}