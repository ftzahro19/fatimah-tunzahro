<?php 
include "../librari/inc.koneksidb.php"; 
?>
<html>
<head>
<title>Daftar pasien per tanggal <? echo date("d-m-Y");?></title>
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
      <td colspan="7" bgcolor="#CCCCCC"><div align="left"><strong>Daftar pasien per tanggal <? echo date("d-m-Y");?></strong></div> </td>
    </tr>
<?php 
$query ="SELECT ruang, COUNT(ruang) FROM data_pasien WHERE status='Aktif' GROUP BY ruang ORDER BY ruang ASC";
$result =mysql_query($query) or die(mysql_error());
while($data=mysql_fetch_array($result)){
	$no++;
  ?>
    <tr bgcolor="#D9E8F3">
      <td colspan="6"><? echo $data['ruang'];?></td>
    </tr>  
    <tr bgcolor="#FFFFFF">
      <td width="14%" bgcolor="#D9E8F3"><div align="center"><strong>PRN</strong></div></td>
      <td width="16%" bgcolor="#D9E8F3"><div align="center"><strong>Nama </strong></div></td>
      <td width="14%" bgcolor="#D9E8F3"><div align="center"><strong>Tanggal Lahir</strong></div></td>
      <td width="10%" bgcolor="#D9E8F3"><div align="center"><strong>Ruang</strong></div></td>
      <td width="14%" bgcolor="#D9E8F3"><div align="center"><strong>Kamar/Kelas</strong></div>        </td>
      <td width="10%" bgcolor="#D9E8F3">&nbsp;</td>
    </tr>
<?php 
	$tanggal = date("Y:m:d");
	$ruang = $data[ruang];
	$sql = "SELECT kd_kunjungan,prn,nama,DATE_FORMAT(tgl_lahir,'%d-%m-%Y') AS tgl_lahir,ruang,kamar,kelas FROM data_pasien WHERE ruang='$ruang' AND status='Aktif' ORDER BY kamar";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
  ?>
    <tr onmouseover="this.bgColor='lightyellow'" onmouseout="this.bgColor='#ffffff'" bgcolor="#ffffff" span class="style1">
      <td><a href="../renpra/diagnosascr.php?kd_kunjungan=<? echo $data['kd_kunjungan']; ?>"><? echo $data['prn'];?></a></td>
      <td><a href="../renpra/diagnosascr.php?kd_kunjungan=<? echo $data['kd_kunjungan']; ?>"><? echo $data['nama'];?></a></td>
      <td><a href="../renpra/diagnosascr.php?kd_kunjungan=<? echo $data['kd_kunjungan']; ?>"><? echo $data['tgl_lahir'];?></a></td>
      <td><a href="../renpra/diagnosascr.php?kd_kunjungan=<? echo $data['kd_kunjungan']; ?>"><? echo $data['ruang'];?></a></td>
      <td><a href="../renpra/diagnosascr.php?kd_kunjungan=<? echo $data['kd_kunjungan']; ?>"><? echo $data['kamar'];?>/<? echo $data['kelas'];?></a></td>
<td width="10%" bgcolor="#FFFFFF">
<div align="center"><a href="pasien_edit.php?kd_kunjungan=<? echo $data['kd_kunjungan']; ?>">Edit</a></div>
</td>
<?php
}
}
?>
  </table>
</body>
</html>
