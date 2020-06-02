<?php 
include "../librari/inc.koneksidb.php";
include "../../config/config.php";
?>
<html>
<head>
<title>Daftar pasien per tanggal <?php echo date("d-m-Y");?></title>
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
</head>
<body id="tab1">
<H1>ANTRIAN PASIEN </H1>
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td colspan="8">TANGGAL <?php echo date("d-m-Y");?></td>
</tr> 
<tr bgcolor="#D9E8F3">
  <td width="6%" align="center"><b>NO</b></td>
  <td width="8%" align="center"><b>TANGGAL</b></td>
  <td width="6%" align="center"><b>JAM</b></td>
  <td width="27%" align="center"><b>NAMA [PRN]</b></td>
  <td width="20%" align="center"><b>KLINIK</b></td>
  <td width="15%" align="center"><b>DOKTER</b></td>
  <td width="10%"><b>STATUS</b></td>
  <td width="8%">&nbsp;</td>
</tr>
<?php 
	$hari_ini = date('Y-m-d');
	$sql = "SELECT * FROM data_pasien,reg,klinikdb WHERE  data_pasien.prn=reg.prn AND reg.klinik=klinikdb.kd_klinik AND tgl_reg='$hari_ini'";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
	$no++;
?>
<tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff" span class="style1">
<td align="center"><?php echo $no;?></td>
<td align="center"><?php echo $data['tgl_reg'];?></td>
<td align="center"><?php echo $data['jam_reg'];?></td>
<td><?php echo $data['nama'];?> [<?php echo $data['prn'];?>]</td>
<td align="center"><?php echo $data['nama_klinik'];?></td>
<td align="center"><?php echo $data['dokter'];?></td>
<td width="10%">
<div align="center"><a href="<?php echo $url;?>tampil/antrian/terbilang.php?bilangan=<?php echo $data['prn'];?>&spesialis=<?php echo $data['nama_klinik'];?>"onClick="NewWindow(this.href,'name','400','300','yes');return false"><?php echo $data['selesai'];?></a></div></td>
<td width="8%"><div align="center"><a href="<?php echo $url;?>tampil/registrasi/reg_edit.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>">Update</a></div></td>
</tr>
<?php
}
?>
</table>
</body>
</html>
