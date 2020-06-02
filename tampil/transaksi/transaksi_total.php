<?php
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
<table width="99%" height="49" border="0" align="left" cellpadding="2" cellspacing="1" bgcolor="#DBEAF5">
<?php
// query untuk mencari file berdasarkan kategori

$grand_total = $harga_total1 + $harga_total2;

?>
<tr bgcolor="#FFFFFF">
  <td height="23" align="center" bgcolor="#FFFFFF"></td>
  <td align="center" bgcolor="#FFFFFF"></td>
  <td align="right" bgcolor="#FFFFFF"><b>Grand Total :</b></td>
  <td align="right" bgcolor="#FFFFFF"><b>Rp. <?php echo $grand_total;?></b></td>
  </tr>
<tr bgcolor="#FFFFFF">
<td width="11%" height="23" align="center" bgcolor="#FFFFFF"></td>
<td width="7%" align="center" bgcolor="#FFFFFF"></td>
<td width="49%" align="right" bgcolor="#FFFFFF">Terbilang : </td>
<td align="left" bgcolor="#FFFFFF"><?php echo terbilang($grand_total);?> rupiah</td>
</tr>
</table>
</body>
</html> 

