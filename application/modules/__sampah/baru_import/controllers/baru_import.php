<?php 
class baru_import extends master_controller {
	function baru_import(){
		parent::__construct();
		// $this->load->model("core_model","cm");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		$this->load->model("import_model","dm");


	}

	function index(){



		$userdata = $this->session->userdata("userdata");
		$data_array['data'] = $this->dm->get_data($userdata['leasing_id']);
		$jenis = ($this->pilihan=="B")?"BARU":"LAMA"; 
		//show_array($data_array); exit;
		$data_array['controller'] = get_class($this);
		$data_array['jenis'] = array(1=>"NOMOR RANGKA","NOMOR BPKB");
		
		$content = $this->load->view($data_array['controller']."_view",$data_array,true);
		
		$this->set_subtitle("IMPORT DATA");
		$this->set_title("IMPORT DATA");
		$this->set_content($content);
		$this->render_baru();
	}

function doupload(){
	$config['upload_path'] = './temp_upload/';
	$config['allowed_types'] = 'xls|xlsx|txt';
	$userdata = $this->session->userdata("userdata");

	$this->load->library('upload', $config);

	if ( ! $this->upload->do_upload('xlsfile')){
			$data = array('error' => $this->upload->display_errors());
			// show_array($data);
			$ret = array("error"=>true,'pesan'=>'File tidak ada. ');
			echo json_encode($ret);

	}
	else {
		$upload_data = $this->upload->data();
		$file =  $upload_data['full_path'];
		// $f_handler = fopen($file,"r");
		// $results = fgetcsv($f_handler, '|');
		// fclose($f_handler);
		//show_array($arr);

		// $lines = file($file);
		// $keys = explode('|', array_shift($lines));
		// $results = array_map(
		//     function($x) use ($keys){
		//         return array_combine($keys, explode('|', trim($x)));
		//     }, 
		//     $lines
		// );

		// show_array($results);
		// echo $results[0][6];




		$fh = fopen($file,"r");
		$headers = fgetcsv($fh, 0, '|');
		$details = array();
		while($line = fgetcsv($fh, 0, '|')) {
		   $details[] = $line;
		}
		fclose($fh);

		// show_array($details);
		// exit;
		// echo "<hr />";
		$row=2;
		foreach($details as $rowData) : 

			$arr_data[$row - 1]['daft_date'] = flipdate($rowData[1]);
			$arr_data[$row - 1]['no_rangka'] = $rowData[2];
			$arr_data[$row - 1]['no_mesin'] = $rowData[3];
			$arr_data[$row - 1]['tahun_kendaraan'] = $rowData[4];
			$arr_data[$row - 1]['jenis_nama'] = $rowData[5];
			$arr_data[$row - 1]['merk_nama'] = $rowData[6];
			$arr_data[$row - 1]['warna_nama'] = $rowData[7];
			$arr_data[$row - 1]['nama_pengajuan_leasing'] = $rowData[8];
			$arr_data[$row - 1]['customer_ktp'] = $rowData[9];
			$arr_data[$row - 1]['alamat_pengajuan_leasing'] = $rowData[10];
			$arr_data[$row - 1]['pemilik_nama'] = $rowData[11];
			$arr_data[$row - 1]['pemilik_ktp'] = $rowData[12];
			$arr_data[$row - 1]['pemilik_alamat'] = $rowData[13];
			$arr_data[$row - 1]['kontrak_no'] = $rowData[14];
			$arr_data[$row - 1]['kontrak_date'] = flipdate($rowData[15]);
			$arr_data[$row - 1]['cabang_id'] = $this->cm->get_id_cabang($rowData[16]);
			$arr_data[$row - 1]['cabang_nama'] = $rowData[16];
			$arr_data[$row - 1]['status'] = 2;
			$arr_data[$row - 1]['import'] = 1;
			$arr_data[$row - 1]['verifikasi_date'] = date("Y-m-d");
			$arr_data[$row - 1]['verifikasi_by'] = $userdata['user_id'];
			$arr_data[$row - 1]['daft_level2_date'] = date("Y-m-d");
			$arr_data[$row - 1]['daft_level2_by'] = $userdata['user_id'];
			$arr_data[$row - 1]['kontrak_perihal'] = "PROSES BLOKIR KENDARAAN";
			$arr_data[$row - 1]['jenis_permohonan'] = (strtoupper($rowData[17])=="NEW")?"B":"L";

			$row++;
		endforeach;

		// show_array($arr_data); exit;
		//$this->session->set_userdata("arr_data",$arr_data);
		$this->session->set_userdata("arr_data",$arr_data);
		session_start();
		$_SESSION['arr_data'] = $arr_data;

		$ret = array("error"=>false,'pesan'=>"Oke ");
		//echo json_encode($ret);
		redirect("baru_import/review");

	}
}
	 
	
function doupload2(){
	// show_array($_FILES);
	// show_array($_POST);

	$config['upload_path'] = './temp_upload/';
	$config['allowed_types'] = 'xls|xlsx|txt';
	$userdata = $this->session->userdata("userdata");

	$this->load->library('upload', $config);

	if ( ! $this->upload->do_upload('xlsfile')){
			$data = array('error' => $this->upload->display_errors());
			// show_array($data);
			$ret = array("error"=>true,'pesan'=>'File tidak ada. ');
			echo json_encode($ret);

	}
	else {

		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));

		$upload_data = $this->upload->data();
		// show_array($upload_data);
		//show_array($upload_data);

		$file =  $upload_data['full_path'];

