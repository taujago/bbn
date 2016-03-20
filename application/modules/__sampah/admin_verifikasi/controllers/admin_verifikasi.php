<?php
class admin_verifikasi extends master_controller {
	function admin_verifikasi(){
		parent::__construct();
		// $this->load->model("core_model","cm");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		$this->load->model("ver_model","dm");

	}

	function index(){
		// echo "fuckkk.."; exit;
		$userdata = $this->session->userdata("userdata");




		// $data['leasing_id'] = $userdata['leasing_id'];
		$status = ($userdata['user_level'] == 1) ? 0:$userdata['user_level'] ;



		//$data_array['data'] = $this->dm->get_data($userdata['leasing_id'],$status);
		$jenis = ($this->pilihan=="B")?"BARU":"LAMA";
		//show_array($data_array); exit;
		$data_array['controller'] = get_class($this);

		$data_array['tanggal_awal'] = $this->session->userdata("tanggal_awal");
		$data_array['tanggal_akhir'] = $this->session->userdata("tanggal_akhir");

		//$data_array['status'] = ( isset($this->input->get('status'))?$this->input->get('status'):"0"; 
		//echo "uri .. ".$data_array['uri']; exit;
		$data_array['status'] = isset($_GET['status'])?$_GET['status']:'0';
		$content = $this->load->view("admin_verifikasi_view",$data_array,true);

		$this->set_subtitle("VERIFIKASI PENDAFTARAN BLOKIR KENDARAAN  $jenis");
		$this->set_title("VERIFIKASI PENDAFTARAN BLOKIR KENDARAAN $jenis ");
		$this->set_content($content);
		$this->render();
	}


function get_data(){
	 	$userdata = $this->session->userdata("userdata");
		$status = ($userdata['user_level'] == 1) ? 0:$userdata['user_level'] ;
		//$data_array['data'] = $this->dm->get_data($userdata['leasing_id'],$status);

		// show_array($_REQUEST); 

    	$draw = $_REQUEST['draw']; // get the requested page 
    	$start = $_REQUEST['start'];
        $limit = $_REQUEST['length']; // get how many rows we want to have into the grid 
        $sidx = isset($_REQUEST['order'][0]['column'])?$_REQUEST['order'][0]['column']:"daft_id"; // get index row - i.e. user click to sort 
        $sord = isset($_REQUEST['order'][0]['dir'])?$_REQUEST['order'][0]['dir']:"asc"; // get the direction if(!$sidx) $sidx =1;  
        
        $no_rangka = $_REQUEST['columns'][5]['search']['value'];
        $tanggal_awal = $_REQUEST['columns'][4]['search']['value'];
        $tanggal_akhir = $_REQUEST['columns'][6]['search']['value'];
        $status = $_REQUEST['columns'][7]['search']['value'];


      //  order[0][column]
        $req_param = array (
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null,
				"vleasing_id" => $userdata['leasing_id'],
				"status" => $status,
				"no_rangka" => $no_rangka,
				"tanggal_awal" => $tanggal_awal,
				"tanggal_akhir" => $tanggal_akhir,
				"status",$status
		);     
           
        $row = $this->dm->data($req_param)->result_array();
		
        $count = count($row); 
       
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->dm->data($req_param)->result_array();
        

       
        $arr_data = array();
        foreach($result as $row) : 
        	$daft_id = $row['daft_id'];
        	$warna = ($row['approved'] == 1) ? "green":"red";
        	$arr_data[] = array(
        			"<input type=\"checkbox\" class=\"ck_data\" name=daft_id[] value=".$row['daft_id']." />", 
        		 
        		  				$row['daft_id'], 
        		  				flipdate($row['daft_date']),
        		  				$row['no_surat'], 
        		  				$row['cabang_nama'], 
        		  				$row['no_rangka'],
        		  				$row['nama_pengajuan_leasing'],
        		  				$row['status2']."  / <span class='$warna'>".$row['approved2'].'</span>',
        		  				"<div class=\"btn-group\"> 
     <a class=\"btn dropdown-toggle btn-primary\" data-toggle=\"dropdown\" href=\"#\">Proses<span class=\"caret\"></span></a>
     
     <ul class=\"dropdown-menu\">
		<li><a  href=\" " . site_url("admin_verifikasi/detail/".$daft_id) ."\" ><span class=\"glyphicon glyphicon-chevron-right\"></span> Detail </a></li>
		<li><a  target=blank  href=\" " . site_url("admin_verifikasi/cetak_permohonan/".$daft_id) ."\" ><span class=\"glyphicon glyphicon-print\"></span> Cetak Permohonan </a></li>
		<li><a  target=blank  href=\" " . site_url("admin_verifikasi/cetak_berkas/".$daft_id) ."\" ><span class=\"glyphicon glyphicon-print\"></span> Cetak Surat Blokir </a></li>
		
       
	</ul>


	</div> "
        		  				);
        endforeach;

         $responce = array('draw' => $draw, // ($start==0)?1:$start,
        				  'recordsTotal' => $count, 
        				  'recordsFiltered' => $count,
        				  'data'=>$arr_data
        	);
         
        echo json_encode($responce); 
    }



function get_pendaftaran_detail($daft_id){
	  	$userdata = $this->session->userdata("userdata");
	  	$leasing_id = $userdata['leasing_id'];
	  	$arr = $this->dm->get_pendaftaran_detail_print($leasing_id,$daft_id);
	  	echo json_encode($arr);
	  }

function verifikasi($daft_id) {

	$data = $this->input->post();
	// show_array($data);
	// exit;

	$userdata = $this->session->userdata("userdata");
	if($userdata['user_level']==2){

		// cek dulu apakah memang boleh diupdate
		$this->db->where("daft_id",$daft_id);
		$data_daft = $this->db->get("t_pendaftaran")->row();
		// echo $this->db->last_query(); exit;
		if($data_daft->status >= $userdata['user_level'] ) {
			$ret = array("error"=>true,"message"=>"HAK AKSES TIDAK SESUAI");
		}
		else {
		$arr_data=array("daft_level2_date"=>date("Y-m-d"),
						"daft_level2_by"=>$userdata['user_id'],
						"status" => 2,
						"kontrak_no" => $data['kontrak_no'],
						"kontrak_date" => flipdate($data['kontrak_date']),
						"kontrak_perihal" => $data['kontrak_perihal']
						);
			$this->db->where("daft_id",$daft_id);
			$res = $this->db->update("t_pendaftaran",$arr_data);
			if($res){
				$ret = array("error"=>false,"message"=>"VERIFIKASI BERHASIL");
			}
			else {
				$ret = array("error"=>true,"message"=>"VERIFIKASI GAGAL ".mysql_error());
			}
		}
	}
	else {
		$ret = array("error"=>true,"message"=>"HAK AKSES TIDAK SESUAI");
	}
	echo json_encode($ret);
}





function verifikasi3($daft_id) {
	$userdata = $this->session->userdata("userdata");
	if($userdata['user_level']==3){

		// cek dulu apakah memang boleh diupdate
		$this->db->where("daft_id",$daft_id);
		$data_daft = $this->db->get("t_pendaftaran")->row();

		if($data_daft->status <> '2' ) {
			$ret = array("error"=>true,"message"=>"HAK AKSES TIDAK SESUAI");
		}
		else {


			if($this->pilihan=="B") {
				$this->db->where("id_polda",$data_daft->id_polda);
				$data_polda = $this->db->get("m_polda")->row();

				$aut_data = $this->get_auth_data();

				// show_array($aut_data);
				$data_service = array("LoginInfo"=>array(
								"LoginName" => $aut_data->service_user,
								"Salt"		=> $aut_data->service_salt,
								"AuthHash" 	=> md5($aut_data->service_salt . md5($aut_data->service_user.$aut_data->service_pass))
								),
								"RequestBlokirItemList"=>
								array(0=>array(
									"NoRangka"=> $data_daft->no_rangka,
									"NoPermohonan" =>$data_daft->no_surat
									))
								);
				$json_data = json_encode($data_service);

				// show_array($aut_data);
				// show_array($json_data); exit;

				$ret_service = $this->execute_service($data_polda->url,"RanRuRequestBlokir",$json_data);
			   	// show_array($ret_service); exit;

				if($ret_service['error']==false)
				{


						if($ret_service['data']['Result'] == true) {  // return dari server true
							$arr_data=array("daft_level3_date"=>date("Y-m-d"),
										"daft_level3_by"=>$userdata['user_id'],
										"approved_error" => 0,
										//"approved" => 1,
										"approved" => 0,
										"status" => 3);
							$this->db->where("daft_id",$daft_id);
							$res = $this->db->update("t_pendaftaran",$arr_data);
		 
							$ret = array("error"=>false,"message"=>"VERIFIKASI BERHASIL");
							 
						}
						else { // return dari server false
							$kode_error = $ret_service['data']['ResponseBlokirItemList'][0]->KodeError;
							$pesan_eror = $this->error_msg($kode_error);


							$arr_data=array("daft_level3_date"=>date("Y-m-d"),
										"daft_level3_by"=>$userdata['user_id'],
										"approved_error" => $kode_error,
										"approved" => 0,
										"status" => 3);
							$this->db->where("daft_id",$daft_id);
							$res = $this->db->update("t_pendaftaran",$arr_data);
							// echo "gagal ". $this->db->last_query();

							$ret = array("error"=>true,"message"=>"$kode_error VERIFIKASI GAGAL \n". $pesan_eror);


						}
				}
				else {
					$ret = array("error"=>true,"message"=>"GAGAL MENGHUBUNGI SERVER KEPOLISIAN");
				}

			}
			else {  // KENDARAAN LAMA

				// begin
				// end of process
				$this->db->where("id_polda",$data_daft->id_polda);
				$data_polda = $this->db->get("m_polda")->row();

				$aut_data = $this->get_auth_data();


				$data_service = array("LoginInfo"=>array(
								"LoginName" => $aut_data->service_user,
								"Salt"		=> $aut_data->service_salt,
								"AuthHash" 	=> md5($aut_data->service_salt . md5($aut_data->service_user.$aut_data->service_pass))
								),
								"NoBPKB"=>$data_daft->no_bpkb

								);
				$json_data = json_encode($data_service);
				// echo "<pre>";
				// echo $json_data;
				// echo "</pre>";
				// exit;

				$ret_service = $this->execute_service($data_polda->url,"RanMaVerifiedForBlokir",$json_data);
				// show_array($ret_service);
				// exit;
				// PUSH DATA KE SERVER
				if($ret_service)
				{
						if($ret_service['Result'] == true and $ret_service['KodeError'] == 0) {  // return dari server true
							$arr_data=array("daft_level3_date"=>date("Y-m-d"),
										"daft_level3_by"=>$userdata['user_id'],
										"status" => 3,
										"approved" => 1,
										"id_approval" => $ret_service['IdApproval']
										);
							$this->db->where("daft_id",$daft_id);
							$res = $this->db->update("t_pendaftaran",$arr_data);
							if($res){
								$ret = array("error"=>false,"message"=>"VERIFIKASI BERHASIL");
							}
							else {
								$ret = array("error"=>true,"message"=>"VERIFIKASI GAGAL ".mysql_error());
							}
						}
						else { // return dari server false
							$kode_error = $ret_service['KodeError'];
							$pesan_eror = $this->error_msg_lama($kode_error);
							$ret = array("error"=>true,"message"=>"VERIFIKASI GAGAL \n". $pesan_eror);
						}
				}
				else {
					$ret = array("error"=>true,"message"=>"GAGAL MENGHUBUNGI SERVER KEPOLISIAN");
				}


			}






		}
	}
	else {
		$ret = array("error"=>true,"message"=>"HAK AKSES TIDAK SESUAI");
	}
	echo json_encode($ret);
}




function cek($daft_id) {
	$hasil = $this->validasi($daft_id) ;
	// show_array($hasil);
	// exit;
	if(!$hasil) {
		return false;
	}
	else {
		if(isset($hasil['RequestBlokirEntryList'])) {
			// echo "valid ";
			return true;
		}
		else {
			return false; //echo "not valid";
		}
	}

}

function cek2($daft_id) {
	$hasil = $this->validasi($daft_id) ;
	show_array($hasil);
	exit;
	if(!$hasil) {
		return false;
	}
	else {
		if(isset($hasil['RequestBlokirEntryList'])) {
			// echo "valid ";
			return true;
		}
		else {
			return false; //echo "not valid";
		}
	}

}

function cek_status($daft_id){
	$arr = array();
	if($this->cek($daft_id) == false) {
		$arr['error'] = true;
	}
	else {
		$arr['error'] = false;
	}
	echo json_encode($arr);
}


function batal($daft_id) {
	$userdata = $this->session->userdata("userdata");
	// show_array($userdata);
	// exit;
	if($userdata['user_level']==2){

		// cek dulu apakah memang boleh diupdate
		$this->db->where("daft_id",$daft_id);
		$data_daft = $this->db->get("t_pendaftaran")->row();

		if($data_daft->status > $userdata['user_level'] ) {
			$ret = array("error"=>true,"message"=>"HAK AKSES TIDAK SESUAI");
		}
		else {
			$arr_data=array("daft_level2_date"=> NULL,
						"daft_level2_by"=>NULL,
						"status" => 0);
			$this->db->where("daft_id",$daft_id);
			$res = $this->db->update("t_pendaftaran",$arr_data);
			if($res){
				$ret = array("error"=>false,"message"=>"BATAL VERIFIKASI BERHASIL");
			}
			else {
				$ret = array("error"=>true,"message"=>"BATAL VERIFIKASI GAGAL ".mysql_error());
			}
		}
	}
	else {
		$ret = array("error"=>true,"message"=>"HAK AKSES TIDAK SESUAI");
	}
	echo json_encode($ret);
}





// function cetak_permohonan
function cetak_permohonan($daft_id) {


		$userdata = $this->session->userdata("userdata");
		$data = $this->dm->get_pendaftaran_detail_print($userdata['leasing_id'],$daft_id);

		if($data['approved'] == 0 ){
			$data['content'] = "DOKUMEN TIDAK DAPAT DICETAK.";
			$content = $this->load->view("error",$data,true);

			$this->set_subtitle("ERROR ");
			$this->set_title("DOKUMEN TIDAK DAPAT DICETAK. STATUS BELUM DIAPPROVED OLEH KEPOLISIAN");
			$this->set_content($content);
			$this->render_baru();
		}
		else
		{


		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'F4', true, 'UTF-8', false);
		$pdf->SetTitle('BERITA ACARA PEMBLOKIRAN');
		$pdf->SetMargins(10, 10, 20);
		$pdf->SetHeaderMargin(10);
		$pdf->SetFooterMargin(10);
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', 10));

 		$pdf->SetAutoPageBreak(true,10);
		$pdf->SetAuthor('Author');


		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->AddPage();

		// show_array($data);
		// exit;
		// $file_name = md5(date("dmyhsi")).".png";
		// $data['file_name'] = $file_name;
		//$this->generate_qrcode($file_name,$data['no_blokir']);
		$html = $this->load->view("pdf/surat_permohonan",$data,true);
		// echo $html; exit;
		$pdf->writeHTML($html, true, false, true, false, '');

		 //$pdf->AddPage();




		 $pdf->Output('DOKUMEN PERMOHONNAN'. $data['no_rangka'] .'.pdf', 'I');
		}

}


