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
    <td width="15%" align="right" valign="middle">POLDA</td>
    <td width="85%"><?php 
	$id_polda = isset($id_polda)?$id_polda:"";
	echo form_dropdown("id_polda",$arr_polda,$id_polda,'id="id_polda" class="form-control" style="width:300px;"'); ?> </td>
  </tr>

  <tr>
    <td width="15%" align="right" valign="middle">POLRES</td>
    <td width="85%"><?php 
   
  echo form_dropdown("id_polres",array(),'','id="id_polres" class="form-control" style="width:300px;"'); ?> </td>
  </tr>

  <tr>
    <td width="15%" align="right" valign="middle">Nama User </td>
    <td width="85%"><input style="width:300px;" name="user_name" type="text" class="form-control" id="user_name" placeholder="Username" 
    value="<?php echo isset($user_name)?$user_name:""; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Alamat </td>
    <td><input style="width:300px;" name="user_alamat" type="text" class="form-control" id="user_alamat" placeholder="Alamat "  value="<?php echo isset($user_alamat)?$user_alamat:""; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Telpon </td>
    <td><input style="width:300px;" name="user_telp" type="text" class="form-control" id="user_telp" placeholder="Telpn "   value="<?php echo isset($user_telp)?$user_telp:""; ?>" /></td>
  </tr>
  
  <tr>
    <td align="right" valign="middle">Password</td>
    <td><input  style="width:300px;" class="form-control" type="password" name="user_password" id="user_password" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Ulangi Password</td>
    <td><input  style="width:300px;" class="form-control" type="password" name="user_password2" id="user_password2" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td><input class="btn btn-lg btn-primary" type="submit" name="Submit" id="button" value="Simpan">
      <a class="btn btn-lg btn-danger" href="<?php echo site_url("$controller"); ?>" >Kembali 
      <input type="hidden" name="mode" id="mode" value="<?php echo isset($mode)?$mode:""; ?>">
      <input type="hidden" name="user_id" id="user_id"  value="<?php echo isset($user_id)?$user_id:""; ?>" />
      </a></td>
  </tr>
</table>
</form>
<?php $this->load->view($controller."_view_form_js");?>