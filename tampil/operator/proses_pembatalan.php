<?php
include "../librari/inc.koneksidb.php";
include "../librari/inc.umum.php";
$bydate1	= $_REQUEST['bydate1'];
?>
<html>
<head>
<title>Daftar Pasien <?php echo $bydate1;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<style type="text/css">
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
<style>
@media print {
    .footer,
    #non-printable {
        display: none !important;
    }
    #printable {
        display: block;
    }
}


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
<body>
<h3 align="center">DAFTAR PASIEN</h3>
<h4 align="center">Tanggal <?php echo $bydate1;?>
<form> 
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
 <tr bgcolor="#D9E8F3">
    <td width="5%"><div align="center">No</div></td>
	<td width="10%"><div align="center">Tanggal</div></td>
    <td width="15%"><div align="center">No Visit</div></td>
    <td width="15%"><div align="center">Nama</div></td>
    <td width="10%"><div align="center">No Medrek</div></td>
	<td width="15%"><div align="center">Dokter</div></td>
    <td width="15%"><div align="center">Status</div></td>
	<td width="15%"><div align="center">Batal</div></td>
 </tr>
<?php
// koneksi ke mysql
$query = "SELECT * FROM data_pasien a,reg b WHERE a.prn=b.prn AND tgl_reg>='$bydate1'";
$hasil = mysql_query($query);
$no=1;
while ($data = mysql_fetch_array($hasil))
{
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><div align="center"><?php echo $no++;?></div></td>
	<td class="style1"><?php echo $data['tgl_reg'];?></td>
    <td class="style1"><?php echo $data['kd_kunjungan'];?></td>
    <td class="style1"><?php echo $data['nama'];?></td>
    <td class="style1"><?php echo $data['prn'];?></td>
	<td class="style1"><?php echo $data['dokter'];?></td>
	<td class="style1"><?php echo $data['selesai'];?></td>
	<td class="style1"><div align="center">
	<?php
	if ($data['batal']=="Tidak") {
	echo "Tidak | <a href='pembatalan_selesai.php?kd_kunjungan=".$data['kd_kunjungan']."&tgl_reg=".$data['tgl_reg']."'>Batalkan</a>";
	}
	else {
	echo "<a href='pembatalan_batalkan.php?kd_kunjungan=".$data['kd_kunjungan']."&tgl_reg=".$data['tgl_reg']."'>Tidak</a> | Batalkan";
	}
	?></div></td>
  </tr>
<?php
}
?>
  <tr bgcolor="#D9E8F3">
    <td colspan="8">Jumlah pasien :</td>
    </td>
  </tr>
</table>
</body>
</html>

