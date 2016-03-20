<?php 
class services extends CI_Controller {

function services(){
	parent::__construct(); 
}



function index($limit=10){


$this->db->limit($limit); 
$res = $this->db->get("t_pendaftaran_test");


foreach($res->result() as $row_array)  :
	$arr['data'][] = $row_array;
endforeach;
header('Content-Type: application/json');
echo json_encode($arr);


}



}


?>