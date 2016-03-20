<style>
* {
font-size : 10px;
}

.garisbawah {
	border-bottom : #000 solid 2px;
}

</style>
<p>
</p>
<p>
</p>
<p>
</p>
<p>
</p>
<p>
</p>
<p>
</p>
<p>
</p>

<table width="100%" border="0">
  <tr>
    <td width="50%"></td>
    <td width="17%">&nbsp;</td>
    <td width="33%"><?php echo $kota_polda ?>, <?php echo ($daft_date); ?></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td width="34%">No. Pol </td>
        <td width="4%">:</td>
        <td width="62%"><?php echo $no_surat; ?></td>
      </tr>
      <tr>
        <td>Klasifikasi</td>
        <td>:</td>
        <td>BIASA </td>
      </tr>
      <tr>
        <td>Lampiran </td>
        <td>:</td>
        <td>-</td>
      </tr>
      <tr>
        <td>Perihal</td>
        <td>:</td>
        <td>Permohonan Blokir BPKB</td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
    <td valign="bottom">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td valign="baseline">Kepada</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">Yth</td>
    <td valign="baseline">DIREKTUR LALU LINTAS <?php  echo $nama_polda ?></td>
  </tr>
  <tr>
    <td colspan="2" rowspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="2%">&nbsp;</td>
        <td width="98%">&nbsp;</td>
      </tr>

    </table></td>
    <td valign="baseline">di</td>
  </tr>
  <tr>
    <td valign="baseline"><?php  echo $kota_polda; ?></td>
  </tr>
  <tr>
    <td valign="baseline">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="1">
  
  <tr>
    <td width="4%"  valign="top">1</td>
    <td  width="96%" valign="top">Rujukan</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top"><table width="100%" border="0" cellpadding="3">
      <tr>
        <td width="4%">a.</td>
        <td width="96%">Undang - undang no. 22 Tahun 2009 tentang Lalu Lintas dan Angkutan Jalan;</td>
      </tr>
      <tr>
        <td>b.</td>
        <td>Perjanjian Kontrak No. 
          <?php  echo $kontrak_no; ?> tanggal 
          <?php  echo flipdate($kontrak_date); ?> tentang perjanjian sewa beli kendaraan antara 
          <?php  echo $leasing_nama; ?> dengan Konsumen, 
          <?php  echo $nama_pengajuan_leasing; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>2</td>
    <td><p>Berdasarkan rujukan tersebut, mohon kepada Direktur untuk dapatnya dilaksanakan pemblokiran BPKB dengan identitas kendaraan sebagai berikut : </p></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="100%" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td width="26%">Merk</td>
        <td width="3%">:</td>
        <td width="71%"><?php echo $merk_nama; ?></td>
      </tr>
      <tr>
        <td>NomorRangka </td>
        <td>:</td>
        <td><?php echo $no_rangka; ?></td>
      </tr>
      <tr>
        <td>Nomor Mesin </td>
        <td>:</td>
        <td><?php echo $no_mesin; ?></td>
      </tr>
      <tr>
        <td>Jenis </td>
        <td>:</td>
        <td><?php echo $jenis_nama; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>3</td>
    <td>Demikian untuk menjadi maklum.</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="100%" border="0" cellpadding="3">
  <tr>
    <td width="61%">&nbsp;</td>
    <td width="39%" align="center">Pemohon</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><?php  echo $leasing_nama; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><table width="100%" border="0" cellpadding="3">
      <tr>
        <td width="32%">NAMA</td>
        <td width="68%">: 
          <?php  echo $leasing_penanggungjawab; ?></td>
      </tr>
      <tr>
        <td>JABATAN</td>
        <td>:
          <?php  echo $leasing_jabatan; ?></td>
      </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
