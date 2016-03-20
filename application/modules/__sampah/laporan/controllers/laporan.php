<?php
class laporan extends master_controller  {
	function laporan(){
		parent::__construct();
		$this->load->model("lap_model","bm");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		 
	}
	

function daftar(){

	$data=$this->session->userdata("userdata");
	$data['controller'] = get_class($this);
	$data['method'] = "daftar_list";
	$data['arr_leasing'] = $this->cm->arr_dropdown("M_LEASING", "LEASING_ID", "LEASING_NAMA", "LEASING_NAMA");
	 
	$content = $this->load->view("daftar/daftar_view",$data,true);
		
	$this->set_subtitle("LAPORAN PENDAFTAAN");
	$this->set_title("LAPORAN PENDAFTAAN");
	$this->set_content($content);
	$this->render();
}




function daftar_list(){
	$userdata=$this->session->userdata("userdata");
	$data = $this->input->post();
	$data['TGL_DAFTAR1'] = ora_date($data['TGL_DAFTAR1']);
	$data['TGL_DAFTAR2'] = ora_date($data['TGL_DAFTAR2']);

	if($userdata['USER_LEVEL'] == 0  or $userdata['USER_LEVEL']== 99){
		$data['LEASING_ID'] = $data['LEASING_ID'];
	}
	else {
		$data['LEASING_ID'] = $userdata['LEASING_ID'];
	}

	$res = $this->bm->daftar_list($data); 


		if($res->num_rows() > 0) 
		{

			foreach($res->result_array() as $val) : 
			$arr[]=array($val['DAFT_ID'],
				$val['NO_BPKB'],
				$val['NO_RANGKA'],
				$val['NO_MESIN'],
				$val['NAMA_PEMILIK'],
				$val['DAFT_DATE'],
				$val['VERIFIKASI_DATE']
				 
				);

			endforeach;
			$ret = array("error"=>false,"message"=>$arr);
		}
		else {
			$ret = array("error"=>true,"message"=>"DATA TIDAK DITEMUKAN");
		}
		echo json_encode($ret);

}

function daftar_cetak(){
	$userdata=$this->session->userdata("userdata");
	$data=$this->input->get();
	$data['TGL_DAFTAR1'] = ora_date($data['TGL_DAFTAR1']);
	$data['TGL_DAFTAR2'] = ora_date($data['TGL_DAFTAR2']);

	if($userdata['USER_LEVEL'] == 0  or $userdata['USER_LEVEL']== 99){
		$data['LEASING_ID'] = $data['LEASING_ID'];
	}
	else {
		$data['LEASING_ID'] = $userdata['LEASING_ID'];
	}

	$res = $this->bm->daftar_list($data); 
	$data['record'] = $res;

	// get data leasing 

	$data['leasing'] = $this->cm->get_detail("M_LEASING",'LEASING_ID',$data['LEASING_ID']);

	// PDF PROCESSING 
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
		 $html = $this->load->view("daftar/daftar_pdf",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');

		 


		  

		 $pdf->Output('Buku Pajak'. $this->session->userdata("tahun") .'.pdf', 'I');

}

//////////// 
// LEPAS .. 


function lepas(){

	$data=$this->session->userdata("userdata");
	$data['controller'] = get_class($this);
	$data['method'] = "lepas_list";
	$data['arr_leasing'] = $this->cm->arr_dropdown("M_LEASING", "LEASING_ID", "LEASING_NAMA", "LEASING_NAMA");
	 
	$content = $this->load->view("lepas/lepas_view",$data,true);
		
	$this->set_subtitle("LAPORAN LEPAS PENDAFTAAN");
	$this->set_title("LAPORAN LEPAS PENDAFTAAN");
	$this->set_content($content);
	$this->render();
}




function lepas_list(){
	$userdata=$this->session->userdata("userdata");
	$data = $this->input->post();
	$data['TGL_DAFTAR1'] = ora_date($data['TGL_DAFTAR1']);
	$data['TGL_DAFTAR2'] = ora_date($data['TGL_DAFTAR2']);

	if($userdata['USER_LEVEL'] == 0  or $userdata['USER_LEVEL']== 99){
		$data['LEASING_ID'] = $data['LEASING_ID'];
	}
	else {
		$data['LEASING_ID'] = $userdata['LEASING_ID'];
	}

	$res = $this->bm->lepas_list($data); 


		if($res->num_rows() > 0) 
		{

			foreach($res->result_array() as $val) : 
			$arr[]=array($val['DAFT_ID'],
				$val['NO_BPKB'],
				$val['NO_RANGKA'],
				$val['NO_MESIN'],
				$val['NAMA_PEMILIK'],
				$val['DAFT_DATE'],
				$val['VERIFIKASI_DATE']
				 
				);

			endforeach;
			$ret = array("error"=>false,"message"=>$arr);
		}
		else {
			$ret = array("error"=>true,"message"=>"DATA TIDAK DITEMUKAN");
		}
		echo json_encode($ret);

}

function lepas_cetak(){
	$userdata=$this->session->userdata("userdata");
	$data=$this->input->get();
	$data['TGL_DAFTAR1'] = ora_date($data['TGL_DAFTAR1']);
	$data['TGL_DAFTAR2'] = ora_date($data['TGL_DAFTAR2']);

	if($userdata['USER_LEVEL'] == 0  or $userdata['USER_LEVEL']== 99){
		$data['LEASING_ID'] = $data['LEASING_ID'];
	}
	else {
		$data['LEASING_ID'] = $userdata['LEASING_ID'];
	}

	$res = $this->bm->lepas_list($data); 
	$data['record'] = $res;

	// get data leasing 

	$data['leasing'] = $this->cm->get_detail("M_LEASING",'LEASING_ID',$data['LEASING_ID']);

	// PDF PROCESSING 
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
		 $html = $this->load->view("lepas/lepas_pdf",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');

		 


		  

		 $pdf->Output('Buku Pajak'. $this->session->userdata("tahun") .'.pdf', 'I');

}



//////////// 
// BLOKIR .. 


function blokir(){

	$data=$this->session->userdata("userdata");
	$data['controller'] = get_class($this);
	$data['method'] = "blokir_list";
	$data['arr_leasing'] = $this->cm->arr_dropdown("M_LEASING", "LEASING_ID", "LEASING_NAMA", "LEASING_NAMA");
	 
	$content = $this->load->view("blokir/blokir_view",$data,true);
		
	$this->set_subtitle("LAPORAN BLOKIR KENDARAAN");
	$this->set_title("LAPORAN BLOKIR KENDARAAN");
	$this->set_content($content);
	$this->render();
}




function blokir_list(){
	$userdata=$this->session->userdata("userdata");
	$data = $this->input->post();
	$data['TGL_DAFTAR1'] = ora_date($data['TGL_DAFTAR1']);
	$data['TGL_DAFTAR2'] = ora_date($data['TGL_DAFTAR2']);

	if($userdata['USER_LEVEL'] == 0  or $userdata['USER_LEVEL']== 99){
		$data['LEASING_ID'] = $data['LEASING_ID'];
	}
	else {
		$data['LEASING_ID'] = $userdata['LEASING_ID'];
	}

	$res = $this->bm->blokir_list($data); 


		if($res->num_rows() > 0) 
		{

			foreach($res->result_array() as $val) : 
			$arr[]=array($val['DAFT_ID'],
				$val['NO_BPKB'],
				$val['NO_RANGKA'],
				$val['NO_MESIN'],
				$val['NAMA_PEMILIK'],
				$val['DAFT_DATE'],
				$val['VERIFIKASI_DATE']
				 
				);

			endforeach;
			$ret = array("error"=>false,"message"=>$arr);
		}
		else {
			$ret = array("error"=>true,"message"=>"DATA TIDAK DITEMUKAN");
		}
		echo json_encode($ret);

}

function blokir_cetak(){
	$userdata=$this->session->userdata("userdata");
	$data=$this->input->get();
	$data['TGL_DAFTAR1'] = ora_date($data['TGL_DAFTAR1']);
	$data['TGL_DAFTAR2'] = ora_date($data['TGL_DAFTAR2']);

	if($userdata['USER_LEVEL'] == 0  or $userdata['USER_LEVEL']== 99){
		$data['LEASING_ID'] = $data['LEASING_ID'];
	}
	else {
		$data['LEASING_ID'] = $userdata['LEASING_ID'];
	}

	$res = $this->bm->blokir_list($data); 
	$data['record'] = $res;

	// get data leasing 

	$data['leasing'] = $this->cm->get_detail("M_LEASING",'LEASING_ID',$data['LEASING_ID']);

	// PDF PROCESSING 
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
		 $html = $this->load->view("blokir/blokir_pdf",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');

		 


		  

		 $pdf->Output('laporan blokir'. $this->session->userdata("tahun") .'.pdf', 'I');

}



//////////// 
// BUKA BLOKIR .. 


function buka(){

	$data=$this->session->userdata("userdata");
	$data['controller'] = get_class($this);
	$data['method'] = "buka_list";
	$data['arr_leasing'] = $this->cm->arr_dropdown("M_LEASING", "LEASING_ID", "LEASING_NAMA", "LEASING_NAMA");
	 
	$content = $this->load->view("buka/buka_view",$data,true);
		
	$this->set_subtitle("LAPORAN BUKA BLOKIR KENDARAAN");
	$this->set_title("LAPORAN BUKA BLOKIR KENDARAAN");
	$this->set_content($content);
	$this->render();
}




function buka_list(){
	$userdata=$this->session->userdata("userdata");
	$data = $this->input->post();
	$data['TGL_DAFTAR1'] = ora_date($data['TGL_DAFTAR1']);
	$data['TGL_DAFTAR2'] = ora_date($data['TGL_DAFTAR2']);

	if($userdata['USER_LEVEL'] == 0  or $userdata['USER_LEVEL']== 99){
		$data['LEASING_ID'] = $data['LEASING_ID'];
	}
	else {
		$data['LEASING_ID'] = $userdata['LEASING_ID'];
	}

	$res = $this->bm->buka_list($data); 


		if($res->num_rows() > 0) 
		{

			foreach($res->result_array() as $val) : 
			$arr[]=array($val['DAFT_ID'],
				$val['NO_BPKB'],
				$val['NO_RANGKA'],
				$val['NO_MESIN'],
				$val['NAMA_PEMILIK'],
				$val['DAFT_DATE'],
				$val['BLOKIR_DATE']
				 
				);

			endforeach;
			$ret = array("error"=>false,"message"=>$arr);
		}
		else {
			$ret = array("error"=>true,"message"=>"DATA TIDAK DITEMUKAN");
		}
		echo json_encode($ret);

}

function buka_cetak(){
	$userdata=$this->session->userdata("userdata");
	$data=$this->input->get();
	$data['TGL_DAFTAR1'] = ora_date($data['TGL_DAFTAR1']);
	$data['TGL_DAFTAR2'] = ora_date($data['TGL_DAFTAR2']);

	if($userdata['USER_LEVEL'] == 0  or $userdata['USER_LEVEL']== 99){
		$data['LEASING_ID'] = $data['LEASING_ID'];
	}
	else {
		$data['LEASING_ID'] = $userdata['LEASING_ID'];
	}

	$res = $this->bm->buka_list($data); 
	$data['record'] = $res;

	// get data leasing 

	$data['leasing'] = $this->cm->get_detail("M_LEASING",'LEASING_ID',$data['LEASING_ID']);

	// PDF PROCESSING 
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
		 $html = $this->load->view("buka/buka_pdf",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');

		 


		  

		 $pdf->Output('laporan blokir'. $this->session->userdata("tahun") .'.pdf', 'I');

}


	 
}
?>