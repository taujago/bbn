<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">

<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>
<link href="<?php echo base_url("assets") ?>/css/eblokir.css" rel="stylesheet">

<style>
.tdata {
	color: #333;
  font-family: sans-serif;
  font-size: .9em;
  font-weight: 300;
  text-align: left;
  line-height: 40px;
  border-spacing: 0;
  border: 1px solid #428bca;
  width: 100%;
  margin: 5px auto;
}


thead tr:first-child {
  background: #428bca;
  color: #fff;
  border: none;
}

th {font-weight: bold;}
th:first-child, td:first-child {padding: 0 15px 0 20px;}

thead tr:last-child th {border-bottom: 2px solid #ddd;}

tbody tr:hover {background-color: #f0fbff;}
tbody tr:last-child td {border: none;}
tbody td {border-bottom: 1px solid #ddd;}

td:last-child {
  /*text-align: right;*/
  padding-right: 10px;
}

.button {
  color: #696969;
  padding-right: 5px;
  cursor: pointer;
}

.alterar:hover {
  color: #428bca;
}

.excluir:hover {
  color: #dc2a2a;
}
</style>


<div class="row">
  <div id="salah" class="col-lg-12" style="display:none">
            <div class="alert alert-danger" role="alert" id="message">
            	
            </div>
        </div>
    </div>
    
  <div class="row">
  <div id="benar" class="col-lg-12" >
            <div class="alert alert-success" role="alert" id="message2">
            	Proses import selesai <br />
                Jumlah record yang berhasil diimport : <?php echo $berhasil; ?> <br />
                Jumlah record yang gagal diimport : <?php echo $gagal; ?> <br /><hr />
                <a href="<?php echo site_url("baru_daftar"); ?>" class="btn btn-primary">
<i class="glyphicon glyphicon-arrow-left"></i>
Kembali </a>
            </div>
        </div>
    </div> 

	


 
<hr />

</div>







<?php $this->load->view($controller."_view_js") ?>
