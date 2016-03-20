<?php
class bd_model extends CI_Model {
	function bd_model(){
		parent::__construct();
	}




 function data($param)
	{		

		// show_array($param);
		// exit;

		 extract($param);
		 
	  	$this->db->select("
			p.*, if(p.status=0,'DAFTAR',
				IF(p.status=2,'VER. LV2',IF(p.status=3,'VER. LV3','X'))) AS status2,
		,   
   IF((p.approved=0 and approved_error = 0 ), 'TUNGGU BLOKIR', 
   if((p.approved=0 and approved_error = 1),'TUNGGU BLOKIR',
   if((p.approved=0 and approved_error = 2),'BATAL BLOKIR (BPKB sudah diblokir)',
   if((p.approved=0 and approved_error = 3),'BATAL BLOKIR (KENDARAAN SUDAH JADI BPKB)',
   if((p.approved=0 and approved_error = 4),'BPKB SUDAH TERBIT DAN SUDAK TIDAK AKTIF',
   if((p.approved=0 and approved_error = 5),'USER TIDAK DITEMUKAN',
   IF(p.approved=1, 'BLOKIR BPKB', 
   IF(p.approved=2, 'CEK ABSAH POLISI, NOMOR RANGKA TIDAK DITEMUKAN',
	'-'))))) ) ) ) AS approved2,
			cab.cabang_nama",false);
		$this->db->where("p.leasing_id",$vleasing_id);		
		$this->db->where("id_polda",$this->session->userdata("id_polda"));
		$this->db->where("jenis_permohonan",$this->pilihan);
		$this->db->from("t_pendaftaran p");
		$this->db->join("t_cabang cab",'p.cabang_id = cab.cabang_id','left');
		$this->db->order_by("daft_id desc");
		

		if($status <> '0') {

			 if($status==1) { // level 2 
			 	$this->db->where("status",2);
			 }
			 if ($status==2){ //
			 	$this->db->where("approved",0);
			 	$this->db->where("approved_error",0);			 	
			 }
			 if ($status==3){
			 	$this->db->where("approved",0);
			 	$this->db->where("approved_error <> 0 ",null,false);		
			 }
			 if($status==4){
			 	$this->db->where("approved",1);
			 }
		} 

		 

		if(!empty($no_rangka) ) {
			//$no_rangka = $param['no_rangka'];
			$this->db->where("(no_rangka = '$no_rangka' or no_bpkb='$no_rangka') ",null,false);
		}

		if( !empty($tanggal_awal) ) {

			$tanggal_awal = flipdate($tanggal_awal);
			$tanggal_akhir = flipdate($tanggal_akhir);
			$this->db->where("daft_date between '$tanggal_awal'  and '$tanggal_akhir'");
		}

		($param['limit'] != null ? $this->db->limit($param['limit']['end'], $param['limit']['start']) : '');
		//$this->db->limit($param['limit']['end'], $param['limit']['start']) ;
       
       // ($param['sort_by'] != null) ? $this->db->order_by($param['sort_by'], $param['sort_direction']) :'';
        
		$res = $this->db->get();
		// echo $this->db->last_query();
 		return $res;
	}


	function get_data($vleasing_id) {
		$this->db->select("
			p.*, if(p.status=0,'DAFTAR',
				IF(p.status=2,'VER. LV2',IF(p.status=3,'VER. LV3','X'))) AS status2,
		IF((p.approved=0 and approved_error = 0 ), 'PENDING', 
   if((p.approved=0 and approved_error = 1),'TUNGGU BLOKIR',
   if((p.approved=0 and approved_error = 2),'BPKB sudah diblokir',
   if((p.approved=0 and approved_error = 3),'KENDARAAN SUDAH JADI BPKB',
   IF(p.approved=1, 'BLOKIR BPKB',

	IF(p.approved=2, 'CEK ABSAH POLISI, NOMOR RANGKA TIDAK DITEMUKAN',   '-'))))) ) AS approved2,
			cab.cabang_nama
		",false);
		$this->db->where("p.leasing_id",$vleasing_id);
		$this->db->where("id_polda",$this->session->userdata("id_polda"));
		$this->db->where("jenis_permohonan",$this->pilihan);
		$this->db->from("t_pendaftaran p");
		$this->db->join("t_cabang cab",'p.cabang_id = cab.cabang_id','left');
		$this->db->order_by("daft_id desc");

		$res = $this->db->get();
		// echo $this->db->last_query(); exit;
		return $res;
	}
	

	 function get_list_daftar($param) {



		$this->db->select("
			p.*, if(p.status=0,'DAFTAR',
				IF(p.status=2,'VER. LV2',IF(p.status=3,'VER. LV3','X'))) AS status2,
		,
		IF((p.approved=0 and approved_error = 0 ), 'PENDING', 
   if((p.approved=0 and approved_error = 1),'TUNGGU BLOKIR',
   if((p.approved=0 and approved_error = 2),'BPKB sudah diblokir',
   if((p.approved=0 and approved_error = 3),'KENDARAAN SUDAH JADI BPKB',
   IF(p.approved=1, 'BLOKIR BPKB', IF(p.approved=2, 'CEK ABSAH POLISI, NOMOR RANGKA TIDAK DITEMUKAN', '-'))))) ) AS approved2,
		cab.cabang_nama
			",false);
		$this->db->where("p.leasing_id",$param['leasing_id']);
		$this->db->where("id_polda",$this->session->userdata("id_polda"));
		

		//pilihan
		$pilihan = $this->session->userdata("pilihan");

		$this->db->where("jenis_permohonan",$pilihan);
		

		if(!empty($param['no_rangka']) ) {
			$no_rangka = $param['no_rangka'];
			$this->db->where("(no_rangka = '$no_rangka' or no_bpkb='$no_rangka') ",null,false);
		}



		if( !empty($param['tanggal_awal']) ) {

			$tanggal_awal = flipdate($param['tanggal_awal']);
			$tanggal_akhir = flipdate($param['tanggal_akhir']);
			$this->db->where("daft_date between '$tanggal_awal'  and '$tanggal_akhir'");
		}


		$this->db->from("t_pendaftaran p");
		$this->db->join("t_cabang cab",'p.cabang_id = cab.cabang_id','left');


		$this->db->order_by("daft_id","desc");
		$res = $this->db->get();
		// echo $this->db->last_query();
		
		$arr = array();
		if($res->num_rows() > 0 ){
			foreach($res->result() as $row) : 
				$color = ($row->approved==1)?"green":"red";


				$arr[] = array(
						$row->daft_id,
						flipdate($row->daft_date),
						$row->no_surat,
						$row->cabang_nama,
						$row->no_rangka,
						$row->nama_pengajuan_leasing,
						$row->status2 ." / <font color=$color>" .$row->approved2."</font>",
						"<div class=\"btn-group\">
						  <a class=\"btn dropdown-toggle btn-primary\" data-toggle=\"dropdown\" href=\"#\">
						    Proses
						    <span class=\"caret\"></span>
						  </a>
						  <ul class=\"dropdown-menu\">
						     <li><a onclick=\"return edit('$row->daft_id')\" href=\"#\" >Edit</a></li>
						     <li><a onclick=\"return hapus('$row->daft_id')\" href=\"#\">Hapus</a></li>
						     <li><a   href=\"". site_url("baru_verifikasi/detail/$row->daft_id") ."\" >Detail</a></li>
						     <li><a  onclick=\"cetak('$row->daft_id');\" href=\"#\" >Cetak</a></li>
						  </ul>
						</div>"
/*

*/



						// '<a class="btn btn-primary"  href="'.site_url("baru_verifikasi/detail/$row->daft_id") .'"> <span class="glyphicon glyphicon-chevron-right"></span> Detail  </a>'.
						// ' <a target=blank class="btn btn-primary"  href="'.site_url("baru_verifikasi/cetak_berkas/$row->daft_id") .'"> <span class="glyphicon glyphicon-print"></span> Cetak  </a>'
					);
			endforeach;
			$ret = array("error"=>false,"message"=>$arr);
		}
		else {
			$ret = array("error"=>true,"message"=>"DATA TIDAK DITEMUKAN");
		}
		return $ret;
	}


function arr_cabang(){
	$userdata = $this->session->userdata("userdata");
	$this->db->where("leasing_id",$userdata['leasing_id']);
	$this->db->order_by("cabang_nama");
	$res = $this->db->get("t_cabang");
	$arr =array();
	foreach($res->result() as $row):
		$arr[$row->cabang_id] = $row->cabang_nama;

	endforeach;
	return $arr;
}


}
?>