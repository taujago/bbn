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
		//$data_array['data'] = $this->dm->get_data($userdata['leasing_id']);
		$data_array['title'] = "DATA PERMOHONAN BLOKIR";
		//show_array($data_array); exit;
		$data_array['controller'] = get_class($this);
		
		$content = $this->load->view("baru_daftar_view",$data_array);
		
		// $this->set_subtitle("DATA PEDAFTARAN BLOKIR KENDARAAN BARU ");
		// $this->set_title("DATA PENDAFTARAN BLOKIR KENDARAAN BARU ");
		// $this->set_content($content);
		// $this->render_baru();
	}




	function get_data(){

		$userdata = $this->session->userdata("userdata");
     	$page = $_REQUEST['page']; // get the requested page 
        $limit = $_REQUEST['rows']; // get how many rows we want to have into the grid 
        $sidx = isset($_REQUEST['sort'])?$_REQUEST['sort']:"p.daft_id"; // get index row - i.e. user click to sort 
        $sord = isset($_REQUEST['order'])?$_REQUEST['order']:"asc"; // get the direction if(!$sidx) $sidx =1;  
       
        
        $req_param = array (
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null,
				"no_rangka" => isset($_REQUEST['no_rangka'])?$_REQUEST['no_rangka']:"x",
				"tgl_mulai" => isset($_REQUEST['tgl_mulai'])?$_REQUEST['tgl_mulai']:"x",
				"tgl_selesai" => isset($_REQUEST['tgl_selesai'])?$_REQUEST['tgl_selesai']:"x",
				"vleasing_id" => $userdata['leasing_id']
				 		
		);     

		show_array($req_param); exit;
           
        $row = $this->dm->get_data($req_param)->result_array();
		
        $count = count($row); 
        if( $count >0 ) { 
            $total_pages = ceil($count/$limit); 
        } else { 
            $total_pages = 0; 
        } 
        if ($page > $total_pages) 
            $page=$total_pages; 
        $start = $limit*$page - $limit; // do not put $limit*($page - 1) 
        
        $start = ($start < 0 )?0:$start;
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->dm->get_data($req_param)->result_array();
        // sekarang format data dari dB sehingga sesuai yang diinginkan oleh jqGrid dalam hal ini aku pakai JSON format
        //$responce->page = $page; 
       $responce = new stdClass();
        $responce->total = $count; 
        //$responce->records = $count;
        if($count == 0) {
        	$i=1;
			$responce->rows[$i]['daft_id']	= "";			 
        }
        else {
                $x=0;
	        for($i=0; $i<count($result); $i++){
	        	$x++;
	      
	        $responce->rows[$i]['daft_id']	= $result[$i]['daft_id'] ; 
	        $responce->rows[$i]['no_surat']	= $result[$i]['no_surat'] ; 
	        $responce->rows[$i]['jenis_permohonan']	= $result[$i]['jenis_permohonan'] ; 
	        $responce->rows[$i]['leasing_id']	= $result[$i]['leasing_id'] ; 
	        $responce->rows[$i]['no_bpkb']	= $result[$i]['no_bpkb'] ; 
	        $responce->rows[$i]['nreg_bpkb']	= $result[$i]['nreg_bpkb'] ; 
	        $responce->rows[$i]['no_rangka']	= $result[$i]['no_rangka'] ; 
	        $responce->rows[$i]['no_mesin']	= $result[$i]['no_mesin'] ; 
	        $responce->rows[$i]['no_polisi']	= $result[$i]['no_polisi'] ; 
	        $responce->rows[$i]['tgl_bpkb']	= $result[$i]['tgl_bpkb'] ; 
	        $responce->rows[$i]['merk_id']	= $result[$i]['merk_id'] ;    

	        $responce->rows[$i]['jenis_id']	= $result[$i]['jenis_id'] ; 
	        $responce->rows[$i]['tahun_kendaraan']	= $result[$i]['tahun_kendaraan'] ; 
	        $responce->rows[$i]['user_id']	= $result[$i]['user_id'] ; 
	        $responce->rows[$i]['status']	= $result[$i]['status'] ; 
	        $responce->rows[$i]['status_polda']	= $result[$i]['status_polda'] ; 
	        $responce->rows[$i]['approved']	= $result[$i]['approved'] ; 
	        $responce->rows[$i]['daft_date']	= $result[$i]['daft_date'] ; 
	        $responce->rows[$i]['daft_by']	= $result[$i]['daft_by'] ; 
	        $responce->rows[$i]['verifikasi_date']	= $result[$i]['verifikasi_date'] ; 
	        $responce->rows[$i]['verifikasi_by']	= $result[$i]['verifikasi_by'] ; 
	        $responce->rows[$i]['daft_level2_date']	= $result[$i]['daft_level2_date'] ;    
	        $responce->rows[$i]['daft_level2_by']	= $result[$i]['daft_level2_by'] ; 
	        $responce->rows[$i]['daft_level3_date']	= $result[$i]['daft_level3_date'] ; 
	        $responce->rows[$i]['daft_level3_by']	= $result[$i]['daft_level3_by'] ; 
	        $responce->rows[$i]['nama_pengajuan_leasing']	= $result[$i]['nama_pengajuan_leasing'] ; 
	        $responce->rows[$i]['alamat_pengajuan_leasing']	= $result[$i]['alamat_pengajuan_leasing'] ; 
	        $responce->rows[$i]['id_polda']					= $result[$i]['id_polda'] ; 
	        $responce->rows[$i]['no_blokir']	= $result[$i]['no_blokir'] ; 
	        $responce->rows[$i]['tgl_blokir']	= flipdate($result[$i]['tgl_blokir']) ; 
	        $responce->rows[$i]['tgl_blokir2']	= flipdate($result[$i]['tgl_blokir2']) ; 
	        $responce->rows[$i]['status2']	= flipdate($result[$i]['status2']) ; 
	        $responce->rows[$i]['approved']	= flipdate($result[$i]['approved']) ; 

	        

	        
	      



/*
``
``
``
``
``
`nreg_bpkb`
`no_rangka`
`no_mesin`
`no_polisi`
`tgl_bpkb`
`merk_id`
`jenis_id`
`tahun_kendaraan`
`user_id`
`status`
`status_polda`
`approved`
`daft_date`
`daft_by`
`verifikasi_date`
`verifikasi_by`
`daft_level2_date`
`daft_level2_by`
`daft_level3_date`
`daft_level3_by`
`nama_pengajuan_leasing`
`alamat_pengajuan_leasing`
`id_polda`
`no_blokir`
`tgl_blokir`
`tgl_blokir2`
*/
	
			 
				
	        } 
		}
		//echo "<hr />";
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
		
		


		//show_array($data_array); exit;
		$data_array['mode'] = "I";
		$content = $this->load->view("baru_daftar_form",$data_array,true);
		
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
		
		
		$data_array['daft_id'] = $daft_id;
		


		//show_array($data_array); exit;
		$data_array['mode'] = "U";
		$content = $this->load->view("baru_daftar_form_edit",$data_array,true);
		
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
  		$this->form_validation->set_rules('no_rangka','Nomor Rangka','required');
  		$this->form_validation->set_rules('daft_date','Tanggal Pendafataran','required');
		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			
			 
			$data['leasing_id'] = $userdata['leasing_id'];
			$data['jenis_permohonan'] =  "B";
			$data['merk_id'] = ($data['merk_id']=="x")?NULL:$data['merk_id'];
			$data['jenis_id'] = ($data['jenis_id']=="x")?NULL:$data['jenis_id'];
			$data['warna_id'] = ($data['warna_id']=="x")?NULL:$data['warna_id'];
			$data['daft_date'] = flipdate($data['daft_date']);
 			// $ret = $this->dm->daftar_simpan($data);
 			unset($data['daft_id']);
 			unset($data['mode']);


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

}
?>