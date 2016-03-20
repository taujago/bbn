<?php
class blokir extends master_controller  {
	function blokir(){
		parent::__construct();
		$this->load->model("daftar_model","dm");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
	}
	
	
	// function arr_dropdown($vTable, $vINDEX, $vVALUE, $vORDERBY){
	// 	$ret = array();
	// 	$service['method']='arr_dropdown';
	// 	$service['debug']='1';
	// 	$service['vTable']=$vTable;
	// 	$service['vINDEX']=$vINDEX;
	// 	$service['vVALUE']=$vVALUE;
	// 	$service['vORDERBY']=$vORDERBY;
	// 	$url = service_url($service);
	// 	$xml = file_get_contents($url);
	// 	$arr = xml_to_array($xml);
	// 	foreach($arr['message']['leasing'] as $data) : 
	// 	//show_array($data);
	// 		if(!is_array($data[$vVALUE])) { 
	// 		$ret[$data[$vINDEX]] = $data[$vVALUE];
	// 		}
	// 	endforeach;
	// 	return $ret;
		 
	// }
	
	
	function daftar(){
		
		$data_array['arr_cari']=array(1=>"Nomor Rangka","Nomor BPKB");
		
		$data_array['controller'] = get_class($this);
		

		$data_array['arr_jenis'] = $this->cm->arr_dropdown("M_JENIS","JENIS_ID","JENIS_NAMA","JENIS_NAMA");
		$data_array['arr_jenis']= $this->add_arr_head($data_array['arr_jenis'],"x"," - PILIH JENIS -");		


		$data_array['arr_warna'] = $this->cm->arr_dropdown("M_WARNA","WARNA_ID","WARNA_NAMA","WARNA_NAMA");
		$data_array['arr_warna']= $this->add_arr_head($data_array['arr_warna'],"x"," - PILIH WARNA -");	

		$data_array['arr_merk'] = $this->cm->arr_dropdown("M_MERK","MERK_ID","MERK_NAMA","MERK_NAMA");
		$data_array['arr_merk']= $this->add_arr_head($data_array['arr_merk'],"x"," - PILIH MERK -");	
		
		


		//show_array($data_array); exit;
		$data_array['mode'] = "I";
		$content = $this->load->view("daftar/daftar_view",$data_array,true);
		
		$this->set_subtitle("PEDAFTARAN BLOKIR ");
		$this->set_title("PENDAFTARAN BLOKIR ");
		$this->set_content($content);
		$this->render();
	}
	
