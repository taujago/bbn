<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Pendaftaran Terkonfrmasi</title>

<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/form-elements.css">
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/sticky-footer.css">
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
  <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>

</head>

<body>

<!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1><?php echo $judul; ?></h1>
      </div>
      <p class="lead">Pendaftaran <span class="email"><?php echo $email ?> </span> berhasil dikonfirmasi.<br /> Silahkan <?php echo anchor("login","Login"); ?> untuk melanjutkan</p>
      
    </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted">Sistem Informasi Biaya Balik Nama &copy 2016. Tiga Pilar Maju Mandiri</p>
      </div>
    </footer>


</body>
</html>