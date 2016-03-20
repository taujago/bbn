<?php
class polda extends master_controller  {
	function polda(){
		parent::__construct();
		$this->load->model("polda_model","lm"); 
	}
	
	
	function index(){
		
		$userdata = $this->session->userdata("userdata");
		$data_array['record'] = $this->lm->get_data_leasing();
		$data_array['controller'] = get_class($this);
		$content = $this->load->view("polda_view",$data_array,true);
		
		$this->set_subtitle("DATA POLDA");
		$this->set_title("DATA POLDA");
		$this->set_content($content);
		$this->render();
	}
	
	function baru(){
		$data['action']="simpan";
		$data['mode']="I";
		$data['controller'] = 'polda';
		$content = $this->load->view("polda_view_form",$data,true);
		$this->set_subtitle("INPUT DATA POLDA");
		$this->set_title("DATA POLDA");
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
		$data['controller'] = 'polda';
		$content = $this->load->view("polda_view_form",$data,true);
		
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


	function simpan(){
		$data=$this->input->post();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama_polda','Nama Polda','callback_ceknama');
		$this->form_validation->set_rules('alamat_polda','Alamat leasing','required');
		$this->form_validation->set_rules('nama_polda_singkatan','Singkatan','required');
		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			unset($data['mode']);
			unset($data['id_polda']);
			 $res = $this->db->insert("m_polda",$data);
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
		$this->form_validation->set_rules('nama_polda','Nama Polda','required');
		$this->form_validation->set_rules('alamat_polda','Alamat leasing','required');
		$this->form_validation->set_rules('nama_polda_singkatan','Singkatan','required');
		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			
			unset($data['mode']);			 
			$this->db->where("id_polda",$data['id_polda']);
			 $res = $this->db->update("m_polda",$data);
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
			
			$this->db->where("id_polda",$id);
			$res = $this->db->delete("m_polda"); 
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
