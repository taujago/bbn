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
         <form id="frm_cek" name="frm_cek" method="post" action="">
             
            <div class="col-md-3">
            <input name="TGL_DAFTAR1" id="vTGL_DAFTAR1" class="form-control" 
                    type="text" placeholder="Tgl Daftar Awal" data-date-format="dd-mm-yyyy">
            <input name="is_cari" type="hidden" id="is_cari" value="tgl" />
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
         
        
        <div class="row">
         <form id="frm_bpkb" name="frm_bpkb" method="post" action="">
             
             
            <div class="col-md-6">
            <div class="form-group input-group">
                    <input name="is_cari" type="hidden" id="is_cari" value="bpkb" />
                    <input name="NO_BPKB" id="vNO_BPKB" class="form-control" 
                    type="text" placeholder="Nomor BPKB atau Nomor Rangka" data-date-format="dd-mm-yyyy">
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
            <div class="panel-heading">DATA BLOKIR</div>
            <div class="panel-body">
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




<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog" style="width:90%; min-height:600px;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
             BUKA BLOKIR KENDARAAN
            </h4>
         </div>
         <div class="modal-body">
           <!-- Add some text here --> 
           
           
 
           
           
           <div class="row">
           <div class="col-md-12">
           <div class="panel panel-default">
           <div class="panel-heading"> DETAIL KENDARAAN </div>
           <div class="panel-body">
           		<table width="100%" border="0" class="table">
                <tr>
                  <td width="18%">NO. BPKB</td>
                  <td width="30%">: <SPAN ID="NO_BPKB"></SPAN> 
                  <input type="hidden" id="DAFT_ID" name="DAFT_ID" /> </td>
                  <td width="24%">TANGGAL DAFTAR</td>
                  <td width="28%">: <SPAN ID="DAFT_DATE"></SPAN></td>
                </tr>
                <tr>
                  <td>TGL. BPKB</td>
                  <td>: <SPAN ID="TGL_BPKB"></SPAN></td>
                  <td>TANGGAL VERIFIKASI</td>
                  <td>: <SPAN ID="VERIFIKASI_DATE"></SPAN></td>
                </tr>
                <tr>
                  <td>NO. RANGKA</td>
                  <td>: <SPAN ID="NO_RANGKA"> </td>
                  <td>KET. VERIFIKASI</td>
                  <td>: <SPAN ID="VERIFIKASI_KET"></SPAN></td>
                </tr>
                <tr>
                  <td>NO. MESIN</td>
                  <td>: <SPAN ID="NO_MESIN"></SPAN></td>
                  <td>TGL. VERIFIKASI LEVEL 2</td>
                  <td>: <SPAN ID="DAFT_LEVEL2_DATE"></SPAN></td>
                </tr>
                <tr>
                  <td>NAMA PEMILIK</td>
                  <td>: <SPAN ID="NAMA_PEMILIK"></SPAN></td>
                  <td>TGL. VERIFIKASI LEVEL 3</td>
                  <td>: <SPAN ID="DAFT_LEVEL3_DATE"></SPAN></td>
                </tr>
                <tr>
                  <td>ALAMAT PEMILIK</td>
                  <td>: <SPAN ID="ALAMAT_PEMILIK"></SPAN></td>
                  <td>TGL.BLOKIR</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
           </div>
           </div>
           </div>
           </div>
           
   
<div class="row batas_pesan">
  <div id="salah_modal" class="col-lg-12" style="display:none">
            <div class="alert alert-danger" role="alert" id="salah_message">
            	
            </div>
        </div>
    </div>
    
  <div class="row batas_pesan">
  <div id="benar_modal" class="col-lg-12" style="display:none">
            <div class="alert alert-success" role="alert" id="benar_message">
            	
            </div>
        </div>
    </div> 
             
           
<div class="row">
   <div class="col-md-12">
      <div class="panel panel-default">
         <div class="panel-heading">BUKA BLOKIR</div>
           <div class="panel-body"> <center>
           	<button type="button" class="btn btn-primary" onclick="blokir();">
               BUKA BLOKIR KENDARAAN
            </button></center>
            
             
         </div>
      </div>
   </div>
    
   
</div>
   
            

                      
            
            
            
            
         	</div> <!-- end of modal body  --> 
         <div class="modal-footer">
            
            
            <button type="button" class="btn btn-default" 
               data-dismiss="modal">Close
            </button>
         </div>
      </div><!-- /.modal-content -->
</div><!-- /.modal -->





 


<?php $this->load->view($controller."_view_js"); ?>