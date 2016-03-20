<?php
class cab_model extends CI_Model {
	function cab_model(){
		parent::__construct();
	}

	function get_data($vleasing_id) {
		$this->db->select('c.*')
		->from("t_cabang c")->join("m_leasing l",'c.leasing_id=l.leasing_id')
		->where("c.leasing_id",$vleasing_id);


		$res = $this->db->get();
		// echo $this->db->last_query(); exit;
		return $res;
	}
	

	 function get_list_daftar($param) {



		$this->db->select("
			p.*, if(p.status=0,'DAFTAR',
				IF(p.status=2,'VER. LV2',IF(p.status=3,'VER. LV3','X'))) AS status2,
		,
		if(p.approved=0,'PENDING','APPROVED') as approved2",false);
		$this->db->where("leasing_id",$param['leasing_id']);
		$this->db->where("id_polda",$this->session->userdata("id_polda"));
		$this->db->where("jenis_permohonan","B");
		

		if(!empty($param['no_rangka']) ) {
			$no_rangka = $param['no_rangka'];
			$this->db->where("(no_rangka = '$no_rangka' or no_bpkb='$no_rangka') ",null,false);
		}



		if( !empty($param['tanggal_awal']) ) {

			$tanggal_awal = flipdate($param['tanggal_awal']);
			$tanggal_akhir = flipdate($param['tanggal_akhir']);
			$this->db->where("daft_date between '$tanggal_awal'  and '$tanggal_akhir'");
		}


		$this->db->from("t_pendaftaran p");



		$this->db->order_by("daft_id","desc");
		$res = $this->db->get();
		// echo $this->db->last_query();
		
		$arr = array();
		if($res->num_rows() > 0 ){
			foreach($res->result() as $row) : 
				$color = ($row->approved==1)?"green":"red";


				$arr[] = array(
						$row->daft_id,
						flipdate($row->daft_date),
						$row->no_surat,
						$row->no_rangka."<br />".$row->no_bpkb,
						$row->nama_pengajuan_leasing,
						$row->status2 ." / <font color=$color>" .$row->approved2."</font>",
						"<div class=\"btn-group\">
						  <a class=\"btn dropdown-toggle btn-primary\" data-toggle=\"dropdown\" href=\"#\">
						    Proses
						    <span class=\"caret\"></span>
						  </a>
						  <ul class=\"dropdown-menu\">
						     <li><a onclick=\"return edit('$row->daft_id')\" href=\"#\" >Edit</a></li>
						     <li><a onclick=\"return hapus('$row->daft_id')\" href=\"#\">Hapus</a></li>
						     <li><a   href=\"". site_url("baru_verifikasi/detail/$row->daft_id") ."\" >Detail</a></li>
						     <li><a  onclick=\"cetak('$row->daft_id');\" href=\"#\" >Cetak</a></li>
						  </ul>
						</div>"
/*

*/



						// '<a class="btn btn-primary"  href="'.site_url("baru_verifikasi/detail/$row->daft_id") .'"> <span class="glyphicon glyphicon-chevron-right"></span> Detail  </a>'.
						// ' <a target=blank class="btn btn-primary"  href="'.site_url("baru_verifikasi/cetak_berkas/$row->daft_id") .'"> <span class="glyphicon glyphicon-print"></span> Cetak  </a>'
					);
			endforeach;
			$ret = array("error"=>false,"message"=>$arr);
		}
		else {
			$ret = array("error"=>true,"message"=>"DATA TIDAK DITEMUKAN");
		}
		return $ret;
	}

}
?>