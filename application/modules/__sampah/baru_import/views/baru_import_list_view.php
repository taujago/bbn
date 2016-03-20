<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">

<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>
<link href="<?php echo base_url("assets") ?>/css/eblokir.css" rel="stylesheet">

<style>

.search-table-outter { overflow-x: scroll; }

.tdata {
	color: #333;
  font-family: sans-serif;
  font-size: .8em;
  font-weight: 300;
  text-align: left;
  line-height: 40px;
  border-spacing: 0;
  border: 1px solid #428bca;
  width: 150%;
  margin: 5px auto;

  /*table-layout: fixed; */
  /*margin:40px auto 0px auto; */
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
  <div id="benar" class="col-lg-12" style="display:none">
            <div class="alert alert-success" role="alert" id="message2">
            	
            </div>
        </div>
    </div> 

<!--<div class="row">
<div class="col-md-12">
		<div class="panel panel-default">
            <div class="panel-heading">IMPORT DATA PENDAFTARAN DARI EXCEL</div>
            <div class="panel-body">
            -->
            	
                <form class="form-inline" id="gembreng" enctype="multipart/form-data" method="post" action="<?php echo site_url("$controller/save"); ?>">
                
        <div class="search-table-outter wrapper">
 
                  <table class="tdata" width="100%" border="0" cellpadding="3">
                  <thead>
                    <tr>
                      <th width="3%" scope="col"> <input type="checkbox" id="selall" name="selall" value="1" />  </th>
                      <th width="4%" scope="col">No.</th>
                      <th width="6%" scope="col">TANGGAL</th>
                      <th width="8%" scope="col">NO. RANGKA</th>
                      <th width="7%" scope="col">NO. MESIN</th>
                      <th width="5%" scope="col">TAHUN</th>
                      <th width="4%" scope="col">JENIS</th>
                      <th width="4%" scope="col">MERK</th>
                      <th width="5%" scope="col">WARNA</th>
                      <th width="4%" scope="col">NAMA</th>
                      <th width="5%" scope="col">NO. KTP</th>
                      <th width="6%" scope="col">ALAMAT</th>
                      <th width="4%" scope="col">NAMA</th>
                      <th width="5%" scope="col">NO.KTP</th>
                      <th width="6%" align="left" scope="col">ALAMAT</th>
                      <th width="9%" scope="col">NO. KONTRAK</th>
                      <th width="9%" scope="col">TGL. KONTRAK</th>
                      <th width="6%" scope="col">CABANG</th>
                    </tr>
                    </thead>
                    <tbody>
<?php 
$i=0;
	foreach($record as $index =>$row) : 
	$i++;
?>
                    <tr>
                    <td scope="col"><input class="ck_data" type="checkbox" name="data[]" value="<?php echo isset($index)?$index:""; ?>" /></td>
                    <td scope="col"><?php echo $i; ?></td>
                      <td scope="col"><?php echo isset($row['daft_date'])?$row['daft_date']:""; ?></td>
                      <td scope="col"><?php echo isset($row['no_rangka'])?$row['no_rangka']:""; ?></td>
                      <td scope="col"><?php echo isset($row['no_mesin'])?$row['no_mesin']:""; ?></td>
                      <td scope="col"><?php echo isset($row['tahun_kendaraan'])?$row['tahun_kendaraan']:""; ?></td>
                      <td scope="col"><?php echo isset($row['jenis_nama'])?$row['jenis_nama']:""; ?></td>
                      <td scope="col"><?php echo isset($row['merk_nama'])?$row['merk_nama']:""; ?></td>
                      <td scope="col"><?php echo isset($row['warna_nama'])?$row['warna_nama']:""; ?></td>
                      <td scope="col"><?php echo isset($row['nama_pengajuan_leasing'])?$row['nama_pengajuan_leasing']:""; ?></td>
                      <td scope="col"><?php echo isset($row['customer_ktp'])?$row['customer_ktp']:""; ?></td>
                      <td scope="col"><?php echo isset($row['alamat_pengajuan_leasing'])?$row['alamat_pengajuan_leasing']:""; ?></td>
                      <td scope="col"><?php echo isset($row['pemilik_nama'])?$row['pemilik_nama']:""; ?></td>
                      <td scope="col"><?php echo isset($row['pemilik_ktp'])?$row['pemilik_ktp']:""; ?></td>
                      <td scope="col"><?php echo isset($row['pemilik_alamat'])?$row['pemilik_alamat']:""; ?></td>
                      <td scope="col"><?php echo isset($row['kontrak_no'])?$row['kontrak_no']:""; ?></td>
                      <td scope="col"><?php echo isset($row['kontrak_date'])?$row['kontrak_date']:""; ?></td>
                      <td scope="col"><?php echo isset($row['cabang_nama'])?$row['cabang_nama']:""; ?></td>
                       
                    </tr>
    <?php endforeach; ?>
    </tbody>
                  </table>

                </div>
                  <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-saved"></i> SIMPAN  </button>        
        </form>
                <hr />
<!--            </div>
        </div>
</div>
-->
</div>







<?php $this->load->view($controller."_view_js") ?>
