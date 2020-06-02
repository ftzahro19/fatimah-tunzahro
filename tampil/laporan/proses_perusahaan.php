<?php
include "../librari/inc.koneksidb.php";
include "../librari/inc.umum.php";
$kd_asuransi= $_REQUEST['kd_asuransi'];
$bydate1	= $_REQUEST['bydate1'];
$bydate2	= $_REQUEST['bydate2'];
?>
<html>
<head>
<title>Laporan Pasien Perusahaan <?php echo $bydate1;?> sd <?php echo $bydate1;?></title>
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
<h3 align="center">KLINIK KAREO MEDIKA</h3>
<h3 align="center">REKAPITULASI PENGOBATAN KARYAWAN</h3>
<?php
// koneksi ke mysql
$query2 = "SELECT * FROM asuransi_db WHERE kd_asuransi='$kd_asuransi'";
$hasil2 = mysql_query($query2);
$data2 = mysql_fetch_array($hasil2);
?>
<h3 align="center"><?php echo $data2['nama_asuransi'];?></h3>
<h4 align="center">Tanggal <?php echo $bydate1;?> sd <?php echo $bydate2;?>
<form> 
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
 <tr bgcolor="#D9E8F3">
    <td width="5%"><div align="center">No</div></td>
    <td width="10%"><div align="center">Tanggal</div></td>
    <td width="25%">Nama Pasien</td>
    <td width="10%">No. Pasien</td>
    <td width="15%">Tagihan</td>
	<td width="15%">Dokter</td>
    <td width="20%">Keterangan</td>
 </tr>
<?php
// koneksi ke mysql
$query = "SELECT * FROM reg a,data_pasien b, user c
			WHERE a.prn=b.prn
			AND a.dokter=c.username
			AND kd_asuransi='$kd_asuransi'
			AND a.batal='Tidak'
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
    <td class="style1">
	<?php 
	$query2 = "SELECT SUM(pribadi) FROM transaksi WHERE kd_kunjungan='$data[kd_kunjungan]'";
	$hasil2 = mysql_query($query2);
	$data2 = mysql_fetch_array($hasil2);
	echo $data2['SUM(pribadi)'];
	$sub_total = $data2['SUM(pribadi)'];
	$total = $total + $sub_total;
	?></td>
	<td class="style1"><?php echo $data['nama_user'];?></td>
	<td class="style1"><?php echo $data['selesai'];?></td>
  </tr>
  <?php
	}
  ?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
  <td colspan="7">Total Tagihan : <?php echo $total;?></td>
  </tr>

</table>
<input class="noPrint" type="button" value="Print" onClick="window.print()">
</form>
</p>
</body>
</html>

