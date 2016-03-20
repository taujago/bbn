<?php
class ulmodel extends CI_Model {
	function ulmodel() {
		parent::__construct();
	}
	function get_data(){
		// select u.*, M.LEASING_NAMA  from t_user u left 
  //               join m_leasing m on M.LEASING_ID = U.LEASING_ID   WHERE U.USER_LEVEL NOT IN (0,99) 

		$this->db->select('u.*, m.leasing_nama ',false)
		->from('t_user u ')->join('m_leasing m ','m.leasing_id = u.leasing_id','left')
		->where("u.user_level not in (0,99) ",null,false);
		$res  = $this->db->get();
		return $res;

	}

	function get_user_leasing_detail($id){
		$ret = array();
		$this->db->where("user_id",$id);
		$res = $this->db->get("t_user");
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