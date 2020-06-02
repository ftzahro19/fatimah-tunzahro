<?php 
include "../librari/inc.koneksidb.php";
include "../librari/inc.resolusi.php";
include "../librari/inc.session.php";
include "tab_transaksi.php";
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
<td colspan="6">INPUT TINDAKAN MEDIS RAWAT JALAN</td>
</tr> 
<tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff" span class="style1">
  <td width="18%"><div align="center"><strong>Identitas Pasien </strong></div></td>
  <td width="9%"><div align="center"><strong>Jam Daftar </strong></div></td>
  <td width="14%"><div align="center"><strong>Ruang</strong></div></td>
  <td width="12%"><div align="center"><strong>Dokter</strong></div></td>
  <td><div align="center"><strong>Tindakan Medis </strong></div></td>
  <td width="14%"><div align="center"></div></td>
  </tr>
<?php 
	$sql = "SELECT * FROM data_pasien,reg,klinikdb WHERE data_pasien.prn=reg.prn AND reg.klinik=klinikdb.kd_klinik AND reg.tindak_lanjut!='Rawat' AND reg.selesai!='Selesai'";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
?>
<tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff" span class="style1">
<td><?php echo $data['nama'];?> [<?php echo $data['prn'];?>]</td>
<td><?php echo $data['jam_reg'];?></td>
<td><?php echo $data['nama_klinik'];?></td>
<td><?php
	$dokter = $data['dokter'];
	$sql1 = "SELECT * FROM user WHERE username='$dokter'";
    $qry1 = mysql_query($sql1, $koneksi) or die ("gagal Query");
	$data1 =mysql_fetch_array($qry1);
	echo $data1['nama'];
	?></td>
<td><?php
	$kd_kunjungan = $data['kd_kunjungan'];
	$sql2 = "SELECT * FROM tm WHERE kd_kunjungan='$kd_kunjungan'";
    $qry2 = mysql_query($sql2, $koneksi) or die ("gagal Query");
	$data2 =mysql_fetch_array($qry2);
	echo $data2['status_tm'];
	?></td>
<td><div align="center"><a href="tm_view.php?kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>" onClick="NewWindow(this.href,'name','<?php echo $lebar;?>','<?php echo $tinggi;?>','yes');return false">Proses</a></div></td>
<?php
}
?>
</table>
</body>
</html>
