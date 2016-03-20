<?php
class user_polres extends master_controller  {
	function user_polres(){
		parent::__construct();
		$this->load->model("upmodel","um");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		 
	}
	
	
	function index(){
		
		
		 
		 
		//show_array($data_array['data']); exit;
		$data_array['data'] = $this->um->get_data();
		$data_array['controller'] = 'user_polres';
		$data_array['arr_polda'] = $this->cm->arr_dropdown("tiger_provinsi", "id", "provinsi", "provinsi");
		//show_array($data_array);
		$content = $this->load->view("user_polres_view",$data_array,true);
		
		$this->set_subtitle("DATA USER POLRES");
		$this->set_title("DATA USER POLRES ");
		$this->set_content($content);
		$this->render();
	}
	
	
	
	
	
	function baru(){
		$data['action']="simpan";
		$data['mode']="I";
		$data['controller'] = 'user_polres';
		
		/*$data['arr_leasing'] = $this->get_arr_leasing();
		$data['arr_level'] = $this->get_arr_level();*/
		
		//exit;
		$data['arr_polda'] = $this->cm->arr_dropdown("tiger_provinsi", "id", "provinsi", "provinsi");
		
		$content = $this->load->view("user_polres_view_form",$data,true);
		
		$this->set_subtitle("INPUT DATA USER POLRES");
		$this->set_title("DATA USER POLRES ");
		$this->set_content($content);
		$this->render();
	}
	
	function edit($id){
		
		
		
		// $service_data['method'] = 'user_leasing_get_detail';
		// $service_data['debug'] = 1;
		// $service_data['vUSER_ID'] = $id;
		// $xml = file_get_contents(service_url($service_data));
		$arr = $this->um->get_user_detail($id);
		$data = $arr['message'];
		
		// show_array($data);
		$data['action']="update";
		$data['mode']="U";
		$data['controller'] = 'user_polres';
		//show_array($data);exit;
		$data['arr_polda'] = $this->cm->arr_dropdown("tiger_provinsi", "id", "provinsi", "provinsi");
		 
		$content = $this->load->view("user_polres_view_form",$data,true);
		
		$this->set_subtitle("EDIT DATA USER");
		$this->set_title("DATA USER");
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
			 unset($data['id_polda']);
			 unset($data['mode']);
			 unset($data['user_password2']);
			 $data['user_password'] = md5($data['user_password']);
			 $data['lastupdate'] = ora_date( date("d-m-Y") );
			 $data['user_level'] = "88";
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
			 unset($data['id_polda']);

			 if(!empty($data['user_password'] )) {
			 	 $data['user_password'] = md5($data['user_password']);
			 }
			 else {
			 	unset($data['user_password']);
			 }

			 $this->db->where("user_id",$data['user_id']);
			 $res = $this->db->update("t_user",$data);
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
			 $this->db->where("USER_ID",$id);
			 $res = $this->db->delete("T_USER");
			 if($res){
			 	$ret = array("error"=>false,"message"=>"Data berhasi dihapus" );
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>$this->db->_error_message());
			 }
			 echo json_encode($ret);
	}
	
	 
	
	
	 
}
?>