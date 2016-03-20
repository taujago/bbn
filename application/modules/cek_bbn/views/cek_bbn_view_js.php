<script type="text/javascript">
	
$(document).ready(function(){


	$("#cekbbn").submit(function(){

		 $.ajax({
		 	url : '<?php echo site_url("$this->controller/get_data_bbn") ?>',
		 	data : $(this).serialize(), 
		 	dataType : 'json',
		 	type :'post',
		 	success : function(ax) {
		 		//alert('sukses');
		 		console.log(ax);
		 	}
		 });

		 return false;
	});



});




</script>