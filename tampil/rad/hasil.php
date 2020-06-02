<?php
include "../librari/inc.koneksidb.php";
include "../librari/inc.session.php";
include "../librari/terbilang.php";
include "../librari/fungsi_indotgl.php";
?>
<html>
<head>
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
<title>HASIL RADIOLOGI</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252"><style type="text/css">
<!--
a:link {
	color: #000080;
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
<body id="tab5">
  <table align="center" width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
 <tr bgcolor="#FFFFFF">
    <td width="2%" bgcolor="#D9E8F3"><div align="center"></div>    </td>
    <td width="8%" bgcolor="#D9E8F3"><div align="center">Tanggal</div></td>
    <td width="7%" bgcolor="#D9E8F3"><div align="center">Jam Order </div></td>
    <td width="22%" bgcolor="#D9E8F3"><div align="center">Nama Pasien [PRN]</div></td>
    <td width="14%" bgcolor="#D9E8F3"><div align="center">Pengirim</div></td>
    <td width="20%" bgcolor="#D9E8F3"><div align="center">Keterangan</div></td>
    <td width="16%" bgcolor="#D9E8F3">Status</td>
    <td width="11%" bgcolor="#D9E8F3"><div align="center"></div></td>
 </tr>

<?php
// query untuk mencari file berdasarkan kategori
$query = "SELECT * FROM data_pasien,reg,rad WHERE data_pasien.prn=reg.prn AND reg.selesai!='Selesai' AND reg.kd_kunjungan=rad.kd_kunjungan AND rad.status='Selesai' GROUP BY rad.kd_kunjungan";
$hasil = mysql_query($query);
$i = 1;
while ($data = mysql_fetch_array($hasil))
{
$tanggal = tgl_indo($data['tanggal_rad']);
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1">
    <div align="center"><?php echo $i++;?>    </div></td>
    <td class="style1"><?php echo $tanggal;?></td>
    <td class="style1"><?php echo $data['jam_rad'];?></td>
    <td class="style1"><?php echo $data['nama'];?></td>
    <td class="style1"><?php echo $data['dr_pengirim'];?></td>
    <td class="style1"><?php echo $data['keterangan'];?></td>   
    <td class="style1"><?php echo $data['status'];?>
    <?php $i++;?></td>
    <td class="style1"><a href="rad_view.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>"><b>Lihat</b></a></td>
  </tr>
  <?php
}
?>
</table>
</div>
</body>
</html>


