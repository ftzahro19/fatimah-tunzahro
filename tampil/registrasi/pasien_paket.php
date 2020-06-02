<?php 
include "../librari/inc.koneksidb.php"; 
?>
<html>
<head>
<title>Daftar pasien paket</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<style type="text/css">
<!--
a:link {
	color: #FF0000;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #0000FF;
}
a:hover {
	text-decoration: none;
	color: #FF0000;
}
a:active {
	text-decoration: none;
}
.style1 {font-size: 16px}
-->
</style>
</head>
<body>
  <table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
    <tr onMouseOver="this.bgColor='lightblue'"
onmouseout="this.bgColor='#efefef'" bgcolor="#efefef"
>
      <td colspan="7" bgcolor="#CCCCCC"><div align="left"><strong>Daftar Pasien Paket</strong></div> </td>
    </tr>  
    <tr bgcolor="#FFFFFF">
      <td width="14%" bgcolor="#D9E8F3"><div align="center"><strong>No Kunjungan</strong></div></td>
      <td width="16%" bgcolor="#D9E8F3"><div align="center"><strong>Nama [Cost ID]</strong></div></td>
      <td width="14%" bgcolor="#D9E8F3"><div align="center"><strong>Nama Paket</strong></div></td>
      <td width="10%" bgcolor="#D9E8F3"><div align="center"><strong>Kunjungan ke </strong></div></td>
      <td width="14%" bgcolor="#D9E8F3"><div align="center"><strong>Jumlah Paket</strong></div>        </td>
      <td width="10%" bgcolor="#D9E8F3">&nbsp;</td>
    </tr>
<?php 
	$sql = "SELECT reg.kd_kunjungan,data_pasien.prn,data_pasien.nama,tm.nama_tm,paket.selesai,paket.order FROM paket,tm,reg,data_pasien WHERE paket.kd_kunjungan=reg.kd_kunjungan AND reg.prn=data_pasien.prn AND tm.kd_kunjungan=reg.kd_kunjungan GROUP BY paket.kd_kunjungan ORDER BY paket.selesai ASC";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
  ?>
    <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff" span class="style1">
      <td><a href="../renpra/diagnosascr.php?kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>"><?php echo $data['kd_kunjungan'];?></a></td>
      <td><a href="../renpra/diagnosascr.php?kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>"><?php echo $data['nama'];?> [<?php echo $data['prn'];?>]</a></td>
      <td><a href="../renpra/diagnosascr.php?kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>"><?php echo $data['nama_tm'];?></a></td>
      <td><a href="../renpra/diagnosascr.php?kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>"><?php echo $data['selesai'];?></a></td>
      <td><a href="../renpra/diagnosascr.php?kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>"><?php echo $data['order'];?></a></td>
<td width="10%" bgcolor="#FFFFFF">
<div align="center"><a href="pasien_edit.php?kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>">Proses</a></div></td>
<?php
}

?>
  </table>
</body>
</html>
