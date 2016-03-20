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
<form id="frm_leasing" method="post" action="<?php echo site_url("$controller/$action"); ?>">
<table width="100%" border="0" class="table">
  <tr>
    <td align="right" valign="middle">Nomor  Urut</td>
    <td><input name="no_urut" type="text" class="form-control" id="no_urut" style="width:50px;" 
    value="<?php echo isset($no_urut)?$no_urut:""; ?>" size="5" placeholder="Nomor Urut" /></td>
  </tr>
  <tr>
    <td width="15%" align="right" valign="middle">Nama Polda</td>
    <td width="85%"><input style="width:300px;" name="nama_polda" type="text" class="form-control" id="nama_polda" placeholder="Nama Polda" 
    value="<?php echo isset($nama_polda)?$nama_polda:""; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">WebService URL</td>
    <td><input style="width:500px;" name="url" type="text" class="form-control" id="url" placeholder="URL" 
    value="<?php echo isset($url)?$url:""; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Singkatan </td>
    <td><input style="width:300px;" name="nama_polda_singkatan" type="text" class="form-control" id="nama_polda_singkatan" placeholder="Alamat Polda"  value="<?php echo isset($nama_polda_singkatan)?$nama_polda_singkatan:""; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Alamat </td>
    <td><input style="width:300px;" name="alamat_polda" type="text" class="form-control" id="alamat_polda" placeholder="Alamat "   value="<?php echo isset($alamat_polda)?$alamat_polda:""; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Kota</td>
    <td><input style="width:300px;" name="kota_polda" type="text" class="form-control" id="kota_polda" placeholder="Kota" value="<?php echo isset($kota_polda)?$kota_polda:""; ?>" /></td>
  </tr>
   <tr>
    <td align="right" valign="middle">Kode Pos</td>
    <td><input style="width:300px;" name="kode_pos" type="text" class="form-control" id="kode_pos" placeholder="Kode Pos" value="<?php echo isset($kode_pos)?$kode_pos:""; ?>" /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="left" valign="middle">PENANDA TANGAN</td>
    </tr>
  <tr>
    <td align="right" valign="middle">Nama</td>
    <td><input style="width:300px;" name="ttd_nama" type="text" class="form-control" id="ttd_nama" placeholder="Nama " value="<?php echo isset($ttd_nama)?$ttd_nama:""; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Pangkat </td>
    <td><input style="width:300px;" name="ttd_pangkat" type="text" class="form-control" id="ttd_pangkat" placeholder="Pangkat" value="<?php echo isset($ttd_pangkat)?$ttd_pangkat:""; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">NRP</td>
    <td><input style="width:300px;" name="ttd_nrp" type="text" class="form-control" id="ttd_nrp" placeholder="NRP" value="<?php echo isset($ttd_nrp)?$ttd_nrp:""; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td><input class="btn btn-lg btn-primary" type="submit" name="Submit" id="button" value="Simpan">
      <a class="btn btn-lg btn-danger" href="<?php echo site_url("$controller"); ?>" >Kembali 
      <input type="hidden" name="mode" id="mode" value="<?php echo isset($mode)?$mode:""; ?>">
      <input type="hidden" name="id_polda" id="id_polda"  value="<?php echo isset($id_polda)?$id_polda:""; ?>" />
      </a></td>
  </tr>
</table>
</form>
<?php $this->load->view($controller."_view_form_js");?>