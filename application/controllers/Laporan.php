<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Laporan extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library('dompdf_gen');
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        $this->tabel = "mteammhs";
        // $this->load->model('mread'); // memanggil model mread
    }

   function index($cnoteam = null) {
        $data['isi'] = "laporan/index";
        if ($this->input->get('cnokegiatan') == null || $this->input->get('cnokegiatan') == "null" || $this->input->get('cnokegiatan') == ""){     
        } else {
            $this->db->where('cnokegiatan', $this->input->get('cnokegiatan'));
        }
        $data['data']['team'] = $this->db->get($this->tabel)->result();
        $data['data']['ai'] = $this->m_universal->ai($this->tabel);
        $data['data']['team_id'] = $this->db->get_where($this->tabel, array('cnoteam' => $cnoteam))->row();
        $this->load->view("template/template", $data);
    }

    function filter($cnoteam = null, $tahun = null, $cs = null){
        $tahun = $this->input->get('tahun_ajar_awal').$this->input->get('tahun_ajar_akhir');
        $cs = $this->input->get('cs');
        $fk = $this->input->get('fk');

        $where['tahun'] = $this->db->where('cthnajar',$tahun);
        #$where['cthnajar'] = $tahun;
        if($cs != null){
            $where['cs'] = $this->db->where('csmt',$cs);
            #$where['csmt'] = $cs;
        }
        if($fk != null){
            $where['SUBSTRING(cnim, 3, 1)'] = $cs;
        }

        $data['isi'] = "laporan/filter";
        $data['data']['team'] = $this->db->get('vteams')->result();
        $data['data']['ai'] = $this->m_universal->ai($this->tabel);
        $data['data']['team_id'] = $this->db->get_where($this->tabel, array('cnoteam' => $cnoteam))->row();

        //print_r($data);
        $this->load->view("template/template", $data);
    }

    public function export(){
        $ambildata = $this->db->get('mteammhs');
         
        if(count($ambildata)>0){
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()
                  ->setCreator("SAMSUL ARIFIN") //creator
                    ->setTitle("Programmer - Regional Planning and Monitoring, XL AXIATA");  //file title
 
            $objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
            $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object
 
            $objget->setTitle('Sample Sheet'); //sheet title
            //Warna header tabel
            // $objget->getStyle("A1:L1")->applyFromArray(
            //     array(
            //         'fill' => array(
            //             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            //             'color' => array('rgb' => '92d050')
            //         ),
            //         'font' => array(
            //             'color' => array('rgb' => '000000')
            //         )
            //     )
            // );
            
            $objPHPExcel->getActiveSheet()->mergeCells('A2:A3');
            $objPHPExcel->getActiveSheet()->mergeCells('B2:B3');
            $objPHPExcel->getActiveSheet()->mergeCells('C2:C3');
            $objPHPExcel->getActiveSheet()->mergeCells('D2:D3');
            $objPHPExcel->getActiveSheet()->mergeCells('E2:E3');
            $objPHPExcel->getActiveSheet()->mergeCells('F2:I2');
            $objPHPExcel->getActiveSheet()->mergeCells('J2:J3');
            $objPHPExcel->getActiveSheet()->mergeCells('K2:K3');
            
            //table header
            $cols = array("A","B","C","D","E","F","J","K","L");
             
            $val = array("NO ","Kategori","Kegiatan","Tingkat","Tempat & tanggal","Mahasiswa Peserta Kejuaraan","Prestasi Yang Dicapai","Foto Kegiatan");
             
            for ($a=0;$a<8; $a++) 
            {
                $objset->setCellValue($cols[$a].'2', $val[$a]);
                 
                //Setting lebar cell
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // no
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // kategori
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // kegiatan
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // tingkat
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25); // tempat dan tanggal f g h i
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(); // tempat dan tanggal f g h i
                $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25); // mahasiswa prestasi
                $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25); // foto Kegiatan
             
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle($cols[$a].'2')->applyFromArray($style);
            }

            $cols2 = array("F","G","H","I");
            $val2 = array("NIM", "Nama","Fakultas","Bukti Prestasi");

            for($a=0; $a<4; $a++){
                $objset->setCellValue($cols2[$a].'3', $val2[$a]);

                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15); // kategori
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // kegiatan
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15); // tingkat
                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15); // tingkat

                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle($cols2[$a].'3')->applyFromArray($style);
            }


            $baris  = 4;
            $no = 1;

            //daata umtuk di tampilkan ireng
            $team = $this->db->get('mteammhs')->result();

            foreach ($team as $tg){
                $kegiatan = $this->db->get_where('mkegiatan', array('cnokegiatan' => $tg->cnokegiatan))->row();
                $kategori = $this->db->get_where('mkategori', array('cnokategori' => $kegiatan->cnokategori))->row();
                $tgt = $this->db->get_where('tagtteam', array('cnoteam' => $tg->cnoteam))->row();   
                 
               //pemanggilan sesuaikan dengan nama kolom tabel
                $objset->setCellValue("A".$baris, $no); //membaca data nama 
                $objset->setCellValue("B".$baris, $kategori->cnmkategori); //membaca data alamat
                $objset->setCellValue("C".$baris, $kegiatan->cnmkegiatan); //membaca data alamat
                $objset->setCellValue("D".$baris, $kegiatan->ctingkat); //membaca data alamat
                $objset->setCellValue("E".$baris, $tg->ctempatlomba); //membaca data alamat


                $mhs = $this->db->get_where('tagtteam', array('cnoteam' => $tg->cnoteam))->result();

                foreach($mhs as $m){
                    $nama = $this->db->get_where('mmhs', array('cnim' => $m->cnim))->row();

                    $objset->setCellValue("F".$baris, $m->cnim);
                    $objset->setCellValue("G".$baris, $nama->cnama);
                    $objset->setCellValue("H".$baris, '-');
                    $objset->setCellValue("I".$baris, $m->cbukti);

                $objPHPExcel->getActiveSheet()->getStyle('C4:C'.$baris)->getNumberFormat()->setFormatCode('0');
                }

                $objset->setCellValue("J".$baris, $tgt->cprestasi);
                $objset->setCellValue("K".$baris, $tg->cfoto); 

                //Set number value
                $objPHPExcel->getActiveSheet()->getStyle('C1:C'.$baris)->getNumberFormat()->setFormatCode('5');
                 
                $no++; 
                $baris++;
            }
             
            $objPHPExcel->getActiveSheet()->setTitle('Data Export');
 
            $objPHPExcel->setActiveSheetIndex(0);  
            $filename = urlencode("Data".date("Y-m-d H:i:s").".xls");
               
              header('Content-Type: application/vnd.ms-excel'); //mime type
              header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
              header('Cache-Control: max-age=0'); //no cache
 
            $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');                
            $objWriter->save('php://output');
        }else{
            redirect('Excel');
        }
    }


    public function pdf(){
        $this->load->view('laporan/pdf');

        $paper_size = 'A4';
        $orientation = 'horizontal';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->output();
        $this->dompdf->stream("Dtm.pdf", array('Attachment'=>0));
    }

    public function pdf_filter($tahun, $semester){
        $data['data']['team'] = $this->db->get_where($this->tabel, array('cthnajar' => $tahun, 'csmt' => $semester))->result();
        $this->load->view('laporan/pdf_filter',$data);

        $paper_size = 'A4';
        $orientation = 'horizontal';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->output();
        $this->dompdf->stream("Dtm.pdf", array('Attachment'=>0));
    }

    public function coba(){
        $this->load->view('coba');
    }

}