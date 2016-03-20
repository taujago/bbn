<style type="text/css">
	.col-centered{
    float: none;
    margin: 0 auto;
}

</style>
<div class="row">
<div class="col-md-5 col-centered">

<form id="cekbbn" action="<?php echo site_url("$this->controller/get_data_bbn"); ?>" method="post">
  <div class="col-lg-12">
    <div class="input-group">
      <input type="text" name="no_bpkb" id="no_bpkb" class="form-control" placeholder="Masukkan Nomor BPKB">
      <span class="input-group-btn">
        <input type="submit" class="btn btn-default"  value="Periksa" /> 
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</form>

</div>
</div>

<hr />



<?php $this->load->view($this->controller."_view_js"); ?>