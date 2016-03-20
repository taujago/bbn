<?php
class bd_model extends CI_Model {
	function bd_model(){
		parent::__construct();
	}

	function get_data($param) {
		//extract($param);
		// show_array($param); exit;
		$this->db->select("
			P.*, if(p.status=0,'DAFTAR',
				IF(p.status=2,'VER. LV2',IF(P.status=3,'VER. LV3','X'))) AS status2,
		if(p.approved=0,'PENDING','APPROVED') as approved
		",false);
		$this->db->where("leasing_id",$param['vleasing_id']);
		$this->db->where("id_polda",$this->session->userdata("id_polda"));
		$this->db->where("jenis_permohonan","B");
		$this->db->from("t_pendaftaran p");
		$this->db->order_by("daft_id desc");


		($param['limit'] != null ? $this->db->limit($param['limit']['end'], $param['limit']['start']) : '');
        
        ($param['sort_by'] != null) ? $this->db->order_by($param['sort_by'], $param['sort_direction']) :'';
 
		$res = $this->db->get();
		 // echo $this->db->last_query(); exit;
		return $res;
	}
	
}
?>