function cetak_berkas($daft_id) {


		$userdata = $this->session->userdata("userdata");
		$data = $this->dm->get_pendaftaran_detail_print($userdata['leasing_id'],$daft_id);


			// $url = $this->session->userdata("url");
			// $aut_data = $this->get_auth_data();
			// $data_service = array("LoginInfo"=>array(
			// 				"LoginName" => $aut_data->service_user,
			// 				"Salt"		=> $aut_data->service_salt,
			// 				"AuthHash" 	=> md5($aut_data->service_salt . md5($aut_data->service_user.$aut_data->service_pass))
			// 				),
			// 				"Criteria"=>array(
			// 					"Param" => $data['no_rangka'],
			// 					"ParamKind" => 1
			// 				)

			// 				);
			// $json_data = json_encode($data_service);



			// $ret_service = $this->execute_service($url,"ComplGetBerkasCheckPoint",$json_data);

			//show_array($ret_service); exit;

		// extract($ret_service);
		// if($Result == "1")	{
		// $data['warna_nama'] = $Data->Warna;
		// $data['pemilik_nama'] = $Data->Pemilik;
		// $data['pemilik_alamat'] = $Data->Alamat;
		// $data['jenis_nama'] = $Data->Jenis;
		// }


		// show_array($data);
		// if($data['approved'] != "1" and $data['status'] != "3" ){
		// 	$data['content'] = "DOKUMEN TIDAK DAPAT DICETAK.";
		// 	$content = $this->load->view("error",$data,true);

		// 	$this->set_subtitle("ERROR ");
		// 	$this->set_title("DOKUMEN TIDAK DAPAT DICETAK. STATUS BELUM DIAPPROVED OLEH KEPOLISIAN");
		// 	$this->set_content($content);
		// 	$this->render_baru();
		// }
		// else

		if($data['approved'] == 1 and $data['status'] ==  "3" )
		{

			// echo "cetak"; exit;

		$this->load->library('Pdf');
		//$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$custom_layout = array("220", "330");
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT,$custom_layout, true, 'UTF-8', false);
		$pdf->SetTitle('BERITA ACARA PEMBLOKIRAN');
		$pdf->SetMargins(10, 10, 10);
		$pdf->SetHeaderMargin(5);
		$pdf->SetFooterMargin(5);
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, 'Arial', 12));

 		$pdf->SetAutoPageBreak(false,10);
		$pdf->SetAuthor('Author');


		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->AddPage();

		// show_array($data);
		// exit;
		$file_name = md5(date("dmyhsi")).".png";
		$data['file_name'] = $file_name;
		$this->generate_qrcode($file_name,$data['no_blokir']);
		$html = $this->load->view("pdf/surat",$data,true);
		// echo $html; exit;
		$pdf->writeHTML($html, true, false, true, false, '');

		 //$pdf->AddPage();




		 $pdf->Output('DOKUMEN BLOKIR' . $data['no_rangka'] .'.pdf', 'I');
		}
		else {
				$data['content'] = "DOKUMEN TIDAK DAPAT DICETAK.";
			$content = $this->load->view("error",$data,true);

			$this->set_subtitle("ERROR ");
			$this->set_title("DOKUMEN TIDAK DAPAT DICETAK. STATUS BELUM DIAPPROVED OLEH KEPOLISIAN");
			$this->set_content($content);
			$this->render_baru();
		}

}



