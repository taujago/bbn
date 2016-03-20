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
            <div class="panel-heading">QUERY</div>
            <div class="panel-body">
            
            	
                <form class="form-inline" id="fuckyouform">
                     
                      <div class="form-group">
                       <?php 
					   	echo form_dropdown('bulan',$this->cm->arr_bulan,'','id="bulan" class="form-control" style="width:300px;"');
					   ?>  
                       
                      </div>
                      
                      <div class="form-group">
                         
                        <input type="text" class="form-control" 
                        id="tahun" placeholder="TAHUN" 
                         value="<?php echo date("Y"); ?>"
                        name="tahun" style="width:100px">
                      </div>
                       
                     
                      <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Query </button>
                      <a href="#" onclick="reset_cari();" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Reset Query</a>
              </form>
                
                
                
            </div>
        </div>
         
        <div class="panel panel-default"> 
         <div class="panel-heading">HASIL </div>
            <div class="panel-body">
            <div  id="hasil_panel">
            
            </div>
            
            
            </div>
          </div>
        </div>
         
        
</div>


 


</div>
 
 


 


<?php $this->load->view($controller."_view_js") ?>
