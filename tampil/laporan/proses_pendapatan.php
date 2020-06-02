<?php
include "../librari/inc.koneksidb.php";
include "../librari/inc.umum.php";
$bydate1	= $_REQUEST['bydate1'];
$bydate2	= $_REQUEST['bydate2'];
?>
<html>
<head>
<title>Laporan Pemasukan Klinik <?php echo $bydate1;?> sd <?php echo $bydate1;?></title>
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
<h3 align="center">Laporan Pemasukan Klinik</h3>
<h4 align="center">Tanggal <?php echo $bydate1;?> sd <?php echo $bydate2;?>
<form> 
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
 <tr bgcolor="#D9E8F3">
    <td width="5%"><div align="center">No</div></td>
    <td width="13%"><div align="center">Kode Visit</div></td>
    <td width="47%">Nama item</td>
    <td width="12%">Nominal</td>
    <td width="23%">Keterangan</td>
 </tr>
<?php
// koneksi ke mysql
$query = "SELECT * FROM reg,transaksi WHERE reg.batal='Tidak'
			AND reg.kd_kunjungan=transaksi.kd_kunjungan 
			AND tanggal_trx>='$bydate1' 
			AND tanggal_trx<='$bydate2'";
$hasil = mysql_query($query);
$no=1;
while ($data = mysql_fetch_array($hasil))
{
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><?php echo $no++;?></td>
    <td class="style1"><?php echo $data['kd_kunjungan'];?></td>
    <td class="style1"><?php echo $data['nama_item'];?></td>
    <td class="style1"><?php echo $data['pribadi'];?></td>
    <td class="style1">	</td>
  </tr>
<?php
}
?>
  <tr bgcolor="#D9E8F3">
    <td colspan="3"><div align="right">Total Pemasukan : </div></td>
    <td colspan="2"><?php
	$query2 = "SELECT SUM(pribadi) FROM reg,transaksi WHERE reg.batal='Tidak'
			AND reg.kd_kunjungan=transaksi.kd_kunjungan
			AND tanggal_trx>='$bydate1' 
			AND tanggal_trx<='$bydate2'";
	$hasil2 = mysql_query($query2);
	$data2 = mysql_fetch_array($hasil2);
	$pribadi = $data2['SUM(pribadi)'];
	$total_pribadi = $total_pribadi+$pribadi;
	echo $pribadi;
	?>
    </td>
  </tr>
</table>
<input class="noPrint" type="button" value="Print" onClick="window.print()">
</form>
</p>
</body>
</html>

