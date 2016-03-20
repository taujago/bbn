<?php
class cek_bbn extends master_controller  {
	var $controller;
	function cek_bbn(){
		$this->controller = get_class($this);
		parent::__construct();
	}
	
	
	function index(){


		$data_array=array();
		$content = $this->load->view($this->controller."_view",$data_array,true);

		$this->set_subtitle("CEK BIAYA BALIK NAMA");
		$this->set_title("CEK BIAYA BALIK NAMA");
		$this->set_content($content);
		$this->render();
	}

var $user;
var $salt;
var $pass; 

	function get_data_bbn(){
		$data = $this->input->post();

		$url = 'http://poldametro.bpkb.net/Blokir-Online/browsj.dll';
			$this->user = 'testblokir';
			$this->salt = "335353535323";
			$this->pass = "123456";


			$data_service = array("LoginInfo"=>array(
							"LoginName" => $this->user,
							"Salt"		=> $this->salt,
							"AuthHash" 	=> md5($this->salt . md5($this->user.$this->pass))
							),
							"Criteria"=>array(
								"Param" => $data['no_bpkb'],
								"ParamKind" => 3
							)
							 
							);

			$json_data = json_encode($data_service);	

			echo $json_data; 

			$ret_service = $this->execute_service2($url,"ComplGetBerkasCheckPoint",$json_data);
			//show_array($ret_service);
			echo $ret_service;
	}

}
?>