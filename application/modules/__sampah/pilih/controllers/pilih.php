<?php
class pilih extends CI_Controller {

	function pilih(){
		parent::__construct();

		$userdata = $this->session->userdata("userdata");
		if($userdata['user_name'] == "admin") {
			redirect("depan");
		}
		else if($userdata['user_level'] == "99") {
			redirect("verifikatur");
		}
		else if($userdata['user_level'] == "88") {
			redirect("polres_depan");
		}

	}

	function index(){
		$this->load->view("pilih_view");
	}

	function simpan($pilih){

		$this->session->set_userdata("pilihan",$pilih);
		// echo "pilihan adalah $pilih <Br />";
		// echo $this->session->userdata("pilihan");
		// exit;
		redirect("pilih_polda");
	}

}
?>