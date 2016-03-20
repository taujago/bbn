<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>
<style>
#frm td {
	padding:5px;
}

.red {
	color:red;
	font-weight:bold;
}

.green {
	color : green;
	font-weight:bold;
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
  
  
  <p>
    <?php $arr_status = $this->dm->arr_status; 
  
  $class = ($status=="0")?"red":"green";
  
  ?>
  </p>
  <p> <a class="btn btn-lg btn-danger" href="<?php echo site_url("polres_blokir_pidana"); ?>" >Kembali </a></p>
 <form id="frm_daftar" >
    
  <div class="row">
<div class="col-lg-12">
  <hr />
  <table width="100%" id="frm" >
  <tr>
    <td colspan="2"><strong>DATA  KENDARAAN </strong></td>
    </tr>
  <tr>
    <td>Status </td>
    <td>: <span class="<?php echo $class; ?>"> <?php echo $arr_status[$status]; ?> </span></td>
  </tr>
  <tr><td width="20%">Tanggal  </td>
  <td width="80%">: <?php echo flipdate($tanggal); ?></td></tr>
   
  <tr>
    <td><p>No Rangka</p></td>
    <td>: <?php echo $no_rangka; ?></td>
  </tr>
  <tr>
    <td>No Mesin</td>
    <td>: <?php echo $no_mesin; ?></td>
  </tr>
  <tr>
    <td>No. Polisi</td>
    <td>: <?php echo $no_polisi; ?></td>
  </tr>
  <tr>
    <td>No. BPKB</td>
    <td>: <?php echo $no_bpkb; ?></td>
  </tr>
  <tr>
    <td>No. Reg BPKB</td>
    <td>: <?php echo $no_reg_bpkb; ?></td>
  </tr>
  
  <tr>
    <td colspan="2"><strong>DATA PEMILIK KENDARAAN
      </strong></td>
    </tr>
  <tr>
    <td>Nama Pemilik</td>
    <td>: <?php echo $pemilik_nama; ?></td>
  </tr>
 <!-- <tr>
    <td>No. KTP Pemilik</td>
    <td><input name="pemilik_ktp" type="text" class="form-control" id="pemilik_ktp" placeholder="No. KTP Pemilik" /></td>
  </tr>-->
  <tr>
    <td>Alamat Pemilik</td>
    <td>: <?php echo $pemilik_alamat; ?></td>
  </tr>
  <!-- <tr>
   <td>Kelurahan</td>
    <td><input name="pemilik_kelurahan" type="text" class="form-control" id="pemilik_kelurahan" placeholder="Kelurahan Pemilik" /></td>
  </tr>
  <tr>
    <td>Kecamatan</td>
    <td><input name="pemilik_kecamatan" type="text" class="form-control" id="pemilik_kecamatan" placeholder="Kecamatan Pemilik" /></td>
  </tr>
  <tr>
    <td>Kab./Kota</td>
    <td><input name="pemilik_kab" type="text" class="form-control" id="pemilik_kab" placeholder="Kab/Kota Pemilik" /></td>
  </tr>
  <tr>
    <td>Provinsi</td>
    <td><input name="pemilik_prov" type="text" class="form-control" id="pemilik_prov" placeholder="Provinsi Pemilik" /></td>
  </tr>-->
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">Keterangan</td>
    <td>: <?php echo $keterangan; ?></td>
  </tr>
  <tr>
    <td valign="top">Diproses pada </td>
    <td>: <?php echo flipdate($approved_date); ?></td>
  </tr>
  </table>
  
       
</div>
</div>
</form>