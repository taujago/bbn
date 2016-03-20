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
            <div class="panel-heading">PENCARIAN</div>
            <div class="panel-body">
            
            	
                <form class="form-inline" id="fuckyouform">
                     
                      <div class="form-group">
                       <?php 
					   	echo form_dropdown('leasing_id',$arr_leasing,'','id="leasing_id" class="form-control" style="width:300px;"');
					   ?>  
                       
                      </div>
                      
                      <div class="form-group">
                         
                        <input type="text" class="form-control" 
                        id="tanggal_awal" placeholder="Tangal Awal" 
                        data-date-format="dd-mm-yyyy" value="<?php echo $tanggal_awal ?>" 
                        name="tanggal_awal" style="width:100px">
                      </div>
                      <div class="form-group">
                         
                        <input type="text" class="form-control" 
                        id="tanggal_akhir" placeholder="Tanggal Akhir"
                        data-date-format="dd-mm-yyyy" style="width:100px"
                        name="tanggal_akhir" value="<?php echo $tanggal_akhir ?>" >
                      </div>
                      
                      <div class="form-group">
                         
                        <input type="text" class="form-control" style="width:200px"
                        id="no_rangka" placeholder="NOMOR RANGKA / BPKB"
                        name="no_rangka">
                      </div>
                     
                      <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Query </button>
                      <a href="#" onclick="reset_cari();" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Reset Query</a>
              </form>
                
                
                
            </div>
        </div>
</div>


<?php 
$userdata = $this->session->userdata("userdata");
if($userdata['user_level'] == 3) : 
?>
<div class="col-md-4">
    <div class="panel panel-default">
            <div class="panel-heading">VERIFIKASI</div>
            <div class="panel-body">
            
              
               <a href="#" onclick='verifikasi_all();' class="btn btn-primary"><i class="glyphicon glyphicon-upload"></i> VERIVIKASI</a>
              <a href="#" onclick="validasi();" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> VALIDASI</a>
           
                
                
                
            </div>
        </div>
</div>

<?php 
endif;
?>
</div>

<form id="frm_validasi" method="post" target="<?php echo site_url("$controller/verifikasi_all") ?>">

 <table  width="100%" border="0" id="leasing" class="table table-striped 
             table-bordered table-hover dataTable no-footer" role="grid">
<thead>
	<tr style="background-color:#CCC">

        <th width="4%"><input type="checkbox" name="checkbox" id="selall" /> </th>
        <th width="4%">ID</th>
        <th width="7%">TGL. DAFT.</th>
        <th width="16%">NO. SURAT</th>
        <th width="15%">CABANG</th>  
      <th width="15%">NO. RANGKA </th>
      <th width="19%">NO. BPKB</th>    
        
      <th width="19%">NAMA PEMOHON </th>
        <th width="14%">STATUS</th>
      <th width="10%">PROSES</th>
    </tr>
	
</thead>

<tbody> 
       
 
	 
</tbody>

</table>
</form>


 


<?php $this->load->view($controller."_view_js") ?>
