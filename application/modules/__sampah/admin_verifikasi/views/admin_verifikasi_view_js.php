<?php 
$userdata = $this->session->userdata("userdata");
?>
<script>
var daft_id = false;



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

	
});


		
			$("#tanggal_awal").datepicker();
			$("#tanggal_akhir").datepicker();





		 var dt = $("#leasing").DataTable(
		 	{
		 		// "order": [[ 0, "desc" ]],
		 		// "iDisplayLength": 50,
				"columnDefs": [ { "targets": 0, "orderable": false } ],
				"processing": true,
		        "serverSide": true,
		        "ajax": '<?php echo site_url("admin_verifikasi/get_data") ?>'
		 	});

		 
		 $("#leasing_filter").css("display","none");  
			$("#btn_cari").click(function(){
				//alert('oooo.. somebody click me');
				 var i = 5;
				 var v =$("#no_rangka").val();
				 var tanggal_awal = $("#tanggal_awal").val();
				 var tanggal_akhir = $("#tanggal_akhir").val();
				 
			
				 console.log(i);
				 console.log(v);
				 var status = $("#arr_status").val();

				 dt.columns(i).search(v)
				 .column(4).search(tanggal_awal)
				 .column(6).search(tanggal_akhir)
				 .column(7).search(status)
				 .draw();
			});


		 
		

var v_status = '<?php echo $status ?>';


if(v_status != "0" ) {
	// alert('test');

	$("#no_rangka").val('');
	$("#tanggal_awal").val('');
	$("#tanggal_akhir").val('');
	$("#arr_status").val(v_status).attr('selected','selected');
	// $("#btn_cari").click();


				 var i = 5;
				 var v =$("#no_rangka").val();
				 var tanggal_awal = $("#tanggal_awal").val();
				 var tanggal_akhir = $("#tanggal_akhir").val();
				 
			
				 console.log(i);
				 console.log(v);
				 var status = $("#arr_status").val();

				 dt.columns(i).search(v)
				 .column(7).search(v_status)
				 .draw();
				 // .column(4).search(tanggal_awal)
				 // .column(6).search(tanggal_akhir)
				
}


		
		
		
		// 	$("#fuckyouform").submit(function(){
			 


			
		// 	$.ajax({
		// 		url : '<?php echo site_url("$controller/get_list_daftar"); ?>',
		// 		dataType:'json',
		// 		beforeSend : function(){
					 
		// 			$("#benar").show();
		// 			$("#message2").html('Sedang diproses. Harap menunggu...');
		// 		},
		// 		complete : function(){
		// 			$("#benar").hide();
		// 		},
		// 		type : 'post',
		// 		data : $(this).serialize(),
		// 		success : function(obj) {
		// 			 if(obj.error==true){
		// 					$("#benar").hide('fast');
		// 				 	$("#salah").show('fast');
		// 					$("#message").html(obj.message);
		// 					$("#tabel-bpkb tbody").hide();
		// 					dt.fnClearTable();
		// 			 }
		// 			 else {
		// 					$("#leasing tbody").show();
		// 				 	$("#salah").hide('fast');
							
		// 					dt.fnClearTable();
		// 				    dt.fnAddData(obj.message);
		// 				   	dt.fnDraw(); 		 
		// 				}
		// 		}
		// 	});
			
		// 	return false;
		// });
		
		
});




function cekall(){
		$('.ck_data').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
}

function uncekall(){
 		$('.ck_data').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class                       
            }); 
}


function verifikasi_all(){


					 

	$.ajax({
		url : $("#frm_validasi").attr('target'),
		type : 'post',
		beforeSend : function(){
					$("#salah").hide(); 
					$("#benar").show();
					$("#message2").html('Sedang melakukan verifikasi. Harap menunggu...');
				},
		dataType : 'json',
		data : $("#frm_validasi").serialize(),
		success : function(obj){
			console.log(obj);
			if(obj.error == true) {
				$("#benar").hide('fast');
			 	$("#salah").show('fast');
				$("#message").html(obj.message);
			}
			else {
				$("#benar").show('fast');
			 	$("#salah").hide('fast');
				$("#message2").html(obj.message);
				//location.href='<?php echo site_url("$controller") ?>';
			}

		}
	});

}




function validasi_all(){


					 

	$.ajax({
		url : "<?php echo site_url("baru_verifikasi/cek_validasi_new"); ?>",
		type : 'post',
		beforeSend : function(){
					$("#salah").hide(); 
					$("#benar").show();
					$("#message2").html('Sedang melakukan validasi. Harap menunggu...');
				},
		dataType : 'json',
		data : $("#frm_validasi").serialize(),
		success : function(obj){
			console.log(obj);
			if(obj.error == true) {
				$("#benar").hide('fast');
			 	$("#salah").show('fast');
				$("#message").html(obj.message);
			}
			else {
				$("#benar").show('fast');
			 	$("#salah").hide('fast');
				$("#message2").html(obj.message);
				//location.href='<?php echo site_url("$controller") ?>';
			}

		}
	});

}

function validasi(){
	$.ajax({
		url : '<?php echo site_url("depan_baru/cekvalidasi") ?>',
		beforeSend : function(){
					 
					$("#benar").show();
					$("#message2").html('Sedang diproses. Harap menunggu...');
				},
		complete : function(){
			$("#message2").html('Proses validasi selesai. silahkan cek kembali dengan merefresh halaman ini.');
		}

	});
}


