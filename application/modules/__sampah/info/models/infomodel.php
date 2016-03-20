<?php
class Ulmodel extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	function get_arr_leasing(){
		// get data leasing
		$data['method']='get_data_leasing';
		$url = service_url($data);
		
		$xml = file_get_contents($url);
		$arr = xml_to_array($xml);
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}

	

}


?>