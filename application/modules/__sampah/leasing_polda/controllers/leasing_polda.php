<?php
class leasing_polda extends master_controller  {
	function leasing_polda(){
		parent::__construct();
		$this->load->model("lp_model","lm"); 
		$this->load->model("coremodel","cm");
	}
	
	
	function index(){
		
		$userdata = $this->session->userdata("userdata");
		$data_array['record'] = $this->lm->get_data_leasing();
		$data_array['controller'] = get_class($this);
		$content = $this->load->view("leasing_polda_view",$data_array,true);
		
		$this->set_subtitle("DATA AUTHENTIKASI LEASING POLDA");
		$this->set_title("DATA AUTHENTIKASI LEASING POLDA");
		$this->set_content($content);
		$this->render();
	}
	
	function baru(){
		$data['action']="simpan";
		$data['mode']="I";
		$data['controller'] = get_class($this);

		$data['arr_leasing'] = $this->cm->arr_dropdown("m_leasing", "leasing_id", "leasing_nama", "leasing_nama");
		$data['arr_polda'] = $this->cm->arr_dropdown("m_polda", "id_polda", "nama_polda", "no_urut");


		$content = $this->load->view("leasing_polda_view_form",$data,true);
		$this->set_subtitle("INPUT DATA AUTHENTIKASI LEASING POLDA");
		$this->set_title("INPUT DATA AUTHENTIKASI LEASING POLDA");
		$this->set_content($content);
		$this->render();
	}
	
	function edit($id_polda){

		$leasing_id = $this->uri->segment(4);

		// $service_data['method'] = 'get_leasing_detail';
		// $service_data['debug'] = 1;
		// $service_data['vLEASING_ID'] = $id;
		// $xml = file_get_contents(service_url($service_data));
		$arr = $this->lm->get_detail($id_polda,$leasing_id); 
		
		$data = $arr['message'];
		$data['action']="update";
		$data['mode']="U";
		$data['controller'] = get_class($this);
		$data['arr_leasing'] = $this->cm->arr_dropdown("m_leasing", "leasing_id", "leasing_nama", "leasing_nama");
		$data['arr_polda'] = $this->cm->arr_dropdown("m_polda", "id_polda", "nama_polda", "no_urut");


		$content = $this->load->view("leasing_polda_view_form",$data,true);
		
		$this->set_subtitle("EDIT DATA POLDA");
		$this->set_title("DATA POLDA");
		$this->set_content($content);
		$this->render();
	}
	
	
	
	function ceknama($LEASING_NAMA) {
		if(empty($LEASING_NAMA)) {
			$this->form_validation->set_message('ceknama', ' %s Harus diisi ');
			return false;
		}

		$this->db->where("nama_polda",$LEASING_NAMA);
		$res = $this->db->get("m_polda");
		if($res->num_rows()==1) {
			$this->form_validation->set_message('ceknama', ' %s Sudah ada ');
			return false;
		}
	}


	function cek($id_polda) {
		if(empty($id_polda)) {
			$this->form_validation->set_message('cek', ' %s Harus diisi ');
			return false;
		}
		$leasing_id = $_POST['leasing_id'];

		$this->db->where("id_polda",$id_polda);
		$this->db->where("leasing_id",$leasing_id);
		$res = $this->db->get("polda_leasing");

		if($res->num_rows() >= 1 ) {
			$this->form_validation->set_message('cek', ' data leasing dan polda ini sudah ada');
			return false;
		}

	}



	function simpan(){
		$data=$this->input->post();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_polda','Polda','callback_cek');
		$this->form_validation->set_rules('leasing_id','Leasing','required');
		$this->form_validation->set_rules('service_user','Username','required');
		$this->form_validation->set_rules('service_pass','Password','required');
		$this->form_validation->set_rules('service_salt','Salt','required');
		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			unset($data['mode']);
			// unset($data['id_polda']);
			 $res = $this->db->insert("polda_leasing",$data);
			 if($res) {
			 	$ret = array("error"=>false,"message"=>"data berhasil disimpan");
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
	
	function update(){
		$data=$this->input->post();



		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_polda','Polda','required');
		$this->form_validation->set_rules('leasing_id','Leasing','required');
		$this->form_validation->set_rules('service_user','Username','required');
		$this->form_validation->set_rules('service_pass','Password','required');
		$this->form_validation->set_rules('service_salt','Salt','required');
		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			
			unset($data['mode']);			 
			$this->db->where("id_polda",$data['id_polda']);
			$this->db->where("leasing_id",$data['leasing_id']);
			 $res = $this->db->update("polda_leasing",$data);
			 if($res) {
			 	$ret = array("error"=>false,"message"=>"data berhasil disimpan");
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
	
	
	
	function hapus() {
			$data = $this->input->post();
			$this->db->where("id_polda",$data['id_polda']);
			$this->db->where("leasing_id",$data['leasing_id']);
			$res = $this->db->delete("polda_leasing"); 
			if($res){
				$ret = array("error"=>false,"message"=>"data berhasil dihapus");
			} 
			else {
				$ret = array("error"=>true,"message"=>$this->db->_error_message());
			}

			echo json_encode($ret);
	}
	
	 
	
	
	 
}
?>
