<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.kodeauto.php";
include "../librari/inc.session.php";

$kd_kunjungan 	= $_GET['kd_kunjungan'];
$sql = "SELECT * FROM data_pasien,reg WHERE data_pasien.prn=reg.prn AND reg.kd_kunjungan='$kd_kunjungan'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
?>
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<title>KWITANSI PEMBAYARAN</title>
<style type="text/css">
<!--
.style2 {font-size: 9px}
.style2 {font-size: 9px}
-->
</style>
</head>
<body>
<form name="form1" method="post" action="transaksi_sim.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>">
<?php include "transaksi_biodata.php";?>
<table width="99%" height="252" border="0" align="left" cellpadding="2" cellspacing="1" bgcolor="#DBEAF5">
<input type="hidden" name="kd_kunjungan" size="12" value="<?php echo $data['kd_kunjungan'];?>"></br>
<input type="hidden" name="kd_transaksi" size="4" value="<?php echo $data['kd_kunjungan'];?>">

 <tr bgcolor="#FFFFFF">
    <td width="11%" bgcolor="#D9E8F3"><B><div align="center">Date</div></B></td>
    <td width="7%" bgcolor="#D9E8F3"><B><div align="center">Item Code</div></B></td>
    <td width="39%" bgcolor="#D9E8F3"><B><div align="center">Description</div></B></td>
    <td width="3%" bgcolor="#D9E8F3"><B><div align="center">Qty</div></B></td>
    <td width="16%" bgcolor="#D9E8F3"><B><div align="center">3rd Party </div></B></td>
    <td width="16%" bgcolor="#D9E8F3"><B><div align="center">Amount</div></B></td>
  </tr>
 <tr bgcolor="#FFFFFF">
    <td colspan="6" bgcolor="#FFFFFF"><div align="left"><b>Consultation and procedur</b></div>      <div align="center"></div>      <div align="center"></div></td>
  </tr>
<?php
// query untuk mencari file berdasarkan kategori
$query = "SELECT * FROM reg,tm WHERE reg.kd_kunjungan=tm.kd_kunjungan AND tm.kd_kunjungan='$kd_kunjungan'";
$hasil = mysql_query($query);
$i = 1;
while ($data = mysql_fetch_array($hasil))
{
$harga_tm = $data['harga_tm'];
$sub_total1 = $harga_tm * $data['qty_tm']; 
$harga_total1 = $harga_total1 + $sub_total1;
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><input type="hidden" name="tanggal_trx<?php echo $i;?>" value="<?php echo $data['tanggal_tm'];?>"><?php echo $data['tanggal_tm'];?>    </td>
    <td class="style1">
	<input type="text" name="kd_item<?php echo $i;?>" size="4" value="<?php echo $data['kd_tm'];?>">
	<input type="hidden" name="grup_item<?php echo $i;?>" size="4" value="Consultation and procedur">	</td>
    <td class="style1">
	<input type="hidden" name="nama_item<?php echo $i;?>" value="<?php echo $data['nama_tm'];?>"><?php echo $data['nama_tm'];?></td>
    <td class="style1" align="center">
	    <input type="text" name="qty_item<?php echo $i;?>"  size="2" value="<?php echo $data['qty_tm'];?>"></td>
    <td class="style1" align="right">
	<?php
	$kd_kunjungan = $data[kd_kunjungan];
	$kd_tm = $data[kd_tm];
	$kd_asuransi = $data[kd_asuransi];
	$sql1 = "SELECT *  FROM reg,asuransi_db,asuransi_plan WHERE reg.kd_asuransi=asuransi_db.kd_asuransi AND asuransi_db.kd_asuransi=asuransi_plan.kd_asuransi AND kd_kunjungan='$kd_kunjungan' AND kd_jaminan='$kd_tm';";
    $qry1 = mysql_query($sql1, $koneksi) or die ("gagal Query");
	$data1 =mysql_fetch_array($qry1);
	$juml1 = mysql_num_rows($qry1);
	$charge1 = $data1[charge];
	$harga_tm = $data[harga_tm];
	$harga_asuransi1 = $harga_tm * $juml1 * $charge1 / 100;
	$harga_pribadi1 = $harga_tm - $harga_asuransi1;
	$sub_total_asuransi1 = $sub_total_asuransi1 + $harga_asuransi1;
	$sub_total_pribadi1 = $sub_total_pribadi1 + $harga_pribadi1;
	echo "<input type='text' name='asuransi".$i."'  size='2' value='".$harga_asuransi1."'>";
	?>	</td>
    <td class="style1" align="right">
	<?php
	echo "<input type='text' name='pribadi".$i."'  size='2' value='".$harga_pribadi1."'>";
	?><?php $i++;?>	</td>
  </tr>
  <?php
}
?>
<tr bgcolor="#FFFFFF">
<td bgcolor="#FFFFFF" align="center"></td>
<td bgcolor="#FFFFFF" align="center"></td>
<td align="right" bgcolor="#FFFFFF"><b>Sub total consultation and procedur :</b></td>
<td bgcolor="#FFFFFF" align="center"></td>
<td bgcolor="#FFFFFF" align="right"><b>Rp. <?php echo $sub_total_asuransi1;?></b></td>
<td bgcolor="#FFFFFF" align="right"><b>Rp. <?php echo $sub_total_pribadi1;?></b></td>
 </tr>
 <tr bgcolor="#FFFFFF">
    <td colspan="6" bgcolor="#FFFFFF"><B>Drug and retail</B>      </div>      </div></td>
  </tr>

