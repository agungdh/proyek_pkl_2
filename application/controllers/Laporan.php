<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Laporan extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->tabel = "mteammhs";
        // $this->load->model('mread'); // memanggil model mread
    }

   function index() {
        redirect(base_url('laporan/filter'));
    }

    function filter($cnoteam = null, $tahun = null, $cs = null){
        $cs = $this->input->get('cs');
        $fk = $this->input->get('fk');

        if($cs != null){
            $this->db->where('csmt',$cs);
        }
        if($this->input->get('tahun_ajar_awal') != null){
            $tahun = $this->input->get('tahun_ajar_awal').$this->input->get('tahun_ajar_akhir');
            $this->db->where('cthnajar',$tahun);
        }
        if($fk != null){
            $this->db->where('SUBSTRING(cnim, 3, 1) = ' . $fk);
        }

        $data['isi'] = "laporan/index";
        $data['data']['team'] = $this->db->get('vteams')->result();
        // echo $this->db->last_query();
        $data['data']['ai'] = $this->m_universal->ai($this->tabel);
        $data['data']['team_id'] = $this->db->get_where($this->tabel, array('cnoteam' => $cnoteam))->row();

        //print_r($data);
        $this->load->view("template/template", $data);
    }

    function excel(){
        $cs = $this->input->get('cs');
        $fk = $this->input->get('fk');

        if($cs != null){
            $this->db->where('csmt',$cs);
        }
        if($this->input->get('tahun_ajar_awal') != null){
            $tahun = $this->input->get('tahun_ajar_awal').$this->input->get('tahun_ajar_akhir');
            $this->db->where('cthnajar',$tahun);
        }
        if($fk != null){
            $this->db->where('SUBSTRING(cnim, 3, 1) = ' . $fk);
        }

        $data['isi'] = "laporan/index";
        $data['data']['team'] = $this->db->get('vteams')->result();
        // echo $this->db->last_query();
        $data['data']['ai'] = $this->m_universal->ai($this->tabel);

        $this->load->library('excel');
        
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        
        $this->excel->getActiveSheet()->setTitle('Sheet 1');
        
        foreach(range('A','F') as $columnID) {
            $this->excel->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }
        foreach(range('H','L') as $columnID) {
            $this->excel->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        $this->excel->getActiveSheet()->setCellValue('A1', 'LAPORAN PRESTASI MAHASISWA');
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('A1:M1');
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('A2', 'TAHUN AJAR ' . $this->input->get('tahun_ajar_awal') . '/' . $this->input->get('tahun_ajar_akhir'));
        $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(20);
        $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('A2:M2');
        $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        if($cs != null) {
            $semester_jadi = $cs == 'e' ? 'Semester Genap' : 'Semester Gasal';
        } else {
            $semester_jadi = "Semua Semester";
        }
        $this->excel->getActiveSheet()->setCellValue('A3', $semester_jadi);
        $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(20);
        $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('A3:M3');
        $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->getStyle('A5:M6')->getFont()->setBold(true); 
        $this->excel->getActiveSheet()->setCellValue('A5', 'NO');
        $this->excel->getActiveSheet()->mergeCells('A5:A6');
        $this->excel->getActiveSheet()->setCellValue('B5', 'KATEGORI');
        $this->excel->getActiveSheet()->mergeCells('B5:B6');
        $this->excel->getActiveSheet()->setCellValue('C5', 'KEGIATAN');
        $this->excel->getActiveSheet()->mergeCells('C5:C6');
        $this->excel->getActiveSheet()->setCellValue('D5', 'TINGKAT');
        $this->excel->getActiveSheet()->mergeCells('D5:D6');
        $this->excel->getActiveSheet()->setCellValue('E5', 'TEMPAT, TANGGAL PELAKSANAAN');
        $this->excel->getActiveSheet()->mergeCells('E5:E6');
        $this->excel->getActiveSheet()->setCellValue('F5', 'NAMA TEAM');
        $this->excel->getActiveSheet()->mergeCells('F5:F6');
        $this->excel->getActiveSheet()->setCellValue('G5', 'FOTO KEGIATAN');
        $this->excel->getActiveSheet()->mergeCells('G5:G6');
        $this->excel->getActiveSheet()->setCellValue('H5', 'MAHASISWA PESERTA KEJUARAAN');
        $this->excel->getActiveSheet()->mergeCells('H5:M5');
        
        $this->excel->getActiveSheet()->setCellValue('H6', 'NO');
        $this->excel->getActiveSheet()->setCellValue('I6', 'NIM');
        $this->excel->getActiveSheet()->setCellValue('J6', 'NAMA');
        $this->excel->getActiveSheet()->setCellValue('K6', 'FAKULTAS');
        $this->excel->getActiveSheet()->setCellValue('L6', 'BUKTI PRESTASI');
        $this->excel->getActiveSheet()->setCellValue('M6', 'PRESTASI YANG DICAPAI');



        $i = 1;
        $a = 7;
          $styleArray = array(
              'borders' => array(
                  'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN
                  )
              )
          );
          $styleArrayBold = array(
              'borders' => array(
                  'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_MEDIUM
                  )
              )
          );
        foreach ($data['data']['team'] as $item) {
            $kegiatan = $this->db->get_where('mkegiatan', array('cnokegiatan' => $item->cnokegiatan))->row();
            $kategori = $this->db->get_where('mkategori', array('cnokategori' => $kegiatan->cnokategori))->row();
            if ($kegiatan->ctingkat == 'l') {
                $tingkat = 'Lokal';
            } elseif ($kegiatan->ctingkat == 'n') {
                $tingkat = 'Nasional';
            } elseif ($kegiatan->ctingkat == 'i') {
                $tingkat = 'Internasional';                            
            }
            $j = 1;

            $val_no = $i;
            $val_kategori = $kategori->cnmkategori;
            $val_kegiatan = $kegiatan->cnmkegiatan;
            $val_tingkat = $tingkat;
            $val_tempatTanggalPelaksanaan = $item->ctempatlomba . ', ' . $this->pustaka->tanggal_indo($item->dtglawallomba) . ' - ' . $this->pustaka->tanggal_indo($item->dtglakhirlomba);
            $val_namaTeam = $item->cnmteam;
            $val_fotoKegiatan = $item->cfoto;

            foreach ($this->db->get_where('tagtteam', array('cnoteam' => $item->cnoteam))->result() as $item2) {
                $mahasiswa = $this->db->get_where('mmhs', array('cnim' => $item2->cnim))->row();
                $param_fk = substr($mahasiswa->cnim, 2, 1);
                switch ($param_fk) {
                    case '1':
                        $fakultas = 'FTI';
                        break;
                    case '2':
                        $fakultas = 'ASTRI';
                        break;
                    case '3':
                        $fakultas = 'FEB';
                        break;
                    case '4':
                        $fakultas = 'FISIP';
                        break;
                    case '5':
                        $fakultas = 'FT';
                        break;
                    case '6':
                        $fakultas = 'PASCASARJANA';
                        break;
                    case '7':
                        $fakultas = 'FIKOM';
                        break;
                    default:
                        $fakultas = 'ERROR !!!';
                        break;
                }

                $this->excel->getActiveSheet()->setCellValue('A' . $a, $val_no);
                $this->excel->getActiveSheet()->setCellValue('B' . $a, $val_kategori);
                $this->excel->getActiveSheet()->setCellValue('C' . $a, $val_kegiatan);
                $this->excel->getActiveSheet()->setCellValue('D' . $a, $val_tingkat);
                $this->excel->getActiveSheet()->setCellValue('E' . $a, $val_tempatTanggalPelaksanaan);
                $this->excel->getActiveSheet()->setCellValue('F' . $a, $val_namaTeam);
                
                if (file_exists($val_fotoKegiatan)) {
                // $this->excel->getActiveSheet()->setCellValue('G' . $a, 'ada');
                    $objDrawing = new PHPExcel_Worksheet_Drawing();
                    $objDrawing->setPath($val_fotoKegiatan);
                    $objDrawing->setCoordinates('G' . $a);                      
                    $objDrawing->setWidth(100); 
                    $objDrawing->setHeight(100); 
                    $objDrawing->setWorksheet($this->excel->getActiveSheet());
                }
                $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(19);
                $this->excel->getActiveSheet()->getRowDimension($a)->setRowHeight(75);
                
                $this->excel->getActiveSheet()->setCellValue('H' . $a, $j);
                $this->excel->getActiveSheet()->setCellValue('I' . $a, $mahasiswa->cnim);
                $this->excel->getActiveSheet()->setCellValue('J' . $a, $mahasiswa->cnama);
                $this->excel->getActiveSheet()->setCellValue('K' . $a, $fakultas);
                $this->excel->getActiveSheet()->setCellValue('L' . $a, $item2->cprestasi);
                
                if (file_exists($item2->cbukti)) {
                // $this->excel->getActiveSheet()->setCellValue('M' . $a, 'ada');
                    $objDrawing = new PHPExcel_Worksheet_Drawing();
                    $objDrawing->setPath($$item2->cbukti);
                    $objDrawing->setCoordinates('M' . $a);                      
                    $objDrawing->setWidth(100); 
                    $objDrawing->setHeight(100); 
                    $objDrawing->setWorksheet($this->excel->getActiveSheet());
                }
                $this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(19);
                $this->excel->getActiveSheet()->getRowDimension($a)->setRowHeight(75);

                $a++;
                $j++;
                $val_no = null;
                $val_kategori = null;
                $val_kegiatan = null;
                $val_tingkat = null;
                $val_tempatTanggalPelaksanaan = null;
                $val_namaTeam = null;
                $val_fotoKegiatan = null;
            }
            $i++;
        }

        $filename='DATA test.xlsx'; 
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); 
        header('Cache-Control: max-age=0'); 
        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
        
        $objWriter->save('php://output');
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

    public function coba(){
        $this->load->view('coba');
    }

}