	function daftar_simpan($id){
		$userdata = $this->session->userdata("userdata");
		//show_array($userdata); exit;
		$data=$this->input->post();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('NAMA_PEMILIK','Nama Pemilik','required');
 		$this->form_validation->set_rules('NO_RANGKA','Nomor Rangka','required');
		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			
			$data['v_is_cari'] = $id;
			$data['LEASING_ID'] = $userdata['LEASING_ID'];

			$data['MERK_ID'] = ($data['MERK_ID']=="x")?NULL:$data['MERK_ID'];
			$data['TYPE_KENDARAAN'] = ($data['TYPE_KENDARAAN']=="x")?NULL:$data['TYPE_KENDARAAN'];
			$data['WARNA_ID'] = ($data['WARNA_ID']=="x")?NULL:$data['WARNA_ID'];

			//show_array($data); exit;
			$ret = $this->dm->daftar_simpan($data);
			// $data['method'] = 'add_daftar';
			// $data['debug'] = 1;
			// $data['vLEASING_ID'] = $userdata['LEASING_ID'];
			// $data['vDAFT_BY'] = $userdata['USER_ID'];
			// $data['vIS_CARI'] = $id;
			// $data['vTGL_BPKB'] = str_replace("-","",flipdate($data['vTGL_BPKB']));
			// $data['vDAFT_DATE'] = str_replace("-","",flipdate($data['vDAFT_DATE']));
			 
			// $url = service_url($data);			
			
			// //echo $url; exit; 
			// $xml = file_get_contents($url);			 
			// $arr = xml_to_array($xml);			 
			// $ret = $arr;
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
	}
	
	
	function pendaftaran_list(){
		$userdata = $this->session->userdata("userdata");
		$data_array['data'] = $this->dm->get_data($userdata['LEASING_ID']);
		 
		//show_array($data_array); exit;
		$data_array['controller'] = get_class($this);
		$content = $this->load->view("daftar/daftar_list_view",$data_array,true);
		
		$this->set_subtitle("DATA PEDAFTARAN BLOKIR ");
		$this->set_title("DATA PENDAFTARAN BLOKIR ");
		$this->set_content($content);
		$this->render();
	}
	
	
	function cekdata(){
		$data = $this->input->post();
		$userdata = $this->session->userdata("userdata");
		$arr = $this->dm->inq_get_bpkb($data['vISCari'], $data['vCari'], $userdata['LEASING_ID'], $userdata['USER_ID'] );

		echo json_encode($arr);
		 
		
		
	}
	
	
	
	 
	
	
	
	
	function edit($id){
		

 
		$data_array = $this->cm->get_detail_pendaftaran($id);
		echo $this->db->last_query();
		$data_array['DAFT_DATE'] = $data_array['DAFT_DATE2'];
		$data_array['TGL_BPKB'] = $data_array['TGL_BPKB2'];

		// $data_array = $this->cm->get_detail("T_PENDAFTARAN","DAFT_ID",$id);
		// show_array($data_array);
		// exit;
		// $data_array['DAFT_DATE'] = indo_date($data_array['DAFT_DATE']);
		// $data_array['TGL_BPKB'] = indo_date($data_array['TGL_BPKB']);
		// $data_array = clear_array($data_array);
		
		/*show_array($data_array);
		exit;*/
		$data_array['controller'] = "blokir";
		$data_array['arr_jenis'] = $this->cm->arr_dropdown("V_JENIS","JENIS_ID","JENIS_NAMA","JENIS_NAMA");
		$data_array['arr_jenis']= $this->add_arr_head($data_array['arr_jenis'],"x"," - PILIH JENIS -");		


		$data_array['arr_warna'] = $this->cm->arr_dropdown("V_WARNA","WARNA_ID","WARNA_NAMA","WARNA_NAMA");
		$data_array['arr_warna']= $this->add_arr_head($data_array['arr_warna'],"x"," - PILIH WARNA -");	

		$data_array['arr_merk'] = $this->cm->arr_dropdown("V_MERK","MERK_ID","MERK_NAMA","MERK_NAMA");
		$data_array['arr_merk']= $this->add_arr_head($data_array['arr_merk'],"x"," - PILIH MERK -");	
			
		
		//show_array($data_array['arr_warna']); exit;
		$data_array['mode'] = "U";
 		$content = $this->load->view("daftar/daftar_view_edit",$data_array,true);
		
		$this->set_subtitle("EDIT PEDAFTARAN BLOKIR ");
		$this->set_title("EDITPENDAFTARAN BLOKIR ");
		$this->set_content($content);
		$this->render();
	}
	 
	
	function daftar_update(){
		$userdata = $this->session->userdata("userdata");
		$data=$this->input->post();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('NAMA_PEMILIK','Nama Pemilik','required');
 		
		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			
			$data['MERK_ID'] = ($data['MERK_ID']=="x")?NULL:$data['MERK_ID'];
			$data['TYPE_KENDARAAN'] = ($data['TYPE_KENDARAAN']=="x")?NULL:$data['TYPE_KENDARAAN'];
			$data['WARNA_ID'] = ($data['WARNA_ID']=="x")?NULL:$data['WARNA_ID'];


			$data['LEASING_ID'] = $userdata['LEASING_ID'];
			$data['DAFT_BY'] = $userdata['USER_ID'];
			unset($data['mode']);
			$data['DAFT_DATE'] = ora_date($data['DAFT_DATE']);
			$data['TGL_BPKB'] = ora_date($data['TGL_BPKB']);
			$this->db->where("DAFT_ID",$data['DAFT_ID']);
			$res = $this->db->update("T_PENDAFTARAN",$data);
			if($res){
				$ret = array("error"=>false,"message"=>"DATA BERHASIL DIUPDATE");

				


				unset($data['NAMA_PENGAJUAN_LEASING']);
		    	unset($data['ALAMAT_PENGAJUAN_LEASING']);
		    	unset($data['USER_ID']);
		    	unset($data['DAFT_DATE']);
		    	unset($data['DAFT_BY']);
		    	$this->db->where("DAFT_ID",$data['DAFT_ID']);
		    	$this->db->update("V_T_BLOKIR_LANGSUNG",$data);
		    	//echo $this->db->last_query();

			}
			else {
				$ret = array("error"=>true,"message"=>$this->db->_eror_message());
			}
			 
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
	}
	
	
	
	function lepas(){
		$data_array['controller'] = get_class($this);
		
		
		
		//show_array($data_array['arr_warna']); exit;
		 
		$content = $this->load->view("lepas/lepas_view",$data_array,true);
		
		$this->set_subtitle("LEPAS PEDAFTARAN BLOKIR ");
		$this->set_title("LEPAS PENDAFTARAN BLOKIR ");
		$this->set_content($content);
		$this->render();
	}
	
