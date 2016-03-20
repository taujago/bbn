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
<div class="col-md-12">
		<div class="panel panel-default">
            <div class="panel-heading">PENCARIAN</div>
            <div class="panel-body">
            
            	
                <form class="form-inline" id="fuckyouform">
                      <div class="form-group">
                         
                        <input type="text" class="form-control" 
                        id="tanggal_awal" placeholder="Tangal Awal" 
                        data-date-format="dd-mm-yyyy" 
                        name="tanggal_awal">
                      </div>
                      <div class="form-group">
                         
                        <input type="text" class="form-control" 
                        id="tanggal_akhir" placeholder="Tanggal Akhir"
                        data-date-format="dd-mm-yyyy"
                        name="tanggal_akhir">
                      </div>
                      
                      <div class="form-group">
                         
                        <input type="text" class="form-control" style="width:200px"
                        id="no_rangka" placeholder="NOMOR RANGKA / BPKB"
                        name="no_rangka">
                      </div>
                     
                      <div class="form-group">
                       <?php 
              $arr_status = $this->dm->arr_status2;
            echo form_dropdown('',$arr_status,'','id="arr_status" class="form-control"');
             ?>
                      </div>

                      <button id="btn_cari" type="button" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Query </button>
                      <a href="#" onclick="reset_cari();" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Reset Query</a>
              </form>
                
                
                
            </div>
        </div>
</div>

</div>
<table id="leasing" class="display" cellspacing="0" width="100%">
<thead>
	<tr style="background-color:#CCC">
        <th width="3%">ID</th>
        <th width="8%">TGL. DAFTAR</th>
        <th width="10%">NO. POLISI </th>
        <th width="10%">NO. BPKB </th>  
        <th width="16%">NO. RANGKA</th>    
        
        <th width="20%">NAMA PEMILIK</th>
        <th width="16%">ALAMAT PEMILIK</th>
        <th width="10%">STATUS</th>
        <th width="7%">&nbsp;</th>
    </tr>
	
</thead>
 
</table>
<?php $this->load->view("polisi_blokir_pidana_view_js") ?>
