<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>
<style>
#frm td {
	padding:5px;
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

<form id="frm_daftar" >

<div class="row">
<div class="col-lg-12">
  <hr />
    <table width="100%" id="frm" >

 <tr>
    <td width="20%">Kantor Cabang</td><td width="80%"> <input name="cabang_nama" type="text" class="form-control" id="cabang_nama" placeholder="Nama Kantor Cabang"   style="width:300px;" /> </td></tr>
   
  <tr>
    <td><p>Alamat</p></td>
    <td><input name="cabang_alamat" type="text" class="form-control" id="cabang_alamat" placeholder="Alamat Cabang"  style="width:500px;" /></td>
  </tr>
  <tr>
    <td><p>No. Telpon</p></td>
    <td><input name="cabang_telpon" type="text" class="form-control" id="cabang_telpon" placeholder="Nomor Telpon"  style="width:300px;"  /></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><input class="btn btn-lg btn-primary" type="submit" name="Submit" id="tombol" value="Simpan">
      <a class="btn btn-lg btn-danger" href="<?php echo site_url("baru_cabang"); ?>" >Kembali 
        <input type="hidden" name="mode" id="mode" value="<?php echo isset($mode)?$mode:""; ?>">
        <input type="hidden" name="cabang_id" id="vDAFT_ID"  value="<?php echo isset($cabang_id)?$cabang_id:""; ?>" />
        </a></td>
  </tr>
  </table>
  
       
</div>
</div>
</form>

<?php $this->load->view($controller."_form_edit_js"); ?>