function generate_qrcode($file_name,$txt){
	$data = $this->session->userdata("nama_polda").":";
	$data .= $txt;
	// $data .= $_GET['data'];

	// $file_name=$_GET['file_name'];
	$this->load->library('ciqrcode');
	// echo FCPATH;
	// exit;
	// header("Content-Type: image/png");
	$params['savename'] = FCPATH."/assets/images/qrcode/$file_name";
	$params['level'] = 'H';
	$params['size'] = 10;
	$params['data'] = $data;
	$this->ciqrcode->generate($params);
}

function code(){
	$data = $this->session->userdata("nama_polda").":";
	$data .= $_GET['data'];
	$this->load->library('ciqrcode');
	$file_name=$_GET['file_name'];

	// echo FCPATH;
	// exit;
	// header("Content-Type: image/png");
	$params['savename'] = FCPATH."/assets/images/qrcode/$file_name";
	$params['level'] = 'H';
	$params['size'] = 10;
	$params['data'] = $data;
	$this->ciqrcode->generate($params);
}



function get_list_daftar(){


		$data = $this->input->post();

// 		tanggal_akhir
// 10-07-2015
// tanggal_awal
// 08-07-2015
		$this->session->set_userdata("tanggal_awal",$data['tanggal_awal']);
		$this->session->set_userdata("tanggal_akhir",$data['tanggal_akhir']);

		$userdata = $this->session->userdata("userdata");
		$data['leasing_id'] = $userdata['leasing_id'];
		$status = ($userdata['user_level'] == 1) ? 0:$userdata['user_level'] ;

		$data['status'] = $status;
		// show_array($data); exit;
		$arr = $this->dm->get_list_daftar($data);
		echo json_encode($arr);

}



