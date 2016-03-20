<?php 
class polisi_blokir_pidana extends master_controller {
	function polisi_blokir_pidana(){
		parent::__construct();
		// $this->load->model("core_model","cm");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		$this->load->model("polisi_blokir_pidana_model","dm");



	}

	function index(){ 
		
		$userdata = $this->session->userdata("userdata");
		//$data_array['data'] = $this->dm->get_data($userdata['leasing_id']);
		 
		//show_array($data_array); exit;
		$data_array['controller'] = get_class($this);
		 
		$content = $this->load->view("polisi_blokir_pidana_view",$data_array,true);

		 



		$this->set_subtitle("DATA PEDAFTARAN BLOKIR PIDANA  ");
		$this->set_title("DATA PENDAFTARAN BLOKIR PIDANA  ");
		$this->set_content($content);
		$this->render_polisi();
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
        // $status = !empty($_REQUEST['columns'][7]['search']['value'])?$_REQUEST['columns'][7]['search']['value']:'x';


      //  order[0][column]
        $req_param = array (
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null,				 
				"no_rangka" => $no_rangka,
				"tanggal_awal" => $tanggal_awal,
				"tanggal_akhir" => $tanggal_akhir,
				"status"=>$status  
		);     
           
        $row = $this->dm->data($req_param)->result_array();
		
        $count = count($row); 
       
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->dm->data($req_param)->result_array();
        

       
        $arr_data = array();

 


        $arr_status = $this->dm->arr_status;
        foreach($result as $row) : 
        	$daft_id = $row['daft_id'];
        	$warna = ($row['status'] == 1) ? "green":"red";
        	$arr_data[] = array(
        						 $row['daft_id'], 
        		  				flipdate($row['tanggal']),
        		  				$row['no_polisi'], 
        		  				$row['no_bpkb'], 
        		  				$row['no_rangka'],
        		  				$row['pemilik_nama'],
        		  				$row['pemilik_alamat'],
        		  					
        		  				// $arr_status[$row['status']],
        		  				  '<span class="'.$warna.'">'.$arr_status[$row['status']].'</span>',

        		  				"<div class=\"btn-group\"> 
     <a class=\"btn dropdown-toggle btn-primary\" data-toggle=\"dropdown\" href=\"#\">Proses<span class=\"caret\"></span></a>
     
     <ul class=\"dropdown-menu\">
		<li><a href=\" " . site_url("polisi_blokir_pidana/detail/".$daft_id) ."\" ><span class=\"glyphicon glyphicon-info-sign\"></span> Detail</a></li>
		<li><a target=\"blank\" href=\" " . site_url("polisi_blokir_pidana/cetak/".$daft_id) ."\"'  ><span class=\"glyphicon glyphicon-print\"></span> Cetak </a></li>
		
       
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
		
  

	 
		$data_array['mode'] = "I";
		$data_array['method'] = "simpan";
 
		$content = $this->load->view("polisi_blokir_pidana_form",$data_array,true);
	 

		
		$this->set_subtitle("PEDAFTARAN BLOKIR PIDANA ");
		$this->set_title("PENDAFTARAN BLOKIR PIDANA");
		$this->set_content($content);
		$this->render_polisi();
	}


	function edit($daft_id) {

		$this->db->where("daft_id",$daft_id);
		$data_daft = $this->db->get("t_pendaftaran_pidana")->row_array();

		if($data_daft['status']=='1') {
			$content = "DATA TIDAK DAPAT DIEDIT";
		}

		else { 

			$data_array['controller'] = get_class($this);
			$data_array['daft_id'] = $daft_id;
			$data_array['mode'] = "U";
			$data_array['method'] = "update";
			
			
		$content = $this->load->view("polisi_blokir_pidana_form",$data_array,true);
		}
		
		$this->set_subtitle("EDIT PEDAFTARAN BLOKIR KENDARAAN BARU ");
		$this->set_title("EDIT PENDAFTARAN BLOKIR KENDARAAN BARU ");
		$this->set_content($content);
		$this->render_polisi();
	}




function detail($daft_id){
		 
		// 
		// echo "kapret.."; exit;

		$this->db->where("daft_id",$daft_id);
		$data_array = $this->db->get("t_pendaftaran_pidana")->row_array();



		$data_array['controller'] = get_class($this);
		
  		

	 
	
 
		$content = $this->load->view("polisi_blokir_pidana_detail",$data_array,true);
	 

		
		$this->set_subtitle("DETAIL PEDAFTARAN BLOKIR PIDANA ");
		$this->set_title("DETAIL PENDAFTARAN BLOKIR PIDANA");
		$this->set_content($content);
		$this->render_polisi();
	}



	function get_pendaftaran_detail($id){ // ($vTB_NAME,$vKEY,$vVALUE)
	// $vTB_NAME = "T_PENDAFTARAN"; 
	// $vKEY = "DAFT_ID";
	// $vVALUE = $id;
	
	// $arr = $this->get_detail($vTB_NAME,$vKEY,$vVALUE);
	// $arr = clear_array($arr['message']);
		$this->db->where("daft_id",$id);
		$res = $this->db->get("t_pendaftaran_pidana");
		$arr = $res->row_array();
		$arr['tanggal'] = flipdate($arr['tanggal']);
	// $arr = $this->cm->get_detail_pendaftaran($id);
	//echo $this->db->last_query();
	echo json_encode($arr);
	}

	


function nomor_surat($daft_id){
// $this->db->where("daft_id",$daft_id);
// $data_ = $this->db->get("t_pendaftaran_pidana")->row();

$tmp_tgl_surat = explode("-", date("Y-m-d"));

$arrbulan = array(1=>"I","II","III","IV","V","VI","VII","VIII","IX","X","XI","XII");

// $no_surat = $daft_id."/LAP-PDN/".$arrbulan[$tmp_tgl_surat[1]]."/".$tmp_tgl_surat[0]."/Sek.Dsw";

$no_surat = "B".$daft_id."/".$arrbulan[$tmp_tgl_surat[1]]."/".$tmp_tgl_surat[0]."/Sek.Dsw";

return $no_surat;

 
}



	function simpan(){
		$data = $this->input->post();
		 $this->db->where("daft_id",$data['daft_id']);
		 $res = $this->db->update("t_pendaftaran_pidana",array("status"=>$data['status'],
		 	"surat_tgl"=>date("Y-m-d"),
		 	"surat_nomor"=>$this->nomor_surat($data['daft_id']),
		 	"approved_date"=>date("Y-m-d")));

		 if($res) {
		 	$ret = array("error"=>false,"message"=>"DATA BERHASIL DISIMPAN");
		 }
		 else {
		 	$ret = array("error"=>rue,"message"=>"DATA GAGAL DISIMPAN".mysql_error());
		 }
		
		echo json_encode($ret);
	}

 
	function update(){
		$userdata = $this->session->userdata("userdata");
		//show_array($userdata); exit;
		$data=$this->input->post();
		// show_array($data); exit;
		$this->load->library('form_validation');
  		$this->form_validation->set_rules('no_rangka','Nomor Rangka','required');
  		$this->form_validation->set_rules('tanggal','Nomor Rangka','required');
		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			
			 
 		 
			$data['tanggal'] = flipdate($data['tanggal']);		// unset($data['DAFT_ID']);
 			unset($data['mode']);
 			unset($data['saa']);
 			$this->db->where("daft_id",$data['daft_id']);
 			$res = $this->db->update("t_pendaftaran_pidana",$data);
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
	$data = $this->db->get("t_pendaftaran_pidana")->row();

	if($data->status == 1 ) {
		$ret = array("error"=>true,"message"=>"TELAH DIPROSES. TIDAK DAPAT DIHAPUS");

	}
	else { 
	$this->db->where("daft_id",$daft_id);
	$this->db->delete("t_pendaftaran_pidana");

 		$ret = array("error"=>false,"message"=>"BERHASIL DIHAPUS");


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


function cetak($daft_id){
	$this->db->select("p.*, polres.kota as polres, polda.*")
	->from("t_pendaftaran_pidana p")
	->join("tiger_kota polres","p.id_polres=polres.id")
	->join("m_polda polda","polda.id_polda = polres.id_provinsi");
	$this->db->where("daft_id",$daft_id);

	$data_p = $this->db->get()->row_array();
	// show_array($data_p); exit;

	if($data_p['status'] == 0 ) {
		$this->set_subtitle("DATA PEDAFTARAN BLOKIR PIDANA  ");
		$this->set_title("DATA PENDAFTARAN BLOKIR PIDANA  ");
		$this->set_content("DATA TIDAK DAPAT DICETAK. BELUM MELALUI PROSES BLOKIR");
		$this->render_polisi();
	}
	else {
		
		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'F4', true, 'UTF-8', false);
		$pdf->SetTitle('SURAT BLOKIR PIDANA');
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
		 
		$html = $this->load->view("pdf/surat",$data_p,true);
		// echo $html; exit;
		$pdf->writeHTML($html, true, false, true, false, '');

		 //$pdf->AddPage();


		  

		 $pdf->Output('SURAT PIDANA' . $data_p['no_rangka'] .'.pdf', 'I');



	}

}
 



}
?>