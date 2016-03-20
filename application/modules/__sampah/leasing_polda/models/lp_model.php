<?php 
class lp_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function get_data_leasing(){
		$this->db->select('p.nama_polda,p.id_polda,l.leasing_id,l.leasing_nama,lp.service_user,lp.service_pass,lp.service_salt')
		->from("polda_leasing lp")
		->join("m_polda p",'p.id_polda = lp.id_polda','left')
		->join("m_leasing l",'l.leasing_id=lp.leasing_id','left')
		->order_by("leasing_nama");
		$res = $this->db->get();


		return $res;
	}

	function get_detail($id_polda,$leasing_id){
		$ret = array();
		$this->db->where("id_polda",$id_polda);
		$this->db->where("leasing_id",$leasing_id);

		$res = $this->db->get("polda_leasing");
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