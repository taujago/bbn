<?php 
class testlogin extends CI_controller {

	function testlogin(){
		parent::__construct();
	}




function execute_service2($url,$method,$json_data) {


	// echo $json_data; exit;

	// echo $json_data; exit;
	$req_url = $url."/".$method;
 	$ch = curl_init();

 	//print_r($json_data); exit;
	//set the url, number of POST vars, POST data



	curl_setopt($ch,CURLOPT_URL, $req_url);
	//curl_setopt($ch,CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch,CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS, $json_data);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	// curl_setopt($ch, CURLINFO_HEADER_OUT, true); // enable tracking
	//execute post
	$result = curl_exec($ch);


// $headerSent = curl_getinfo($ch, CURLINFO_HEADER_OUT ); // request headers

// echo $headerSent; exit;

	// $obj  = json_decode($result);
	// $array = (array) $obj;
	// 
	curl_close($ch);
	// return $array;
	return $result;
}



	function SignIn(){

 		// echo "bangkehhasdfdh..";
		$LoginName = "bcafinance";
		$Salt = "FIrmansyagaafd";
		$Password = "123456";

			$data_service = array("LoginInfo"=>array(
									"LoginName" => $LoginName,
									"Salt"		=> $Salt,
									"AuthHash" 	=> md5($Salt. md5($LoginName.$Password))
								 
									) 
								);
	
	show_array($data_service); 
	// exit;
	 
	$json_data = json_encode($data_service);
	echo $json_data; 
	// http://poldametro.bpkb.net/Blokir-Online/browsj.dll
	// $ret_service = $this->execute_service2("http://localhost/blokirjabar/rocknroll.php","SignIn",$json_data);
	$ret_service = $this->execute_service2("http://poldametro.bpkb.net/Blokir-Online/browsj.dll","SignIn",$json_data);
	echo $ret_service; 
	 

	}


	// RanRuRequestBlokir

	function RanRuRequestBlokir(){

		// echo "bangkehhh..";
		$LoginName = "testblokir";
		$Salt = "FIrmansyagaafd";
		$Password = "123456";

/*
{"LoginInfo":{"LoginName":"ATWIS","Salt":"FIrmansyagaafd","AuthHash":"a0b74209237871511eeb45f16a86f647"
},"RequestBlokirItemList":[{"NoRangka":"L3535363636","NoPermohonan":"00001\/BCA\/09\/2015"}]}
*/


			$data_service = array("LoginInfo"=>array(
								"LoginName" => $LoginName,
								"Salt"		=> $Salt,
								"AuthHash" 	=> md5($Salt. md5($LoginName.$Password))
							  // "AuthHash" 	=> "a0b74209237871511eeb45f16a86f647"
									 
								),
								"RequestBlokirItemList"=>array(
									0=>array("NoRangka"=>"MHFE2CJ2JFK052379",
										     "NoPermohonan"=>"01119/MNDRI/09/2015")
									)
	
								);
	// echo "<pre>";
	// print_r($data_service); 
	// echo "</pre>";
			
	$json_data = json_encode($data_service);
	//echo "<Pre>"; echo $json_data;  echo "</pre>";exit;
	$ret_service = $this->execute_service2("http://poldametro.bpkb.net/Blokir-Online/browsj.dll","RanRuRequestBlokir",$json_data);
	echo  $ret_service;		 
	// print_r($ret_service);
	echo "<pre>";
	print_r(json_decode($ret_service));
	echo "</pre>"; 

	}




	function RanRuGetBlokirEntryByNoKa(){

		// echo "bangkehhh..";
		$LoginName = "testblokir";
		$Salt = "FIrmansyagaafd";
		$Password = "123456";


			$data_service = array("LoginInfo"=>array(
								"LoginName" => $LoginName,
								"Salt"		=> $Salt,
								"AuthHash" 	=> md5($Salt. md5($LoginName.$Password))
								),
								"NoRangkaList"=>array(
									0=>"MHKM5EA3JFJ001587" 										      
									)
	
								);
	
	// show_array($data_service);
	 	
	$json_data = json_encode($data_service);
	// echo "<Pre>"; echo $json_data;  echo "</pre>";exit;
	$ret_service = $this->execute_service2("http://poldametro.bpkb.net/Blokir-Online/browsj.dll","RanRuGetBlokirEntryByNoKa",$json_data);
	echo  $ret_service;		 
	// print_r($ret_service);
	echo "<pre>";
	print_r(json_decode($ret_service));
	echo "</pre>"; 

	}



