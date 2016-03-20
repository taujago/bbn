<?php
class ws extends CI_Controller {

	var $data ; //j
	var $polda_url = 'http://poldametro.bpkb.net/Blokir-Online/browsj.dll';
	function ws () {
		parent::__construct();

		 //$this->data = json_decode(file_get_contents("php://input")); 
		  $this->data = json_decode($this->input->post('data'));
	}


	function auth(){
		
		$data = $this->data;
		// show_array($this->data);
		$username = "akprind";
		$password = "stelkendo";

		if($data->auth_user == $username and $data->auth_pass == $password) {
			$ret = array("error"=>false);
		}
		else {
			$ret = array("error"=>true);
		}

		return $ret;
	}


	function login(){
		$res = $this->auth();
		echo json_encode($res);
	}

function AddUser(){
		$data = $this->data;

		$auth = $this->auth();
		if($auth['error'] == true){
			$ret = array("error"=>true,"msg"=>"Login Error");
		}
		else {
			// cek apakah username ada atau tidak
			$this->db->where("user_id",$data->user_id);
			$res = $this->db->get("t_user_monitoring");
			if($res->num_rows() == 1){
				$ret = array("error"=>true,"msg"=>"User Exists");
			}
			else {
				$ins_data = array("user_id"=>$data->user_id,
								  "snhdd"=>$data->snhdd,
								  "nama"=>$data->nama,
								  "alamat"=>$data->alamat,
								  "password"=>$data->password
								  );
				$rs_insert = $this->db->insert("t_user_monitoring",$ins_data);
				if($rs_insert){
					$ret = array("error"=>false,"msg"=>"User Saved");
				}
				else {
					$ret = array("error"=>true,"msg"=>"User Not Saved".mysql_error());
				}
			}

		}
		echo json_encode($ret);

	}


function EditUser(){
		$data = $this->data;

		$auth = $this->auth();
		if($auth['error'] == true){
			$ret = array("error"=>true,"msg"=>"Login Error");
		}
		else {
			// cek apakah username ada atau tidak
			$this->db->where("user_id",$data->user_id);
			$res = $this->db->get("t_user_monitoring");
			if($res->num_rows() < 1){
				$ret = array("error"=>true,"msg"=>"User Not Found");
			}
			else {
				$ins_data = array("user_id"=>$data->user_id,
								  "snhdd"=>$data->snhdd,
								  "nama"=>$data->nama,
								  "alamat"=>$data->alamat
								  );
				if(!empty($data->password)){
					$ins_data['password'] = $data->password;
				}
				$this->db->where("user_id",$data->user_id);
				$rs_insert = $this->db->update("t_user_monitoring",$ins_data);
				if($rs_insert){
					$ret = array("error"=>false,"msg"=>"User Updated");
				}
				else {
					$ret = array("error"=>true,"msg"=>"User Not Update".mysql_error());
				}
			}

		}
		echo json_encode($ret);

	}


function RemoveUser(){
		$data = $this->data;

		$auth = $this->auth();
		if($auth['error'] == true){
			$ret = array("error"=>true,"msg"=>"Login Error");
		}
		else {
			// cek apakah username ada atau tidak
			$this->db->where("user_id",$data->user_id);
			$res = $this->db->get("t_user_monitoring");
			if($res->num_rows() < 1){
				$ret = array("error"=>true,"msg"=>"User Not Found");
			}
			else {
				
				$this->db->where("user_id",$data->user_id);
				$rs_insert = $this->db->delete("t_user_monitoring");
				if($rs_insert){
					$ret = array("error"=>false,"msg"=>"User Deleted");
				}
				else {
					$ret = array("error"=>true,"msg"=>"User Not Deleted".mysql_error());
				}
			}

		}
		echo json_encode($ret);

	}



function user_auth(){
	$data = $this->data;

	$this->db->where("user_id",$data->user_id);
	$this->db->where("password",$data->password);
	$this->db->where("snhdd",$data->snhdd);
	$jumlah = $this->db->get("t_user_monitoring")->num_rows();
	//echo $this->db->last_query(); exit;
	if($jumlah==0){
		$ret = array("error"=>true);
	}
	else {
		$ret = array("error"=>false);
	}
	return $ret;
}


function RanRuGetBlokirEntryByDate(){
$data = $this->data;


$auth = $this->user_auth();
if($auth['error'] == true){
			$ret = array("error"=>true,"msg"=>"Login Error");
}
else { 

// show_array($data); exit;
$service_user  = "testblokir";
$service_salt = "235325265663633jjj";
$service_pass = "123456";

	$data_service = array("LoginInfo"=>array(
								"LoginName" => $service_user,
								"Salt"		=> $service_salt,
								"AuthHash" 	=> md5($service_salt . md5($service_user.$service_pass))
								),
							"FromDate" => $data->FromDate,
  							"ToDate" =>  $data->ToDate	 
								);
				$json_data = json_encode($data_service);

				// echo $json_data; // exit;
				// show_array($aut_data);
				// show_array($json_data); exit;

	$ret_service = $this->execute_service($this->polda_url,"RanRuGetBlokirEntryByDate",$json_data);
	if($ret_service['error'] == false) {
		$ret = array("error"=>false,"msg"=>$ret_service['data']['RequestBlokirEntryList']);
	}
	else {
		$ret = array("error"=>true,"msg"=>array());
	}
}
	echo json_encode($ret);

}




function ComplGetBerkasCheckPoint(){
$data = $this->data;


$auth = $this->user_auth();
if($auth['error'] == true){
			$ret = array("error"=>true,"msg"=>"Login Error");
}
else { 

// show_array($data); exit;
$service_user  = "testblokir";
$service_salt = "235325265663633jjj";
$service_pass = "123456";

	$data_service = array("LoginInfo"=>array(
								"LoginName" => $service_user,
								"Salt"		=> $service_salt,
								"AuthHash" 	=> md5($service_salt . md5($service_user.$service_pass))
								),
							"Criteria" => array(
									"Param"=>$data->Param,
									"ParamKind" => $data->ParamKind
								)
								);
				$json_data = json_encode($data_service);

				// echo $json_data; // exit;
				// show_array($aut_data);
				// show_array($json_data); exit;

	$ret_service = $this->execute_service($this->polda_url,"ComplGetBerkasCheckPoint",$json_data);
	//show_array($ret_service); exit;
	if($ret_service['error'] == false) {
		if($ret_service['data']['Result'] == true) { 
		$ret = array("error"=>false,"msg"=>$ret_service['data']['Data']);
		}
		else {
			$ret = array("error"=>true,"msg"=>"Data tidak ditemukan");
		}
	}
	else {
		$ret = array("error"=>true,"msg"=>"connect failed");
	}
}
	echo json_encode($ret);

}

function execute_service($url,$method,$json_data) {

	// echo $json_data; exit;
	$req_url = $url."/".$method;
	// echo $req_url;  exit;
 	$ch = curl_init();

	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL, $req_url);
	curl_setopt($ch,CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS, $json_data);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

	//execute post
	$result = curl_exec($ch);
	// echo $result;  

	$obj  = json_decode($result);
	$array = (array) $obj;

	$info = curl_getinfo($ch);

	$error = ($info['http_code']=="200")?false:true;
	// show_array($array); exit;
	curl_close($ch);
	return array("data"=>$array,"error"=>$error);
}



}

?>