<?php
class leasing extends master_controller  {
	function Leasing(){
		parent::__construct();
		$this->load->model("leasing_model","lm"); 
	}
	
	
	function index(){
		
		$userdata = $this->session->userdata("userdata");
		$data_array['record'] = $this->lm->get_data_leasing();
		$data_array['controller'] = get_class($this);
		$content = $this->load->view("leasing_view",$data_array,true);
		
		$this->set_subtitle("DATA LEASING");
		$this->set_title("DATA LEASING");
		$this->set_content($content);
		$this->render();
	}
	
	function baru(){
		$data['action']="simpan";
		$data['mode']="I";
		$data['controller'] = 'leasing';
		$content = $this->load->view("leasing_view_form",$data,true);
		$this->set_subtitle("INPUT DATA LEASING");
		$this->set_title("DATA LEASING");
		$this->set_content($content);
		$this->render();
	}
	
	function edit($id){
		// $service_data['method'] = 'get_leasing_detail';
		// $service_data['debug'] = 1;
		// $service_data['vLEASING_ID'] = $id;
		// $xml = file_get_contents(service_url($service_data));
		$arr = $this->lm->get_leasing_detail($id); 
		$data = $arr['message'];
		$data['action']="update";
		$data['mode']="U";
		$data['controller'] = 'leasing';
		$content = $this->load->view("leasing_view_form",$data,true);
		
		$this->set_subtitle("EDIT DATA LEASING");
		$this->set_title("DATA LEASING");
		$this->set_content($content);
		$this->render();
	}
	
	
	
	function ceknama($LEASING_NAMA) {
		if(empty($LEASING_NAMA)) {
			$this->form_validation->set_message('ceknama', ' %s Harus diisi ');
			return false;
		}

		$this->db->where("leasing_nama",$LEASING_NAMA);
		$res = $this->db->get("m_leasing");
		if($res->num_rows()==1) {
			$this->form_validation->set_message('ceknama', ' %s Sudah ada ');
			return false;
		}
	}


	function simpan(){
		$data=$this->input->post();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('leasing_nama','Nama leasing','callback_ceknama');
		$this->form_validation->set_rules('leasing_alamat','Alamat leasing','required');
		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			unset($data['mode']);
			unset($data['leasing_id']);
			 $res = $this->db->insert("m_leasing",$data);
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
		$this->form_validation->set_rules('leasing_nama','Nama leasing','required');
		$this->form_validation->set_rules('leasing_alamat','Alamat leasing','required');
		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			
			unset($data['mode']);			 
			$this->db->where("leasing_id",$data['leasing_id']);
			 $res = $this->db->update("m_leasing",$data);
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
	
	
	
	function hapus($id) {
			
			$this->db->where("leasing_id",$id);
			$res = $this->db->delete("m_leasing"); 
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
