<?php 
class polda_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function get_data_leasing(){
		$this->db->order_by("no_urut");
		$res = $this->db->get("m_polda");
		return $res;
	}

	function get_leasing_detail($id){
		$ret = array();
		$this->db->where("id_polda",$id);
		$res = $this->db->get("m_polda");
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