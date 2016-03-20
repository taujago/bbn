<?php
class lapmodel extends CI_Model {
	function lapmodel(){
		parent::__construct();
	}

	function get_data($vleasing_id) {
		$this->db->select("
			p.*, if(p.status=0,'DAFTAR',
				IF(p.status=2,'VER. LV2',IF(p.status=3,'VER. LV3','X'))) AS status2,
		if(p.approved=0,'PENDING','APPROVED') as approved2
		",false);
		$this->db->where("leasing_id",$vleasing_id);
		$this->db->where("id_polda",$this->session->userdata("id_polda"));
		$this->db->where("jenis_permohonan",$this->pilihan);
		$this->db->from("t_pendaftaran p");
		$this->db->order_by("daft_id desc");

		$res = $this->db->get();
		// echo $this->db->last_query(); exit;
		return $res;
	}
	

function get_list_daftar($param) {




$this->db->select("pol.*,
					p.`daft_id`, 
		`no_surat`,`no_urut_surat`,`jenis_permohonan`,p.`leasing_id`,`no_bpkb`,`nreg_bpkb`,`no_rangka`,`no_mesin`,`tgl_bpkb`,`no_polisi`,
		DATE_FORMAT(`tgl_bpkb`,'%d-%m-%Y') AS tgl_bpkb,
		`nama_pemilik`,`alamat_pemilik`,p.`merk_id`,

		IF((jenis_permohonan='B' and import='0'),m.merk_nama,p.`merk_nama`) AS merk_nama,
		`type_kendaraan`,p.`warna_id`,
		IF((jenis_permohonan='B' and import='0'),w.`warna_nama`,p.`warna_nama`) AS warna_nama,
		p.`jenis_id`, id_approval,
		IF((jenis_permohonan='B' and import='0'),j.`jenis_nama`,p.`jenis_nama`) AS jenis_nama,



		`tahun_kendaraan`,`user_id`,`status`,`approved`,`nama_pengajuan_leasing`,`alamat_pengajuan_leasing`,p.`id_polda`,`no_blokir`,
		DATE_FORMAT(`tgl_blokir`, '%d-%m-%Y')AS tgl_blokir ,
		DATE_FORMAT(`tgl_blokir2`, '%d-%m-%Y')AS tgl_blokir2 ,

		DATE_FORMAT(p.daft_date, '%d-%m-%Y') AS daft_date, DATE_FORMAT(p.verifikasi_date, '%d-%m-
		%Y') AS verifikasi_date, DATE_FORMAT(p.daft_level2_date, '%d-%m-%Y') AS daft_level2_date, DATE_FORMAT
		(p.daft_level3_date, '%d-%m-%Y') AS daft_level3_date, DATE_FORMAT(p.level2_tglsurat, '%d-%m-%Y') AS level2_tglsurat
		,l.leasing_nama, l.leasing_kota, l.leasing_alamat,
					if(p.status=0,'DAFTAR',
						IF(p.status=2,'VER. LV2',IF(p.status=3,'VER. LV3','X'))) AS status2
			 
		,

		IF((p.approved=0 and approved_error = 0 ), 'TUNGGU BLOKIR', 
		   if((p.approved=0 and approved_error = 1),'BATAL BLOKIR (NOMOR RANGKA SUDAH ADA)',
		   if((p.approved=0 and approved_error = 2),'BATAL BLOKIR (BPKB sudah diblokir)',
		   if((p.approved=0 and approved_error = 3),'BATAL BLOKIR (KENDARAAN SUDAH JADI BPKB)',
		   IF(p.approved=1, 'BLOKIR BPKB', '-'))))) AS approved2,
			cab.cabang_nama
		
		",false);
		$this->db->where("l.leasing_id",$param['leasing_id']);
		$this->db->join("m_polda pol","pol.id_polda= p.id_polda")
		->join("m_warna w","w.warna_id=p.warna_id",'left')
		->join("m_jenis j","j.jenis_id=p.jenis_id",'left')
		->join("m_merk m","m.merk_id=p.merk_id",'left')
		->join("t_cabang cab","cab.cabang_id=p.cabang_id",'left')
		->join("m_leasing l","l.leasing_id=p.leasing_id",'left');
		
		// $this->db->where("status",$param['status']);

		if($param['status'] <> '0') {

			 if($param['status']==1) { // level 2 
			 	$this->db->where("status",2);
			 }
			 if ($param['status']==2){ //
			 	$this->db->where("approved",0);
			 	$this->db->where("approved_error",0);			 	
			 }
			 if ($param['status']==3){
			 	$this->db->where("approved",0);
			 	$this->db->where("approved_error <> 0 ",null,false);		
			 }
			 if($param['status']==4){
			 	$this->db->where("approved",1);
			 }
		} 
		

		if( $param['id_polda'] <> 'x'  ) {
			 
			$this->db->where("p.id_polda",$param['id_polda'] );
		}
		 
		if( $param['jenis_permohonan'] <> 'x'  ) {
			 
			$this->db->where("jenis_permohonan",$param['jenis_permohonan'] );
		}

		if( !empty($param['tanggal_awal']) ) {

			$tanggal_awal = flipdate($param['tanggal_awal']);
			$tanggal_akhir = flipdate($param['tanggal_akhir']);
			$this->db->where("daft_date between '$tanggal_awal'  and '$tanggal_akhir'");
		}


		//$this->db->where("approved",1);
		$this->db->from("t_pendaftaran p");



		$this->db->order_by("daft_date","desc");
		$res = $this->db->get();
		// echo $this->db->last_query();
		
		$arr = array();
		if($res->num_rows() > 0 ){
			$nomor = 0;

			foreach($res->result() as $row) : 
				 $nomor++;


				$arr[] = array(
						$nomor,
						$row->daft_date,
						$row->cabang_nama,
						$row->no_polisi,$row->no_rangka,
						$row->no_bpkb,
						$row->nama_pengajuan_leasing,
						$row->no_blokir,
						$row->jenis_nama,
						$row->merk_nama,
						$row->approved2
						
						 
 					);
			endforeach;
			$ret = array("error"=>false,"message"=>$arr);
		}
		else {
			$ret = array("error"=>true,"message"=>"DATA TIDAK DITEMUKAN");
		}
		return $ret;
	}


function get_list_daftar_print($param) {




$this->db->select("pol.*,
					p.`daft_id`, 
		`no_surat`,`no_urut_surat`,`jenis_permohonan`,p.`leasing_id`,`no_bpkb`,`nreg_bpkb`,`no_rangka`,`no_mesin`,`tgl_bpkb`,`no_polisi`,
		DATE_FORMAT(`tgl_bpkb`,'%d-%m-%Y') AS tgl_bpkb,
		`nama_pemilik`,`alamat_pemilik`,p.`merk_id`,


		IF((jenis_permohonan='B' and import='0'),m.merk_nama,p.`merk_nama`) AS merk_nama,
		`type_kendaraan`,p.`warna_id`,
		IF((jenis_permohonan='B' and import='0'),w.`warna_nama`,p.`warna_nama`) AS warna_nama,
		p.`jenis_id`, id_approval,
		IF((jenis_permohonan='B' and import='0'),j.`jenis_nama`,p.`jenis_nama`) AS jenis_nama,


		`tahun_kendaraan`,`user_id`,`status`,`approved`,`nama_pengajuan_leasing`,`alamat_pengajuan_leasing`,p.`id_polda`,`no_blokir`,
		DATE_FORMAT(`tgl_blokir`, '%d-%m-%Y')AS tgl_blokir ,
		DATE_FORMAT(`tgl_blokir2`, '%d-%m-%Y')AS tgl_blokir2 ,

		DATE_FORMAT(p.daft_date, '%d-%m-%Y') AS daft_date, DATE_FORMAT(p.verifikasi_date, '%d-%m-
		%Y') AS verifikasi_date, DATE_FORMAT(p.daft_level2_date, '%d-%m-%Y') AS daft_level2_date, DATE_FORMAT
		(p.daft_level3_date, '%d-%m-%Y') AS daft_level3_date, DATE_FORMAT(p.level2_tglsurat, '%d-%m-%Y') AS level2_tglsurat
		,l.leasing_nama, l.leasing_kota, l.leasing_alamat,
					if(p.status=0,'DAFTAR',
						IF(p.status=2,'VER. LV2',IF(p.status=3,'VER. LV3','X'))) AS status2
			 
		,IF((p.approved=0 and approved_error = 0 ), 'TUNGGU BLOKIR', 
		   if((p.approved=0 and approved_error = 1),'BATAL BLOKIR (NOMOR RANGKA SUDAH ADA)',
		   if((p.approved=0 and approved_error = 2),'BATAL BLOKIR (BPKB sudah diblokir)',
		   if((p.approved=0 and approved_error = 3),'BATAL BLOKIR (KENDARAAN SUDAH JADI BPKB)',
		   IF(p.approved=1, 'BLOKIR BPKB', '-'))))) AS approved2,
		cab.cabang_nama
		",false);
		$this->db->where("l.leasing_id",$param['leasing_id']);
		$this->db->join("m_polda pol","pol.id_polda= p.id_polda")
		->join("m_warna w","w.warna_id=p.warna_id",'left')
		->join("m_jenis j","j.jenis_id=p.jenis_id",'left')
		->join("m_merk m","m.merk_id=p.merk_id",'left')
		->join("t_cabang cab","cab.cabang_id=p.cabang_id",'left')
		->join("m_leasing l","l.leasing_id=p.leasing_id",'left');
		

		if( $param['id_polda'] <> 'x'  ) {
			 
			$this->db->where("p.id_polda",$param['id_polda'] );
		}
		 
		if( $param['jenis_permohonan'] <> 'x'  ) {
			 
			$this->db->where("jenis_permohonan",$param['jenis_permohonan'] );
		}

		if( !empty($param['tanggal_awal']) ) {

			$tanggal_awal = flipdate($param['tanggal_awal']);
			$tanggal_akhir = flipdate($param['tanggal_akhir']);
			$this->db->where("daft_date between '$tanggal_awal'  and '$tanggal_akhir'");
		}


		if($param['status'] <> '0') {
			// echo "status oke .. ";

			 if($param['status']==1) { // level 2 
			 	$this->db->where("status",2);
			 }
			 if ($param['status']==2){ //
			 	$this->db->where("approved",0);
			 	$this->db->where("approved_error",0);			 	
			 }
			 if ($param['status']==3){
			 	$this->db->where("approved",0);
			 	$this->db->where("approved_error <> 0 ",null,false);		
			 }
			 if($param['status']==4){
			 	$this->db->where("approved",1);
			 }
		} 

		// $this->db->where("approved",1);
	//	$this->db->where("status",$param['status']);

		$this->db->from("t_pendaftaran p");



		$this->db->order_by("daft_date","desc");
		$res = $this->db->get();
	  // echo $this->db->last_query(); exit;
		
		 
		return $res;
	}	

}
?>
