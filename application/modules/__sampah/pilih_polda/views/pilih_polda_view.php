<html>
<head>
<link rel="shortcut icon" href="<?php echo base_url("assets/images/favicon.ico"); ?>" />
<!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets") ?>/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <title> Blokir Online  </title>
</head>
<body>

<div class="row" style="margin-top:100px;">
	<div class="col-md-3">
	</div>
	<div class="col-md-6">
		<div class="panel panel-success">
            <div class="panel-heading"><h3 style="text-align:center;">PILIH POLDA</h3></div>        	

            <div class="panel-body">
                <form id="frm_polda" action="<?php echo site_url("pilih_polda/simpan") ?>" method="POST" >

                <?php  
                    echo form_dropdown("id_polda",$arr_polda,'','id="id_polda" class="form-control"');
                ?>

                <BR />
                <a class="btn btn-success"  href="<?php echo site_url("pilih") ?>"> <i class="glyphicon glyphicon-arrow-left"></i> KEMBALI </a>
                <a class="btn btn-primary" onClick="javascript:$('#frm_polda').submit();"  href="#">  LANJUTKAN <i class="glyphicon glyphicon-arrow-right"></i></a> 
                 </form>
            </div>
        </div>
	</div>
</div>


</body>


 <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  <!-- Bootstrap Core JavaScript -->
  <script src="<?php echo base_url("assets") ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</html>