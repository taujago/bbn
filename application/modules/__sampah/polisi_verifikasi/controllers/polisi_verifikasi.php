<?php 
class polisi_verifikasi extends master_controller {
	function polisi_verifikasi(){
		parent::__construct();
		// $this->load->model("core_model","cm");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		$this->load->model("ver_model","dm");

	}

	function index(){
		// echo "fuckkk.."; exit;
		$userdata = $this->session->userdata("userdata");


		
		
		 
		$data_array['arr_leasing'] = $this->dm->arr_leasing();	 
		$data_array['controller'] = get_class($this);
		$data_array['tanggal_awal'] = $this->session->userdata("tanggal_awal");
		$data_array['tanggal_akhir'] = $this->session->userdata("tanggal_akhir");
		$content = $this->load->view($data_array['controller']."_view",$data_array,true);
		$this->set_subtitle("VERIFIKASI PENDAFTARAN BLOKIR KENDARAAN LAMA");
		$this->set_title("VERIFIKASI PENDAFTARAN BLOKIR KENDARAAN LAMA");
		$this->set_content($content);
		$this->render_polisi();
	}

	 




function get_pendaftaran_detail($daft_id){
	  	$userdata = $this->session->userdata("userdata");
	  	$leasing_id = $userdata['leasing_id'];
	  	$arr = $this->dm->get_pendaftaran_detail_print($leasing_id,$daft_id);
	  	echo json_encode($arr);
	  }
 


function polisi_get_auth_data($leasing_id) {
	$userdata = $this->session->userdata("userdata");
	//$leasing_id = $userdata['leasing_id'];
	$id_polda = $this->session->userdata("id_polda");

	$this->db->where("id_polda",$id_polda);
	$this->db->where("leasing_id",$leasing_id);
	$data = $this->db->get("polda_leasing")->row();
	return $data;
}



function verifikasi3($daft_id) {
	// sleep(2);
	$userdata = $this->session->userdata("userdata");
	// show_array($userdata); exit;
	//echo "suckk...";
	if($userdata['user_level'] == 99){
		// echo "i'm 99 ";
		// cek dulu apakah memang boleh diupdate 
		$this->db->where("daft_id",$daft_id);
		$data_daft = $this->db->get("t_pendaftaran")->row();


		if($data_daft->status <> '2' ) {
			$ret = array("error"=>true,"message"=>"HAK AKSES TIDAK SESUAI");
		}
		else { 

		 
			 
			//else {  // KENDARAAN LAMA 

				// begin 
				// end of process 
				$this->db->where("id_polda",$data_daft->id_polda);
				$data_polda = $this->db->get("m_polda")->row();

				$aut_data = $this->polisi_get_auth_data($data_daft->leasing_id);
				//show_array($aut_data); exit;

				


				/// cek kelengkapan datanya 

			// $data_service = array("LoginInfo"=>array(
			// 				"LoginName" => $aut_data->service_user,
			// 				"Salt"		=> $aut_data->service_salt,
			// 				"AuthHash" 	=> md5($aut_data->service_salt . md5($aut_data->service_user.$aut_data->service_pass))
			// 				),
			// 				"NoBPKB"=> $data_daft->no_bpkb
							 
			// 				);
			
			
			$data_service = array("LoginInfo"=>array(
							"LoginName" => $aut_data->service_user,
							"Salt"		=> $aut_data->service_salt,
							"AuthHash" 	=> md5($aut_data->service_salt . md5($aut_data->service_user.$aut_data->service_pass))
							),
							//"NoBPKB"=> $data_daft->no_bpkb
							"Param" => array(
								"Type" => "2",
								"Value" => $data_daft->no_rangka
								)
							 
							);
			 

			$json_data = json_encode($data_service);
		
			//echo "json data ".$json_data . "<br />";
		 
		 	$ret_service = $this->execute_service($data_polda->url,"RanMaGetDataRanmor",$json_data);
		 	// echo "service ". $ret_service;
		 	// show_array($ret_service);
		 	// exit;


		 	if($ret_service['error'] == true) {
		 		$ret = array("error"=>true,"message"=>"GAGAL MENGHUBUNGI SERVER KEPOLISIAN ",'debug'=>$ret_service);
		 		echo json_encode($ret);
		 		exit;

		 	}
		 	else {
		 		

		 		// cek apakah reslt true atau false 
		 		if($ret_service['data']['Result']==true){
		 			// show_array($ret_service['data']['DataRanmor']);


		 			if($ret_service['data']['DataRanmor']->Status <> 'AKTIF') {
		 				$ret = array("error"=>true,"message"=>"BPKB STATUS DIBLOKIR. TIDAK DAPAT DIBLOKIR KEMBALI",'debug'=>$ret_service);
				 		echo json_encode($ret);
				 		exit;
		 			}
		 			else {  // DATA FOUND AND  AKTIF. COPY THE FILE THEN 
		 				$dataBlokir = $ret_service['data']['DataRanmor'];
		 				$arr_update['no_rangka'] = $dataBlokir->NoRangka;
						$arr_update['no_bpkb'] = $dataBlokir->NoBPKB;
 						$arr_update['no_polisi'] = $dataBlokir->NoPolisi;
						 
						$arr_update['tgl_bpkb']  = $this->tanggal($dataBlokir->TglBPKB);
 
						$arr_update['jenis_nama'] = $dataBlokir->Jenis; 
						$arr_update['jenis_nama'] = $dataBlokir->Jenis; 
						$arr_update['warna_nama'] = $dataBlokir->Warna; 
						$arr_update['pemilik_nama'] = $dataBlokir->NamaPemilik; 
						$arr_update['type_kendaraan'] = $dataBlokir->Tipe; 					

						 
						$arr_update['merk_nama'] = $dataBlokir->Merk; 
 						$arr_update['nreg_bpkb'] = $dataBlokir->NoRegister; 

 						$arr_update['model'] = $dataBlokir->Model; 
 						$arr_update['tempat_penerbitan'] = $dataBlokir->TempatPenerbitan; 
 						$arr_update['jumlah_sumbu'] = $dataBlokir->JumlahRoda; 
 						$arr_update['jumlah_roda'] = $dataBlokir->JumlahSumbu; 
 						$arr_update['tahun_buat'] = $dataBlokir->ThnBuat; 
 						$arr_update['tahun_rakit'] = $dataBlokir->ThnRakit; 
 						$arr_update['vol_silinder'] = $dataBlokir->VolSilinder; 
 						$arr_update['bahan_bakar'] = $dataBlokir->BahanBakar; 
 						$arr_update['pemilik_pekerjaan'] = $dataBlokir->Pekerjaan; 
 						$arr_update['pemilik_kodepos'] = $dataBlokir->KodePos; 
 						$arr_update['wilayah_samsat'] = $dataBlokir->WilayahSamsat; 
 						$arr_update['no_faktur'] = $dataBlokir->NoFaktur; 
 						$arr_update['tgl_faktur'] = $this->tanggal($dataBlokir->TglFaktur); 
 						$arr_update['peruntukan'] = $dataBlokir->Peruntukan; 
 						$arr_update['jenis_daftaran'] = $dataBlokir->JenisDaftaran; 
 						$arr_update['no_pabean'] = $dataBlokir->NoPabean; 
 						$arr_update['tgl_pabean'] = $this->tanggal($dataBlokir->TglPabean); 
 						$arr_update['pelabuhan'] = $dataBlokir->Pelabuhan; 
 						$arr_update['cara_impor'] = $dataBlokir->CaraImpor; 
 						$arr_update['no_ckd'] = $dataBlokir->NoCKD; 
 						$arr_update['keterangan_pabean'] = $dataBlokir->KeteranganPabean; 
 						$arr_update['status_blokir'] = $dataBlokir->Status; 
 						$arr_update['keterangan_status'] = $dataBlokir->KeteranganStatus; 
 						$arr_update['pemilik_ktp'] = $dataBlokir->NoIdentitas; 





 						

 						// show_array($arr_update);
 						$this->db->where("daft_id",$data_daft->daft_id);
 						$res=$this->db->update("t_pendaftaran",$arr_update);
 						// echo $this->db->last_query(); exit;

		 			}


		 			 
		 		}
		 		else { // no data found 

		 			$arr_update = array("approved"=>2);
	 				$this->db->where("daft_id",$data_daft->daft_id);
					$res=$this->db->update("t_pendaftaran",$arr_update);

		 			$ret = array("error"	=>true,
			 					"message"	=>"BPKB TIDAK DAPAT DITEMUKAN",
			 					'debug'		=>$ret_service);
				 	echo json_encode($ret);
				 	exit;
		 		}



		 	}
				

		 	// echo "selamat ke sini.";
		 	// exit;

				

				$data_service = array("LoginInfo"=>array(
								"LoginName" => $aut_data->service_user,
								"Salt"		=> $aut_data->service_salt,
								"AuthHash" 	=> md5($aut_data->service_salt . md5($aut_data->service_user.$aut_data->service_pass))
								),
								"NoBPKB"=>$data_daft->no_bpkb
								 
								);
				// show_array($data_service);  
				$json_data = json_encode($data_service);
				// echo "<pre>";
				//echo $json_data;
				// echo "</pre>";
				// exit;

				 $ret_service = $this->execute_service($data_polda->url,"RanMaVerifiedForBlokir",$json_data);
				// $ret_service = $this->execute_service2($data_polda->url,"RanMaVerifiedForBlokir",$json_data);
			
				// echo "result".  $ret_service; exit;
				// show_array($ret_service); 
				// PUSH DATA KE SERVER 
				if($ret_service['error'] == false)
				{ 		

					if($ret_service['data']['Result'] == true and $ret_service['data']['KodeError'] == 0 ){
						// echo "result true";

						 
							// echo "kdoe error  nol ";
							$arr_data=array("daft_level3_date"=>date("Y-m-d"),
										"daft_level3_by"=>$userdata['user_id'],
										"status" => 3,
										"approved"=> 0,
										"approved_error"=> $ret_service['data']['KodeError'],
										"id_approval" => $ret_service['data']['IdApproval'] 
										);
							$this->db->where("daft_id",$daft_id);
							$res = $this->db->update("t_pendaftaran",$arr_data);

							$ret = array("error"=>false,"message"=>"VERIFIKASI BERHASIL",'debug'=>$ret_service);

						 
						

					}

					elseif($ret_service['data']['Result'] == false and $ret_service['data']['KodeError'] <> '0' ) {  // kode bukan 0
							// echo  "bukan nol ";
							$kode_error = $ret_service['data']['KodeError'];
							$pesan_eror = $this->error_msg_lama($kode_error);
							$msg=isset($ret_service['data']['msg'])?$ret_service['data']['msg']:"";
							$ret = array("error"=>true,"message"=>"VERIFIKASI GAGAL \n". $pesan_eror." ". $msg,'debug'=>$ret_service);

					}

					else {  // result false 
							$msg=isset($ret_service['data']['msg'])?$ret_service['data']['msg']:"";
							$kode_error = $ret_service['data']['KodeError'];
							$pesan_eror = $this->error_msg_lama($kode_error);
							$ret = array("error"=>true,"message"=>"VERIFIKASI GAGAL  $msg" ,'debug'=>$ret_service);
						//echo "result false";
					}

						  
				}
				else {
					$ret = array("error"=>true,"message"=>"GAGAL MENGHUBUNGI SERVER KEPOLISIAN",'debug'=>$ret_service);
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
		$pdf->SetMargins(30, 10, 20);
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
		$data = $this->dm->get_pendaftaran_detail_print($daft_id);

		// show_array($data); exit;

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
		$pdf->SetMargins(30, 10, 20);
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
		$file_name = md5(date("dmyhsi")).".png";
		$data['file_name'] = $file_name;
		$this->generate_qrcode($file_name,$data); 
		$html = $this->load->view("pdf/surat",$data,true);
		// echo $html; exit;
		$pdf->writeHTML($html, true, false, true, false, '');

		 //$pdf->AddPage();


		  

		 $pdf->Output('DOKUMEN BLOKIR' . $data['no_rangka'] .'.pdf', 'I');
		}
		
}




function cetak_keabsahan($daft_id) {

 		
		$userdata = $this->session->userdata("userdata");
		$data = $this->dm->get_pendaftaran_detail_print($daft_id);

		if($data['status'] < 3 ){
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
		//$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$custom_layout = array("220", "330");
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT,$custom_layout, true, 'UTF-8', false);
		$pdf->SetTitle('SURAT KEABSAHAN');
		$pdf->SetMargins(10, 10, 10);
		$pdf->SetHeaderMargin(5);
		$pdf->SetFooterMargin(5);
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, 'Arial', 12));

 		$pdf->SetAutoPageBreak(false,10);
		$pdf->SetAuthor('Author');


		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->AddPage();

		 
		$html = $this->load->view("pdf/surat_keabsahan",$data,true);
		// echo $html; exit;
		$pdf->writeHTML($html, true, false, true, false, '');

		 //$pdf->AddPage();




		 $pdf->Output('DOKUMEN KEABSAHAN ' . $data['no_rangka'] .'.pdf', 'I');
		}
		
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
		//$data['leasing_id'] = $userdata['leasing_id'];
		$status = ($userdata['user_level'] == 1) ? 0:$userdata['user_level'] ;