	function inq_lepas_daft(){
		$data = $this->input->post();
		$userdata = $this->session->userdata("userdata");

		$data['LEASING_ID']=$userdata['LEASING_ID'];
		$data['INQ_BY']=$userdata['USER_ID'];
		
		$arr = $this->dm->inq_lepas_daft($data);


		if($arr['error']== false){ 
		$arr_jenis = $this->cm->arr_dropdown("V_JENIS","JENIS_ID","JENIS_NAMA","JENIS_NAMA");
		$arr_jenis= $this->add_arr_head($arr_jenis,"x"," - PILIH JENIS -");

		$arr_warna = $this->cm->arr_dropdown("V_WARNA","WARNA_ID","WARNA_NAMA","WARNA_NAMA");
		$arr_warna= $this->add_arr_head($arr_warna,"x"," - PILIH JENIS -");

		$arr_merk = $this->cm->arr_dropdown("V_MERK","MERK_ID","MERK_NAMA","MERK_NAMA");
		$arr_merk= $this->add_arr_head($arr_merk,"x"," - PILIH JENIS -");
		
		$arr['message']['JENIS_NAMA'] = isset($arr_jenis[$arr['message']['TYPE_KENDARAAN']])?$arr_jenis[$arr['message']['TYPE_KENDARAAN']]:"";
		$arr['message']['WARNA_NAMA'] = isset($arr_jenis[$arr['message']['WARNA_ID']])?$arr_jenis[$arr['message']['WARNA_ID']]:"";
		$arr['message']['MERK_NAMA'] = isset($arr_jenis[$arr['message']['MERK_ID']])?$arr_jenis[$arr['message']['MERK_ID']]:"";
		}
		echo json_encode($arr);

		
	}
	
	function lepas_blokir($v_is_cari){
		
		 
		$data = $this->input->post();

		$userdata = $this->session->userdata("userdata");
		$data['LEASING_ID']=$userdata['LEASING_ID'];
		$data['USER_ID']=$userdata['USER_ID'];
		$data['v_is_cari']= $v_is_cari;
		//show_array($data); exit;
		$arr = $this->dm->lepas_daftar($data);
		echo json_encode($arr);
		// $service['method']='lepas_daftar';
		// $service['debug']='true';
		// $service['vNO_BPKB']=$data['NO_BPKB'];
		// $service['vLEASING_ID']=$userdata['LEASING_ID'];
		// $service['vUSER_ID']=$userdata['USER_ID'];
		// $url = service_url($service);	
		// //echo $url; exit;	
		// $xml = file_get_contents($url);
		// $arr = xml_to_array($xml);
		// //show_array($arr); exit;
		// echo json_encode($arr);
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
	 
	function hapus($id) {
		$userdata = $this->session->userdata("userdata");
		 
 	// 	$service['vLEASING_ID']=$userdata['LEASING_ID'];
		// $service['vDAFT_ID']=$id;
		
		$this->db->where("DAFT_ID",$id);
		$this->db->WHERE("LEASING_ID",$userdata['LEASING_ID']);
		$res = $this->db->delete("T_PENDAFTARAN");
		if($res){
			$ret = array("error"=>false,"message"=>"DATA BERHASIL DIHAPUS");
		}
		else {
			$ret = array("error"=>true,"message"=> $this->db->_eror_message() );
		} 
		echo json_encode($ret);
	}
	 

	function cetak_berkas($id){
		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'F4', true, 'UTF-8', false);
		$pdf->SetTitle('BERITA ACARA PEMBLOKIRAN');
		$pdf->SetMargins(10, 30, 10);
		$pdf->SetHeaderMargin(10);
		$pdf->SetFooterMargin(10);
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', 10));

 		$pdf->SetAutoPageBreak(true,10);
		$pdf->SetAuthor('Author');
		 
			
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(true);

		$pdf->AddPage();
		$data_pendaftaran = $this->cm->get_detail_pendaftaran($id);

		 // $data_kendaraan = $this->cm->get_detail_kendaraan("2",$data_pendaftaran['NO_BPKB']);
		 // $data_kendaraan = $data_kendaraan['message'];

		  
		 //show_array($data_pendaftaran); exit;
		 $html = $this->load->view("daftar/daftar_pdf",$data_pendaftaran,true);
		 $pdf->writeHTML($html, true, false, true, false, '');

		 //$pdf->AddPage();


		  

		 $pdf->Output('Buku Pajak'. $this->session->userdata("tahun") .'.pdf', 'I');
	}
	 
	 
}
?>
