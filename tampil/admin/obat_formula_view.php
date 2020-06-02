<?php 
include "../librari/inc.koneksidb.php";
include_once "../librari/inc.session.php";
?>
<html>
<head>
<title>DAFTAR FORMULA OBAT</title>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>
<body>
  <table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
      <td colspan="5" bgcolor="#CCCCCC"><div align="left"><strong>FORMULA OBAT</strong></div></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="10%" bgcolor="#D9E8F3"><div align="center"><strong>KODE</strong></div></td>
	  <td width="10%" bgcolor="#D9E8F3"><div align="center"><strong>GOLONGAN</strong></div></td>
      <td width="25%" bgcolor="#D9E8F3"><div align="center"><strong>NAMA OBAT </strong></div></td>
	   <td width="39%" bgcolor="#D9E8F3"><div align="center"><strong>ISI OBAT </strong></div></td>
	  <td width="16%" bgcolor="#D9E8F3"><div align="center"></div></td>
    </tr>
<?php 
	$sql = "SELECT * FROM obat_db WHERE gol_obat='Formula' ORDER BY kd_obat";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
  ?>
    <tr bgcolor="#FFFFFF">
      <td><?php echo $data['kd_obat'];?></td>
      <td><?php echo $data['gol_obat'];?></td>
	  <td><?php echo $data['nama_obat'];?></td>
	  <td align="left">
	  <?php 
	$kd_obat = $data['kd_obat'];
	$sql2 = "SELECT * FROM obat_formula WHERE kd_obat='$kd_obat' ORDER BY nama_bahan";
	$qry2 = mysql_query($sql2, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data2=mysql_fetch_array($qry2)) {
		echo "".$data2[nama_bahan].", ket : ".$data2[keterangan]."</br>";
		}
      ?>
	  </td>
	  <td align="right"><div align="center"><a href="obat_formula.php?kd_obat=<?php echo $data['kd_obat']; ?>">Update</a></div></td>

      <?php
}
?>
    </tr>
  </table>
</body>
</html>
