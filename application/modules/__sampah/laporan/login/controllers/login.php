<?php 
class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		//$this->load->helper("serviceurl");
		
	}
	
	function index(){
		$this->load->view("login_view");
	}
	
	
	function logout(){
		$this->session->unset_userdata("login",true);
		redirect("login");
	}
	
	function ceklogin(){

		$data = $this->input->post();
		$this->db->select("u.*,l.leasing_nama, l.leasing_alamat,l.leasing_kota");
		$this->db->where("user_name",$data['username']);
		$this->db->where("user_password",$data['password']);
		$this->db->from("t_user u")
		->join("m_leasing l",'u.leasing_id = l.leasing_id','left');
		$res = $this->db->get();
		// echo $this->db->last_query(); exit;

		if($res->num_rows() == 1 ) {
			$this->session->set_userdata("login",true);
			$userdata = $res->row_array();
			///show_array($userdata);
			$this->session->set_userdata("userdata",$userdata);
			$ret = array("error"=>false,"message"=>"Login gagal");
		}
		else {
			$ret = array("error"=>true,"message"=>"Login gagal");
		}

		echo json_encode($ret);


		// $data = $this->input->post();		
		// $data['debug'] = '1';
		// $data['method'] = 'login';
		// $url = service_url($data);
		// $xml = file_get_contents($url);
		// $arr = xml_to_array($xml);
		
		 
		  
		// if($arr['error'] == "false") {
			 
		// 	$ret['error'] = false;
		// 	$this->session->set_userdata("login",true);
		// 	$this->session->set_userdata("userdata",$arr['message']);
			
		// 	$data_user = $this->session->userdata("userdata");
		// 	//show_array($data_user); exit;
		// }
		// else {
			 
		// 	$ret['error'] = true;
		// }
		// echo json_encode($ret);
		 
		 
	}
}

?>