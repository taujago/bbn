<?php 
class baru_bukablokir extends master_controller {
	function baru_bukablokir(){
		parent::__construct();
		// $this->load->model("core_model","cm");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		$this->load->helper("url");
		$this->load->model("buka_model","dm");

	}

	function index(){



		$userdata = $this->session->userdata("userdata");
		$data_array['data'] = array(); //$this->dm->get_data($userdata['leasing_id']);
		$jenis = ($this->pilihan=="B")?"BARU":"LAMA"; 
		//show_array($data_array); exit;
		$data_array['controller'] = get_class($this);
		$data_array['jenis'] = array(1=>"NOMOR RANGKA","NOMOR BPKB");
		
		$content = $this->load->view($data_array['controller']."_view",$data_array,true);
		
		$this->set_subtitle("BUKA BLOKIR");
		$this->set_title("BUKA BLOKIR");
		$this->set_content($content);
		$this->render_baru();
	}


function list_buka_blokir(){



		$userdata = $this->session->userdata("userdata");
		$data_array['data'] = array(); //$this->dm->get_data($userdata['leasing_id']);
		$jenis = ($this->pilihan=="B")?"BARU":"LAMA"; 
		//show_array($data_array); exit;
		$data_array['controller'] = get_class($this);
		$data_array['jenis'] = array(1=>"NOMOR RANGKA","NOMOR BPKB");
		
		$content = $this->load->view($data_array['controller']."_list_view",$data_array,true);
		
		$this->set_subtitle("DATA BUKA BLOKIR");
		$this->set_title("DATA BUKA BLOKIR");
		$this->set_content($content);
		$this->render_baru();
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
        
        // $no_rangka = $_REQUEST['columns'][5]['search']['value'];
        // $tanggal_awal = $_REQUEST['columns'][4]['search']['value'];
        // $tanggal_akhir = $_REQUEST['columns'][6]['search']['value'];
        // $status = $_REQUEST['columns'][7]['search']['value'];


      //  order[0][column]
        $req_param = array (
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null,
				"vleasing_id" => $userdata['leasing_id']
				// "status" => $status,
				// "no_rangka" => $no_rangka,
				// "tanggal_awal" => $tanggal_awal,
				// "tanggal_akhir" => $tanggal_akhir,
				// "status",$status
		);     
           
        $row = $this->dm->data($req_param)->result_array();
		
        $count = count($row); 
       
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->dm->data($req_param)->result_array();
        

       
        $arr_data = array();
        $no = 0;
        foreach($result as $row) : 
        	$no++;
        	$daft_id = $row['daft_id'];
        	$warna = ($row['approved'] == 1) ? "green":"red";
        	$arr_data[] = array(
        			 			$no,
        			 			$row['no_rangka'],
        			 			$row['no_buka_blokir'],
        			 			flipdate($row['tgl_buka_blokir']),
        		  				$row['no_polisi'],         		  				
        		  				$row['kontrak_no'], 
        		  				$row['no_bpkb'],         		  				
        		  				flipdate($row['tgl_bpkb']), 
        		  				"<a  target=blank  href=\" " . site_url("baru_bukablokir/cetak/".$daft_id) ."\" ><span class=\"glyphicon glyphicon-print\"></span> Cetak Surat Blokir </a>"
        		  				
        		  				);
        endforeach;

         $responce = array('draw' => $draw, // ($start==0)?1:$start,
        				  'recordsTotal' => $count, 
        				  'recordsFiltered' => $count,
        				  'data'=>$arr_data
        	);
         
        echo json_encode($responce); 
    }


	

function cek_status(){

	// echo "dodol..."; exit;
	$data = $this->input->post();


	/// cek apakan datanya ada atau tidak di pendafatarn 
	$userdata = $this->session->userdata("userdata");
	// $data_array['data'] = $this->dm->get_data($userdata['leasing_id']);

	$this->db->where("leasing_id",$userdata['leasing_id']);
	//$this->db->where("buka_blokir","0");
	if($data['jenis'] == "1") {
		$this->db->where("no_rangka",$data['no_rangka']);
		
	}
	else {
		$this->db->where("no_bpkb",$data['no_rangka']);
	}

	
	$res = $this->db->get("t_pendaftaran");
	// echo $this->db->last_query(); 
	if($res->num_rows() == 0){
		$ret = array("error"=>true,
					"message"=>"DATA NOMOR RANGKA BELUM TERDAFTAR");
		echo json_encode($ret);
		exit;
	}

	else {
		$datadaftar = $res->row();
	}


	// show_array($datadaftar); 
	// exit;

	$aut_data = $this->get_auth_data();

	$url = $this->session->userdata("url");
	$data_service = array("LoginInfo"=>array(
							"LoginName" => $aut_data->service_user,
							"Salt"		=> $aut_data->service_salt,
							"AuthHash" 	=> md5($aut_data->service_salt . md5($aut_data->service_user.$aut_data->service_pass))
							),
							"Criteria"=>array(
								"Param" => $datadaftar->no_rangka,  // $data['no_rangka'],
								"ParamKind" => 1 // $data['jenis']
							)
							 
							);
			$json_data = json_encode($data_service);
		
			// echo "$aut_data->service_user   $aut_data->service_pass <br />";

			// echo "$url <pre>". $json_data . "</pre>";  

			$ret_service = $this->execute_service($url,"ComplGetBerkasCheckPoint",$json_data);
			
			// echo $ret_service; exit;
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
					$ran_data['TglDaftar'] = todate($ran_data['TglDaftar']);
					$ran_data['TglCetakBpkb'] = todate($ran_data['TglCetakBpkb']);
					$ran_data['TglPenyerahan'] = todate($ran_data['TglPenyerahan']);
					$ran_data['TglVerifikasi'] = todate($ran_data['TglVerifikasi']);

					$ran_data['TglCetakKartuInduk'] = todate($ran_data['TglCetakKartuInduk']);
					$ran_data['TglFaktur'] = todate($ran_data['TglFaktur']);
					$ran_data['TglEntri'] = todate($ran_data['TglEntri']);
					$ran_data['daft_id'] = $datadaftar->daft_id;

					$ret['message'] = "DATA DITEMUKAN";
					$ret['data'] = $ran_data;

				}
			}
			echo json_encode($ret);
}


