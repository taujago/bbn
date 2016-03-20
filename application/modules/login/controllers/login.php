<?php 
class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper("tanggal");
		$this->load->helper("url");
		//$this->load->helper("serviceurl");
		
	}
	
	function index(){
		$this->load->view("login_view");
	}
	
	
	function logout(){
		$this->session->unset_userdata("login",true);
		redirect("login");
	}
	

function cek_email($email) {
	$this->db->where("email",$email);
	$jumlah = $this->db->get("members")->num_rows();
	if($jumlah > 0) {
		$this->form_validation->set_message('cek_email', "Email $email sudah terdaftar  ");
		return false;
	}
}



function cek_password($password) {
	 $password2 = $_POST['password2'];

	 if($password == "" or $password2=="") {
	 	$this->form_validation->set_message('cek_password', 'Password harus diisi dengan benar ');
		return false;
	 }

	 if($password <> $password2 ) {
	 	$this->form_validation->set_message('cek_password', 'Password Harus sama');
		return false;
	 }


}

	function register(){
		//sleep(1);
		$data = $this->input->post();
		$userdata = $this->session->userdata("userdata");
		$this->load->library('form_validation');
  		$this->form_validation->set_rules('email','Email','callback_cek_email');
  		$this->form_validation->set_rules('password','Password','callback_cek_password');
		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			unset($data['password2']);
			$res = $this->db->insert("members",$data);

			// echo $this->db->last_query();
			$data['registered_date'] = date("Y-m-d h:i:s");
			if($res) {
				$ret = array("error"=>false,"message"=>"Pendaftaran berhasil <br />
					Silahkan cek email ". $data['email']. "untuk melakukan aktivasi pendaftaran");

				$data_validasi['id_user'] = $this->db->insert_id();
				$data_validasi['hash'] = md5(date('Ymdhis').'r^7dfjdfdkf');
				$data_validasi['valid'] = 1;

				$user_id = $data_validasi['id_user'] ;
				$hash = $data_validasi['hash'] ; 
				$email_body = "<p>Kami telah menerima pendaftaran anda <p>
				        	<p>
				        		silahkan klik link ". anchor("login/verifikasi?id_user=$user_id&hash=$hash")  ."
				        	</p>";

				

				$res = $this->db->insert("aktivasi",$data_validasi);

				$this->load->library('email');

 

			// $this->email->initialize(array(
			//   'mailpath' => "/usr/sbin/sendmail",
			//   'protocol' => 'smtp',
			//   'smtp_host' => 'localhost',			  
			//   'smtp_port' => 25,
			//   'mailtype'  => 'html', 
			//   'crlf' => "\r\n",
			//   'newline' => "\r\n"
			// ));

			// $this->email->from('no-reply@tigapilarmandiri.com', 'Firmansyah');
			// $this->email->to($data['email']);
		 
			// $this->email->subject('Konfirmasi Pendaftaran Sistem Informasi BBN');
			// $this->email->message($email_body);
			// $this->email->send();

			 




			}
		}
		else {  // validation error
			$ret = array("error"=>true,"message"=>validation_errors());

		}
		// $ret['email'] = $this->email->print_debugger();
		echo json_encode($ret);

	}



function verifikasi(){
	$get  = $this->input->get();
	$this->db->where("id_user",$get['id_user']);
	$this->db->where("hash",$get['hash']);
	$this->db->where("valid",1);

	$jumlah = $this->db->get("aktivasi")->num_rows();
	//$jumlah = 1;

	if($jumlah == 1 ) {
		
		// update tabel validasi

		$this->db->where("id_user",$get['id_user']);
		$this->db->where("hash",$get['hash']);
		$this->db->where("valid",1);
		$this->db->update("aktivasi", array("valid"=>0,"validated"=>date("Y-m-d h:i:s") ) );

		// update tabel member 
		$this->db->where("id",$get['id_user']);
		$this->db->update("members",array("aktif"=>1));

		$this->db->where("id",$get['id_user']);
		$users = $this->db->get("members")->row();
		//echo $this->db->last_query();

		$data['judul'] = 'Konfirmasi pendaftaran sukses !!';
		$data['email'] = $users->email;
		$this->load->view("register_confirm",$data);


	}
	else 
	{
		$this->load->view("register_confirm_fail");
	}


}




	function ceklogin(){

		 $data = $this->input->post();
		 $username = $data['form-username'];
		 $password = $data['mask'];

		 $this->db->where("email",$username);
		 $this->db->where("password",$password);
		 $res = $this->db->get("members");
		 // echo $this->db->last_query(); exit;

		 if($res->num_rows()==0) {
		 	$ret = array("error"=>true,"message"=>"Kombinasi Email dan password tidak dikenali");

		 }
		 else {

		 	$member = $res->row();

		 	if($member->aktif == 1) {
		 		

		 		$this->session->userdata("login",true);
		 		$ret = array("error"=>false,"message"=>"Login sukses.Klik Oke untuk melanjutkan");


		 	}
		 	else {
		 		$ret = array("error"=>true,"message"=>"Username belum aktif");
		 	}

		 }


		 echo json_encode($ret);
 
		 
		 
	}

}

?>