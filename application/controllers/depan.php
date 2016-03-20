<?php
class Depan extends master_controller  {
	function __consruct(){
		parent::__construct();
	}
	
	
	function index(){
		$this->set_subtitle("DASHBOARD");
		$this->set_title("DASHBOARD");
		$this->set_content("WELCOME");
		$this->render();
	}
}
?>