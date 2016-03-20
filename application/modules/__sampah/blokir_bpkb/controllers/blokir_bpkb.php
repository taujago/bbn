<?php
class blokir_bpkb extends master_controller  {
	function blokir_bpkb(){
		parent::__construct();
		$this->load->model("blokir_model","bm");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		 
	}
	

function index(){ 
	$data_array['controller'] = get_class($this);
	 
	$content = $this->load->view($data_array['controller']."_view",$data_array,true);
		
	$this->set_subtitle("BLOKIR  BPKB");
	$this->set_title("BLOKIR BPKB");
	$this->set_content($content);
	$this->render();
}
	 
	
	function get_list_daftar(){
		$data = $this->input->post();
		$userdata = $this->session->userdata("userdata");
		$data['LEASING_ID'] = $userdata['LEASING_ID'];
		$arr = $this->bm->get_list_daftar($data);
		echo json_encode($arr);


	}


function verifikasi_level2(){
	$data = $this->input->post();
	$userdata = $this->session->userdata("userdata");
	$data['LEASING_ID'] = $userdata['LEASING_ID'];
	$data['VERIFIKASI_DATE'] = ora_date(date("d-m-Y"));
	$data['VERIFIKASI_BY'] = $userdata['USER_ID'];
	$user_level = $userdata['USER_LEVEL'];

	// cek hanyya user yang level 2 ke atas yang bisa proses ini. 
	if($user_level >= 2){ // boleh 
		// bolleh
		$arr = $this->bm->verifikasi_level2($data);
	}
	else {
		$arr = array("error"=>true,"message"=>"ANDA TIDAK PUNYA HAK AKSES UNTUK PROSES INI");
	}

	echo json_encode($arr);
}

function verifikasi_level3(){
	$data = $this->input->post();
	$userdata = $this->session->userdata("userdata");
	$data['LEASING_ID'] = $userdata['LEASING_ID'];
	$data['VERIFIKASI_DATE'] = ora_date(date("d-m-Y"));
	$data['VERIFIKASI_BY'] = $userdata['USER_ID'];
	$user_level = $userdata['USER_LEVEL'];

	// cek hanyya user yang level 2 ke atas yang bisa proses ini. 
	if($user_level >= 3){ // boleh 
		// bolleh
		$arr = $this->bm->verifikasi_level3($data);
	}
	else {
		$arr = array("error"=>true,"message"=>"ANDA TIDAK PUNYA HAK AKSES UNTUK PROSES INI");
	}

	echo json_encode($arr);
}
	
	
function get_detail_pendaftaran($vDAFT_ID){
	
	$arr = $this->cm->get_detail_pendaftaran($vDAFT_ID);
	//$arr['message'] = clear_array($arr['message']);
	echo json_encode($arr);
}



function cek_blokir(){
	$data = $this->input->post();
	$arr_pendaftaran = $this->cm->get_detail_pendaftaran($data['DAFT_ID']);
	if($arr_pendaftaran['DAFT_LEVEL3_DATE'] ==""){
		$arr = array("error"=>true,"message"=>"BELUM VERIFIKASI LEVEL 3");
	}
	else {
		$arr = array("error"=>false,"message"=>"ANDA TIDAK PUNYA HAK AKSES UNTUK PROSES INI");
	}
	echo json_encode($arr);
}


function simpan_blokir(){
	$data = $this->input->post();
	$userdata = $this->session->userdata("userdata");
	$user_level = $userdata['USER_LEVEL'];
	//echo "user level = $user_level "; exit;

	if($user_level >= 3){ // boleh 
		// bolleh
		$arr_pendaftaran = $this->cm->get_detail_pendaftaran($data['DAFT_ID']);
		$data['HB_BLOKIR'] = "0";
		$data['TGL_ENTRI'] = ora_date(date("d-m-Y"));
		$data['HB_PEMOHON'] = $arr_pendaftaran['NAMA_PENGAJUAN_LEASING'];
		$data['HB_ALAMATPEMOHON'] = $arr_pendaftaran['ALAMAT_PENGAJUAN_LEASING'];
		$data['OP_ID'] = $userdata['USER_ID'];
		$data['OPERATOR_NAMA'] = $userdata['USER_NAME'];
		$data['PRINTED'] = "0";
		$data['PIDANA'] = "0";  
		$data['HB_KOTAPMH'] = $userdata['LEASING_KOTA'];	
		$data['LEASING_ID'] = $userdata['LEASING_ID'];	
		$data['JENIS_BLOKIR'] = "2";
		$arr = $this->bm->simpan_blokir($data);
	}
	else {
		$arr = array("error"=>true,"message"=>"ANDA TIDAK PUNYA HAK AKSES UNTUK PROSES INI ".$user_level);
	}

	echo json_encode($arr);

}

function cetak($id){
		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'F4', true, 'UTF-8', false);
		$pdf->SetTitle('BERITA ACARA PEMBLOKIRAN');
		$pdf->SetMargins(10, 30, 10);
		$pdf->SetHeaderMargin(10);
		$pdf->SetFooterMargin(10);
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', 10));

 		$pdf->SetAutoPageBreak(true,10);
		$pdf->SetAuthor('Author');
		 
			
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(true);

		$pdf->AddPage();
		$data_pendaftaran = $this->cm->get_detail_pendaftaran($id);

		 $data_kendaraan = $this->cm->get_detail_kendaraan("2",$data_pendaftaran['NO_BPKB']);
		 $data_kendaraan = $data_kendaraan['message'];

		 $data_blokir = $this->bm->get_blokir($id);

		 $data = array_merge($data_kendaraan,$data_pendaftaran);
		 $data = array_merge($data,$data_blokir);
		 //show_array($data); exit;
		 $html = $this->load->view("cetak/halaman1",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');

		 


		  

		 $pdf->Output('Buku Pajak'. $this->session->userdata("tahun") .'.pdf', 'I');
}


function cetak_level2($id){
		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'F4', true, 'UTF-8', false);
		$pdf->SetTitle('BERITA ACARA PEMBLOKIRAN');
		$pdf->SetMargins(10, 30, 10);
		$pdf->SetHeaderMargin(10);
		$pdf->SetFooterMargin(10);
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', 10));

 		$pdf->SetAutoPageBreak(true,10);
		$pdf->SetAuthor('Author');
		 
			
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(true);

		$pdf->AddPage();
		$data_pendaftaran = $this->cm->get_detail_pendaftaran($id);

		// show_array($data_pendaftaran); exit;

		 $data_kendaraan = $this->cm->get_detail_kendaraan("1",$data_pendaftaran['NO_RANGKA']);
		 $data_kendaraan = $data_kendaraan['message'];
		 //show_array($data_kendaraan); exit;

		 $data = array_merge($data_kendaraan,$data_pendaftaran);
		 //show_array($data); exit;
		 $html = $this->load->view("cetak/halaman2",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');

		 //$pdf->AddPage();


		  

		 $pdf->Output('DOKUMEN'. $data['NO_BPKB'] .'.pdf', 'I');
}

	 
}
?>