function detail($daft_id){
	$userdata = $this->session->userdata("userdata");
	$data_array = $this->dm->get_pendaftaran_detail_print($userdata['leasing_id'],$daft_id);
	// show_array($data_array);


		$data_array['controller'] = get_class($this);
		$data_array['userdata'] = $userdata;

		$content = $this->load->view("admin_verifikasi_view_detail",$data_array,true);

		$this->set_subtitle("DETAIL PENDAFTARAN ");
		$this->set_title("DETAIL PENDAFTARAN ");
		$this->set_content($content);
		$this->render_baru();
}

function detail2($daft_id){
	$userdata = $this->session->userdata("userdata");
	$data_array = $this->dm->get_pendaftaran_detail_print($userdata['leasing_id'],$daft_id);
	show_array($data_array);


}



function cek_validasi($daft_id) {
$userdata = $this->session->userdata("userdata");
if($this->pilihan=="B")
{
	// echo "askti mafjfdjffd"; exit;
		// $ret_arr = array();
		// $hasil = $this->validasi($daft_id) ;
		$userdata = $this->session->userdata("userdata");
		// show_array($hasil);
		// exit;


		$this->db->where("daft_id",$daft_id);
		$data_daft = $this->db->get("t_pendaftaran")->row();




		$this->db->where("id_polda",$data_daft->id_polda);
				$data_polda = $this->db->get("m_polda")->row();

				$aut_data = $this->get_auth_data();


				$data_service = array("LoginInfo"=>array(
							"LoginName" => $aut_data->service_user,
							"Salt"		=> $aut_data->service_salt,
							"AuthHash" 	=> md5($aut_data->service_salt . md5($aut_data->service_user.$aut_data->service_pass))
							),
							"NoRangkaList"=>array(0=>$data_daft->no_rangka)
							//array(0=>$no_rangka)
							);

			  $json_data = json_encode($data_service);
		 	 
			  //echo $json_data; exit;

			  $ret_service = $this->execute_service($data_polda->url,"RanRuGetBlokirEntryByNoKa",$json_data);
			  //echo "return " .$ret_service;
			 // show_array($ret_service);
			  //$hasil = json_decode($ret_service); 
			  // show_array($hasil);
			  if($ret_service['error'] == false) {


			  			if(!isset($ret_service['data']['RequestBlokirEntryList'])) {
							$ret_arr['error']  = true;
							$ret_arr['message'] = "BERKAS BELUM TERDAFTAR.";
						}
						else if(empty($ret_service['data']['RequestBlokirEntryList'][0]->NoBlokir)) {
							$ret_arr['error']  = true;
							$ret_arr['message'] = "BERKAS BELUM DIAPPROVE";
						}
					    else { 
			  	  		
			  	  		$dataBlokir = $ret_service['data']['RequestBlokirEntryList'][0];
			  	 		$arr_update = array();
						$arr_update['approved'] = 1;
						$arr_update['no_rangka'] = $dataBlokir->NoRangka;
						$arr_update['no_bpkb'] = $dataBlokir->NoBpkb;
						$arr_update['no_blokir'] = $dataBlokir->NoBlokir;
						$arr_update['no_polisi'] = $dataBlokir->NoPolisi;
						$arr_update['tgl_blokir'] = $this->tanggal($dataBlokir->TglBlokir);
						$arr_update['tgl_bpkb']  = $this->tanggal($dataBlokir->TglBpkb);
						$arr_update['tgl_blokir2']  = $this->tanggal2_tahun($dataBlokir->TglBlokir);
						$arr_update['sub_id'] = $dataBlokir->SubID;

						$arr_update['jenis_nama'] = $dataBlokir->Jenis; 
						$arr_update['warna_nama'] = $dataBlokir->Warna; 
						$arr_update['pemilik_nama'] = $dataBlokir->NamaPemilik; 
						$arr_update['pemilik_alamat'] = $dataBlokir->AlamatPemilik; 

						$arr_update['pemilik_ktp'] = $dataBlokir->NoIdentitas; 
						$arr_update['merk_nama'] = $dataBlokir->Merk; 
						$arr_update['jenis_nama'] = $dataBlokir->Jenis; 
						$arr_update['nreg_bpkb'] = $dataBlokir->NoRegBpkb; 



						$this->db->where("no_rangka",$dataBlokir->NoRangka);
						$this->db->where("leasing_id",$userdata['leasing_id']);
						$this->db->update("t_pendaftaran",$arr_update);

						// echo $this->db->last_query();

						$ret_arr['error']  = false;
						$ret_arr['message'] = "BERKAS  DIAPPROVE";
						 
			  	 	 	}

			  	 
			  

			  }
			  else {
			  	$ret = array("error"=>true, "message"=>"Gagal menghubungi server");
			  }



 
}

else { // KENDARAAN LAMA
$userdata = $this->session->userdata("userdata");
$this->db->where("daft_id",$daft_id);
$this->db->where("jenis_permohonan",$this->pilihan);
$this->db->where("leasing_id",$userdata['leasing_id']);
$data_daft = $this->db->get("t_pendaftaran")->row();
// show_array($data_daft); exit;

// get data polda
$this->db->where("id_polda",$data_daft->id_polda);
$data_polda = $this->db->get("m_polda")->row();

$aut_data = $this->get_auth_data();
// generate json data
$data_service = array("LoginInfo"=>array(
							"LoginName" => $aut_data->service_user,
							"Salt"		=> $aut_data->service_salt,
							"AuthHash" 	=> md5($aut_data->service_salt . md5($aut_data->service_user.$aut_data->service_pass))
							),
							"DataPermohonan"=>
							array("NoBPKB"=>$data_daft->no_bpkb,
								"NoPermohonan" => $data_daft->no_surat,
								"IdApproval" => $data_daft->id_approval
								)
							);
			$json_data = json_encode($data_service);

			//echo $json_data; exit;

	$ret_service = $this->execute_service($data_polda->url,"RanMaExecuteBlokir",$json_data);




if(!$ret_service) {
			$ret_arr['error']  = true;
			$ret_arr['message'] = "KONEKSI TERPUTUS DENGAN SERVER PUSAT";
}
else if($ret_service['Result'] == true and  $ret_service['KodeError'] <> 0  ) {
			$ret_arr['error']  = true;

			$error_code = $ret_service['KodeError'];
			$error  = array(1=>"BPKB TIDAK DITEMUKAN",
				"DATA TIAK DITEMUKAN DALAM DATABASE VERIFIED REQUEST",
				"BPKB YANG DISUBMIT TIDAK SESUAI SAAT VERIFIKASI",
				"LEASING YANG MELAKUKAN BLOKIR TIDAK SAMA DENGAN YANG MELAKUKAN VERIFIKASI ",
				"BPKB TELAH DIBLOKIR");

			$ret_arr['message'] = "BERKAS BELUM TERDAFTAR. \n". $error[$error_code];
}
else { // no error may found

	$data['no_blokir'] = $ret_service['BlokirData']->NoRegBlokir;
	$data['tgl_blokir'] = $this->tanggal($ret_service['BlokirData']->TglBlokir);
	$data['tgl_blokir2'] = $this->tanggal($ret_service['BlokirData']->TglAkhirBerlaku);
	$data['approved'] = 1;
	$data['daft_level3_by'] = $userdata['user_name'];
	$data['daft_level3_date'] = date("Y-m-d");
	$this->db->where("daft_id",$daft_id);
	$res = $this->db->update("t_pendaftaran",$data);
		if($res){
			$ret_arr['error']  = false;
			$ret_arr['message'] = "BLOKIR BERHASIL";
		}
		else {
			$ret_arr['error']  = true;
			$ret_arr['message'] = "GAGAL BLOKRI ".mysql_error();
		}

	}
}

echo json_encode($ret_arr);

}

