<?php 
class gantipass extends master_controller {
	function gantipass(){
		parent::__construct();
		// $this->load->model("core_model","cm");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
 


	}

	function index(){ 
		
		$userdata = $this->session->userdata("userdata");
		// $data_array['data'] = $this->dm->get_data($userdata['leasing_id']);
		 
		//show_array($data_array); exit;
		$data_array['controller'] = get_class($this);
		$content = $this->load->view("gantipass_view",$data_array,true);

		 


		$this->set_subtitle("GANTI PASSWORD ");
		$this->set_title("GANTI PASSWORD");
		$this->set_content($content);
		$this->render_baru();
	}

	function ganti(){

		/// cek password lama 
		$data = $this->input->post();
		$userdata = $this->session->userdata("userdata");

		$this->db->where("user_id",$userdata['user_id']);
		$this->db->where("user_password",$data['passlama']);
		$res  = $this->db->get("t_user");
		if($res->num_rows() > 0 ) {
			// password lama benar 
			if( ( $data['password1'] <> $data['password']) )    {
				$ret = array("error"=>true,"message"=>"Password tidak sama");
			}
			else {

				$this->db->where("user_id",$userdata['user_id']);
				$res = $this->db->update("t_user",array("user_password"=>$data['password']));

				$ret = ($res)?array("error"=>false,"message"=>"Password berhasil diganti"):array("error"=>true,"message"=>"gagal update password".mysql_error());
			}
		}
		else {
			$ret = array("error"=>true,"message"=>"Password lama salah");
		}

		echo json_encode($ret);

	}
	 



}
?>