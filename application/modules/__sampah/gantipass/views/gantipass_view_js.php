
<script type="text/javascript" src="<?php echo base_url("assets/js/md5.js") ?>">
	
</script>
<script>
$(document).ready(function(){
	var dt = $("#leasing").dataTable();

	 
	$("#fm-login").submit(function(){
		console.log($("#password").val());
		console.log($("#password1").val());
		v1 = $.md5($("#passlama").val());
		v2 = $.md5($("#password").val());
		v3 = $.md5($("#password1").val());
			
			$.ajax({
				url : '<?php echo site_url("$controller/ganti"); ?>',
				dataType:'json',
				beforeSend : function(){
					 
					$("#benar").show();
					$("#message2").html('Sedang diproses. Harap menunggu...');
				},
				complete : function(){
					// $("#benar").hide();
				},
				type : 'post',
				data : { passlama:v1, password:v2, password1 : v3 }, //$(this).serialize(), 
				success : function(obj) {
					 if(obj.error==true){
							$("#benar").hide('slow');
						 	$("#salah").show('slow');
							$("#message").html(obj.message);
							 
					 }
					 else {
							 
						 	$("#salah").hide('slow');
							$("#benar").show('slow');
							$("#message2").html(obj.message);
							 
						}
				}
			});
			
			return false;
		});


});



 

</script>