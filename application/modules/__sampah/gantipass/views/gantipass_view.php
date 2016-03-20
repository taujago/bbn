<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">

<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>
<link href="<?php echo base_url("assets") ?>/css/eblokir.css" rel="stylesheet">

 
<style>

.green {
color:green;
 }
.red {
	color:red;
 	
}
</style>

<div class="row">
  <div id="salah" class="col-lg-12" style="display:none">
            <div class="alert alert-danger" role="alert" id="message">
              
            </div>
        </div>
    </div>
    
  <div class="row">
  <div id="benar" class="col-lg-12" style="display:none">
            <div class="alert alert-success" role="alert" id="message2">
              
            </div>
        </div>
    </div> 


  <div class="row">
    <div class="col-md-6 col-md-offset-4">
        <!-- <div class="panel panel-primary">
         <div class="panel-heading">
            <h3 class="panel-title">GANTI PASSWORD </h3>
        </div>-->
          <div class="panel-body">
            <form method="post" id="fm-login" accept-charset="UTF-8" role="form">
                    <fieldset>
                <div class="form-group">
                  <input id="passlama" class="form-control" placeholder="Password Lama" name="passlama" type="password">
              </div>
                <div class="form-group">
                  <input id="password" class="form-control" placeholder="Password Baru" name="password" type="password">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Ulangi Password Baru" name="password1" type="password" value="" id="password1">
              </div>
               
              <input class="btn btn-lg btn-primary btn-block" type="submit" value="GANTI PASSWORD">
            </fieldset>
              </form>
          </div>
      </div>
    <!--</div>-->
  </div>


<?php $this->load->view("gantipass_view_js") ?>
