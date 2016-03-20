<?php
class buka_blokir extends master_controller  {
	function buka_blokir(){
		parent::__construct();
		$this->load->model("buka_model","bm");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		 
	}
	

function index(){ 
	$data_array['controller'] = get_class($this);
	 
	$content = $this->load->view($data_array['controller']."_view",$data_array,true);
		
	$this->set_subtitle("BUKA BLOKIR");
	$this->set_title("BUKA BLOKIR");
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

 
	
function get_detail_pendaftaran($vDAFT_ID){
	
	$arr = $this->cm->get_detail_pendaftaran($vDAFT_ID);
	//$arr['message'] = clear_array($arr['message']);
	echo json_encode($arr);
}


 

function simpan_blokir(){
	$data = $this->input->post();
	// show_array($data); exit;
	$userdata = $this->session->userdata("userdata");
	$user_level = $userdata['USER_LEVEL'];
 
	if($user_level >= 3){ // boleh 
		// bolleh
		$arr_pendaftaran = $this->cm->get_detail_pendaftaran($data['DAFT_ID']);
		$data['HB_BLOKIR'] = "1";
		$data['TGL_ENTRI'] = ora_date(date("d-m-Y"));
		$data['HB_PEMOHON'] = $arr_pendaftaran['NAMA_PENGAJUAN_LEASING'];
		$data['HB_ALAMATPEMOHON'] = $arr_pendaftaran['ALAMAT_PENGAJUAN_LEASING'];
		$data['OP_ID'] = $userdata['USER_ID'];
		$data['OPERATOR_NAMA'] = $userdata['USER_NAME'];
		$data['PRINTED'] = "0";
		$data['PIDANA'] = "0";  
		$data['HB_KOTAPMH'] = $userdata['LEASING_KOTA'];	
		$data['LEASING_ID'] = $userdata['LEASING_ID'];	
		$arr = $this->bm->simpan_blokir($data);
	}
	else {
		$arr = array("error"=>true,"message"=>"ANDA TIDAK PUNYA HAK AKSES UNTUK PROSES INI ".$user_level);
	}

	echo json_encode($arr);

}
 
	 
}
?>