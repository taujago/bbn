<?php
class depan_baru extends master_controller  {
	function depan_baru(){
		parent::__construct();
		// echo "pilihan ".$this->session->userdata("pilihan"); exit;
	}
	
	
	function index(){
		$this->set_subtitle("DASHBOARD");
		$this->set_title("DASHBOARD");
		$this->set_content("WELCOME");
		$this->render_baru();
	}
}
?>