<?php
// query untuk mencari file berdasarkan kategori
$query = "SELECT * FROM resep WHERE kd_kunjungan='$kd_kunjungan'";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
$harga = $data['harga'];
$sub_total2 = $harga * $data['qty']; 
$harga_total2 = $harga_total2 + $sub_total2;
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1">
	    <input type="hidden" name="tanggal_trx<?php echo $i;?>" value="<?php echo $data['tanggal_rx'];?>"><?php echo $data['tanggal_rx'];?></td>
    <td class="style1">
	    <input type="text" name="kd_item<?php echo $i;?>" size="4" value="<?php echo $data['kd_obat'];?>">
		<input type="hidden" name="grup_item<?php echo $i;?>" size="4" value="Drug and retail">		</td>
    <td class="style1">
	    <input type="hidden" name="nama_item<?php echo $i;?>" value="<?php echo $data['nama_obat'];?>"><?php echo $data['nama_obat'];?></td>
    <td class="style1" align="center"><input type="text" name="qty_item<?php echo $i;?>" size="2" value="<?php echo $data['qty'];?>"></td>
    <td class="style1" align="right">
	<?php
	$kd_kunjungan = $data[kd_kunjungan];
	$kd_obat = $data[kd_obat];
	$kd_asuransi = $data[kd_asuransi];
	$harga = $data[harga];
	$qty = $data[qty];
	$harga_obat = $qty * $harga;
	$sql2 = "SELECT *  FROM reg,asuransi_db,asuransi_plan WHERE reg.kd_asuransi=asuransi_db.kd_asuransi 
	AND asuransi_db.kd_asuransi=asuransi_plan.kd_asuransi AND kd_kunjungan='$kd_kunjungan' AND kd_jaminan='$kd_obat';";
    $qry2 = mysql_query($sql2, $koneksi) or die ("gagal Query");
	$data2 =mysql_fetch_array($qry2);
	$juml2 = mysql_num_rows($qry2);
	$charge2 = $data2[charge];
	$harga_asuransi2 = $harga_obat * $juml2 * $charge2 / 100;
	$harga_pribadi2 = $harga_obat - $harga_asuransi2;
	$sub_total_asuransi2 = $sub_total_asuransi2 + $harga_asuransi2;
	$sub_total_pribadi2 = $sub_total_pribadi2 + $harga_pribadi2;
	echo "<input type='text' name='asuransi".$i."'  size='2' value='".$harga_asuransi2."'>";
	?></td>
	<td bgcolor="#FFFFFF" align="right"></div>
	  <span class="style1">
	  <?php
	echo "<input type='text' name='pribadi".$i."'  size='2' value='".$harga_pribadi2."'>";
	?><?php $i++;?>
    </span></td>
  </tr>
  <?php
}
?>
  <tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" align="center"></td>
    <td bgcolor="#FFFFFF" align="center"></td>
    <td bgcolor="#FFFFFF" align="right"><b>Sub total drug and retail :</b></td>
    <td bgcolor="#FFFFFF" align="right">&nbsp;</td>
    <td bgcolor="#FFFFFF" align="right"><b>Rp. <?php echo angka($sub_total_asuransi2);?></b></td>
    <td bgcolor="#FFFFFF" align="right"><b>Rp. </b><b><?php echo angka($sub_total_pribadi2);?></b></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" align="center"></td>
    <td bgcolor="#FFFFFF" align="center"></td>
    <td bgcolor="#FFFFFF" align="right"><b>Sub total : </b></td>
    <td bgcolor="#FFFFFF" align="right">&nbsp;</td>
    <td bgcolor="#FFFFFF" align="right"><b>
	<?php 
	$total_asuransi = $sub_total_asuransi1 + $sub_total_asuransi2;
	echo "Rp. ";
	echo angka($total_asuransi);
	?>
	</b></td>
    <td bgcolor="#FFFFFF" align="right"><b>
	<?php 
	$total_pribadi = $sub_total_pribadi1 + $sub_total_pribadi2;
	echo "Rp. ";
	echo angka($total_pribadi);
	?></b></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" align="center"></td>
    <td bgcolor="#FFFFFF" align="center"></td>
    <td bgcolor="#FFFFFF" align="right"><b>Total pembayaran  : </b></td>
    <td bgcolor="#FFFFFF" align="right">&nbsp;</td>
    <td colspan="2" align="right" bgcolor="#FFFFFF"><b>
      <?php 
	$grand_total = $total_asuransi + $total_pribadi;
	echo "Rp. ";
	echo angka($grand_total);
	?>
    </b></td>
  </tr>
  <tr bgcolor="#FFFFFF">
<td colspan="6" align="left" bgcolor="#FFFFFF"><input type="hidden" name="jumMK" value="<?php echo $i; ?>" />
  <input type="submit" name="Submit" value="Close and Print"></td>
</tr></form>
</table>
</body>
</html> 

