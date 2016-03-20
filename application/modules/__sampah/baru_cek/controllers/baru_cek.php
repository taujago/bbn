<?php 
class baru_cek extends master_controller {
	function baru_cek(){
		parent::__construct();
		// $this->load->model("core_model","cm");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		$this->load->model("cek_model","dm");

	}

	function index(){



		$userdata = $this->session->userdata("userdata");
		$data_array['data'] = $this->dm->get_data($userdata['leasing_id']);
		$jenis = ($this->pilihan=="B")?"BARU":"LAMA"; 
		//show_array($data_array); exit;
		$data_array['controller'] = get_class($this);
		$data_array['jenis'] = array(1=>"NOMOR RANGKA","NOMOR BPKB");
		
		$content = $this->load->view($data_array['controller']."_view",$data_array,true);
		
		$this->set_subtitle("CEK STATUS BLOKIR KENDARAAN");
		$this->set_title("CEK STATUS BLOKIR KENDARAAN");
		$this->set_content($content);
		$this->render_baru();
	}

	 
	

function cek_status(){
	$data = $this->input->post();


	/// cek apakan datanya ada atau tidak di pendafatarn 
	$userdata = $this->session->userdata("userdata");
	// $data_array['data'] = $this->dm->get_data($userdata['leasing_id']);



// copy









	$this->db->where("leasing_id",$userdata['leasing_id']);
	$this->db->where("no_rangka",$data['no_rangka']);
	$res = $this->db->get("t_pendaftaran");
	if($res->num_rows() == 0){
		$ret = array("error"=>true,
					"message"=>"DATA NOMOR RANGKA BELUM TERDAFTAR");
		echo json_encode($ret);
		exit;
	}



	$data_daft = $res->row_array(); 


	// show_array($data_daft); 
	// if( $data_daft['status'] <> '3' or   $data_daft['approved'] <> '1' ){
	// 	$ret = array("error"=>true,
	// 				"message"=>"DATA BELUM DIVALIDASI DI KEPOLISIAN");
	// 	echo json_encode($ret);
	// 	exit;
	// }

	$aut_data = $this->get_auth_data();

	$url = $this->session->userdata("url");
	
	$data_service = array("LoginInfo"=>array(
							"LoginName" => $aut_data->service_user,
							"Salt"		=> $aut_data->service_salt,
							"AuthHash" 	=> md5($aut_data->service_salt . md5($aut_data->service_user.$aut_data->service_pass))
							),
							"Criteria"=>array(
								"Param" => $data['no_rangka'],
								"ParamKind" => $data['jenis']
							)
							 
							);
			$json_data = json_encode($data_service);
	

			$ret_service = $this->execute_service($url,"ComplGetBerkasCheckPoint",$json_data);
			
			// show_array($ret_service); exit;


			if($ret_service['error'] == true){
				$ret = array("error"=>true,
					"message"=>"GAGAL MENGHUBUNGI SERVER");
			}
			else {
				if($ret_service['data']['Result'] == false) {
					$ret = array("error"=>true,
					"message"=>"NOMOR BPKB TIDAK DITEMUKAN");
				}
				else {
					extract($ret_service['data']);

					$ran_data = (array) $Data;
					// show_array($ran_data);

					$ret['error'] = false;
					// $ran_data['no_rangka'] = $DataRanmor->NoRangka;
					// $ran_data['no_mesin'] = $DataRanmor->NoMesin;
					// $ran_data['no_bpkb'] = $DataRanmor->NoBPKB;
					// $ran_data['tgl_bpkb'] = $DataRanmor->TglBPKB;
					// $ran_data['no_polisi'] = $DataRanmor->NoPolisi;
					// $ran_data['tahun_kendaraan'] = $DataRanmor->ThnBuat;
					// $ran_data['jenis_nama'] = $DataRanmor->Jenis;
					// $ran_data['merk_nama'] = $DataRanmor->Merk;
					// $ran_data['warna_nama'] = $DataRanmor->Warna;
					// $ran_data['nama_pemilik'] = $DataRanmor->NamaPemilik;
					// $ran_data['alamat_pemilik'] = $DataRanmor->Alamat;
					// // $ran_data['no_rangka'] = $DataRanmor->NoRangka;
					// // $ran_data['no_rangka'] = $DataRanmor->NoRangka;
					// // show_array($ret_service);

					// // show_array($ran_data);
					$ran_data['TglDaftar'] = todate($ran_data['TglDaftar']) ;
					$ran_data['TglCetakBpkb'] = todate($ran_data['TglCetakBpkb']);
					$ran_data['TglPenyerahan'] = todate($ran_data['TglPenyerahan']);
					$ran_data['TglVerifikasi'] = todate($ran_data['TglVerifikasi']);

					$ran_data['TglCetakKartuInduk'] = todate($ran_data['TglCetakKartuInduk']);
					$ran_data['TglFaktur'] = todate($ran_data['TglFaktur']);
					$ran_data['TglEntri'] = todate($ran_data['TglEntri']);
					

					$ret['message'] = "DATA DITEMUKAN";
					$ret['data'] = $ran_data;

				}
			}
			echo json_encode($ret);
}



}
?>