<?php 
$userdata = $this->session->userdata("userdata");
?>

<script type="text/javascript" src="http://malsup.github.com/jquery.form.js"></script>


<script>
 $(document).ready(function(){
 
$("#selall").click(function(){
	
	if(this.checked) { // check select status
            $('.ck_data').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            $('.ck_data').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }

 	
}
);
});
 /*
 $("#fuckyouform").submit(function(){

 	$(this).ajaxSubmit({
 		url : '<?php echo site_url("$controller/doupload"); ?>',
 		beforeSend : function(){
					 
					$("#benar").show();
					$("#message2").html('Sedang diproses. Harap menunggu...');
				},
		complete : function(){
					$("#benar").hide();
				},
		dataType : 'json',
		success : function(obj) {
				console.log(obj);
					 if(obj.error==true){
							$("#benar").hide('fast');
						 	$("#salah").show('fast');
							$("#message").html(obj.pesan);
							 
					 }
					 else {
							 
						 	$("#salah").hide('fast');
							//var newWin = 
							location.href=('<?php echo site_url("$controller/review/"); ?>');
							//newWin.location = href;

							
							 	 
						}
				}
 	}); 



	 
			
			return false;
		});
		
		
});*/





</script>