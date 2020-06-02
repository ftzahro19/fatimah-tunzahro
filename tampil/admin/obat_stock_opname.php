<?php 
include "../librari/inc.koneksidb.php";
include_once "../librari/inc.session.php";
?>
<html>
<head>
<title>DAFTAR OBAT</title>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>
<body>
  <table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
      <td colspan="5" bgcolor="#CCCCCC"><div align="left"><strong>STOCK OBAT </strong></div></td>
    </tr>
	    
    <tr bgcolor="#FFFFFF">
      <td width="12%" bgcolor="#D9E8F3"><div align="center"><strong>KODE</strong></div></td>
	  <td width="28%" bgcolor="#D9E8F3"><div align="center"><strong>NAMA OBAT </strong></div></td>
	  <td width="13%" bgcolor="#D9E8F3"><div align="center"><B>SISA SISTEM</B></div></td>
	  <td width="13%" bgcolor="#D9E8F3"><div align="center"><B>SISA FISIK</B></div></td>
	  <td width="13%" bgcolor="#D9E8F3"><div align="center"><B>SELISIH</B></div></td>
    </tr>
<?php 
	$sql = "SELECT * FROM obat_db ORDER BY kd_obat";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
?>
    <tr bgcolor="#FFFFFF">
      <td><?php echo $data['kd_obat'];?></td>
      <td><?php echo $data['nama_obat'];?></td>
	  <?php
	  $kd_obat = $data['kd_obat'];
	  $sql1 = "SELECT kd_obat,SUM(jumlah) FROM obat_stock WHERE kd_obat='$kd_obat' GROUP BY kd_obat";
	  $qry1 = mysql_query($sql1, $koneksi) 
		 	 or die ("SQL Error".mysql_error());
			 while ($data1=mysql_fetch_array($qry1)) {
			 if($data1['SUM(jumlah)']!="") {
			 echo "<input type='hidden' name='qty' value='".$data1['SUM(jumlah)']."'>";
			 }
			 else {
			 echo "0";
			 }
	  $sql2 = "SELECT kd_item,SUM(qty_item) FROM transaksi  WHERE kd_item='$kd_obat' GROUP BY kd_item";
	  $qry2 = mysql_query($sql2, $koneksi) 
		 	 or die ("SQL Error".mysql_error());
			 while ($data2=mysql_fetch_array($qry2)) {
		echo "<input type='hidden' name='qty' value='".$data2['SUM(qty_item)']."'></br>";
	  ?>
	  <td align="center">
	  <?php
	  $masuk  = $data1['SUM(jumlah)'];
	  $keluar = $data2['SUM(qty_item)'];
	  $sisa   = $masuk - $keluar;
	  echo "$sisa";
	  }}
	  ?>	  
	  </td>
	  <td align="center"><input type='text' name='qty_so'></td>
	  <td align="center"><input type='text' name='selisih'></td>
	  <?php
}
?>
    </tr>
  </table>
</body>
</html>
