<?php
class User_leasing extends master_controller  {
	function User_leasing(){
		parent::__construct();
		$this->load->model("ulmodel","um");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		//$this->load->model("Ulmodel");
	}
	
	
	function index(){
		
		
 		$data_array['data'] = $this->um->get_data();
		$data_array['controller'] = 'user_leasing';
		$content = $this->load->view("user_leasing_view",$data_array,true);
		
		$this->set_subtitle("DATA USER LEASING");
		$this->set_title("DATA USER LEASING");
		$this->set_content($content);
		$this->render();
	}
	
	
	
	
	
	function baru(){
		$data['action']="simpan";
		$data['mode']="I";
		$data['controller'] = 'user_leasing';
		

		$data['arr_leasing'] = $this->cm->arr_dropdown("m_leasing", "leasing_id", "leasing_nama", "leasing_nama");
		$data['arr_level'] = $this->cm->arr_level();
		// $data['arr_leasing'] = $this->get_arr_leasing();
		// $data['arr_level'] = $this->get_arr_level();
		
		//exit;
		
		$content = $this->load->view("user_leasing_view_form",$data,true);
		
		$this->set_subtitle("INPUT DATA USER LEASING");
		$this->set_title("DATA USER LEASING");
		$this->set_content($content);
		$this->render();
	}
	
	function edit($id){
		
		
		
		// $service_data['method'] = 'user_leasing_get_detail';
		// $service_data['debug'] = 1;
		// $service_data['vUSER_ID'] = $id;
		// $xml = file_get_contents(service_url($service_data));
		// $arr = xml_to_array($xml);
		$arr = $this->um->get_user_leasing_detail($id);
		$data = $arr['message'];
		
		$data['action']="update";
		$data['mode']="U";
		$data['controller'] = 'user_leasing';
		//show_array($data);exit;
		$data['arr_leasing'] = $this->cm->arr_dropdown("m_leasing", "leasing_id", "leasing_nama", "leasing_nama");
		$data['arr_level'] = $this->cm->arr_level();
		$content = $this->load->view("user_leasing_view_form",$data,true);
		
		$this->set_subtitle("EDIT DATA USER LEASING");
		$this->set_title("DATA LEASING");
		$this->set_content($content);
		$this->render();
	}
	
	
	function cekpass($pass){
		if(empty($pass)) {
			$this->form_validation->set_message('cekpass', ' Password  Harus diisi ');
			return false;
		}
		
		if($pass <> $_POST['user_password2']) {
			$this->form_validation->set_message('cekpass', ' Password  Harus sama ');
			return false;
		}
		 
	}
	
	
	function simpan(){
		$data=$this->input->post();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_name','Nama user','required');
 		$this->form_validation->set_rules('user_password','Password','callback_cekpass');
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			 
			 unset($data['user_id']);
			 unset($data['mode']);
			 unset($data['user_password2']);
			 $data['user_password'] = md5($data['user_password']);
			 $data['lastupdate'] = date('Y-m-d h:i:s');
			 $res = $this->db->insert("t_user",$data);
			 if($res){
			 	$ret = array("error"=>false,"message"=>"Data berhasi disimpan" );
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>$this->db->_error_message());
			 }
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
		
		
		//$data['method']='simpan_leasing';
	}
	
	
	
	function cekpass2($pass){
		 
		
		if($pass <> $_POST['user_password2']) {
			$this->form_validation->set_message('cekpass', ' Password  Harus sama ');
			return false;
		}
		 
	}
	
	function update(){
		$data=$this->input->post();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_name','Nama user','required');
 		$this->form_validation->set_rules('user_password','Password','callback_cekpass2');
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
		
		 	 
			 unset($data['mode']);
			 unset($data['user_password2']);
			 $data['lastupdate'] = date('Y-m-d h:i:s');

			 if(!empty($data['user_password'] )) {
			 	 $data['user_password'] = md5($data['user_password']);
			 }
			 else {
			 	unset($data['user_password']);
			 }

			 $this->db->where("user_id",$data['user_id']);
			 $res = $this->db->update("t_user",$data);
			 // echo $this->db->last_query(); exit;
			 if($res){
			 	$ret = array("error"=>false,"message"=>"Data berhasi disimpan" );
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>$this->db->_error_message());
			 }
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
	}
	
	
	
	function hapus($id) {
			 $this->db->where("user_id",$id);
			 $res = $this->db->delete("t_user");
			 if($res){
			 	$ret = array("error"=>false,"message"=>"Data berhasi dihapus" );
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>$this->db->_error_message());
			 }
			 echo json_encode($ret);
	}
	
	
	function get_data_leasing(){
		//$data['method']='get_data_leasing';
		$url = 'http://192.168.1.2/leasingservice/api_service.php?debug=1&method=add_edit_leasing&vLEASING_NAMA=Abadi Jaya Motor&vLEASING_ALAMAT=Jl Pratama No. 434&vLEASING_KOTA=Jogjakarta&vLEASING_TELP=0813243535356&vLEASING_FAX=0274 - 1214141151'; 
		
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		 $output = curl_exec($ch);
		 echo $output;
		echo $url."<br />";
		//$xml = file_get_contents($url);
		//echo $xml;
		
		/*$arr = xml_to_array($xml);
		echo "<pre>"; print_r($arr); echo "</pre>";*/
	}
	
	
	 
}
?>