function bukablokir(){
	$data=$this->input->post();
	// show_array($data);

	$this->db->where("daft_id",$data['daft_id']);
	$data_daft = $this->db->get("t_pendaftaran")->row();

	$this->db->where("id_polda",$data_daft->id_polda);
	$data_polda = $this->db->get("m_polda")->row();

	$aut_data = $this->get_auth_data();
				 
				// show_array($aut_data); 
				$data_service = array("LoginInfo"=>array(
								"LoginName" => $aut_data->service_user,
								"Salt"		=> $aut_data->service_salt,
								"AuthHash" 	=> md5($aut_data->service_salt . md5($aut_data->service_user.$aut_data->service_pass))
								),
								"Param"=> array(
									"SubID"					=> $data_daft->sub_id,
									"IdApproval"    		=> $data_daft->id_approval,
									"NoRangka"   			=> $data_daft->no_rangka,
									"NoSuratPermohonan"   	=> $data['surat_no'],
									"Alasan"   				=> $data['alasan'],
									"NoSuratRef"   			=> $data['surat_ref_no'],
									"TglSuratPemohon"   	=> service_date($data['surat_tgl'])
									)
								 
								);
				$json_data = json_encode($data_service);
		 		 /*
 "IdApproval:<int>,
    "NoRangka":<string>,
    "NoSuratPermohonan":<string>,
    "Alasan":<string>,                     
    "NoSuratRef":<string>
    "TglSuratPemohon":<string>     
		 		 */
				// show_array($aut_data); 
     			// echo "data json $json_data "; exit;
				// show_array($json_data); 
    			// echo "data jeson". $data_polda->url;
				$ret_service = $this->execute_service($data_polda->url,"ComplExecuteBukaBlokir",$json_data);
				// $ret_service = $this->execute_service2($data_polda->url,"ComplExecuteBukaBlokir",$json_data);
			   	// echo $ret_service;  exit;
			   	// exit;
			   	// show_array($ret_service); exit;
     	if($ret_service['error'] == true){
				$ret = array("error"=>true,
					"message"=>"GAGAL MENGHUBUNGI SERVER");
		}	   	
		else {

			if($ret_service['data']['ResultCode'] <>  0  or $ret_service['data']['ResultCode'] == 'else' ) {
					 

					if($ret_service['data']['ResultCode'] == 1) $err_msg = "data tidak ditemukan";
					else if ($ret_service['data']['ResultCode'] == 2) $err_msg = "ranmor tidak dalam status blokir";
					else if ($ret_service['data']['ResultCode'] == 2) $err_msg = "ranmor sedang dalam status blokir non perdata (pidana atau duplikat)";
					else if ($ret_service['data']['ResultCode'] == 2) $err_msg = "pemohon blokir tidak sama dengan pemohon buka blokir";
					else $err_msg = "Error tidak diketahui";

					$ret = array("error"=>true,
					"message"=>"GAGAL BUKA BLOKIR. ". strtoupper($err_msg));
			 }
			 else {

			 	// get daft_id 
			 	//$this->db->where("no_rangka",)
			 	$ins_data['daft_id'] = $data_daft->daft_id;
				$ins_data['surat_no'] = $data['surat_no'];
				$ins_data['alasan'] = $data['alasan'];
				$ins_data['surat_ref_no'] = $data['surat_ref_no'];
				$ins_data['surat_tgl'] = $data['surat_tgl'];
				$ins_data['tgl_buka_blokir'] = todate2($ret_service['data']['OutputData']->TglBukaBlokir);
				$ins_data['no_buka_blokir'] = $ret_service['data']['OutputData']->NoBukaBlokir;
				//$ins_data['buka_blokir'] = '1';
				$this->db->insert("t_buka_blokir",$ins_data);
				// echo "input blokir ". $this->db->last_query(); 


				$this->db->where("daft_id",$data_daft->daft_id);
				$this->db->update("t_pendaftaran",array("buka_blokir"=>1));
				// echo "<br /> update pendaftaran blokir ". $this->db->last_query(); 
				// echo $this->db->last_query();
				$ret = array("error"=>false,
					"message"=>"BUKA BLOKIR KENDARAAN BERHASIL","debug"=>$ret_service);
			 }

		}

		echo json_encode($ret);

}

function cetak($daft_id){

	$userdata = $this->session->userdata("userdata");

	$data = $this->dm->get_pendaftaran_detail_print($userdata['leasing_id'],$daft_id);
	//show_array($data);
	if($data['approved'] == 1 and $data['status'] ==  "3" )
	{

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

		 
		$html = $this->load->view("pdf/surat_buka_blokir",$data,true);
		// echo $html; exit;
		$pdf->writeHTML($html, true, false, true, false, '');

		 //$pdf->AddPage();




		 $pdf->Output('DOKUMEN BUKA  BLOKIR ' . $data['no_rangka'] .'.pdf', 'I');

	}
	else {
		$this->set_subtitle("TIDAK DAPAT DICETAK");
		$this->set_title("TIDAK DAPAT DICETAK");
		$this->set_content($content);
		$this->render_baru();
	}


}


}
?>