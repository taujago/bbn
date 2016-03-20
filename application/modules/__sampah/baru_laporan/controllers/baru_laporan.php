<?php 
class baru_laporan extends master_controller {
	function baru_laporan(){
		parent::__construct();
		// $this->load->model("core_model","cm");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		$this->load->model("lapmodel","dm");



	}

	function index(){ 
		
		$userdata = $this->session->userdata("userdata");
		// $data_array['data'] = $this->dm->get_data($userdata['leasing_id']);
		 
		//show_array($data_array); exit;
		$data_array['controller'] = get_class($this);
		$data_array['arr_polda'] = $this->arr_dropdown("m_polda", "id_polda", "nama_polda", "no_urut");
		$data_array['arr_polda'] = $this->add_arr_head($data_array['arr_polda'],"x","- SEMUA POLDA - ");
		$data_array['arr_permohonan'] = $this->arr_permohonan();

		$content = $this->load->view("baru_laporan_view",$data_array,true);

		// $jenis = ($this->pilihan=="B")?"BARU":"LAMA";


		$this->set_subtitle("LAPORAN BLOKIR KENDARAAN");
		$this->set_title("LAPORAN BLOKIR KENDARAAN");
		$this->set_content($content);
		$this->render_baru();
	}

	 

 


function get_list_daftar(){
		$data = $this->input->post();
		$userdata = $this->session->userdata("userdata");
		$data['leasing_id'] = $userdata['leasing_id'];

		//$status = ($userdata['user_level'] == 1) ? 0:$userdata['user_level'] ;

		//$data['status'] = $status;
		// show_array($data); exit;
		// show_array($data);
		$arr = $this->dm->get_list_daftar($data);
		echo json_encode($arr);
}


function cetak(){
		$data = $this->input->get();
		$userdata = $this->session->userdata("userdata");
		$data['leasing_id'] = $userdata['leasing_id'];
		// $status = ($userdata['user_level'] == 1) ? 0:$userdata['user_level'] ;
		// $data['status'] = $status;
		$data['record'] = $this->dm->get_list_daftar_print($data);
		// echo $this->db->last_query(); 
		// exit;

		if($data['id_polda']=="x") {
			$data['nama_polda'] = "SEMUA POLDA";
		}
		else {
			$this->db->where("id_polda",$data['id_polda']);
			$data_polda = $this->db->get("m_polda")->row();
			$data['nama_polda'] = $data_polda->nama_polda;
		}
		

		if($data['jenis_permohonan']=="x"){
			$data['permohonan'] = 'SEMUA PERMOHONAN';

		}
		else {
			$data['permohonan'] = ($data['jenis_permohonan']=="B")?"KENDARAAN BARU":"KENDARAAN LAMA";
		}
		
		$data['userdata'] = $userdata ;

		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'F4', true, 'UTF-8', false);
		$pdf->SetTitle('BERITA ACARA PEMBLOKIRAN');
		$pdf->SetMargins(10, 10, 10);
		$pdf->SetHeaderMargin(10);
		$pdf->SetFooterMargin(10);
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', 10));

 		$pdf->SetAutoPageBreak(true,10);
		$pdf->SetAuthor('Author');
		 
			
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(true);

		$pdf->AddPage('L');
		 
		 //show_array($data); exit;
		 $html = $this->load->view("baru_laporan_pdf",$data,true);
		 // echo $html;
		 // exit;
		 $pdf->writeHTML($html, true, false, true, false, ''); 

		 $pdf->Output('laporan_blokir'. $this->session->userdata("tahun") .'.pdf', 'I');


}


