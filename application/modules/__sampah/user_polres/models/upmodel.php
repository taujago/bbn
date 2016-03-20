<?php
class upmodel extends CI_Model {
	function upmodel() {
		parent::__construct();
	}
	 

	function get_data(){
		$this->db->select('u.*, res.kota as nama_polres , da.provinsi as nama_polda',false)
		->from('t_user u')
		->join("tiger_kota res","res.id=u.id_polres")
		->join("tiger_provinsi da",'da.id = res.id_provinsi');
		$this->db->where("user_level",'88');
		$res = $this->db->get();
		return $res;
	}


 



	function get_user_detail($id){
		$ret = array();
		$this->db->select("u.*, res.id as id_polres, res.id_provinsi as id_polda ",false)
		->from('t_user u')->join('tiger_kota res','u.id_polres = res.id');
		$this->db->where("u.user_id",$id);
		$res = $this->db->get();
		//echo $this->db->last_query(); exit;
		if($res->num_rows()==0){
			$ret['error']=true;
			$res['message']="DATA TIDAK ADA ";
		}
		else {
			$arr = $res->row_array();
			$ret['error']=false;
			$ret['message'] = $arr;
		}
		//show_array($ret);
		return $ret;
	}

}


?>