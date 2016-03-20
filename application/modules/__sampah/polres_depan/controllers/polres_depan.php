<?php
class polres_depan extends master_controller  {
	function polres_depan(){
		parent::__construct();
		$this->load->model("coremodel","cm");
		$this->load->model("vmodel","vm");
		$this->load->helper("tanggal");
		 
	}
	

function index(){
	$data_array['controller'] = get_class($this);
	 
	$content = $this->load->view("polres_depan_view",$data_array,true);
		
	$this->set_subtitle("POLRES " . $this->session->userdata('nama_polres'));
	$this->set_title("POLRES " . $this->session->userdata('nama_polres'));
	$this->set_content($content);
	$this->render_polres();
}


function get_data(){
		$userdata = $this->session->userdata("userdata");

		$data = $this->input->post();
		
		$arr = $this->cm->get_detail_kendaraan($data['v_is_cari'],$data['v_cari']) ;
		//echo $this->db->last_query();
			 

	    //show_array($arr); exit;

		echo json_encode($arr);
	}
	 
	
	
	function inq_get_list_daftar(){
		 
		$data = $this->input->post();
		$userdata = $this->session->userdata("userdata");
		
		$tanggal = str_replace("-","",flipdate($data['vTGL_DAFTAR']));
		 
		$arr= $this->vm->get_data($data['vLEASING_ID'],$tanggal);
		echo json_encode($arr);
		//show_array($arr); exit;

		// $service['method']='inq_get_list_daftar';
		// $service['debug']='1';
		// $service['vTGL_DAFTAR']= str_replace("-","",flipdate($data['vTGL_DAFTAR']));
		// $service['vLEASING_ID']= $data['vLEASING_ID'];
		 
		// $url = service_url($service);
		// //echo $url; exit;
		// $xml = file_get_contents($url);
		// $arr = xml_to_array($xml);
		
		// if($arr['error'] == "true") {
		// echo json_encode($arr);		
		// }
		// else {
		// 	if(!isset($arr['message']['inq_bpkb'][0])) { 
			
		// 	$arr['message']['inq_bpkb']  = array($arr['message']['inq_bpkb']);
		// 	}
		// 	//show_array($arr);
		// 	foreach($arr['message']['inq_bpkb'] as $index => $val ) :
		// 		//
		// 		$ret[]=array($val['DAFT_ID'],
		// 		"<a href='#' onclick='detail(\"".$val['NO_BPKB']."\",\"".$val['DAFT_ID']."\")'>".$val['NO_BPKB']."</a>",$val['NO_MESIN'],$val['NO_RANGKA']);
		// 	endforeach;
		// 	//show_array($ret);  exit;
		// 	$r=array("error"=>false,"message"=>array("data"=>$ret));
		 
		// 	echo json_encode($r);
		// }
		
		
	}
	
function get_detail_pendaftaran($vDAFT_ID){
	
	$arr = $this->cm->get_detail_pendaftaran($vDAFT_ID);
	//$arr['message'] = clear_array($arr['message']);
	echo json_encode($arr);
}


function simpan(){
	$userdata = $this->session->userdata("userdata");
	$data = $this->input->post();
	$data['polres_depan_BY'] = $userdata['USER_ID'];
	 
	if($data['IS_VERIFIED'] == "1" and $data['STATUS'] <> 'AKTIF') {
		$ret = array("error"=>true,"message"=>"STATUS KENDARAAN TIDAK BISA UNTUK DIpolres_depan");
	}
	else {
		$ret = $this->vm->simpan($data);
	}
	
	echo json_encode($ret);	
	
}
	 
}
?>