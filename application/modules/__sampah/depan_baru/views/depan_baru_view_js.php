<script type="text/javascript">
function load_statistik(){
	setTimeout(load_statistik, 300000);
	$.ajax({
		url : '<?php echo site_url("$controller/get_statistik") ?>',
		beforeSend : function(){
			$("#statistik").hide();
			$("#loading").show();
		},
		success : function(htmldata){
			$("#loading").hide();
			$("#statistik").show();
			$("#statistik").html(htmldata);
		}

	});
}


$(document).ready(function(){
	load_statistik();


	// setTimeout(function() {
 //        load_statistik()
 //    }, 5000);


});




</script>