function show_modal(id){
	$("#myModal").modal('show');
	$.ajax({
		url : '<?php echo site_url("baru_verifikasi/get_pendaftaran_detail") ?>/'+id,
		dataType : 'json',
		success : function(hasil) {
			daft_id = hasil.daft_id;
			 $("#NO_SURAT").html(hasil.no_surat);
			 $("#DAFT_DATE").html(hasil.daft_date);
			 $("#STATUS").html(hasil.status2);
			 $("#NO_RANGKA").html(hasil.no_rangka);
			 $("#NO_MESIN").html(hasil.no_mesin);

			 $("#TAHUN_KENDARAAN").html(hasil.tahun_kendaraan);
			 $("#JENIS_NAMA").html(hasil.jenis_nama);
			 $("#MERK_NAMA").html(hasil.merk_nama);
			 $("#WARNA_NAMA").html(hasil.warna_nama);
			 $("#NAMA_PENGAJUAN_LEASING").html(hasil.nama_pengajuan_leasing);
			 $("#ALAMAT_PENGAJUAN_LEASING").html(hasil.alamat_pengajuan_leasing);
			 
			 
			 // kalo level 2, 
			 if( parseFloat(<?php echo $userdata["user_level"] ?>) == 2 )
			 {
			 	$("#oke3").hide();
			 	if(parseFloat(hasil.status) < 2 )
			 	{
			 		$("#oke").show();
			 		$("#batal").hide();
			 	}
			 	else if(parseFloat(hasil.status)==2)
			 	{
			 		$("#oke").hide();
			 		$("#batal").show();
			 	}
			 	else {
			 		$("#oke").hide();
			 		$("#batal").hide();
			 	}

			 } 
			 else {
			 	// level 3 
			 	$("#oke").hide();
			 	$("#batal").hide();
			 	if (parseFloat(hasil.status) == 2) {
			 		$("#oke3").show();
					$("#batal").hide();
			 	}
			 	else {
			 		$("#oke3").hide();
			 	}
			 }


			  

		}

	});

}



function verifikasi(){
	//alert(DAFT_ID);
	a = confirm('ANDA AKAN MELAKUKAN VERIFIKASI. ANDA YAKIN ?  ? ');
	if(a){

		$.ajax({
			url:'<?php echo site_url("baru_verifikasi/verifikasi") ?>/'+daft_id,
			dataType : 'json',
			success : function(hasil) {
				if(hasil.error == false) {
					alert(hasil.message);
					$("#myModal").modal('hide');
					location.href=('<?php echo site_url("baru_verifikasi") ?>');
				}
				else {
					alert(hasil.message);
				}
			}
		});
	}

}


function verifikasi3(){
	//alert(DAFT_ID);
	a = confirm('ANDA AKAN MELAKUKAN VERIFIKASI. ANDA YAKIN ?  ? ');
	if(a){

		$.ajax({
			url:'<?php echo site_url("baru_verifikasi/verifikasi3") ?>/'+daft_id,
			dataType : 'json',
			success : function(hasil) {
				if(hasil.error == false) {
					alert(hasil.message);
					$("#myModal").modal('hide');
					location.href=('<?php echo site_url("baru_verifikasi") ?>');
				}
				else {
					alert(hasil.message);
				}
			}
		});
	}

}


function batal(){
	a = confirm('ANDA AKAN MEMBATALKAN VERIFIKASI. ANDA YAKIN ?  ? ');
	if(a){

		$.ajax({
			url:'<?php echo site_url("baru_verifikasi/batal") ?>/'+daft_id,
			dataType : 'json',
			success : function(hasil) {
				if(hasil.error == false) {
					alert(hasil.message);
					$("#myModal").modal('hide');
					location.href=('<?php echo site_url("baru_verifikasi") ?>');
				}
				else {
					alert(hasil.message);
				}
			}
		});
	}

}


function edit(id){
	$.ajax({
		url : '<?php echo site_url("$controller/get_pendaftaran_detail") ?>/'+id,
		dataType : 'json',
		success : function(obj) {
			console.log(obj.verifikasi_by);
			
			if(obj.verifikasi_by != null) {
				alert('record sudah diverifikasi. tidak dapat diedit');
				return false;
			}
			else {
				location.href=('<?php echo site_url("$controller/edit/");?>/'+id);
			}
		}
			
	});
	 
}



function hapus(id) {
	a = confirm('Yakin akan menghapus data ini ? ');
	if(a){
		
		
			$.ajax({
		url : '<?php echo site_url("$controller/get_pendaftaran_detail") ?>/'+id,
		dataType : 'json',
		success : function(obj) {
			 
			console.log(obj.VERIFIKASI_BY);
			if(obj.STATUS != "0") {
				alert('record sudah diverifikasi. tidak dapat dihapus');
				return false;
			}
			else {
				 
				// return false;
					 $.ajax({
					url : '<?php echo site_url("$controller/hapus") ?>/'+id,
					dataType : 'json',
					success : function(obj) {
						if(obj.error==false) { 
						alert(obj.message);
						location.href=('<?php echo site_url("baru_daftar"); ?>');
						}
						else {
							alert(obj.message);
						}
					}
				});
				 
				 
			}
		}
			
	});
	 
			
		///// 	
			
		////// 
	}
	else {
		return false;
	}
}


function cetak(daft_id){

	$.ajax({
		url : '<?php echo site_url("$controller/cek_status") ?>/'+daft_id,
		dataType:'json',
		success : function (hasil) {
			if(hasil.error == true) {
				alert('Dokumen tidak dapat dicetak');
			}
			else {
				var newWin = window.open('<?php echo site_url("$controller/cetak_berkas/"); ?>/'+daft_id);
				newWin.location = href;
				
			}
		}
	});

	
}




function reset_cari(){
	$("#no_rangka").val('');
	$("#tanggal_awal").val('');
	$("#tanggal_akhir").val('');
	$("#arr_status").val('0').attr('selected','selected');
	$("#btn_cari").click(); 
}



</script>