<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">

<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>
<style>


.datepicker{z-index:1151 !important;}

#frm td {
	padding:5px;
}
</style>

<div class="row">
	<div class="col-md-12">
    	<div class="panel panel-default">
            <div class="panel-heading">PENCARIAN</div>
            <div class="panel-body">
            
            
     <div class="row">
         <form id="frm_cek" name="frm_cek" method="post" action="<?php echo site_url("laporan/$method"); ?>">
             
             <?php if($USER_LEVEL=="0" or $USER_LEVEL=="99") :   ?>
              <div class="col-md-6">
            
                <?php 
					echo form_dropdown("LEASING_ID",$arr_leasing,'',"id='LEASING_ID' class='form-control'");
				?>   
                 
            </div>
             
             <?php endif; ?>
             
            <div class="col-md-3">
            <input name="TGL_DAFTAR1" id="vTGL_DAFTAR1" class="form-control" 
                    type="text" placeholder="Tgl Daftar Awal" data-date-format="dd-mm-yyyy">
             
            </div>
            <div class="col-md-3">
            <div class="form-group input-group">
                    
                    <input name="TGL_DAFTAR2" id="vTGL_DAFTAR2" class="form-control" 
                    type="text" placeholder="Tgl Daftar Akhir" data-date-format="dd-mm-yyyy">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" value="CEK DATA" >
                    <i class="fa fa-search"></i>
                    </button>
                    </span>
                </div> 
            </div>
         
       
        
         
        
       
         
             
             
           
         
        </form>
        </div> 
        
        
            </div>
        </div>
    </div>
</div>


 


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
<!-- lets begin table section  -->

<div class="row">
	<div class="col-md-12">
    	<div class="panel panel-default">
            <div class="panel-heading">DATA PENDAFTARAN</div>
            <div class="panel-body">
            
            <a href="#" onclick="cetak();" class="btn btn-primary">CETAK </a><br /><br />
            
            
             <table  width="100%" border="0" id="tabel-bpkb" class="table table-striped 
             table-bordered table-hover dataTable no-footer" role="grid">
              <thead>
              <tr>
                <th width="4%" scope="col">ID </th>
                <th width="20%" scope="col">NO. BPKB</th>
                <th width="13%" scope="col">NO. RANGKA</th>
                <th width="15%" scope="col">NO. MESIN</th>
                <th width="15%" scope="col">NAMA PEMILIK</th>
                <th width="18%" scope="col">TGL. DAFTAR</th>
                <th width="15%" scope="col">TGL. VERIFIKASI</th>
               <!-- <th width="28%" scope="col">KET. VERIFIKASI</th>
                <th width="28%" scope="col">TGL LV2</th>
                <th width="28%" scope="col">TGL. LV3</th>-->
                </tr>
              </thead>
              <tbody>
              
              </tbody>
            </table>
            </div>
        </div>
    </div>
</div>



<script language="javascript">
function cetak(){
	data = $("#frm_cek").serialize();
	window.open('<?php echo site_url("laporan/daftar_cetak"); ?>/?'+data);
}
</script> 




 


<?php $this->load->view("laporan_view_js"); ?>