 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/jseasyui/themes/default/easyui.css">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/jseasyui/themes/icon.css">
 
<script src="<?php echo base_url("assets") ?>/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/jseasyui/jquery.easyui.min.js"></script>

 
 <table id="tt" class="easyui-datagrid" style="width:1180px;height:600px"
			url="<?php echo site_url("$controller/get_data")  ?>"
			title="<?php echo $title; ?>" toolbar="#tb"  pageSize="50"
			rownumbers="false" pagination="true">
		<thead>
       <!-- <thead frozen="true"  >-->
			<tr>
				<th field="ck" checkbox="true"></th>
				<th field="kode" width="120" sortable="true"><strong>Kode Rekening</strong></th>
				<th field="nama" width="500" sortable="true"><strong>Uraian </strong></th>
                
                 
         <!--    </tr>
             </thead>
             <thead>
             <tr>-->                
				<th field="total" width="150" sortable="true" align="right"><strong>Jumlah (Rp) </strong></th>
                <th field="pendapatan" width="300" sortable="true"><strong>Sumber Dana </strong></th>
 				<!-- <th field="t1" width="100" sortable="true" align="right"><strong>TW I  (Rp) </strong></th>
                 <th field="t2" width="100" sortable="true" align="right"><strong>TW II  (Rp) </strong></th>
                 <th field="t3" width="100" sortable="true" align="right"><strong>TW III  (Rp) </strong></th>
                 <th field="t4" width="100" sortable="true" align="right"><strong>TW IV  (Rp) </strong></th>-->
 		 
			 <!-- FormatNumberBy3(angsuran,',','.');	 -->
			</tr>
		</thead>
	</table>
	 
<div id="tb"  style="padding:5px;height:auto">
	
	<div >		
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="baru()" >Tambah Baru</a>	
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="edit()" >Edit</a>	
<!--        <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="penarikan()" >Rencana Penarikan</a>
-->		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="hapus()" >Hapus</a>		 
		 
		<br />
		 
	</div>
	<!-- filter section -->

	
	 <div>
		<fieldset style="border-radius: 5px; border:solid 1px #ccc; margin: 2px 0px;" > <legend>Pencarian </legend>
		 
		 
		 
		<input  size="30" type="text" name="search_uraian" placeholder="Cari kode rekening atau Uraian " id="search_uraian" />
		 

		<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="cari()">Cari</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-reset" onclick="reset_cari()">Reset Pencarian</a>
		
		</fieldset>	
		
	</div>
	 
	 
	 
		
</div>
  
<?php
//$this->load->view($controller."_penarikan_form"); 
$this->load->view($controller."_js"); 
?>