		$data['status'] = $status;
		// show_array($data); exit;
		$arr = $this->dm->get_list_daftar($data);
		echo json_encode($arr);

}



function detail($daft_id){

$this->db->where("daft_id",$daft_id);
$data_daft = $this->db->get("t_pendaftaran")->row();

				$this->db->where("id_polda",$data_daft->id_polda);
				$data_polda = $this->db->get("m_polda")->row();

				$aut_data = $this->polisi_get_auth_data($data_daft->leasing_id);
				//show_array($aut_data); exit;

				// show_array($data_daft); 


				/// cek kelengkapan datanya 

			$data_service = array("LoginInfo"=>array(
							"LoginName" => $aut_data->service_user,
							"Salt"		=> $aut_data->service_salt,
							"AuthHash" 	=> md5($aut_data->service_salt . md5($aut_data->service_user.$aut_data->service_pass))
							),
							//"NoBPKB"=> $data_daft->no_bpkb
							"Param" => array(
								"Type" => "2",
								"Value" => $data_daft->no_rangka
								)
							 
							);
			 
			$json_data = json_encode($data_service);
			// show_array($data_daft); 
		
			// echo "json data ".$json_data . "<br />"; //exit;
		 
		 	$ret_service = $this->execute_service($data_polda->url,"RanMaGetDataRanmor",$json_data);
		 	// echo "service ". $ret_service; exit;
		 	// show_array($ret_service); exit;
		 	// exit;

		 	// $ret_service = $this->execute_service2($data_polda->url,"RanMaGetDataRanmor",$json_data);
		 	// echo "service ". $ret_service; exit;

		 	// if($ret_service['error'] == true) {
		 	// 	$ret = array("error"=>true,"message"=>"GAGAL MENGHUBUNGI SERVER KEPOLISIAN",'debug'=>$ret_service);
		 	// 	echo json_encode($ret);
		 	// 	exit;

		 	// }
		 	// else {
		 		

		 		// cek apakah reslt true atau false 
		 		if($ret_service['data']['Result']==true){
		 			// show_array($ret_service['data']['DataRanmor']);


		 			 
		 				$dataBlokir = $ret_service['data']['DataRanmor'];
		 				// $arr_update['no_rangka'] = $dataBlokir->NoRangka;
						$arr_update['no_bpkb'] = $dataBlokir->NoBPKB;
 						$arr_update['no_polisi'] = $dataBlokir->NoPolisi;
 						$arr_update['no_mesin'] = $dataBlokir->NoMesin;

 						
						 
						$arr_update['tgl_bpkb']  = $this->tanggal($dataBlokir->TglBPKB);
 
						$arr_update['jenis_nama'] = $dataBlokir->Jenis; 
						$arr_update['jenis_nama'] = $dataBlokir->Jenis; 
						$arr_update['warna_nama'] = $dataBlokir->Warna; 
						$arr_update['pemilik_nama'] = $dataBlokir->NamaPemilik; 
						$arr_update['type_kendaraan'] = $dataBlokir->Tipe; 					

						 
						$arr_update['merk_nama'] = $dataBlokir->Merk; 
 						$arr_update['nreg_bpkb'] = $dataBlokir->NoRegister; 

 						$arr_update['model'] = $dataBlokir->Model; 
 						$arr_update['tempat_penerbitan'] = $dataBlokir->TempatPenerbitan; 
 						$arr_update['jumlah_sumbu'] = $dataBlokir->JumlahSumbu; 
 						$arr_update['jumlah_roda'] = $dataBlokir->JumlahRoda; 
 						$arr_update['tahun_buat'] = $dataBlokir->ThnBuat; 
 						$arr_update['tahun_rakit'] = $dataBlokir->ThnRakit; 
 						$arr_update['vol_silinder'] = $dataBlokir->VolSilinder; 
 						$arr_update['bahan_bakar'] = $dataBlokir->BahanBakar; 
 						$arr_update['pemilik_pekerjaan'] = $dataBlokir->Pekerjaan; 
 						$arr_update['pemilik_kodepos'] = $dataBlokir->KodePos; 
 						$arr_update['wilayah_samsat'] = $dataBlokir->WilayahSamsat; 
 						$arr_update['no_faktur'] = $dataBlokir->NoFaktur; 
 						$arr_update['tgl_faktur'] = $this->tanggal($dataBlokir->TglFaktur); 
 						$arr_update['peruntukan'] = $dataBlokir->Peruntukan; 
 						$arr_update['jenis_daftaran'] = $dataBlokir->JenisDaftaran; 
 						$arr_update['no_pabean'] = $dataBlokir->NoPabean; 
 						$arr_update['tgl_pabean'] = $this->tanggal($dataBlokir->TglPabean); 
 						$arr_update['pelabuhan'] = $dataBlokir->Pelabuhan; 
 						$arr_update['cara_impor'] = $dataBlokir->CaraImpor; 
 						$arr_update['no_ckd'] = $dataBlokir->NoCKD; 
 						$arr_update['keterangan_pabean'] = $dataBlokir->KeteranganPabean; 
 						$arr_update['status_blokir'] = $dataBlokir->Status; 
 						$arr_update['keterangan_status'] = $dataBlokir->KeteranganStatus; 
 						$arr_update['pemilik_ktp'] = $dataBlokir->NoIdentitas; 
 						$arr_update['pemilik_alamat'] = $dataBlokir->Alamat; 
  						// $arr_update['pemilik_kodepos'] = $dataBlokir->KodePos; 
 						
 						





 						

 						// show_array($arr_update);
 						$this->db->where("daft_id",$data_daft->daft_id);

 						$res=$this->db->update("t_pendaftaran",$arr_update);
 						// echo $this->db->last_query(); exit;
 


		 			 
		 	 
		 		// else { // no data found 
		 		// 	$ret = array("error"=>true,"message"=>"BPKB TIDAK DAPAT DITEMUKAN",'debug'=>$ret_service);
				 // 	echo json_encode($ret);
				 // 	exit;
		 		// }



		 	}

		 	// else {
		 	// 	echo "error dari webservice";
		 	// }




	$userdata = $this->session->userdata("userdata");
	$data_array = $this->dm->get_pendaftaran_detail_print($daft_id);
	// show_array($data_array);


		$data_array['controller'] = get_class($this);
		$data_array['userdata'] = $userdata;
		
		$content = $this->load->view("polisi_verifikasi_view_detail",$data_array,true);
		
		$this->set_subtitle("DETAIL PENDAFTARAN ");
		$this->set_title("DETAIL PENDAFTARAN ");
		$this->set_content($content);
		$this->render_polisi();
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
		$ret_arr = array();
		$hasil = $this->validasi($daft_id) ;
		$userdata = $this->session->userdata("userdata");
		// show_array($hasil);

		if(!$hasil) {
			$ret_arr['error']  = true;
			$ret_arr['message'] = "KONEKSI TERPUTUS DENGAN SERVER PUSAT";
		}
		else if(!isset($hasil['RequestBlokirEntryList'])) {
			$ret_arr['error']  = true;
			$ret_arr['message'] = "BERKAS BELUM TERDAFTAR.";
		}
		else if(empty($hasil['RequestBlokirEntryList'][0]->NoBlokir)) {
			$ret_arr['error']  = true;
			$ret_arr['message'] = "BERKAS BELUM DIAPPROVE";
		}
		else {
			$arr_update = array();
			$arr_update['approved'] = 1;
			$arr_update['no_rangka'] = $hasil['RequestBlokirEntryList'][0]->NoRangka;
			$arr_update['no_bpkb'] = $hasil['RequestBlokirEntryList'][0]->NoBpkb;
			$arr_update['no_blokir'] = $hasil['RequestBlokirEntryList'][0]->NoBlokir;
			$arr_update['no_polisi'] = $hasil['RequestBlokirEntryList'][0]->NoPolisi;
			$arr_update['tgl_blokir'] = $this->tanggal($hasil['RequestBlokirEntryList'][0]->TglBlokir);
			$arr_update['tgl_bpkb']  = $this->tanggal($hasil['RequestBlokirEntryList'][0]->TglBpkb);
			$arr_update['tgl_blokir2']  = $this->tanggal2_tahun($hasil['RequestBlokirEntryList'][0]->TglBpkb);
			
			$this->db->where("daft_id",$daft_id);
			$this->db->where("leasing_id",$userdata['leasing_id']);
			$this->db->update("t_pendaftaran",$arr_update);


			$ret_arr['error']  = false;
			$ret_arr['message'] = "BERKAS  DIAPPROVE";
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


				foreach($data['daft_id'] as $daft_id) : 
					

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
								"RequestBlokirItemList"=>
								array(0=>array(
									"NoRangka"=> $data_daft->no_rangka,
									"NoPermohonan" =>$data_daft->no_surat
									))
								);
				$json_data = json_encode($data_service);
		 
		 		// echo $json_data . '<br />';

				$ret_service = $this->execute_service($data_polda->url,"RanRuRequestBlokir",$json_data);
			 
		 		if($ret_service['Result'] == true) {  
					$arr_data=array("daft_level3_date"=>date("Y-m-d"),
								"daft_level3_by"=>$userdata['user_id'],
								"approved_error" => 0,
								"status" => 3);
					$this->db->where("daft_id",$daft_id);
					$res = $this->db->update("t_pendaftaran",$arr_data);
			 				$x++;
				}
				else { 
					$kode_error = $ret_service['ResponseBlokirItemList'][0]->KodeError;
					$pesan_eror = $this->error_msg($kode_error);
					

					$arr_data=array("daft_level3_date"=>date("Y-m-d"),
								"daft_level3_by"=>$userdata['user_id'],
								"approved_error" => $kode_error,
								"status" => 3);
					$this->db->where("daft_id",$daft_id);
					$res = $this->db->update("t_pendaftaran",$arr_data);

 					$y++;

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