function verifikasi_all(){
	$data = $this->input->post();
	//show_array($data);

	$userdata = $this->session->userdata("userdata");

	if(count($data['daft_id']) == 0) {
	$ret = array("error"=>true,"message"=>"Tidak ada data yang dipilih");
	}

	else {
		$x = 0;
		$y = 0;

				$arr_norangka = array();
				foreach($data['daft_id'] as $daft_id) :


						$this->db->where("daft_id",$daft_id);
						$data_daft = $this->db->get("t_pendaftaran")->row();

						
						// if($)
						if($data_daft->status == "2") { 
						
						$arr_norangka[] = array("NoRangka"=> $data_daft->no_rangka,
											"NoPermohonan" =>$data_daft->no_surat);
						}
				endforeach;



				$this->db->where("id_polda",$data_daft->id_polda);
				$data_polda = $this->db->get("m_polda")->row();

				$aut_data = $this->get_auth_data();


				$data_service = array("LoginInfo"=>array(
								"LoginName" => $aut_data->service_user,
								"Salt"		=> $aut_data->service_salt,
								"AuthHash" 	=> md5($aut_data->service_salt . md5($aut_data->service_user.$aut_data->service_pass))
								),
								"RequestBlokirItemList"=>
								$arr_norangka
								);

				// show_array($data_service);
				// exit;


				$json_data = json_encode($data_service);



				$ret_service = $this->execute_service($data_polda->url,"RanRuRequestBlokir",$json_data);

				// show_array($ret_service);
				// exit;
				if($ret_service['error'] == false) { 
					foreach($data['daft_id'] as $daft_id) :
							$arr_data=array("daft_level3_date"=>date("Y-m-d"),
												"daft_level3_by"=>$userdata['user_id'],
												"approved_error" => 0,
												//"approved" => 1,
												"approved" => 0,
												"status" => 3);
							$this->db->where("daft_id",$daft_id);
							$res = $this->db->update("t_pendaftaran",$arr_data);
							
							if($data_daft->status == "2") { 
							$x++;
							}

					endforeach;


					if($ret_service['data']['Result'] == true) {

			 				
					}
					else {
						// echo "ada  yang error " ;
						foreach($ret_service['data']['ResponseBlokirItemList'] as $respons ) :
							// echo "noKA = $respons->NoRangka  | kode error $respons->KodeError<br />";

							$kode_error = $respons->KodeError;
							//$pesan_eror = $this->error_msg($kode_error);
							$arr_data=array("daft_level3_date"=>date("Y-m-d"),
												"daft_level3_by"=>$userdata['user_id'],
												"approved_error" => $kode_error,
												"approved" => 0,
												"status" => 3);
							// $this->db->where("daft_id",$daft_id);
							$this->db->where("no_rangka",$respons->NoRangka);
							$res = $this->db->update("t_pendaftaran",$arr_data);

		 					$y++;
		 					$x--;
	 					endforeach;

					}




						    $pesan = "Jumlah Berhasil proses = $x  <br />
						    		  Jumlah Gagal proses = $y <br />
						    		  Total = ". ($x + $y);
						    $ret = array("error"=>false, "message"=>$pesan);


				 
				}
				else {
					$ret = array("error"=>true, "message"=>"Gagal menghubungi server");
				}

		 		


	    }
	    echo json_encode($ret);


}