function excel(){

	$data = $this->input->get();
	$userdata = $this->session->userdata("userdata");
	$data['leasing_id'] = $userdata['leasing_id'];
	// $status = ($userdata['user_level'] == 1) ? 0:$userdata['user_level'] ;
	// $data['status'] = $status;
	//$data['record'] = $this->dm->get_list_daftar_print($data);
	
	$record = $this->dm->get_list_daftar_print($data);

	$tanggal_awal = $data['tanggal_awal'];
	$tanggal_akhir = $data['tanggal_akhir'];

	if($data['id_polda']=="x") {
		$nama_polda = "SEMUA POLDA";
	}
	else {
		$this->db->where("id_polda",$data['id_polda']);
		$data_polda = $this->db->get("m_polda")->row();
		$nama_polda = $data_polda->nama_polda;
	}
	
	//show_array($data_polda); 
	// echo "nama polda $nama_polda <br />";
	// exit;

	if($data['jenis_permohonan']=="x"){
		$permohonan = 'SEMUA PERMOHONAN';

	}
	else {
		$permohonan  = ($data['jenis_permohonan']=="B")?"KENDARAAN BARU":"KENDARAAN LAMA";
	}
	
	$data['userdata'] = $userdata ;


    $this->load->library('Excel');
    $this->load->helper("excelformat");

    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('LaporanBlokirKendaraan');
    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
    $this->excel->getActiveSheet()->getColumnDimension('h')->setWidth(35);
    
    $this->excel->getActiveSheet()->getColumnDimension('i')->setWidth(30);
    $this->excel->getActiveSheet()->getColumnDimension('j')->setWidth(30);
    $this->excel->getActiveSheet()->getColumnDimension('k')->setWidth(30);
    $this->excel->getActiveSheet()->getColumnDimension('l')->setWidth(50);

    $arr_kolom = array('a','b','c','d','e','f','g','h','i','j','k','l');

    $baris = 1;
    $this->excel->getActiveSheet()->mergeCells('A'.$baris.':l'.$baris);
    $this->excel->getActiveSheet()
            ->setCellValue('a'.$baris, "LAPORAN BLOKIR KENDARAAN");

     $this->format_center(array("a"),$baris);

    $baris++;
    $this->excel->getActiveSheet()->mergeCells('A'.$baris.':l'.$baris);
     $this->excel->getActiveSheet()
            ->setCellValue('a'.$baris, $userdata['leasing_nama']);
    $this->format_center(array("a"),$baris);
     

    $baris++; 
    $baris++;

 
     $periode = (empty($tanggal_awal)) ? "SEMUA PERIODE": $tanggal_awal." s.d ".$tanggal_akhir;

     $this->excel->getActiveSheet()->setCellValue('a'.$baris, "PERIODE");
     $this->excel->getActiveSheet()->setCellValue('C'.$baris, ": ". $periode);
     $baris++;

     $this->excel->getActiveSheet()->setCellValue('a'.$baris, "JENIS PERMOHONAN");
     $this->excel->getActiveSheet()->setCellValue('c'.$baris, ": ".$permohonan); 
            
     $baris++;
     
     $this->excel->getActiveSheet()->setCellValue('a'.$baris, "POLDA");
     $this->excel->getActiveSheet()->setCellValue('c'.$baris, ": ".$nama_polda);         
     $baris++;

     $arr_status = $this->cm->arr_status2;
     $status_name = $arr_status[$data['status']];
     // echo "Status $status_name <br />"; exit;

     $this->excel->getActiveSheet()->setCellValue('a'.$baris, "STATUS");
     $this->excel->getActiveSheet()->setCellValue('c'.$baris, ": ". strtoupper($status_name));         
     $baris++;

     $baris++;
     $this->excel->getActiveSheet()->setCellValue('a'.$baris, "NO.");
     $this->excel->getActiveSheet()->setCellValue('B'.$baris, "TGL. DAFTAR");
     $this->excel->getActiveSheet()->setCellValue('C'.$baris, "CABANG");
	 
	 $this->excel->getActiveSheet()->setCellValue('D'.$baris, "NO. POLISI");
     $this->excel->getActiveSheet()->setCellValue('E'.$baris, "NO. RANGKA");
     $this->excel->getActiveSheet()->setCellValue('F'.$baris, "NO.BPKB");
     $this->excel->getActiveSheet()->setCellValue('G'.$baris, "TGL.BPKB");

     $this->excel->getActiveSheet()->setCellValue('H'.$baris, "NAMA PEMOHON");
     $this->excel->getActiveSheet()->setCellValue('I'.$baris, "NO. BLOKIR");
     $this->excel->getActiveSheet()->setCellValue('J'.$baris, "TGL. BLOKIR");
     $this->excel->getActiveSheet()->setCellValue('K'.$baris, "JENIS / MERK");

     $this->excel->getActiveSheet()->setCellValue('L'.$baris, "STATUS");
     $this->format_header($arr_kolom,$baris) ;
     $baris++;

     $no = 0;
     foreach($record->result() as $row) : 
     $no++;
     $this->excel->getActiveSheet()->setCellValue('a'.$baris, $no);
     $this->excel->getActiveSheet()->setCellValue('B'.$baris, $row->daft_date);
     $this->excel->getActiveSheet()->setCellValue('C'.$baris, $row->cabang_nama);
	 
	 $this->excel->getActiveSheet()->setCellValue('D'.$baris, $row->no_polisi);
     $this->excel->getActiveSheet()->setCellValue('E'.$baris, $row->no_rangka);
     $this->excel->getActiveSheet()->setCellValue('F'.$baris, $row->no_bpkb);
     $this->excel->getActiveSheet()->setCellValue('G'.$baris, $row->tgl_bpkb);

     $this->excel->getActiveSheet()->setCellValue('H'.$baris, $row->nama_pengajuan_leasing);
     $this->excel->getActiveSheet()->setCellValue('I'.$baris, $row->no_blokir);
     $this->excel->getActiveSheet()->setCellValue('J'.$baris, $row->tgl_blokir);
     $this->excel->getActiveSheet()->setCellValue('K'.$baris, $row->jenis_nama." / ".$row->merk_nama );

     $this->excel->getActiveSheet()->setCellValue('L'.$baris, $row->approved2);
     $this->format_baris($arr_kolom,$baris) ;
     $baris++;

/*
 <td width="6%" scope="col"><?php echo $row->daft_date; ?></td>
    <td width="8%" scope="col"><?php echo $row->cabang_nama; ?></td>
    <td width="6%" scope="col"><?php echo $row->no_polisi; ?></td>
    <td width="10%" scope="col"><?php echo $row->no_rangka; ?></td>
    <td width="6%" scope="col"><?php echo $row->no_bpkb; ?></td>
    <td width="6%" scope="col"><?php echo $row->tgl_bpkb; ?></td>
    <td width="13%" scope="col"><?php echo $row->nama_pengajuan_leasing; ?></td>
    <td width="12%" scope="col"><?php  echo $row->no_blokir; ?></td>
    <td width="6%" scope="col"><?php echo $row->tgl_blokir; ?></td>
    <td width="10%" scope="col"><?php echo $row->jenis_nama."<br />".$row->merk_nama; ?></td>
    <td width="13%" scope="col"><?php echo $row->approved2; ?></td>
*/

     endforeach;

     //$filename = "Laporan Blokir ".$tanggal_awal." s.d ".$tanggal_akhir.".xlsx";
     $filename = "Laporan Blokir ".$status_name." ". date("dmYhis").".xlsx";
     $filename = str_replace(" ", "_", $filename);
    //   exit;




    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cache
                  
     //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
     //if you want to save it as .XLSX Excel 2007 format
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
     //force user to download the Excel file without writing it to server's HD
    $objWriter->save('php://output');



}


}
?>