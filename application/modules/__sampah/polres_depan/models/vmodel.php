<?php
class vmodel extends CI_Model {
	function vmodel() {
		parent::__construct();
	}
	
	function get_data($leasing_id,$tanggal) {
		$arr = array();
		$this->db->select("p.*, L.LEASING_NAMA, M.MERK_NAMA, M.MERK_NAMA_R",false)
		->from("T_PENDAFTARAN P")
		->join("M_LEASING L","L.LEASING_ID = P.LEASING_ID",'left')
		->join("V_MERK M","M.MERK_ID = P.MERK_ID",'left')
		->where("P.LEASING_ID",$leasing_id)
		->where(" TO_CHAR (P.DAFT_DATE, 'YYYYMMDD') = '$tanggal' ",null,false);
		$this->db->order_by("P.DAFT_ID",'DESC');
		$res = $this->db->get();
		//echo $this->db->last_query(); exit;

		if($res->num_rows() == 0){
			$ret = array("error"=>true,"message"=>"DATA TIDAK ADA");
		}
		else {
			foreach($res->result_array() as $val) : 
				$arr[]=array($val['DAFT_ID'],
			 		"<a href='#' onclick='detail(\"".$val['NO_RANGKA']."\",\"".$val['DAFT_ID']."\")'>".$val['NO_BPKB']."</a>",
			 		//$val['DAFT_DATE'],
			 		$val['NO_MESIN'],
			 		$val['NO_RANGKA']);
			
			endforeach;
		   $ret = array("error"=>false,"message"=>array("data"=>$arr));
		}
		return $ret;

	}


	function simpan($data) {
		unset($data['STATUS']);
		unset($data['LEASING_ID']);
		$data['VERIFIKASI_DATE'] =  ora_date(date("d-m-Y"));
		
		//show_array($data); exit;
		$this->db->where("DAFT_ID",$data['DAFT_ID']);
		$res = $this->db->get("T_PENDAFTARAN");
		$jml  = $res->num_rows();
		if($jml > 0){

			$data_daftar = $res->row();
			// show_array($data_daftar); exit;

			$this->db->where("DAFT_ID",$data['DAFT_ID']);
			$res = $this->db->update("T_PENDAFTARAN",$data);



			if($res){

				$this->db->where("DAFT_ID",$data['DAFT_ID']);
				$res = $this->db->update("V_T_BLOKIR_LANGSUNG",$data);
				//echo $this->db->last_query();

				$ret = array("error"=>false,"message"=>"SUKSES, BERKAS BERHASIL DIUPDATE SERVER");
			}
			else {
				$ret = array("error"=>true,"message"=>$this->db->_error_message());
			}


		}
		else {
			$ret = array("error"=>true,"message"=>"GAGAL, BERKAS DATA TIDAK DITEMUKAN DI SERVER");
		}
		return $ret;
	}

}


?>