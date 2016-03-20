<style type="text/css">
	
	#loading{
		margin : 100px 200px;
	}

</style>


<div id="statistik">


</div>

<div id="loading" style="display:none;">

<p align="center">
<img src="<?php echo base_url("assets/images/ajax-loader.gif"); ?>" /><br />
membaca data....
</p>
</div>


<?php
$this->load->view($controller."_view_js");
?>