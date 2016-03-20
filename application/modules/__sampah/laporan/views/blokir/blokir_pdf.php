<style>
* {
	font-family:"Times New Roman", Times, serif;
	
}
table {
	font-size:10px;
}
th {
	font-weight:bold;
	padding:5px 0px;
}

 td {
	padding:5px 0px;
}

</style>
<p align="center">
<h3>LAPORAN  BLOKIR BPKB KENDARAAN
</h3>
<h4>PERIODE : <?php echo $TGL_DAFTAR1 . " s/d ". $TGL_DAFTAR2 ?></h4>
<h4>LEASING : <?php echo $leasing['LEASING_NAMA']; ?> </h4>
</p>
<table width="100%" border="1">
<thead>
  <tr>
    <th width="5%" align="center" scope="col"><br>
      <br>
      No.</th>
    <th width="9%" align="center" scope="col"><br>
      <br>
      NO. BPKB</th>
    <th width="14%" align="center" scope="col"><br>
      <br>
      NO. RANGKA</th>
    <th width="10%" align="center" scope="col"><br>
      <br>
      NO. MESIN</th>
    <th width="8%" align="center" scope="col"><br>
      
      NO. POLISI</th>
    <th width="12%" align="center" scope="col"><br>
      <br>
      NAMA PEMILIK</th>
    <th width="8%" align="center" scope="col">TGL. DAFTAR</th>
    <th width="9%" align="center" scope="col">TGL. VERIFIKASI</th>
    <th width="9%" align="center" scope="col">TGL. VERIFIKASI LV. 2</th>
    <th width="9%" align="center" scope="col">TGL. VERIFIKASI LV. 3</th>
    <th width="8%" align="center" scope="col">TGL. BLOKIR</th>
  </tr>
  </thead>
  <TBODY>
  <?php 
  $x=0;
  foreach($record->result() as $row) : 
  $x++;
  ?>
  <tr>
    <td width="5%"><?php echo $x; ?></td>
    <td width="9%" ><?php echo $row->NO_BPKB; ?></td>
    <td width="14%" ><?php echo $row->NO_RANGKA; ?></td>
    <td  width="10%" ><?php echo $row->NO_MESIN; ?></td>
    <td  width="8%" ><?php echo $row->NO_POLISI; ?></td>
    <td  width="12%"><?php echo $row->NAMA_PEMILIK; ?></td>
    <td  width="8%"><?php echo $row->DAFT_DATE; ?></td>
    <td  width="9%"><?php echo $row->VERIFIKASI_DATE; ?></td>
    <td  width="9%"><?php echo $row->DAFT_LEVEL2_DATE; ?></td>
    <td  width="9%"><?php echo $row->DAFT_LEVEL3_DATE; ?></td>
    <td  width="8%"><?php echo $row->BLOKIR_DATE; ?></td>
  </tr>
  <?php endforeach; ?>
  </TBODY>
</table>