		try{
			$inputFileType = IOFactory::identify($file);
			$objReader = IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($file);

			// echo "success... ";
		}
		catch(Exception $e) {
			//die('error loading file '.$file);
			//show_array($e);
			$ret = array("error"=>true,'pesan'=>$e['error']);
			echo json_encode($ret);
		}


		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();

		//echo "Jumlah kolom $highestColumn <br />"; exit;

		if($highestColumn <> 'Q') {
			$ret = array("error"=>true,'pesan'=>"Jumlah kolom tidak sesuai");
			echo json_encode($ret);
			exit;
		}


		$arr_data = array();
		for($row=2; $row<=$highestRow; $row++){
			$rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row, NULL,TRUE,FALSE);
			//show_array($rowData);
			//echo $rowData[0][0]." ".$rowData[0][1]. "<br />";

			$arr_data[$row - 1]['daft_date'] = flipdate($rowData[0][1]);
			$arr_data[$row - 1]['no_rangka'] = $rowData[0][2];
			$arr_data[$row - 1]['no_mesin'] = $rowData[0][3];
			$arr_data[$row - 1]['tahun_kendaraan'] = $rowData[0][4];
			$arr_data[$row - 1]['jenis_nama'] = $rowData[0][5];
			$arr_data[$row - 1]['merk_nama'] = $rowData[0][6];
			$arr_data[$row - 1]['warna_nama'] = $rowData[0][7];
			$arr_data[$row - 1]['nama_pengajuan_leasing'] = $rowData[0][8];
			$arr_data[$row - 1]['customer_ktp'] = $rowData[0][9];
			$arr_data[$row - 1]['alamat_pengajuan_leasing'] = $rowData[0][10];
			$arr_data[$row - 1]['pemilik_nama'] = $rowData[0][11];
			$arr_data[$row - 1]['pemilik_ktp'] = $rowData[0][12];
			$arr_data[$row - 1]['pemilik_alamat'] = $rowData[0][13];
			$arr_data[$row - 1]['kontrak_no'] = $rowData[0][14];
			$arr_data[$row - 1]['kontrak_date'] = flipdate($rowData[0][15]);
			$arr_data[$row - 1]['cabang_id'] = $this->cm->get_id_cabang($rowData[0][16]);
			$arr_data[$row - 1]['cabang_nama'] = $rowData[0][16];
			$arr_data[$row - 1]['status'] = 2;
			$arr_data[$row - 1]['import'] = 1;
			$arr_data[$row - 1]['verifikasi_date'] = date("Y-m-d");
			$arr_data[$row - 1]['verifikasi_by'] = $userdata['user_id'];
			$arr_data[$row - 1]['daft_level2_date'] = date("Y-m-d");
			$arr_data[$row - 1]['daft_level2_by'] = $userdata['user_id'];
			$arr_data[$row - 1]['kontrak_perihal'] = "PROSES BLOKIR KENDARAAN";



		}

		//$this->session->set_userdata("arr_data",$arr_data);
		$this->session->set_userdata("arr_data",$arr_data);
		session_start();
		$_SESSION['arr_data'] = $arr_data;

		$ret = array("error"=>false,'pesan'=>"Oke ");
		//echo json_encode($ret);
		redirect("baru_import/review");
		 


	}
}


function review(){
	//echo "review";
	session_start();
	//$arr_data = $this->session->userdata("arr_data");
		$data = $_SESSION['arr_data'] ;
	 	$arr_data['controller'] = get_class($this)	;


		$arr_data['record'] = $data;
		$content = $this->load->view($arr_data['controller']."_list_view",$arr_data,true);
		
		$this->set_subtitle("REVIEW IMPORT DATA");
		$this->set_title("REVIEW IMPORT DATA");
		$this->set_content($content);
		$this->render_baru();
}


function save(){
	session_start();
	$arr = $_SESSION['arr_data'] ;
	// show_array($arr);
	$data = $this->input->post();
	// show_array($data['data']);


	$userdata = $this->session->userdata("userdata");


	$berhasil = 0;
	$gagal = 0;
	foreach($data['data'] as $index => $row):

		 $input_arr = $arr[$row];
		 unset($input_arr['cabang_nama']);
		 $input_arr['leasing_id'] = $userdata['leasing_id'];
		 $input_arr['daft_date'] = $input_arr['daft_date'];
		 $input_arr['id_polda'] = $this->session->userdata("id_polda");
 		 //$input_arr['status'] = '0';
 		 //$input_arr['jenis_permohonan'] =  $this->pilihan;



		 $this->db->where("no_rangka",$input_arr['no_rangka']);
		 $this->db->where("buka_blokir","0");

		 $rx = $this->db->get("t_pendaftaran"); 
		 if($rx->num_rows() == 0 )
		 { 
		 		 $res = $this->db->insert("t_pendaftaran",$input_arr);
		 		 if($res){

		 		 	$berhasil++;
		 		 	$this->nomor_surat($this->db->insert_id(),$input_arr);

		 		 }
		 		 else {
		 		 	$gagal++;
		 		 }
 		 }
 		 else {
 		 	$gagal++;
 		 }
		 

	endforeach;

		$xdata['berhasil'] = $berhasil;
		$xdata['gagal'] = $gagal;
		$xdata['controller'] = get_class($this);

		$content = $this->load->view($xdata['controller']."_result_view",$xdata,true);
		
		$this->set_subtitle("IMPORT DATA SELESAI");
		$this->set_title("IMPORT DATA SELESAI");
		$this->set_content($content);
		$this->render_baru();
}

}
?>