function cek_validasi_new(){
	$data = $this->input->post();
	foreach($data['daft_id'] as $daft_id) :

				$this->db->where("daft_id",$daft_id);
				$data_daft = $this->db->get("t_pendaftaran")->row();

				$arr_norangka[] =  $data_daft->no_rangka;

	endforeach;

		$userdata = $this->session->userdata("userdata");
				$this->db->where("id_polda",$data_daft->id_polda);
				$data_polda = $this->db->get("m_polda")->row();

				$aut_data = $this->get_auth_data();


				$data_service = array("LoginInfo"=>array(
							"LoginName" => $aut_data->service_user,
							"Salt"		=> $aut_data->service_salt,
							"AuthHash" 	=> md5($aut_data->service_salt . md5($aut_data->service_user.$aut_data->service_pass))
							),
							"NoRangkaList"=>$arr_norangka
							//array(0=>$no_rangka)
							);

			  $json_data = json_encode($data_service);
		 	 
			  //echo $json_data; exit;

			  $ret_service = $this->execute_service($data_polda->url,"RanRuGetBlokirEntryByNoKa",$json_data);
			  //echo "return " .$ret_service;
			 //show_array($ret_service); exit;
			  //$hasil = json_decode($ret_service); 
			  // show_array($hasil);
			  // show_array($ret_service); exit;
			  if($ret_service['error'] == false) {



			  	$benar = 0;
			  	$salah =0;
			  	 foreach($ret_service['data']['RequestBlokirEntryList'] as $dataBlokir) : 

			  	 	if(empty($dataBlokir->NoBlokir)) {
			  	 		$salah++;
			  	 	}
			  	 	else {
			  	 		$arr_update = array();
						$arr_update['approved'] = 1;
						$arr_update['no_rangka'] = $dataBlokir->NoRangka;
						$arr_update['no_bpkb'] = $dataBlokir->NoBpkb;
						$arr_update['no_blokir'] = $dataBlokir->NoBlokir;
						$arr_update['no_polisi'] = $dataBlokir->NoPolisi;
						$arr_update['tgl_blokir'] = $this->tanggal($dataBlokir->TglBlokir);
						$arr_update['tgl_bpkb']  = $this->tanggal($dataBlokir->TglBpkb);
						$arr_update['tgl_blokir2']  = $this->tanggal2_tahun($dataBlokir->TglBlokir);
						$arr_update['sub_id'] = $dataBlokir->SubID;

						$arr_update['jenis_nama'] = $dataBlokir->Jenis; 
						$arr_update['warna_nama'] = $dataBlokir->Warna; 
						$arr_update['pemilik_nama'] = $dataBlokir->NamaPemilik; 
						$arr_update['pemilik_alamat'] = $dataBlokir->AlamatPemilik; 

						$arr_update['pemilik_ktp'] = $dataBlokir->NoIdentitas; 
						$arr_update['merk_nama'] = $dataBlokir->Merk; 
						$arr_update['jenis_nama'] = $dataBlokir->Jenis; 
						$arr_update['nreg_bpkb'] = $dataBlokir->NoRegBpkb; 



						$this->db->where("no_rangka",$dataBlokir->NoRangka);
						$this->db->where("leasing_id",$userdata['leasing_id']);
						$this->db->update("t_pendaftaran",$arr_update);

						// echo $this->db->last_query();

						$ret_arr['error']  = false;
						$ret_arr['message'] = "BERKAS  DIAPPROVE";
						$benar++;
			  	 	}

			  	 endforeach;
			  	  $pesan = "Jumlah Berhasil proses = $benar  <br />
						    		  Jumlah Gagal proses = $salah <br />
						    		  Total = ". ($benar + $salah);
						    $ret = array("error"=>false, "message"=>$pesan);


			  }
			  else {
			  	$ret = array("error"=>true, "message"=>"Gagal menghubungi server");
			  }

			  echo json_encode($ret);

}


