<?php 
class baru_daftar extends master_controller {
	function baru_daftar(){
		parent::__construct();
		// $this->load->model("core_model","cm");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		$this->load->model("bd_model","dm");



	}

	function index(){ 
		
		$userdata = $this->session->userdata("userdata");
		$data_array['data'] = $this->dm->get_data($userdata['leasing_id']);
		 
		//show_array($data_array); exit;
		$data_array['controller'] = get_class($this);
		$data_array['jenis'] = array(1=>"NOMOR RANGKA","NOMOR BPKB");
		$content = $this->load->view("baru_daftar_view",$data_array,true);

		$jenis = ($this->pilihan=="B")?"BARU":"LAMA";



		$this->set_subtitle("DATA PEDAFTARAN BLOKIR KENDARAAN $jenis ");
		$this->set_title("DATA PENDAFTARAN BLOKIR KENDARAAN $jenis ");
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
        
        $no_rangka = $_REQUEST['columns'][5]['search']['value'];
        $tanggal_awal = $_REQUEST['columns'][4]['search']['value'];
        $tanggal_akhir = $_REQUEST['columns'][6]['search']['value'];
        $status = isset($_REQUEST['columns'][7]['search']['value'])?$_REQUEST['columns'][7]['search']['value']:0;


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
     	<li><a onclick=\"return edit('".$row['daft_id'] ."')\"  href='#' ><span class=\"glyphicon glyphicon-chevron-right\"></span> Edit </a></li>
		<li><a onclick=\"return hapus('".$row['daft_id'] ."')\"  href='#' ><span class=\"glyphicon glyphicon-remove-sign\"></span> Hapus </a></li>
		<li><a href=\" " . site_url("baru_verifikasi/detail/".$daft_id) ."\" ><span class=\"glyphicon glyphicon-info-sign\"></span> Detail</a></li>
		<li><a onclick=\"return cetak('".$row['daft_id'] ."')\"  href='#'  ><span class=\"glyphicon glyphicon-print\"></span> Cetak </a></li>
		
       
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



	function baru(){
		 
		
		$data_array['controller'] = get_class($this);
		

		$data_array['arr_jenis'] = $this->cm->arr_dropdown("m_jenis","jenis_id","jenis_nama","jenis_nama");
		$data_array['arr_jenis']= $this->add_arr_head($data_array['arr_jenis'],"x"," - PILIH JENIS -");		


		$data_array['arr_warna'] = $this->cm->arr_dropdown("m_warna","warna_id","warna_nama","warna_nama");
		$data_array['arr_warna']= $this->add_arr_head($data_array['arr_warna'],"x"," - PILIH WARNA -");	

		$data_array['arr_merk'] = $this->cm->arr_dropdown("m_merk","merk_id","merk_nama","merk_nama");
		$data_array['arr_merk']= $this->add_arr_head($data_array['arr_merk'],"x"," - PILIH MERK -");	
		
		$data_array['arr_cabang'] = $this->dm->arr_cabang();//("t_cabang","cabang_id","cabang_nama","cabang_nama");
 		
		$data_array['jenis'] = array(1=>"NOMOR RANGKA","NOMOR BPKB");

		//show_array($data_array); exit;
		$data_array['mode'] = "I";

		if($this->pilihan == "B")
		{
			$content = $this->load->view("baru_daftar_form",$data_array,true);
		}
		else {
			// echo " pilihan ".$this->pilihan."<br />"; exit;
			$content = $this->load->view("lama_daftar_form",$data_array,true);	
		}


		
		$this->set_subtitle("PEDAFTARAN BLOKIR KENDARAAN BARU ");
		$this->set_title("PENDAFTARAN BLOKIR KENDARAAN BARU ");
		$this->set_content($content);
		$this->render_baru();
	}


	function edit($daft_id) {
		$data_array['controller'] = get_class($this);
		

		$data_array['arr_jenis'] = $this->cm->arr_dropdown("m_jenis","jenis_id","jenis_nama","jenis_nama");
		$data_array['arr_jenis']= $this->add_arr_head($data_array['arr_jenis'],"x"," - PILIH JENIS -");		


		$data_array['arr_warna'] = $this->cm->arr_dropdown("m_warna","warna_id","warna_nama","warna_nama");
		$data_array['arr_warna']= $this->add_arr_head($data_array['arr_warna'],"x"," - PILIH WARNA -");	

		$data_array['arr_merk'] = $this->cm->arr_dropdown("m_merk","merk_id","merk_nama","merk_nama");
		$data_array['arr_merk']= $this->add_arr_head($data_array['arr_merk'],"x"," - PILIH MERK -");	
		
		$data_array['arr_cabang'] = $this->dm->arr_cabang();//("t_cabang","cabang_id","cabang_nama","cabang_nama");

		$data_array['daft_id'] = $daft_id;
		


		//show_array($data_array); exit;
		$data_array['mode'] = "U";
		
		if($this->pilihan=="B"){ 
		$content = $this->load->view("baru_daftar_form_edit",$data_array,true);
		}
		else {
		$content = $this->load->view("lama_daftar_form_edit",$data_array,true);	
		}
		
		$this->set_subtitle("EDIT PEDAFTARAN BLOKIR KENDARAAN BARU ");
		$this->set_title("EDIT PENDAFTARAN BLOKIR KENDARAAN BARU ");
		$this->set_content($content);
		$this->render_baru();
	}


	function get_pendaftaran_detail($id){ // ($vTB_NAME,$vKEY,$vVALUE)
	// $vTB_NAME = "T_PENDAFTARAN"; 
	// $vKEY = "DAFT_ID";
	// $vVALUE = $id;
	
	// $arr = $this->get_detail($vTB_NAME,$vKEY,$vVALUE);
	// $arr = clear_array($arr['message']);
	$arr = $this->cm->get_detail_pendaftaran($id);
	//echo $this->db->last_query();
	echo json_encode($arr);
	}

	

function cek_no_rangka($no_rangka) {

	if(empty($no_rangka)) {
		$this->form_validation->set_message('cek_no_rangka', '% harus diisi ');
		return false;
	}

	$this->db->where("no_rangka",$no_rangka);
	$this->db->where("buka_blokir","0");
	$jumlah = $this->db->get("t_pendaftaran")->num_rows();
	// echo $this->db->last_query(); 
	if($jumlah > 0 ) {
		$this->form_validation->set_message('cek_no_rangka', '%s sudah ada  ');
		return false;
	}

}

	function simpan(){

		//sleep(2);

		$userdata = $this->session->userdata("userdata");
		//show_array($userdata); exit;
		$data=$this->input->post();
		
		$this->load->library('form_validation');
  		$this->form_validation->set_rules('no_rangka','Nomor Rangka','callback_cek_no_rangka');
  		$this->form_validation->set_rules('daft_date','Tanggal Pendafataran','required');
		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			
			 
			$data['leasing_id'] = $userdata['leasing_id'];
			$data['jenis_permohonan'] =  $this->pilihan;
			// $data['merk_id'] = ($data['merk_id']=="x")?NULL:$data['merk_id'];
			// $data['jenis_id'] = ($data['jenis_id']=="x")?NULL:$data['jenis_id'];
			// $data['warna_id'] = ($data['warna_id']=="x")?NULL:$data['warna_id'];
			$data['import']  = "1";
			$data['daft_date'] = flipdate($data['daft_date']);
 			// $ret = $this->dm->daftar_simpan($data);
 			unset($data['daft_id']);
 			unset($data['mode']);
 			unset($data['saa']);



 			$data['id_polda'] = $this->session->userdata("id_polda");
 			$data['status'] = '0';
 			$res = $this->db->insert("t_pendaftaran",$data);
 			$this->nomor_surat($this->db->insert_id(),$data);
 			

 			if($res){
				$ret = array("error"=>false,"message"=>"PENDAFTARAN BERHASIL DISIMPAN");
 			}
 			else {
 				$ret = array("error"=>true,"message"=>"PENDAFTARAN GAGAL DISIMPAN ".mysql_error());
 			}
			 
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
	}


function simpan_lama(){
		// sleep(2);
		$userdata = $this->session->userdata("userdata");
		//show_array($userdata); exit;
		$data=$this->input->post();
		
		$this->load->library('form_validation');
  		$this->form_validation->set_rules('no_rangka','Nomor Rangka','callback_cek_no_rangka');
  		$this->form_validation->set_rules('daft_date','Tanggal Pendafataran','required');
		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			
			 
			$data['leasing_id'] = $userdata['leasing_id'];
			$data['jenis_permohonan'] =  $this->pilihan;
			// $data['merk_id'] = ($data['merk_id']=="x")?NULL:$data['merk_id'];
			// $data['jenis_id'] = ($data['jenis_id']=="x")?NULL:$data['jenis_id'];
			// $data['warna_id'] = ($data['warna_id']=="x")?NULL:$data['warna_id'];
			$data['daft_date'] = flipdate($data['daft_date']);
			$data['tgl_bpkb'] = flipdate($data['tgl_bpkb']);
 			// $ret = $this->dm->daftar_simpan($data);
 			unset($data['daft_id']);
 			unset($data['mode']);


 			$data['id_polda'] = $this->session->userdata("id_polda");
 			$data['status'] = '0';

 			// show_array($data); exit;
 			$res = $this->db->insert("t_pendaftaran",$data);
 			$this->nomor_surat($this->db->insert_id(),$data);
 			

 			if($res){
				$ret = array("error"=>false,"message"=>"PENDAFTARAN BERHASIL DISIMPAN");
 			}
 			else {
 				$ret = array("error"=>true,"message"=>"PENDAFTARAN GAGAL DISIMPAN ".mysql_error());
 			}
			 
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
	}



	function update(){
		$userdata = $this->session->userdata("userdata");
		//show_array($userdata); exit;
		$data=$this->input->post();
		
		$this->load->library('form_validation');
  		$this->form_validation->set_rules('no_rangka','Nomor Rangka','required');
  		$this->form_validation->set_rules('daft_date','Nomor Rangka','required');
		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			
			 
 			$data['merk_id'] = ($data['merk_id']=="x")?NULL:$data['merk_id'];
			$data['jenis_id'] = ($data['jenis_id']=="x")?NULL:$data['jenis_id'];
			$data['warna_id'] = ($data['warna_id']=="x")?NULL:$data['warna_id'];
			$data['daft_date'] = flipdate($data['daft_date']);		// unset($data['DAFT_ID']);
 			unset($data['mode']);
 			unset($data['saa']);
 			$this->db->where("daft_id",$data['daft_id']);
 			$res = $this->db->update("t_pendaftaran",$data);
 			// $this->nomor_surat($this->db->insert_id(),$data);
 			

 			if($res){
				$ret = array("error"=>false,"message"=>"PENDAFTARAN BERHASIL DIUPDATE");
 			}
 			else {
 				$ret = array("error"=>true,"message"=>"PENDAFTARAN GAGAL DIUPATE ".mysql_error());
 			}
			 
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
	}



	function update_lama(){
		$userdata = $this->session->userdata("userdata");
		//show_array($userdata); exit;
		$data=$this->input->post();
		
		$this->load->library('form_validation');
  		$this->form_validation->set_rules('no_rangka','Nomor Rangka','required');
  		$this->form_validation->set_rules('daft_date','Nomor Rangka','required');
		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			
			 
 		// 	$data['merk_id'] = ($data['merk_id']=="x")?NULL:$data['merk_id'];
			// $data['jenis_id'] = ($data['jenis_id']=="x")?NULL:$data['jenis_id'];
			// $data['warna_id'] = ($data['warna_id']=="x")?NULL:$data['warna_id'];
			$data['daft_date'] = flipdate($data['daft_date']);		// unset($data['DAFT_ID']);
 			$data['tgl_bpkb'] = flipdate($data['tgl_bpkb']);
 			unset($data['mode']);
 			$this->db->where("daft_id",$data['daft_id']);
 			$res = $this->db->update("t_pendaftaran",$data);
 			// $this->nomor_surat($this->db->insert_id(),$data);
 			

 			if($res){
				$ret = array("error"=>false,"message"=>"PENDAFTARAN BERHASIL DIUPDATE");
 			}
 			else {
 				$ret = array("error"=>true,"message"=>"PENDAFTARAN GAGAL DIUPATE ".mysql_error());
 			}
			 
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
	}

function hapus($daft_id) {
	$this->db->where("daft_id",$daft_id);
	$data = $this->db->get("t_pendaftaran")->row();

	if($data->STATUS > 0 ) {
		$ret = array("error"=>true,"message"=>"TELAH TERVERIFIKASI. TIDAK DAPAT DIHAPUS");

	}
	else { 
	$this->db->where("daft_id",$daft_id);
	$this->db->delete("t_pendaftaran");

 		$ret = array("error"=>false,"message"=>"BERHASIL DIHAPUS");


	}
	echo json_encode($ret);
}


function get_detail_kendaraan(){
	$data = $this->input->post();
	$aut_data = $this->get_auth_data();

	$url = $this->session->userdata("url");
	$data_service = array("LoginInfo"=>array(
							"LoginName" => $aut_data->service_user,
							"Salt"		=> $aut_data->service_salt,
							"AuthHash" 	=> md5($aut_data->service_salt . md5($aut_data->service_user.$aut_data->service_pass))
							),
							"NoBPKB"=> $data['no_bpkb']
							 
							);
			$json_data = json_encode($data_service);
			

			$ret_service = $this->execute_service($url,"RanMaGetDataRanmor",$json_data);
			

			if(!$ret_service){
				$ret = array("error"=>true,
					"message"=>"GAGAL MENGHUBUNGI SERVER");
			}
			else {
				if($ret_service['Result'] == false) {
					$ret = array("error"=>true,
					"message"=>"NOMOR BPKB TIDAK DITEMUKAN");
				}
				else {
					extract($ret_service);
					$ret['error'] = false;
					$ran_data['no_rangka'] = $DataRanmor->NoRangka;
					$ran_data['no_mesin'] = $DataRanmor->NoMesin;
					$ran_data['no_bpkb'] = $DataRanmor->NoBPKB;
					$ran_data['tgl_bpkb'] = $DataRanmor->TglBPKB;
					$ran_data['no_polisi'] = $DataRanmor->NoPolisi;
					$ran_data['tahun_kendaraan'] = $DataRanmor->ThnBuat;
					$ran_data['jenis_nama'] = $DataRanmor->Jenis;
					$ran_data['merk_nama'] = $DataRanmor->Merk;
					$ran_data['warna_nama'] = $DataRanmor->Warna;
					$ran_data['nama_pemilik'] = $DataRanmor->NamaPemilik;
					$ran_data['pemilik_alamat'] = $DataRanmor->Alamat;
					// $ran_data['no_rangka'] = $DataRanmor->NoRangka;
					// $ran_data['no_rangka'] = $DataRanmor->NoRangka;
					// show_array($ret_service);

					// show_array($ran_data);
					$ret['message'] = $ran_data;

				}
			}
			echo json_encode($ret);
}


function get_list_daftar(){
		$data = $this->input->post();
		$userdata = $this->session->userdata("userdata");
		$data['leasing_id'] = $userdata['leasing_id'];
		// show_array($data); exit;
		$arr = $this->dm->get_list_daftar($data);
		echo json_encode($arr);
}

function get_atpm(){
	$data = $this->input->post();
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
		
			// echo "$aut_data->service_user   $aut_data->service_pass <br />";

			// echo "$url <pre>". $json_data . "</pre>";  
			
			$ret_service = $this->execute_service($url,"ComplGetDataAtpmSub",$json_data);
			// echo $ret_service; exit;
			// show_array($ret_service); 
			//exit;


			if($ret_service['error'] == true){
				$ret = array("error"=>true,
					"message"=>"GAGAL MENGHUBUNGI SERVER","debug"=>$ret_service);
			}
			else {
				if($ret_service['data']['Result'] == false ) {
					$ret = array("error"=>true,
					"message"=>"DATA TIDAK DITEMUKAN.<br /> Silahkan input data secara manual ","debug"=>$ret_service);
				}
				else {
					extract($ret_service);
					$ret['error'] = false;
					// echo "<hr /> data ";
					// show_array($data);
					// exit;
					$ran_data['no_rangka'] = $data['Data']->NoRangka;
					$ran_data['no_mesin'] = $data['Data']->NoMesin;
					// $ran_data['no_bpkb'] = $Data->NoBPKB;
					// $ran_data['tgl_bpkb'] = $Data->TglBPKB;
					// $ran_data['no_polisi'] = $Data->NoPolisi;
					$ran_data['tahun_kendaraan'] = $data['Data']->ThnBuat;
					$ran_data['jenis_nama'] = $data['Data']->Jenis;
					$ran_data['merk_nama'] = $data['Data']->Merk;
					$ran_data['warna_nama'] = $data['Data']->Warna;
					$ran_data['pemilik_nama'] = $data['Data']->Pemilik;
					$ran_data['pemilik_alamat'] = $data['Data']->Alamat;
					$ran_data['pemilik_ktp'] = $data['Data']->NoIdentitas;

					
					// $ran_data['alamat_pemilik'] = $Data->Alamat;
					// $ran_data['no_rangka'] = $Data->NoRangka;
					// $ran_data['no_rangka'] = $Data->NoRangka;
					// show_array($ret_service);
					// echo "ran data";
					// show_array($ran_data);
					$ret['message'] = "DATA APM DITEMUKAN";
					$ret['data'] = $ran_data;
					//$ret['debug'] = $ret_service;

				}
			}
			echo json_encode($ret);
}




}
?>