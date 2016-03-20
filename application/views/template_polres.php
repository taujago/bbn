<?php 
					$userdata =$this->session->userdata("userdata");
//show_array($userdata);			
					?>
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="shortcut icon" href="<?php echo base_url("assets/images/favicon.ico"); ?>" />
<style type="text/css">

  #page-header {
  background-image:url('<?php echo base_url("assets/images/")."/".$this->session->userdata("header_image") ?>');
   height:168px;
   background-size:cover;
   border-radius : 6px;
   margin : 0px auto;
   padding: 10px;
}



</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Informasi Leasing BPKB - <?php echo $title; ?></title>
<!-- 
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/jseasyui/themes/default/easyui.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/jseasyui/themes/icon.css">
 -->
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets") ?>/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url("assets") ?>/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url("assets") ?>/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url("assets") ?>/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url("assets") ?>/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url("assets") ?>/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


<script src="<?php echo base_url("assets") ?>/bower_components/jquery/dist/jquery.min.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/jseasyui/jquery.easyui.min.js"></script>
-->
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("assets") ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url("assets") ?>/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
   <!-- <script src="<?php echo base_url("assets") ?>/bower_components/raphael/raphael-min.js"></script>
    <script src="<?php echo base_url("assets") ?>/bower_components/morrisjs/morris.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/js/morris-data.js"></script>-->

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url("assets") ?>/dist/js/sb-admin-2.js"></script>


    <link href="<?php echo base_url("assets") ?>/css/eblokir.css" rel="stylesheet">

 
 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css">

 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.js"></script>

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

     <?php 
        $userdata = $this->session->userdata("userdata");
        // show_array($userdata); exit;
       ?>

<div class="container">

 <div class="page-header" id="page-header">
  <!--<h1>SISTEM BLOKIR ONLINE <small><?php echo $this->session->userdata("nama_polda"); ?></small></h1>-->
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
   <!-- <div class="navbar-header">
      <a class="navbar-brand" >BLOKIR ONLINE <?php echo $this->session->userdata("nama_polda_singkatan"); ?></a>
    </div>-->
    <div>
      <ul class="nav navbar-nav">
        <li><a href="<?php echo site_url("polres_depan"); ?>">DEPAN</a></li>
        <li><a href="<?php echo site_url("polres_blokir_pidana"); ?>">BLOKIR PIDANA</a></li>
      
      
      
      </ul>

       <ul class="nav navbar-nav navbar-right">
      
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">USER : <?php echo $userdata['user_name']; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo site_url("gantipass"); ?>">Ganti Password</a></li>
            <li><a href="<?php echo site_url("login/logout"); ?>">Logout</a></li>
             
          </ul>
        </li>
      </ul>

    </div>
  </div>
</nav>


<div class="row">
    <div class="col-md-12">

<!-- <ol class="breadcrumb" style="margin-bottom: 0px; padding-top: 1px; padding-bottom: 1px;">
<?php 
$pilihan = $this->session->userdata("pilihan");
$txt = ($pilihan=="B")?"KENDARAAN BARU":"KENDARAAN LAMA";
?>
  <li><a href="<?php echo site_url("pilih") ?>"><?php echo $txt; ?></a></li>
  <li class="active"><a href="<?php echo site_url("pilih_polda") ?>"><?php echo $this->session->userdata("nama_polda"); ?></a></li>
</ol> -->


        <div class="panel panel panel-success">
            <div class="panel-heading"><strong><?php echo $subtitle; ?></strong></div>            

            <div id="homepage" class="panel-body" style="min-height:300px;">
                    <?php echo $content; ?>
            </div>
        </div>
    </div>
</div>
</div>
</body>

</html>
