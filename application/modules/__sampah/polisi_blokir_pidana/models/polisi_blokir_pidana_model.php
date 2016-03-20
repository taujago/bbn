<?php
class polisi_blokir_pidana_model extends CI_Model {
	function polisi_blokir_pidana_model(){
		parent::__construct();
	}



var $arr_status2 = array("x"=>"Semua Status", 0=>"Menunggu Blokir","Diblokir");


var $arr_status = array("Menunggu Blokir","Diblokir");


 function data($param)
	{		

		// show_array($param);
		// exit;

		 extract($param);
		 
	  	 $this->db->select('*')->from('t_pendaftaran_pidana p');
		 

	  	$status = ($status=='')?'x':$status;


	  	 if( $status <> 'x' ){
	  	 	$this->db->where("status",$status);
	  	 }


		if(!empty($no_rangka) ) {
			//$no_rangka = $param['no_rangka'];
			$this->db->where("(no_rangka = '$no_rangka' or no_bpkb='$no_rangka') ",null,false);
		}

		if( !empty($tanggal_awal) ) {

			$tanggal_awal = flipdate($tanggal_awal);
			$tanggal_akhir = flipdate($tanggal_akhir);
			$this->db->where("tanggal between '$tanggal_awal'  and '$tanggal_akhir'");
		}


		//$this->db->where("id_polres",$this->session->userdata("id_polres"));

		$this->db->join("tiger_kota res","res.id=p.id_polres");
		$this->db->where("res.id_provinsi",$this->session->userdata("id_polda"));

		($param['limit'] != null ? $this->db->limit($param['limit']['end'], $param['limit']['start']) : '');
		//$this->db->limit($param['limit']['end'], $param['limit']['start']) ;
       
       // ($param['sort_by'] != null) ? $this->db->order_by($param['sort_by'], $param['sort_direction']) :'';
        
		$this->db->order_by("daft_id desc");

		$res = $this->db->get();
		// echo $this->db->last_query();  exit;
 		return $res;
	}

 


}
?>