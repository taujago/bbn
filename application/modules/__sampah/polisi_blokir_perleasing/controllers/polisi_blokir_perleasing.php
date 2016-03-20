<?php 
class polisi_blokir_perleasing extends master_controller {
	function polisi_blokir_perleasing(){
		parent::__construct();
		// $this->load->model("core_model","cm");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		$this->load->model("pbpl_model","dm");

	}

	function index(){
		// echo "fuckkk.."; exit;
		$userdata = $this->session->userdata("userdata");


		
		
		 
		// $data_array['arr_leasing'] = $this->dm->arr_leasing();	 
		$data_array['controller'] = get_class($this);
		$data_array['tanggal_awal'] = $this->session->userdata("tanggal_awal");
		$data_array['tanggal_akhir'] = $this->session->userdata("tanggal_akhir");
		$content = $this->load->view($data_array['controller']."_view",$data_array,true);
		$this->set_subtitle("LAPORAN BLOKIR KENDARAAN PER LEASING");
		$this->set_title("LAPORAN BLOKIR KENDARAAN PER LEASING");
		$this->set_content($content);
		$this->render_polisi();
	}


function get_record() {
	$id_polda = $this->session->userdata("id_polda");
	$data = $this->input->post();
	$bulan = $data['bulan'];
	$tahun = $data['tahun'];

	$data['record'] = $this->dm->get_data($id_polda,$bulan,$tahun);
	$this->load->view("polisi_blokir_perleasing_hasil_view",$data);

	

}	 

 

}
?>