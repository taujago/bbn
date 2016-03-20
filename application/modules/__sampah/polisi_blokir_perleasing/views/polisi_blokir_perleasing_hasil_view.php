<table width="661" class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="45" rowspan="2" align="center" valign="middle"><center>NO.</center></th>
		    <th width="299" rowspan="2"><center>NAMA LEASING</center></th>
		    <th colspan="2" align="center" valign="middle"><center>JUMLAH BLOKIR</center></th>
		    <th width="125" rowspan="2" align="center" valign="middle"><center>TOTAL</center></th>
		    </tr>
                <tr>
                  <th width="107" align="center" valign="middle"><center>KENDARAAN BARU</center></th>
                  <th width="151" align="center" valign="middle"><center>KENDARAAN LAMA</center></th>
                </tr>
               
            </thead>
            <TBODY>
            <?php 
			$n=0;
			$baru =0; $lama = 0 ;
			$semua = 0;
			foreach($record->result() as $row) :  
			$baru += $row->baru;
			$lama += $row->lama;
			$n++;
			?>
             <tr>
                  <td align="center"><?php echo $n; ?></td>
                  <td align="center"><?php echo $row->leasing_nama; ?></td>
                  <td align="center"><?php echo $row->baru; ?></td>
                  <td align="center"><?php echo $row->lama; ?></td>
                  <td align="center"><?php echo $row->semua; ?></td>
              </tr>
            
              <?php 
			  endforeach;
			  ?>
               <tr>
               <td align="center">&nbsp;</td>
               <td align="center"><strong>TOTAL</strong></td>
               <td align="center"><strong><?php echo $baru; ?></strong></td>
               <td align="center"><strong><?php echo $lama; ?></strong></td>
               <td align="center"><strong><?php echo ($baru + $lama); ?></strong></td>
             </tr>
            </TBODY>
            </table>