<?php 
include "../librari/inc.koneksidb.php";
include "../librari/inc.resolusi.php";
?>
<html>
<head>
<title>Daftar pasien per tanggal <? echo date("d-m-Y");?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
  <script language="javascript">
var win = null;
function NewWindow(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
}
</script>
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
<body id="tab1">
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
<tr bgcolor="#D9E8F3">
<td colspan="5">DAFTAR PASIEN </td>
</tr> 
<tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff" span class="style1">
  <td width="15%"><div align="center"><strong>Tanggal</strong></div></td>
  <td width="35%"><div align="center"><strong>Identitas Pasien </strong></div></td>
  <td width="21%"><div align="center"><strong>Klinik</strong></div></td>
  <td width="20%"><div align="center"><strong>Dokter</strong></div></td>
  <td width="9%"><div align="center"></div></td>
  </tr>
<?php 
$kd_kunjungan=$_GET["kd_kunjungan"];
$q=$_GET["q"];
	$sql = "SELECT * FROM data_pasien,reg,klinikdb WHERE data_pasien.prn=reg.prn AND reg.klinik=klinikdb.kd_klinik AND reg.selesai='Selesai' AND (nama LIKE '%".$q."%' || reg.prn LIKE '%".$q."%')";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
?>
<tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff" span class="style1">
<td><?php echo $data['tgl_reg'];?> <?php echo $data['jam_reg'];?></td>
<td><?php echo $data['nama'];?> [<?php echo $data['prn'];?>]</td>
<td>Klinik <?php echo $data['nama_klinik'];?></td>
<td><?php
	$dokter = $data['dokter'];
	$sql4 = "SELECT * FROM user WHERE username='$dokter'";
    $qry4 = mysql_query($sql4, $koneksi) or die ("gagal Query");
	$data4 =mysql_fetch_array($qry4);
	echo $data4['nama'];
	?></td>
<?php
$kd_kunjungan = $data['kd_kunjungan'];
$sql1 = "SELECT * FROM pasien_poliklinik WHERE kd_kunjungan='$kd_kunjungan'";
$qry1 = mysql_query($sql1, $koneksi) 
		 or die ("SQL Error".mysql_error());
$data1=mysql_fetch_array($qry1)
?>
<?php
$sql2 = "SELECT * FROM resep WHERE kd_kunjungan='$kd_kunjungan'";
$qry2 = mysql_query($sql2, $koneksi) 
		 or die ("SQL Error".mysql_error());
$data2=mysql_fetch_array($qry2)
?>
<?php
$sql3 = "SELECT * FROM tm WHERE kd_kunjungan='$kd_kunjungan'";
$qry3 = mysql_query($sql3, $koneksi) 
		 or die ("SQL Error".mysql_error());
$data3=mysql_fetch_array($qry3)
?>
<td><div align="center"><a href="kwitansi1.php?kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>">Print</a></div></td>
<?php
}
?>
</table>
</body>
</html>
