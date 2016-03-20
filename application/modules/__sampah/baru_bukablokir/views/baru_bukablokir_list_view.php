<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">

<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>
<link href="<?php echo base_url("assets") ?>/css/eblokir.css" rel="stylesheet">

<a href="<?php echo site_url("$controller/"); ?>" class="btn btn-success">
<i class="glyphicon glyphicon-plus"></i>
Buka Blokir Kendaraan </a> <br /><br /><br />


 <table  width="100%" border="0" id="leasing" class="table table-striped 
             table-bordered table-hover dataTable no-footer" role="grid">
<thead>
	<tr style="background-color:#CCC">
	  <th width="6%">NO.</th>

        <th width="9%">NO RANGKA</th>
        <th width="14%">NO. BUKA BLOKIR</th>
        <th width="13%">TANGGAL BUKA BLOKIR</th>  
      <th width="13%">NO. POLISI</th>    
        
      <th width="16%">NO. KONTRAK</th>
        <th width="12%">NO BPKB</th>
        <th width="8%">TGL BPKB</th>
      <th width="9%">&nbsp;</th>
    </tr>
	
</thead>
</table>

<?php 
$this->load->view("baru_bukablokir_list_view_js");

?>