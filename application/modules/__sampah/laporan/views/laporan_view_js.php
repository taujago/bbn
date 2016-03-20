<script>


	$(document).ready(function(){
		
		var dt = $('#tabel-bpkb').dataTable();
		 
		$("#vTGL_DAFTAR1").datepicker();
		$("#vTGL_DAFTAR2").datepicker();
	 
		 
		
		
		$("#frm_cek").submit(function(){
			 
			
			$.ajax({
				url : $(this).attr('action'),
				dataType:'json',
				beforeSend : function(){
					 
					$("#benar").show();
					$("#message2").html('Sedang diproses. Harap menunggu...');
				},
				complete : function(){
					$("#benar").hide();
				},
				type : 'post',
				data : $(this).serialize(),
				success : function(obj) {
					 if(obj.error==true){
							$("#benar").hide('fast');
						 	$("#salah").show('fast');
							$("#message").html(obj.message);
							$("#tabel-bpkb tbody").hide();
					 }
					 else {
							$("#tabel-bpkb tbody").show();
						 	$("#salah").hide('fast');
							
							dt.fnClearTable();
						    dt.fnAddData(obj.message);
						   	dt.fnDraw(); 		 
						}
				}
			});
			
			return false;
		});
		
	 
		
		
});
	
	 
</script>