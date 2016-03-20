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
    <td width="15%" align="right" valign="middle">Nama Polda</td>
    <td width="85%"><?php 
		$id_polda = isset($id_polda)?$id_polda:"";
		echo form_dropdown("id_polda",$arr_polda,$id_polda,'class="form-control" style="width:400px" id="id_polda"');
	?></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Leasing  </td>
    <td><?php 
		$leasing_id = isset($leasing_id)?$leasing_id:"";
		echo form_dropdown("leasing_id",$arr_leasing,$leasing_id,'class="form-control" style="width:400px" id="leasing_id"');
	?></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Username  </td>
    <td><input style="width:300px;" name="service_user" type="text" class="form-control" id="service_user" placeholder="Alamat "   value="<?php echo isset($alamat_polda)?$alamat_polda:""; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Password </td>
    <td><input style="width:300px;" name="service_pass" type="text" class="form-control" id="service_pass" placeholder="Alamat "   value="<?php echo isset($alamat_polda)?$alamat_polda:""; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Salt</td>
    <td><input style="width:300px;" name="service_salt" type="text" class="form-control" id="service_salt" placeholder="Alamat "   value="<?php echo isset($alamat_polda)?$alamat_polda:""; ?>" /></td>
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