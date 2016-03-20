<style>
* {
font-size : 9px;
}

.garisbawah {
	border-bottom : #000 solid 2px;
}

</style>

<table width="100%" border="0">
   
  <tr>
    <td width="56%" align="center"><b><img width="70px" height="70px" align="middle" src="<?php echo base_url(); ?>/assets/images/logo.png" /><br />
    <?php echo $nama_polda ?></b></td>
    <td width="11%">&nbsp;</td>
    <td width="33%">&nbsp;</td>
  </tr>
  <tr>
    <td class="garisbawahs" align="center"><!--DIREKTORAT LALU LINTAS <br />
       --><strong>
       <?php echo $nama_polres; ?><br />
       <?php 
	   	if($jenis=="polsek"){
			echo  $nama_polsek;
		}
	   ?><br /></strong>
       <?php echo $alamat_instansi; ?><br />
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><hr /></td>
    <td>&nbsp;</td>
    <td><?php echo $kota_polda ?>, 
    <?php  echo tgl_indo(flipdate($surat_tgl)) ?></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td width="24%">No. Pol </td>
        <td width="3%">:</td>
        <td width="73%"><?php echo $surat_nomor; ?></td>
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
        <td>Permohonan Pemblokiran Surat <br /><u>Kendaraan R-<?php echo $jumlah_roda; ?>  No. Pol : <?php echo $no_polisi ?></u></td>
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
    <td valign="baseline">DIREKTUR LALU LINTAS    </td>
  </tr>
  <tr>
    <td colspan="2" rowspan="4" valign="top"><table width="100%" border="0">
      <tr>
        <td width="2%">&nbsp;</td>
        <td width="98%">&nbsp;</td>
        </tr>
      
    </table></td>
    <td valign="baseline"><?php  echo $nama_polda_singkatan; ?></td>
  </tr>
  <tr>
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
    <td colspan="2"  valign="top">u.p. Kasubdit Reg Ident</td>
  </tr>
  <tr>
    <td width="4%"  valign="top">1.</td>
    <td  width="96%" valign="top">Rujukan Laporan Polisi Nomor : 
    <?php  echo $surat_laporan_nomor ?>, tanggal 
    <?php  echo tgl_indo(flipdate($surat_laporan_tanggal)) ?> perihal terjadinya tindak pidana 
    <?php  echo $jenis_pidana ?> dengan pemberatan sebagaimana dimaksud dalam pasal 363 KUHP yang terjadi pada hari 
    <?php  echo hari($pidana_tgl); ?> 
    tanggal
<?php  echo tgl_indo(flipdate($pidana_tgl))  ?> sekitar jam 
    <?php  echo $pidana_waktu; ?> di 
    <?php  echo $pidana_tkp;  ?> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>2.</td>
    <td>Sehubungan dengan rujukan tersebut di atas, guna kepentingan penyelidikan dan penyidikan lebih lanjut, bersama ini dimohon kepada Dir untuk memblokir surat - surat kendaraan RODA dengan data - data sebagai beriktu :</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="100%" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td width="26%">Merk</td>
        <td width="3%">:</td>
        <td width="71%"><?php echo $merk; ?></td>
      </tr>
      <tr>
        <td> Nomor polisi</td>
        <td>:</td>
        <td><?php echo $no_polisi; ?></td>
      </tr>
      <tr>
        <td>Warna</td>
        <td>:</td>
        <td><?php echo $warna; ?></td>
      </tr>
      <tr>
        <td>Tahun Pembuatan </td>
        <td>:</td>
        <td><?php echo $tahun_pembuatan; ?></td>
      </tr>
      <tr>
        <td>Nomor Rangka </td>
        <td>:</td>
        <td><?php echo $no_rangka; ?></td>
      </tr>
      <tr>
        <td>Nomor Mesin </td>
        <td>:</td>
        <td><?php echo $no_mesin; ?></td>
      </tr>
      <tr>
        <td>Atas Nama</td>
        <td>:</td>
        <td><?php echo $pemilik_nama; ?></td>
      </tr>
      <tr>
        <td>Alamat </td>
        <td>:</td>
        <td><?php echo $pemilik_alamat; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>3. </td>
    <td>Demikian untuk dimaklumi </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><table width="100%" border="0">
      <tr>
        <td align="left">&nbsp;</td>
        <td align="right"><!--<img src="<?php echo base_url(); ?>/assets/images/<?php echo $stempel_file ?>" />--></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="3%">&nbsp;</td>
    <td width="57%">&nbsp;</td>
    <td width="40%" align="center">KEPALA KEPOLISIAN 
	<?php echo ($jenis=="polsek")?$nama_polsek:$nama_polres;  ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Tembusan : </td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center" style="border-bottom:#000 solid 2px;"> <?php echo $ttd_nama; ?></td>
  </tr>
  <tr>
    <td>1.</td>
    <td>Dir Lantas <?php echo $nama_polda ?></td>
    <td align="center"><?php echo $ttd_pangkat." NRP.".$ttd_nrp; ?> </td>
  </tr>
 <?php if($jenis=="polsek") :  ?> 
  <tr>
    <td>2.</td>
    <td>Kapolres <?php echo $nama_polres; ?></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>3. </td>
    <td>Kasat Reskrim <?php echo $nama_polres; ?></td>
    <td align="center">&nbsp;</td>
  </tr>
  <?php endif; ?>
</table>
