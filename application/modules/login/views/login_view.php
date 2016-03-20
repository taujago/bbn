<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistem Informasi Biaya Balik Nama</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-57-precomposed.png">


 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css">


    </head>

    <body>




<div class="modal fade bs-example-modal-sm" id="myPleaseWait" tabindex="-1"
    role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <span class="glyphicon glyphicon-time">
                    </span>Sedang memproses. Harap Tunggu...
                 </h4>
            </div>
            <div class="modal-body">
                <div class="progress">
                    <div class="progress-bar progress-bar-info
                    progress-bar-striped active"
                    style="width: 100%">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal ends Here -->





        <!-- Top content -->
      <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                	
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>SISFO BBN</strong> Login &amp; Pendaftaran </h1>
                            <div class="description">
                            	<p>Sistem informasi Biaya Balik Nama Kendaraan</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-5">
                        	
                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Login </h3>
	                            		<p>Masukkan username dan password untuk masuk:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-key"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="" method="post" class="login-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-username">Username</label>
				                        	<input type="text" name="form-username" placeholder="Username..." class="form-username form-control" id="form-username">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-password">Password</label>
				                        	<input type="password" name="form-password" placeholder="Password..." class="form-password form-control" id="form-password">
				                        
                                        <input type="hidden" id="mask" name="mask" />
                                        
                                        </div>
				                        <button type="submit" class="btn">Sign in!</button>
				                    </form>
			                    </div>
		                    </div>
		                
		                	<!-- <div class="social-login">
	                        	<h3>...or login with:</h3>
	                        	<div class="social-login-buttons">
		                        	<a class="btn btn-link-1 btn-link-1-facebook" href="#">
		                        		<i class="fa fa-facebook"></i> Facebook
		                        	</a>
		                        	<a class="btn btn-link-1 btn-link-1-twitter" href="#">
		                        		<i class="fa fa-twitter"></i> Twitter
		                        	</a>
		                        	<a class="btn btn-link-1 btn-link-1-google-plus" href="#">
		                        		<i class="fa fa-google-plus"></i> Google Plus
		                        	</a>
	                        	</div>
	                        </div> -->
	                        
                        </div>
                        
                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>
                        	
                        <div class="col-sm-5">
                        	
                        	<div class="form-box">
                        		<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Daftar Sekarang</h3>
	                            		<p>Masukkan formulir berikut :</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-pencil"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form id="frm_registrasi" role="form" action="" method="post" class="registration-form">
				                    	<div class="form-group">
			                    		  <label class="sr-only" for="nama">First name</label>
			                    		  <input type="text" name="nama" placeholder="Nama" class="nama form-control" id="nama">
				                        </div>
                                        
                                         <div class="form-group">
				                        	<label class="sr-only" for="alamat">Alamat</label>
				                        	<textarea name="alamat" placeholder="Alamat" 
				                        				class="alamat form-control" id="alamat"></textarea>
				                        </div>
                                        
				                        <div class="form-group">
				                        	<label class="sr-only" for="nomor_ktp">Nomor KTP</label>
				                        	<input type="text" name="nomor_ktp" placeholder="Nomor KTP" class="nomor_ktp form-control" id="nomor_ktp">
				                        </div>
                                        
                                     <div class="form-group">
				                        	<label class="sr-only" for="nomor_hp">Nomor HP</label>
				                        	<input type="text" name="nomor_hp" placeholder="HP" class="form-last-name form-control" id="nomor_hp">
				                        </div>     
                                        
                                        
				                        <div class="form-group">
				                        	<label class="sr-only" for="email">Email</label>
				                        	<input type="text" name="email" placeholder="Email" class="email form-control" id="email">
				                        </div>

                                         <div class="form-group">
                                            <label class="sr-only" for="password">Password</label>
                                            <input type="password" name="password" placeholder="Password" class="email form-control" id="password">
                                        </div>

                                        <div class="form-group">
                                            <label class="sr-only" for="password2">Ulangi Password</label>
                                            <input type="password" name="password2" placeholder="Ulangi Password" class="email form-control" id="password2">
                                        </div>
				                       
				                        <button type="submit" class="btn">Daftar Sekarang!</button>
				                    </form>
			                    </div>
                        	</div>
                        	
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>

        <!-- Footer -->
        <footer>
        	<div class="container">
        		<div class="row">
        			
        			<div class="col-sm-8 col-sm-offset-2">
        				<div class="footer-border"></div>
        				<p>Dikelola oleh <a href="http://tigapilarmandiri.com" target="_blank"><strong>TIGA PILAR MAJU MANDIRI</strong></a> 
        					hak cipta dilindungi undang undang. </p>
        			</div>
        			
        		</div>
        	</div>
        </footer>

        <!-- Javascript -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.backstretch.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.md5.js"></script>
        
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.js"></script>
        <?php 
        $this->load->view("login_view_js");
        ?>        
        <!--[if lt IE 10]>
            <script src="<?php echo base_url(); ?>assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>