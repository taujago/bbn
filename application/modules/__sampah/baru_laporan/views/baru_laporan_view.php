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

#leasing{
  width: 120%;
}

th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
</style>

<!--<a href="<?php echo site_url("$controller/baru"); ?>" class="btn btn-success">Tambah Baru </a><br><br>-->


<div class="row">
<div class="col-md-12">
		<div class="panel panel-default">
            <div class="panel-heading">PENCARIAN</div>
            <div class="panel-body">
            
            	
                <form class="form-inline" id="fuckyouform">
                      <div class="form-group">
                         
                        <input type="text" class="form-control" 
                        id="tanggal_awal" placeholder="Tgl. Awal" 
                        data-date-format="dd-mm-yyyy" 
                        style="width:100px;"
                        name="tanggal_awal">
                      </div>
                      <div class="form-group">
                         
                        <input type="text" class="form-control" 
                        id="tanggal_akhir" placeholder="Tgl. Akhir"
                        data-date-format="dd-mm-yyyy"
                         style="width:100px;"
                        name="tanggal_akhir">
                      </div>
                      
                      <div class="form-group">
                         
                       <?php echo form_dropdown("id_polda",$arr_polda,'',
					   'id="id_polda" class="form-control" '); ?>  
                      </div>
                      
                      <div class="form-group">
                         
                       <?php echo form_dropdown("jenis_permohonan",$arr_permohonan,'',
					   'id="jenis_permohonan" class="form-control" '); ?>  
                      </div>

                      <div class="form-group">
                       <?php 
                        $arr_status = $this->cm->arr_status2;
                      echo form_dropdown('status',$arr_status,'','id="arr_status" class="form-control"');
                       ?>
                      </div>
                     
                      <div class="row" style="margin-top:10px;">
                      <div class="col-md-12">
                      <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Query </button>
                      <a href="#" onclick="reset_cari();" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Reset Query</a>
                      <a class="btn btn-success" onclick="cetak()"><i class="glyphicon glyphicon-print"></i> Cetak </a>
                      <a class="btn btn-success" onclick="excel()"><i class="glyphicon glyphicon-print"></i> Excel </a>
                      </div>
                      </div>
              </form>
                
                
                
            </div>
        </div>
</div>

</div>
<table id="leasing" class="display" cellspacing="0" width="100%">
<thead>
	<tr style="background-color:#CCC">
        <th width="3%">NO.</th>
        <th width="9%">TGL. DAFTAR</th>
        <th width="9%">CABANG</th>
        <th width="9%">NO. POLISI</th>
        <th width="13%">NO. RANGKA</th>  
        <th width="8%">NOMOR BPKB</th>    
        
        <th width="11%">NAMA PEMOHON </th>
        <th width="15%">NOMOR BLOKIR</th>
        <th width="10%">JENIS</th>
        <th width="9%"> MERK</th>
        <th width="9%">STATUS</th>
        
    </tr>
	
</thead>

<tbody>
 
	 
</tbody>

</table>
<?php $this->load->view("baru_laporan_view_js") ?>
