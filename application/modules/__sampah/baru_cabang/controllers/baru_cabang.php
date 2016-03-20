<?php 
class baru_cabang extends master_controller {
	function baru_cabang(){
		parent::__construct();
		// $this->load->model("core_model","cm");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		$this->load->model("cab_model","dm");



	}

	function index(){ 
		
		$userdata = $this->session->userdata("userdata");
		$data_array['data'] = $this->dm->get_data($userdata['leasing_id']);
		 
		//show_array($data_array); exit;
		$data_array['controller'] = get_class($this);
		$content = $this->load->view("baru_cabang_view",$data_array,true);

		 


		$this->set_subtitle("DATA KANTOR CABANG");
		$this->set_title("DATA KANTOR CABANG");
		$this->set_content($content);
		$this->render_baru();
	}

	function baru(){
		 
		
		$data_array['controller'] = get_class($this);		 		
		


 

		 
		$content = $this->load->view("baru_cabang_form",$data_array,true);
		 


		
		$this->set_subtitle("PEDAFTARAN KANTOR CABANG BARU ");
		$this->set_title("PENDAFTARAN BKANTOR CABANG BARU ");
		$this->set_content($content);
		$this->render_baru();
	}


	function edit($cabang_id) {
		$data_array['controller'] = get_class($this);
		$data_array['cabang_id'] = $cabang_id;
		$content = $this->load->view("baru_cabang_form_edit",$data_array,true);	
		$this->set_subtitle("EDIT DATA KANTOR CABANG");
		$this->set_title("EDIT DATA KANTOR CABANG");
		$this->set_content($content);
		$this->render_baru();
	}


	function get_cabang_detail($id){ // ($vTB_NAME,$vKEY,$vVALUE)
	$userdata = $this->session->userdata("userdata");
	$this->db->where("leasing_id",$userdata['leasing_id']);
	$this->db->where("cabang_id",$id);

	$arr = $this->db->get("t_cabang")->row_array();
	//echo $this->db->last_query();
	echo json_encode($arr);
	}

	function nomor_surat($id, $data){
		 
		$nol = array(1=>'0000','000','00','0','');
		$userdata = $this->session->userdata("userdata");
		// get max 
		$sql="select max(no_urut_surat) no_urut from t_pendaftaran";
		$rs = $this->db->query($sql);
		if($rs->num_rows() == 0){
			$nomor = 1;

		}
		else {
			$xx = $rs->row();
			$nomor = $xx->no_urut;
			$nomor++;
		}
		$angka = $nol[strlen($nomor)].$nomor;

		$nama= $userdata['leasing_nama_singkatan']; // eplace(" ", "", $userdata['leasing_nama']), 0,5)  ;
		$tmp = explode("-", $data['daft_date']);

		$hasil[0]=$angka;
		$hasil[] = $nama;
		$hasil[] = $tmp[1];
		$hasil[] = $tmp[0];

		$arr['no_surat'] = implode("/", $hasil);
		$arr['no_urut_surat']  = $nomor;

		$this->db->where("daft_id",$id);
		$this->db->update("t_pendaftaran",$arr);




	}

	function simpan(){
		$userdata = $this->session->userdata("userdata");
		//show_array($userdata); exit;
		$data=$this->input->post();
		
		$this->load->library('form_validation');
  		$this->form_validation->set_rules('cabang_nama','Nama kantor Cabang','required');
 		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			
			 
			$data['leasing_id'] = $userdata['leasing_id'];
 			 
  			unset($data['cabang_id']);
 			unset($data['mode']);


  			$res = $this->db->insert("t_cabang",$data);
  			

 			if($res){
				$ret = array("error"=>false,"message"=>"KANTOR CABANG BERHASIL DISIMPAN");
 			}
 			else {
 				$ret = array("error"=>true,"message"=>"KANTOR CABANG  GAGAL DISIMPAN ".mysql_error());
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
  		$this->form_validation->set_rules('cabang_nama','Nama Kantor Cabang','required');
 		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			
			 
 			unset($data['mode']);
 			$this->db->where("cabang_id",$data['cabang_id']);
 			$res = $this->db->update("t_cabang",$data);
 			// $this->nomor_surat($this->db->insert_id(),$data);
 			

 			if($res){
				$ret = array("error"=>false,"message"=>"KANTOR CABANG BERHASIL DIUPDATE");
 			}
 			else {
 				$ret = array("error"=>true,"message"=>"KANTOR CABANG  GAGAL DIUPATE ".mysql_error());
 			}
			 
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
	}


 

function hapus($cabang_id) {
	$this->db->where("cabang_id",$cabang_id);
 
 	$this->db->delete("t_cabang");	 
	redirect("baru_cabang");
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
					$ran_data['alamat_pemilik'] = $DataRanmor->Alamat;
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




}
?>