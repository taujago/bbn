<?php 
class leasing_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function get_data_leasing(){
		$this->db->order_by("leasing_nama");
		$res = $this->db->get("m_leasing");
		return $res;
	}

	function get_leasing_detail($id){
		$ret = array();
		$this->db->where("leasing_id",$id);
		$res = $this->db->get("m_leasing");
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