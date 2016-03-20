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
    <td width="15%" align="right" valign="middle">Nama User </td>
    <td width="85%"><input style="width:300px;" name="user_name" type="text" class="form-control" id="user_name" placeholder="Username" 
    value="<?php echo isset($user_name)?$user_name:""; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Alamat </td>
    <td><input style="width:300px;" name="user_alamat" type="text" class="form-control" id="user_alamat" placeholder="Alamat User"  value="<?php echo isset($user_alamat)?$user_alamat:""; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Telpon </td>
    <td><input style="width:300px;" name="user_telp" type="text" class="form-control" id="user_telp" placeholder="Telpon "   value="<?php echo isset($user_telp)?$user_telp:""; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Nama Leasing</td>
    <td><?php 
		$leasing_id = isset($leasing_id)?$leasing_id:"";
		echo form_dropdown("leasing_id",$arr_leasing,$leasing_id,'class="form-control" style="width:400px" id="leasing_id"');
	?></td>
  </tr>
  <tr>
    <td align="right" valign="middle">User Level</td>
    <td><?php 
		$user_level = isset($user_level)?$user_level:"";
		echo form_dropdown("user_level",$arr_level,$user_level,'class="form-control" style="width:400px" id="user_level"');
	?></td>
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