	function RanMaGetDataRanmor(){

		// echo "bangkehhh..";
		$LoginName = "ATWIS";
		$Salt = "3332245FkS";
		$Password = md5("12345678");

			$data_service = array("LoginInfo"=>array(
								"LoginName" => $LoginName,
								"Salt"		=> $Salt,
								"AuthHash" 	=> md5($Salt. md5($LoginName.$Password))
								),
								"NoBPKB"=> "F6355774H"
	
								);
	// echo "<pre>";
	// print_r($data_service); 
	// echo "</pre>";
	 	
	$json_data = json_encode($data_service);
	// echo "<Pre>"; echo $json_data;  echo "</pre>";exit;
	$ret_service = $this->execute_service2("http://localhost/blokirjabar/rocknroll.php","RanMaGetDataRanmor",$json_data);
	echo  $ret_service;		 
	// print_r($ret_service);

	}


/*

{"LoginInfo":{"LoginName":"ATWIS","Salt":"FIrmansyagaafd","AuthHash":"a0b74209237871511eeb45f16a86f647"
},"NoBPKB":"L05014703"}<
*/
	function RanMaVerifiedForBlokir(){

		// echo "bangkehhh..";
		$LoginName = "ATWIS";
		$Salt = "3332245FkS";
		$Password = "12345678";

			$data_service = array("LoginInfo"=>array(
								"LoginName" => $LoginName,
								"Salt"		=> $Salt,
								"AuthHash" 	=> md5($Salt. md5($LoginName.$Password))
								),
								"NoBPKB"=> "L05014703"
	
								);
	echo "<pre>";
	print_r($data_service); 
	echo "</pre>";
	 	
	$json_data = json_encode($data_service);
	// echo "<Pre>"; echo $json_data;  echo "</pre>";exit;
	$ret_service = $this->execute_service2("http://localhost/blokirjabar/rocknroll.php","RanMaVerifiedForBlokir",$json_data);
	echo  $ret_service;		 
	// print_r($ret_service);

	}



function RanMaExecuteBlokir(){

		// echo "bangkehhh..";
		$LoginName = "ATWIS";
		$Salt = "3332245FkS";
		$Password = md5("12345678");

			$data_service = array("LoginInfo"=>array(
								"LoginName" => $LoginName,
								"Salt"		=> $Salt,
								"AuthHash" 	=> md5($Salt. md5($LoginName.$Password))
								),
								"DataPermohonan"=>array(
									"NoBPKB"=> "L13137659",
									"NoPermohonan"=>"MANDIRI/335/3522",
									"IdApproval" => "12"
								)
								);
	// echo "<pre>";
	// print_r($data_service); 
	// echo "</pre>";
	 	
	$json_data = json_encode($data_service);
	// echo "<Pre>"; echo $json_data;  echo "</pre>";exit;
	$ret_service = $this->execute_service2("http://localhost/blokirjabar/rocknroll.php","RanMaExecuteBlokir",$json_data);
	echo  $ret_service;		 
	// print_r($ret_service);

	}

function ComplGetBerkasCheckPoint(){

		// echo "bangkehhh..";
		$LoginName = "ATWIS";
		$Salt = "3332245FkS";
		$Password = md5("12345678");

			$data_service = array("LoginInfo"=>array(
								"LoginName" => $LoginName,
								"Salt"		=> $Salt,
								"AuthHash" 	=> md5($Salt. md5($LoginName.$Password))
								),
								"Criteria"=>array(
									"Param"=> "MJEFG8JPK9JG12963",
									"ParamKind"=>"1"
									 
								)
								);
	// echo "<pre>";
	// print_r($data_service); 
	// echo "</pre>";
	 	
	$json_data = json_encode($data_service);
	// echo "<Pre>"; echo $json_data;  echo "</pre>";exit;
	$ret_service = $this->execute_service2("http://localhost/blokirjabar/rocknroll.php","ComplGetBerkasCheckPoint",$json_data);
	echo  $ret_service;		 
	// print_r($ret_service);

	}


function UserList(){

		// echo "bangkehhh..";
		$LoginName = "ATWIS";
		$Salt = "3332245FkS";
		$Password = md5("12345678");

			$data_service = array("LoginInfo"=>array(
								"LoginName" => $LoginName,
								"Salt"		=> $Salt,
								"AuthHash" 	=> md5($Salt. md5($LoginName.$Password))
								));
	// echo "<pre>";
	// print_r($data_service); 
	// echo "</pre>";
	 	
	$json_data = json_encode($data_service);
	// echo "<Pre>"; echo $json_data;  echo "</pre>";exit;
	$ret_service = $this->execute_service2("http://localhost/blokirjabar/rocknroll.php","UserList",$json_data);
	echo  $ret_service;		 
	// print_r($ret_service);

	}



function UserInsert(){



		// echo "bangkehhh..";
		$LoginName = "ATWIS";
		$Salt = "3332245FkS";
		$Password = md5("12345678");

			$data_service = array("LoginInfo"=>array(
								"LoginName" => $LoginName,
								"Salt"		=> $Salt,
								"AuthHash" 	=> md5($Salt. md5($LoginName.$Password))
								),
							"Data" => array(
									"USER_ID" => "FIRMAN",
									"USER_NAMA" => "FIRMAN",
									"ALAMAT" => "BANDUNG",
									"LEASING_NAMA" => "PT. MAJU LANCAR JAYA",
									"TGL_DAFTAR" => date("Y-m-d"),
									"NO_TLP" => "0812424",
									"EMAIL" => "taujago@gmail.com",
									"PASSWORD" => md5('rahasia')
								)

		 
			);
	// echo "<pre>";
	// print_r($data_service); 
	// echo "</pre>";
	 	
	$json_data = json_encode($data_service);
	// echo "<Pre>"; echo $json_data;  echo "</pre>";exit;
	$ret_service = $this->execute_service2("http://180.250.16.227/blokirjabar/rocknroll.php","UserInsert",$json_data);
	echo  $ret_service;		 
	// print_r($ret_service);

	}



function UserUpdate(){



		// echo "bangkehhh..";
		$LoginName = "ATWIS";
		$Salt = "3332245FkS";
		$Password = md5("12345678");

			$data_service = array("LoginInfo"=>array(
								"LoginName" => $LoginName,
								"Salt"		=> $Salt,
								"AuthHash" 	=> md5($Salt. md5($LoginName.$Password))
								),
							"Data" => array(
									"USER_ID_OLD" => "BONDENG",
									"USER_ID" => "BURHAN",
									"USER_NAMA" => "TAMBARRU",
									"ALAMAT" => "SEMARANG",
									"LEASING_NAMA" => "PT. MANDIRI JAYA MAKMUR",
									"TGL_DAFTAR" => date("Y-m-d"),
									"NO_TLP" => "08123556678",
									"EMAIL" => "taujago@gmail.com",
									"PASSWORD" => '' // md5('rahasiaencok')
								)

		 
			);
	// echo "<pre>";
	// print_r($data_service); 
	// echo "</pre>";
	 	
	$json_data = json_encode($data_service);
	// echo "<Pre>"; echo $json_data;  echo "</pre>";exit;
	$ret_service = $this->execute_service2("http://localhost/blokirjabar/rocknroll.php","UserUpdate",$json_data);
	echo  $ret_service;		 
	// print_r($ret_service);

	}



function UserDelete(){



		// echo "bangkehhh..";
		$LoginName = "ATWIS";
		$Salt = "3332245FkS";
		$Password = md5("12345678");

			$data_service = array("LoginInfo"=>array(
								"LoginName" => $LoginName,
								"Salt"		=> $Salt,
								"AuthHash" 	=> md5($Salt. md5($LoginName.$Password))
								),
							"Data" => array(
									
									"USER_ID" => "BURHAN"
								 
								)

		 
			);
	// echo "<pre>";
	// print_r($data_service); 
	// echo "</pre>";
	 	
	$json_data = json_encode($data_service);
	// echo "<Pre>"; echo $json_data;  echo "</pre>";exit;
	$ret_service = $this->execute_service2("http://localhost/blokirjabar/rocknroll.php","UserDelete",$json_data);
	echo  $ret_service;		 
	// print_r($ret_service);

	}


function InsertAPM(){

// load file content 
	$namafile = "HONDA-20150825.apm";
$bulk_data_content = file_get_contents("./dataapm/$namafile");
//echo $bulk_data_content; 

//exit;

// 

		// echo "bangkehhh..";
		$LoginName = "ATWIS";
		$Salt = "3332245FkS";
		$Password = md5("12345678");

			/* $data_service = array("LoginInfo"=>array(
								"LoginName" => $LoginName,
								"Salt"		=> $Salt,
								"AuthHash" 	=> md5($Salt. md5($LoginName.$Password))
								),
							"BulkApmData" =>  $bulk_data_content,
							"FileName" => "somenamefile.apm" */

			$data_service = array( 
								"LoginName" => $LoginName,
								"Salt"		=> $Salt,
								"AuthHash" 	=> md5($Salt. md5($LoginName.$Password)),					 
								"BulkApmData" =>  $bulk_data_content,
								"FileName" => $namafile

		 
			);
	// echo "<pre>";
	// print_r($data_service); 
	// exit;
	// echo "</pre>";
	 	
	$json_data = json_encode($data_service);
	// echo "<Pre>"; echo $json_data;  echo "</pre>";exit;
	$ret_service = $this->execute_service2("http://localhost/blokirjabar/rocknroll.php","InsertAPM",$json_data);
	echo  $ret_service;		 
	// print_r($ret_service);

	}



}
?>