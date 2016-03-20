<script>


	$(document).ready(function(){
		
		var dt = $('#tabel-bpkb').dataTable();
		 
		$("#vTGL_DAFTAR1").datepicker();
		$("#vTGL_DAFTAR2").datepicker();
		$("#HB_TGLSURATPEMOHON").datepicker();
		$("#LEVEL2_TGLSURAT").datepicker();

		//$("#vTGL_BPKB").datepicker();		
		//$("#tabel-bpkb").dataTable();
		//var tableAjax = $('#tabel-bpkb').dataTable();
		
		 
		
		/*$('#example').on('click', 'a.editor_view', function (e) {
		  e.preventDefault();
		  var rowIndex = oTable.fnGetPosition( $(this).closest('tr')[0] );
		  aData = oTable.fnGetData(rowIndex,0);
		  alert(aData);
		} );*/
		
		
		$("#frm_cek, #frm_bpkb").submit(function(){
			 
			
			$.ajax({
				url : '<?php echo site_url("$controller/get_list_daftar"); ?>',
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
		
		
		
	 
	
	
$("#frm_blokir").submit(function(){	



	$.ajax({
		url : '<?php echo site_url("$controller/simpan_blokir"); ?>',
		type : 'post',
		dataType : 'json',
		data : $(this).serialize(),
		success : function(obj) {
			if(obj.error==false){
				$("#benar_modal").show();
				$("#salah_modal").hide();
				$("#benar_message").html(obj.message);

				 $('#myModal').animate({
			        scrollTop: $("#benar_modal").offset().top
			      }, 500);
			}
			else {
				$("#benar_modal").hide();
				$("#salah_modal").show();
				$("#salah_message").html(obj.message);

				$('#myModal').animate({
			        scrollTop: $("#salah_modal").offset().top
			      }, 500);
			}
		}
	});
	return false;
});	


$("#frm_level2").submit(function(){
		verifikasi_level2();
		return false;

});

		
		
});
	
	
function detail(id)
{

	$("#salah_modal").hide();
	$("#benar_modal").hide();
	$("#dvblokir").hide();

	$.ajax({
		url : '<?php echo site_url("$controller/get_detail_pendaftaran"); ?>/'+id,
		type : 'post',
		dataType :'json',
		//data : { v_is_cari : "2", v_cari : id },
		success: function(obj){
			console.log(obj);	

			$("#myModal").modal('show');
			$("#panel_detail").show('fast');
			$("#NO_BPKB").html(obj.NO_BPKB);		
			$("#TGL_BPKB").html(obj.TGL_BPKB2);	
			$("#DAFT_DATE").html(obj.DAFT_DATE);	
			$("#NO_RANGKA").html(obj.NO_RANGKA);	 
			$("#VERIFIKASI_DATE").html(obj.VERIFIKASI_DATE2);	
			$("#NO_MESIN").html(obj.NO_MESIN);	
			$("#VERIFIKASI_KET").html(obj.VERIFIKASI_KET);	
			$("#NAMA_PEMILIK").html(obj.NAMA_PEMILIK);	
			$("#DAFT_LEVEL2_DATE").html(obj.DAFT_LEVEL2_DATE2);	
			$("#ALAMAT_PEMILIK").html(obj.ALAMAT_PEMILIK);	
			$("#DAFT_LEVEL3_DATE").html(obj.DAFT_LEVEL3_DATE3);
			//$("#DAFT_LEVEL3_DATE").html(obj.DAFT_LEVEL3_DATE32);	
			$("#DAFT_ID").val(obj.DAFT_ID);	
			$("#DAFT_ID2").val(obj.DAFT_ID);	
			$("#LEVEL2_TGLSURAT").val(obj.LEVEL2_TGLSURAT2);
			$("#LEVEL2_NOSURAT").val(obj.LEVEL2_NOSURAT);


			// $("#NO_BPKB").html(obj.NO_BPKB);	
			// $("#NO_BPKB").html(obj.NO_BPKB);	
			// $("#NO_BPKB").html(obj.NO_BPKB);	
			// $("#NO_BPKB").html(obj.NO_BPKB);	
			// $("#NO_BPKB").html(obj.NO_BPKB);	
			// $("#NO_BPKB").html(obj.NO_BPKB);	

		}
	});
	
	
	 
}	
	




function verifikasi_level2(){

	var data = $("#frm_level2").serialize();

	console.log(data);
	data += "&DAFT_ID="+$("#DAFT_ID").val();

	//data.push({ name:"DAFT_ID", value : $("#DAFT_ID").val() });
	 

	$.ajax({
		url : '<?php echo site_url("$controller/verifikasi_level2") ?>',
		data : data,
		type : 'post',
		dataType : 'json',
		success : function(obj){
			if(obj.error==false){
				$("#benar_modal").show();
				$("#salah_modal").hide();
				$("#benar_message").html(obj.message);
				$('#myModal').animate({
			        scrollTop: $("#benar_modal").offset().top
			      }, 500);
			}
			else {
				$('#myModal').animate({
			        scrollTop: $("#salah_modal").offset().top
			      }, 500);

				$("#benar_modal").hide();
				$("#salah_modal").show();
				$("#salah_message").html(obj.message);
			}
		}
	});

	$("#dvlevel2").hide();
}


function show_level2(){
	$("#dvlevel2").show();
	$("#dvblokir").hide();
	$('#myModal').animate({
			        scrollTop: $("#dvlevel2").offset().top
			      }, 500);
}

function verifikasi_level3(){
	$.ajax({
		url : '<?php echo site_url("$controller/verifikasi_level3") ?>',
		data : {DAFT_ID : $("#DAFT_ID").val() },
		type : 'post',
		dataType : 'json',
		success : function(obj){
			if(obj.error==false){
				$("#benar_modal").show();
				$("#salah_modal").hide();
				$("#benar_message").html(obj.message);
			}
			else {
				$("#benar_modal").hide();
				$("#salah_modal").show();
				$("#salah_message").html(obj.message);
			}
		}
	});
}

function blokir(){
	
	



	$.ajax({
		url : '<?php echo site_url("$controller/cek_blokir") ?>',
		data : {DAFT_ID : $("#DAFT_ID").val() },
		type : 'post',
		dataType : 'json',
		success : function(obj){
			if(obj.error==false){
				// $("#benar_modal").show();
				// $("#salah_modal").hide();
				// $("#benar_message").html(obj.message);
				$("#dvblokir").show();
				$("#benar_modal").hide();
				$("#salah_modal").hide();

				$("#dvlevel2").hide();

 				$('#myModal').animate({
			        scrollTop: $("#dvblokir").offset().top
			      }, 500);

 				

			}
			else {
				$("#benar_modal").hide();
				$("#salah_modal").show();
				$("#salah_message").html(obj.message);
			}
		}
	});

}

function cetak()
{
	window.open('<?php echo site_url("$controller/cetak") ?>/'+$("#DAFT_ID").val());
}

function cetak_level2(){
	window.open('<?php echo site_url("$controller/cetak_level2") ?>/'+$("#DAFT_ID").val());
}


functio


</script>