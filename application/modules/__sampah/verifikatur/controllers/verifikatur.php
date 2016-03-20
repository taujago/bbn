<?php
class verifikatur extends master_controller  {
	function depan_baru(){
		parent::__construct();
		// echo "pilihan ".$this->session->userdata("pilihan"); exit;
		$this->load->model("verm","dm");
		$userdata = $this->session->userdata("userdata");
		show_array($userdata);
	}
	
	
	function index(){
		 

		$data_array['controller'] = get_class($this);
		$content = $this->load->view($data_array['controller']."_view",$data_array,true);

		 


		$this->set_subtitle("DASHBOARD");
		$this->set_title("DASHBOARD");
		$this->set_content($content);
		$this->render_polisi();
	}


	// function get_statistik(){
	// 	//sleep(2);

	// 	// call 

	// 	$userdata = $this->session->userdata("userdata");
	// 	$data = $this->dm->get_data_resume();
	// 	$data['leasing_id'] = $userdata['leasing_id'];
	// 	$data['record'] = $this->dm->get_list_daftar_print($data);		
	// 	$this->load->view("statistik",$data);
	// }


function cekvalidasi(){

	$userdata = $this->session->userdata("userdata");

	$this->db->where("approved",0);
	$this->db->where("approved_error",0);
	$res = $this->db->get("t_pendaftaran");
	

	foreach($res->result() as $row) : 

		$ret_arr = array();
		$hasil = $this->validasi($row->daft_id) ;
		
	 
			$arr_update = array();
			$arr_update['approved'] = 1;
			$arr_update['no_rangka'] = $hasil['RequestBlokirEntryList'][0]->NoRangka;
			$arr_update['no_bpkb'] = $hasil['RequestBlokirEntryList'][0]->NoBpkb;
			$arr_update['no_blokir'] = $hasil['RequestBlokirEntryList'][0]->NoBlokir;
			$arr_update['no_polisi'] = $hasil['RequestBlokirEntryList'][0]->NoPolisi;
			$arr_update['tgl_blokir'] = $this->tanggal($hasil['RequestBlokirEntryList'][0]->TglBlokir);
			$arr_update['tgl_bpkb']  = $this->tanggal($hasil['RequestBlokirEntryList'][0]->TglBpkb);
			$arr_update['tgl_blokir2']  = $this->tanggal2_tahun($hasil['RequestBlokirEntryList'][0]->TglBpkb);
			
			$this->db->where("daft_id",$row->daft_id);
			$this->db->where("leasing_id",$userdata['leasing_id']);
			$this->db->update("t_pendaftaran",$arr_update);


			// $ret_arr['error']  = false;
			// $ret_arr['message'] = "BERKAS  DIAPPROVE";
		// }



	endforeach;
}




}
?>