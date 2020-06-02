<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.session.php";
include "../librari/inc.kodeauto.php";
include "../operator/tab_order_poli.php";

$tanggal= date("Y-m-d");
$kd_kunjungan 	= $_GET['kd_kunjungan'];
$sql = "SELECT * FROM data_pasien,reg WHERE data_pasien.prn=reg.prn AND reg.kd_kunjungan='$kd_kunjungan'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
?>
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<style>
@media print {
input.noPrint { display: none; }
}
@page 
        {
            size: auto;   /* auto is the initial value */
			margin: 20mm;
        }

</style>
<script type="text/javascript">
	window.history.forward(1);
	function noBack()
  { 
  window.history.forward(); 
  }
</script>
<title>KWITANSI PEMBAYARAN</title>
<style type="text/css">
<!--
.style2 {font-size: 9px}
.style2 {font-size: 9px}
input.noPrint {display: none; }
-->
</style>
<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="jquery.validate.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
    	$('#form1').validate();
    });
    </script>
</head>
<body id="tab7" onLoad="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
<form name="form1" method="post" action="transaksi_sim.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>">
<input type="hidden" name="kd_kunjungan" size="12" value="<?php echo $data['kd_kunjungan'];?>">
<input type="hidden" name="kd_transaksi" size="4" value="<?php echo $data['kd_kunjungan'];?>">
<input type="hidden" name="username" size="4" value="<?php echo $_SESSION['klinik'];?>">
<table width="99%" height="129" border="0" align="left" cellpadding="2" cellspacing="1" bgcolor="#DBEAF5">
 <tr bgcolor="#FFFFFF">
    <td width="11%" height="23" bgcolor="#D9E8F3"><B>
      <div align="center">Date</div></B></td>
    <td width="7%" bgcolor="#D9E8F3"><B><div align="center">Item Code</div></B></td>
    <td width="39%" bgcolor="#D9E8F3"><B><div align="center">Description</div></B></td>
    <td width="3%" bgcolor="#D9E8F3"><B><div align="center">Qty</div></B></td>
    <td width="16%" bgcolor="#D9E8F3"><B><div align="center">Amount</div></B></td>
  </tr>
<?php
// query untuk mencari file berdasarkan kategori
$query = "SELECT * FROM tm WHERE kd_kunjungan='$kd_kunjungan' AND status_tm='Selesai'";
$hasil = mysql_query($query);
$i = 1;
while ($data = mysql_fetch_array($hasil))
{
$harga_tm = $data['harga_tm'];
$sub_total1 = $harga_tm * $data['qty_tm']; 
$harga_total1 = $harga_total1 + $sub_total1;
?>
<tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td height="26" class="style1"><input type="hidden" name="tanggal_trx<?php echo $i;?>" value="<?php echo $data['tanggal_tm'];?>"><?php echo $data['tanggal_tm'];?></td>
    <td class="style1">
	<input type="text" name="kd_item<?php echo $i;?>" size="4" value="<?php echo $data['kd_tm'];?>">
	<input type="hidden" name="grup_item<?php echo $i;?>" size="4" value="Consultation and procedur">	</td>
    <td class="style1">
	<input type="hidden" name="nama_item<?php echo $i;?>" value="<?php echo $data['nama_tm'];?>"><?php echo $data['nama_tm'];?></td>
    <td class="style1" align="center">
	    <input type="text" name="qty_item<?php echo $i;?>"  size="2" value="<?php echo $data['qty_tm'];?>"></td>
    <td class="style1" align="right"><input type="hidden" name="pribadi<?php echo $i;?>"  size="10" value="<?php echo $sub_total1;?>" onFocus="startCalc();" onBlur="stopCalc();"><?php echo $sub_total1;?>
	<?php $i++;?></td>
</tr>
<?php
}
// query untuk mencari biaya resep dokter
$query2 = "SELECT * FROM resep WHERE kd_kunjungan='$kd_kunjungan' AND status='Selesai'";
$hasil2 = mysql_query($query2);
while ($data2 = mysql_fetch_array($hasil2))
{
$harga_resep = $data2['harga'];
$sub_total2 = $harga_resep * $data2['qty']; 
$harga_total2 = $harga_total2 + $sub_total2;
?>
<tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td height="26" class="style1"><input type="hidden" name="tanggal_trx<?php echo $i;?>" value="<?php echo $data2['tanggal_rx'];?>"><?php echo $data2['tanggal_rx'];?></td>
    <td class="style1">
	<input type="text" name="kd_item<?php echo $i;?>" size="4" value="<?php echo $data2['kd_obat'];?>">
	<input type="hidden" name="grup_item<?php echo $i;?>" size="4" value="Drug and retail">	</td>
    <td class="style1">
	<input type="hidden" name="nama_item<?php echo $i;?>" value="<?php echo $data2['nama_obat'];?>"><?php echo $data2['nama_obat'];?>
	<input type="hidden" name="operator<?php echo $i;?>" value="<?php echo $data2['operator'];?>"><?php echo $data2['operator'];?>	</td>
    <td class="style1" align="center">
	    <input type="text" name="qty_item<?php echo $i;?>"  size="2" value="<?php echo $data2['qty'];?>"></td>
    <td class="style1" align="right">
	<?php
	echo "<input type='hidden' name='pribadi".$i."'  size='10' value='0'>".$sub_total2."";
	?><?php $i++;?></td>
</tr>
<?php
}
?>
<tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td height="26" class="style1"><input type="hidden" name="tanggal_trx<?php echo $i;?>" value="<?php echo $tanggal;?>"><?php echo $tanggal;?></td>
    <td class="style1">
	<input type="text" name="kd_item<?php echo $i;?>" size="4" value="PAKET01">
	<input type="hidden" name="grup_item<?php echo $i;?>" size="4" value="Drugs Package">	</td>
    <td class="style1">
	<input type="hidden" name="nama_item<?php echo $i;?>" value="PAKET OBAT-OBAT">PAKET OBAT-OBAT
	<input type="hidden" name="operator<?php echo $i;?>" value="<?php echo $data2['operator'];?>"><?php echo $data2['operator'];?>	</td>
    <td class="style1" align="center">
	    <input type="text" name="qty_item<?php echo $i;?>"  size="2" value="1"></td>
    <td class="style1" align="right">
	<?php
	echo "<input type='text' name='pribadi".$i."'  size='10' required>";
	?></td>
</tr>

<tr bgcolor="#FFFFFF">
    <td height="23" colspan="2" align="center" bgcolor="#FFFFFF"><b>Total tagihan : </b></td>
    <td colspan="4" align="right" bgcolor="#FFFFFF"><b>
	<?php 
	$total = $harga_total1 + $harga_total2;
	echo "Rp. ";
	echo angka($total);
	?>
	</b></td>
</tr>

<tr bgcolor="#FFFFFF">
    <td height="23" colspan="2" align="left" bgcolor="#FFFFFF">Terbilang :</td>
    <td colspan="4" align="right" bgcolor="#FFFFFF">
	<?php
	$kalimat = terbilang($total);
	$kalimat_new = ucwords($kalimat);
	echo "$kalimat_new"; ?> Rupiah</td>
</tr>

<tr bgcolor="#FFFFFF">
<td colspan="5" align="left" bgcolor="#FFFFFF"><input type="hidden" name="jumMK" value="<?php echo $i; ?>" />
<input name="button" type="button" class="noPrint" onClick="window.print()" value="Print">
<input type="submit" name="Submit" value="Close and Print">  </td>
</tr>

</table>
</form>
</body>
</html> 
