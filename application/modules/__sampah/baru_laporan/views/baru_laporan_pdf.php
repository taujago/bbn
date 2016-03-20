<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>
<style>
* {
	font-size : 7px;
}
</style>
<body>
<p align="center">
<h2>LAPORAN BLOKIR KENDARAAN<br />
  <?php echo $userdata['leasing_nama']; ?> <br />
  
</h2>
</p>
<table width="50%" border="0" cellpadding="3">
  <tr>
    <td width="44%">PERIODE</td>
    <td width="7%">:</td>
    <td width="49%"><?php echo $tanggal_awal." s.d ".$tanggal_akhir; ?></td>
  </tr>
  <tr>
    <td>JENIS PERMOHONAN</td>
    <td>:</td>
    <td><?php echo  $permohonan ?></td>
  </tr>
  <tr>
    <td>POLDA</td>
    <td>:</td>
    <td><?php echo $nama_polda; ?></td>
  </tr>
</table><br />
<br />
<table width="100%" border="1" cellpadding="3">
 <thead>
  <tr>
    <th width="3%" align="center" scope="col"><strong>NO</strong></th>
    <th width="6%" align="center" scope="col"><strong>TGL. DAFTAR</strong></th>
    <th width="8%" align="center" scope="col"><strong>CABANG</strong></th>
    <th width="6%" align="center" scope="col"><strong>NO.POLISI <br /></strong></th>
    <th width="10%" align="center" scope="col">NO. RANGKA</th>
    <th width="6%" align="center" scope="col">NO. BPKB</th>
    <th width="6%" align="center" scope="col"><strong>TGL BKPB</strong></th>
    <th width="13%" align="center" scope="col"><strong>NAMA PEMOHON</strong></th>
    <th width="12%" align="center" scope="col"><strong>NO. BLOKIR</strong></th>
    <th width="6%" align="center" scope="col"><strong>TGL. BLOKIR</strong></th>
    <th width="10%" align="center" scope="col"><strong>JENIS/MERK</strong></th>
     <th width="13%" align="center" scope="col"><strong>STATUS</strong></th>
  </tr>
  </thead>
  <tbody>
  <?php 
  $nomor = 0;
  foreach($record->result() as $row) :  
  $nomor++;
  ?>
  <tr>
    <td width="3%" scope="col"><?php echo $nomor; ?></td>
    <td width="6%" scope="col"><?php echo $row->daft_date; ?></td>
    <td width="8%" scope="col"><?php echo $row->cabang_nama; ?></td>
    <td width="6%" scope="col"><?php echo $row->no_polisi; ?></td>
    <td width="10%" scope="col"><?php echo $row->no_rangka; ?></td>
    <td width="6%" scope="col"><?php echo $row->no_bpkb; ?></td>
    <td width="6%" scope="col"><?php echo $row->tgl_bpkb; ?></td>
    <td width="13%" scope="col"><?php echo $row->nama_pengajuan_leasing; ?></td>
    <td width="12%" scope="col"><?php  echo $row->no_blokir; ?></td>
    <td width="6%" scope="col"><?php echo $row->tgl_blokir; ?></td>
    <td width="10%" scope="col"><?php echo $row->jenis_nama."<br />".$row->merk_nama; ?></td>
    <td width="13%" scope="col"><?php echo $row->approved2; ?></td>
  </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<p><br />
  <br />
</p>
</body>
</html>