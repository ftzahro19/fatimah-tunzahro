<?php
include "../librari/inc.koneksidb.php";
include "../librari/inc.umum.php";
$bydate1	= $_REQUEST['bydate1'];
$bydate2	= $_REQUEST['bydate2'];
?>
<html>
<head>
<title>Laporan Kunjungan Pasien <?php echo $bydate1;?> sd <?php echo $bydate1;?></title>
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
input.noPrint { display: none; }
}
@page 
        {
            size: auto;   /* auto is the initial value */
			margin: 20mm;
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
<h3 align="center">LAPORAN KUNJUNGAN</h3>
<h4 align="center">Tanggal <?php echo $bydate1;?> sd <?php echo $bydate2;?>
<form> 
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
 <tr bgcolor="#D9E8F3">
    <td width="5%"><div align="center">No</div></td>
    <td width="15%"><div align="center">Tanggal</div></td>
    <td width="25%">Nama Pasien</td>
    <td width="15%">PRN</td>
    <td width="20%">Klinik</td>
	<td width="20%">Dokter</td>
    <td width="20%">Keterangan</td>
 </tr>
<?php
// koneksi ke mysql
$query = "SELECT * FROM data_pasien a,reg b,klinikdb c,user d
			WHERE a.prn=b.prn 
			AND b.klinik=c.kd_klinik
			AND b.dokter=d.username
			AND b.batal='Tidak'
			AND tgl_reg>='$bydate1' 
			AND tgl_reg<='$bydate2'";
$hasil = mysql_query($query);
$no=1;
while ($data = mysql_fetch_array($hasil))
{
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><?php echo $no++;?></td>
    <td class="style1"><?php echo $data['tgl_reg'];?></td>
    <td class="style1"><?php echo $data['nama'];?></td>
    <td class="style1"><?php echo $data['prn'];?></td>
    <td class="style1"><?php echo $data['nama_klinik'];?></td>
	<td class="style1"><?php echo $data['nama_user'];?></td>
	<td class="style1"><?php echo $data[''];?></td>
  </tr>
<?php
}
?>
</table>
<input class="noPrint" type="button" value="Print" onClick="window.print()">
</form>
</p>
</body>
</html>

