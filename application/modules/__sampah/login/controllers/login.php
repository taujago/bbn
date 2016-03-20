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
		$this->db->select("u.*,l.leasing_nama,l.leasing_nama_singkatan, 
			l.leasing_alamat,l.leasing_kota, res.id as id_polres, 
			res.kota as nama_polres, res.id_provinsi as id_polda2, da.provinsi as nama_polda",false);
		$this->db->where("user_name",$data['username']);
		$this->db->where("user_password",$data['password']);
		$this->db->from("t_user u")
		->join("m_leasing l",'u.leasing_id = l.leasing_id','left')
		->join("tiger_kota res","res.id = u.id_polres",'left')
		->join("tiger_provinsi da","res.id_provinsi = da.id",'left');
		$res = $this->db->get();
		// echo $this->db->last_query(); exit;

		if($res->num_rows() == 1 ) {
			$this->session->set_userdata("login",true);
			$userdata = $res->row_array();
			// show_array($userdata);

			if($userdata['user_level'] == "99") {
				$this->db->where("id_polda",$userdata['id_polda']);
				$data_polda = $this->db->get("m_polda")->row();
				// show_array($data_polda);
				$this->session->set_userdata("id_polda",$userdata['id_polda']);
				$this->session->set_userdata("header_image",$data_polda->header_image);
			}

			if($userdata['user_level'] == "88") {
				$this->db->where("id_polda",$userdata['id_polda']);
				$data_polda = $this->db->get("m_polda")->row();


				$header = (isset($data_polda->header_image))?$data_polda->header_image:"header-metro.png";
				$this->session->set_userdata("id_polda",$userdata['id_polda2']);
				$this->session->set_userdata("id_polres",$userdata['id_polres']);
				$this->session->set_userdata("nama_polres",$userdata['nama_polres']);
				$this->session->set_userdata("nama_polda",$userdata['nama_polda']);
				$this->session->set_userdata("header_image",$header);
			}


			$this->session->set_userdata("userdata",$userdata);
			$ret = array("error"=>false,"message"=>"Login berhasil");
		}
		else {
			$ret = array("error"=>true,"message"=>"Login gagal");
		}

		echo json_encode($ret);

 
		 
		 
	}
}

?>