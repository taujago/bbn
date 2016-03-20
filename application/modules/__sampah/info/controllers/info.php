<?php
class info extends master_controller  {
	function info(){
		parent::__construct();
		$this->load->model("coremodel","cm");
		 
	}
	
	 
	
	function cekdata(){
		$data = $this->input->post();
		$userdata = $this->session->userdata("userdata");
		$service['method']='inq_get_bpkb';
		$service['debug']='true';
		$service['vNO_BPKB']=$data['vNO_BPKB'];
		$service['vLEASING_ID']=$userdata['LEASING_ID'];
		$service['vINQ_BY']=$userdata['USER_ID'];
		$url = service_url($service);
		$xml = file_get_contents($url);
		$arr = xml_to_array($xml);
		echo json_encode($arr['message']['inq_bpkb']);
		
		
	}
	
	function get_data(){
		$userdata = $this->session->userdata("userdata");

		$data = $this->input->post();
		
		$arr = ($userdata['USER_LEVEL'] == '0' or $userdata['USER_LEVEL'] =="99")?
			 $this->cm->get_detail_kendaraan($data['v_is_cari'],$data['v_cari']) : 
			 $this->cm->get_detail_kendaraan_pendaftaran($data['v_is_cari'],$data['v_cari']);

	    //show_array($arr); exit;

		echo json_encode($arr);
	}
	
	
	
	
	function index(){
		 
		$data_array['controller'] = 'info';
		$content = $this->load->view("info_view",$data_array,true);
		
		$this->set_subtitle("INFORMASI DATA");
		$this->set_title("INFORMASI DATA");
		$this->set_content($content);
		$this->render();
	}
	
	
	
	
	 
	
	 
}
?>