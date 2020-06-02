<?php 
include "../librari/inc.koneksidb.php"; 
include "tab_order_poli.php";
?>
<html>
<head>
<title>RIWAYAT BEROBAT</title>
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
<body id="tab8">
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
	<tr bgcolor="#FFFFFF">
      <td width="16%" bgcolor="#D9E8F3"><div align="center"><strong>No Kunjungan </strong></div></td>
      <td width="23%" bgcolor="#D9E8F3"><div align="center"><strong>Nama [ PRN ]</strong></div></td>
      <td width="15%" bgcolor="#D9E8F3"><div align="center"><strong>Tanggal Berobat </strong></div></td>
      <td width="21%" bgcolor="#D9E8F3"><div align="center"><strong>Klinik</strong></div></td>
      <td width="20%" bgcolor="#D9E8F3"><div align="center"><strong>Dokter</strong></div></td>
      <td width="5%" bgcolor="#D9E8F3"><strong></strong></td>
    </tr>
<?php 
	$prn = $_REQUEST['prn'];
	$sql = "SELECT * FROM data_pasien,reg WHERE data_pasien.prn=reg.prn AND data_pasien.prn='$prn'";
	$qry = mysql_query($sql, $koneksi);
	while($data = mysql_fetch_array($qry)){
  ?>
   <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff" span class="style1">
	<td><?php echo $data['kd_kunjungan'];?> </td>
      <td><?php echo $data['nama'];?> [<?php echo $data['prn'];?>]</td>
      <td><?php echo $data['tgl_reg'];?></td>
      <td><?php echo $data['klinik'];?></td>      
      <td><?php echo $data['dokter'];?></td>
<td width="5%" bgcolor="#FFFFFF">
<div align="center"><a href="emr_view.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>" onClick="NewWindow(this.href,'name','800','400','yes');return false"><b>Lihat </b>
</a>
</div></td>
</tr>
<?php
}
?>
  </table>
</body>
</html>
