<?php
class usermodel extends CI_Model {
	function usermodel() {
		parent::__construct();
	}
	 

	function get_data(){
		$this->db->select('u.*, p.nama_polda')
		->from('t_user u')->join('m_polda p','u.id_polda=p.id_polda','left');
		$this->db->where("user_level",'99');
		$res = $this->db->get();
		return $res;
	}

	function get_user_detail($id){
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