<script>


$(document).ready(function(){
	$("#frm_leasing").submit(function(){
		
		$.ajax({
			url : $("#frm_leasing").attr('action'),
			data : $(this).serialize(),
			dataType : 'json',
			type : 'post',
			success : function(obj) {
				if(obj.error==false){
						 
						$("#salah").hide();
						$("#message2").html(obj.message);
						$("#benar").hide().show('fast');
						
						$("#vUSER_NAME").focus();
						
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
		 
	});

});
 
 

</script>