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
    <td width="15%" align="right" valign="middle">Nama Leasing</td>
    <td width="85%"><input style="width:300px;" name="leasing_nama" type="text" class="form-control" id="leasing_nama" placeholder="Nama Leasing" 
    value="<?php echo isset($leasing_nama)?$leasing_nama:""; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Nama Singkat </td>
    <td><input style="width:300px;" name="leasing_nama_singkatan" type="text" class="form-control" id="leasing_nama_singkatan" placeholder="Nama Leasing" 
    value="<?php echo isset($leasing_nama_singkatan)?$leasing_nama_singkatan:""; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Alamat Leasing</td>
    <td><input name="leasing_alamat" type="text" class="form-control" id="leasing_alamat" placeholder="Penanggung Jawab"  value="<?php echo isset($leasing_alamat)?$leasing_alamat:""; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Penanggung Jawab</td>
    <td><input style="width:300px;" name="leasing_penanggungjawab" type="text" class="form-control" id="leasing_penanggungjawab" placeholder="Jabatan"  value="<?php echo isset($leasing_penanggungjawab)?$leasing_penanggungjawab:""; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Jabatan</td>
    <td><input style="width:300px;" name="leasing_jabatan" type="text" class="form-control" id="leasing_jabatan" placeholder="Jabatan"  value="<?php echo isset($leasing_jabatan)?$leasing_jabatan:""; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Kota</td>
    <td><input style="width:300px;" name="leasing_kota" type="text" class="form-control" id="leasing_kota" placeholder="Kota "   value="<?php echo isset($leasing_kota)?$leasing_kota:""; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Telpon</td>
    <td><input style="width:300px;" name="leasing_telp" type="text" class="form-control" id="leasing_telp" placeholder="Telpon" value="<?php echo isset($leasing_telp)?$leasing_telp:""; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Fax</td>
    <td><input style="width:300px;" name="leasing_fax" type="text" class="form-control" id="leasing_fax" placeholder="Fax" value="<?php echo isset($leasing_fax)?$leasing_fax:""; ?>" />
      <input type="hidden" name="leasing_id" id="leasing_id"  value="<?php echo isset($leasing_id)?$leasing_id:""; ?>" ></td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td><input class="btn btn-lg btn-primary" type="submit" name="Submit" id="button" value="Simpan">
      <a class="btn btn-lg btn-danger" href="<?php echo site_url("$controller"); ?>" >Kembali 
      <input type="hidden" name="mode" id="mode" value="<?php echo isset($mode)?$mode:""; ?>">
      </a></td>
  </tr>
</table>
</form>
<?php $this->load->view($controller."_view_form_js");?>