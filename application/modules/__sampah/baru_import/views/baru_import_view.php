<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">

<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>
<link href="<?php echo base_url("assets") ?>/css/eblokir.css" rel="stylesheet">

<style>

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
<div class="col-md-12">
		<div class="panel panel-default">
            <div class="panel-heading">IMPORT DATA PENDAFTARAN DARI EXCEL</div>
            <div class="panel-body">
            
            	
                <form class="form-inline" id="fuckyouform" enctype="multipart/form-data" method="post" action="<?php echo site_url("$controller/doupload"); ?>">
                      
                   
<div class="form-group">
                         
                        <input type="file"  style="width:600px; height:30px;"
                        id="xlsfile" placeholder="FILE EXCEL"
                        name="xlsfile">
                      </div>
                     
                      <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-import"></i> IMPORT </button>
                      
              </form>
                <hr />
            </div>
        </div>
</div>

</div>







<?php $this->load->view($controller."_view_js") ?>
