<script>


$(document).ready(function(){
	$("#frm_leasing").submit(function(){
		
		$.ajax({
			url : $("#frm_leasing").attr('action'),
			data : $(this).serialize(),
			dataType : 'json',
			type : 'post',
			success : function(obj) {
				console.log(obj.error);
				if(obj.error==false){
						//location.href=('<?php echo site_url("leasing"); ?>');
						//$("#message").html("<strong>ERROR</strong><br/>");
						$("#salah").hide();
						$("#message2").html(obj.message);
						$("#benar").hide().show('fast');
						
						 
						
						if($("#mode").val() == "I") { 
						$("#frm_leasing")[0].reset(); }
						
						//$('#myform')
					}
					else {
						$("#benar").hide();
						$("#message").html("<strong>ERROR</strong><br/>");
						$("#message").append(obj.message);
						$("#salah").hide().show('fast');
					}
			}
		});
		return false;
		/*console.log('test ');
		
		$(this).form('submit',{
				onSubmit: function(){
					return $(this).form('validate');
				},
				success : function() {
					console.log('halo');
				}
			});
		return false;*/
	});

});
 
 

</script>