function cek_validasi_all(){
	$data = $this->input->post();
	//show_array($data);

	$userdata = $this->session->userdata("userdata");

	if(count($data['daft_id']) == 0) {
	$ret = array("error"=>true,"message"=>"Tidak ada data yang dipilih");
	}

	else {
		$x = 0;
		$y = 0;


				foreach($data['daft_id'] as $daft_id) :


					//echo "daft id = $daft_id <br />";


					$ret_arr = array();
					$hasil = $this->validasi($daft_id) ;


					if(!$hasil) {
						$ret_arr['error']  = true;
						$ret_arr['message'] = "KONEKSI TERPUTUS DENGAN SERVER PUSAT";
					}
					else if(!isset($hasil['RequestBlokirEntryList'])) {
						$ret_arr['error']  = true;
						$ret_arr['message'] = "BERKAS BELUM TERDAFTAR.";
						$y++;
					}
					else if(empty($hasil['RequestBlokirEntryList'][0]->NoBlokir)) {
						$ret_arr['error']  = true;
						$ret_arr['message'] = "BERKAS BELUM DIAPPROVE";
						$y++;
					}
					else if(!empty($hasil['RequestBlokirEntryList'][0]->NoBlokir)) {
						$arr_update = array();
						$arr_update['approved'] = 1;
						$arr_update['no_rangka'] = $hasil['RequestBlokirEntryList'][0]->NoRangka;
						$arr_update['no_bpkb'] = $hasil['RequestBlokirEntryList'][0]->NoBpkb;
						$arr_update['no_blokir'] = $hasil['RequestBlokirEntryList'][0]->NoBlokir;
						$arr_update['no_polisi'] = $hasil['RequestBlokirEntryList'][0]->NoPolisi;
						$arr_update['tgl_blokir'] = $this->tanggal($hasil['RequestBlokirEntryList'][0]->TglBlokir);
						$arr_update['tgl_bpkb']  = $this->tanggal($hasil['RequestBlokirEntryList'][0]->TglBpkb);
						$arr_update['tgl_blokir2']  = $this->tanggal2_tahun($hasil['RequestBlokirEntryList'][0]->TglBlokir);
						$arr_update['sub_id'] = $hasil['RequestBlokirEntryList'][0]->SubID;

						if(isset($hasil['RequestBlokirEntryList'][0]->Jenis)) { $arr_update['jenis_nama'] = $hasil['RequestBlokirEntryList'][0]->Jenis; }
						if(isset($hasil['RequestBlokirEntryList'][0]->Warna)) { $arr_update['warna_nama'] = $hasil['RequestBlokirEntryList'][0]->Warna; }
						if(isset($hasil['RequestBlokirEntryList'][0]->NamaPemilik)) { $arr_update['pemilik_nama'] = $hasil['RequestBlokirEntryList'][0]->NamaPemilik; }
						if(isset($hasil['RequestBlokirEntryList'][0]->AlamatPemilik)) { $arr_update['pemilik_alamat'] = $hasil['RequestBlokirEntryList'][0]->AlamatPemilik; }

						if(isset($hasil['RequestBlokirEntryList'][0]->NoIdentitas)) { $arr_update['pemilik_ktp'] = $hasil['RequestBlokirEntryList'][0]->NoIdentitas; }
						if(isset($hasil['RequestBlokirEntryList'][0]->Merk)) { $arr_update['merk_nama'] = $hasil['RequestBlokirEntryList'][0]->Merk; }
						if(isset($hasil['RequestBlokirEntryList'][0]->Jenis)) { $arr_update['jenis_nama'] = $hasil['RequestBlokirEntryList'][0]->Jenis; }
						if(isset($hasil['RequestBlokirEntryList'][0]->NoRegBpkb)) { $arr_update['nreg_bpkb'] = $hasil['RequestBlokirEntryList'][0]->NoRegBpkb; }



						$this->db->where("daft_id",$daft_id);
						$this->db->where("leasing_id",$userdata['leasing_id']);
						$this->db->update("t_pendaftaran",$arr_update);


						$ret_arr['error']  = false;
						$ret_arr['message'] = "BERKAS  DIAPPROVE";
						$x++;
					}
					else
					{
						$ret_arr['error']  = false;
						$ret_arr['message'] = "ERROR TIDAK DIKETAHUI";
					}


	    endforeach;

	    $pesan = "Jumlah Berhasil proses = $x  <br />
	    		  Jumlah Gagal proses = $y <br />
	    		  Total = ". ($x + $y);
	    $ret = array("error"=>false, "message"=>$pesan);


	    }
	    echo json_encode($ret);
}



}
?>
