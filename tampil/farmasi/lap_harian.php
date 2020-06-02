<?php
include "../librari/inc.session.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.resolusi.php";
?>
<html>
<head>
<title>LAPORAN HARIAN FARMASI</title>
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
<h3><div align="center">LAPORAN HARIAN FARMASI</div></h3>
<div align="center">Tanggal : <?php echo "".date('d-m-Y') ;?></div>
<form>
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
 <tr bgcolor="#CCCCCC">
   <td bgcolor="#CCCCCC" align="center">Nama Obat </td>
   <td bgcolor="#CCCCCC" align="center">Qty</td>
   <td bgcolor="#CCCCCC" align="center">Harga</td>
   <td bgcolor="#CCCCCC" align="center">Sub Total     </td>
   </tr>
<?php
$tanggal= date('Y-m-d') ;
$tanggal2= date('d-m-Y') ;
// query untuk mencari file berdasarkan kategori
$query = "SELECT * FROM data_pasien,reg,resep WHERE data_pasien.prn=reg.prn AND reg.kd_kunjungan=resep.kd_kunjungan AND resep.tanggal_rx='$tanggal' GROUP BY resep.kd_kunjungan";
$hasil = mysql_query($query);
$num_rows = mysql_num_rows($hasil);
while ($data = mysql_fetch_array($hasil))
{
?>
 <tr bgcolor="#FFFFFF">
   <td width="25%" bgcolor="#D9E8F3">Nama : <span class="style1"><?php echo $data['nama'];?></span></td>
   <td colspan="2" bgcolor="#D9E8F3">PRN : <span class="style1"><?php echo $data['prn'];?></span></td>
   <td width="40%" bgcolor="#D9E8F3">No Kunjungan : <span class="style1"><?php echo $data['kd_kunjungan'];?></span></td>
</tr>
 <?php
// query untuk mencari file berdasarkan kategori
$kd_kunjungan = $data['kd_kunjungan'];
$query2 = "SELECT * FROM resep WHERE kd_kunjungan='$kd_kunjungan' AND status!='Batal'";
$hasil2 = mysql_query($query2);
$num_rows2 = mysql_num_rows($hasil2);
$i=1;
while ($data2 = mysql_fetch_array($hasil2))
{
?>
 <tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF"><div align="left"><span class="style1"><?php echo $data2['nama_obat'];?></span></div></td>
    <td width="15%" bgcolor="#FFFFFF"><div align="left"><span class="style1"><?php echo $data2['qty'];?></span></div></td>
    <td width="20%" bgcolor="#FFFFFF"><span class="style1"><?php echo $data2['harga'];?></span></td>
	<?php 
	$qty = $data2['qty'] * 1;
	$harga = $data2['harga'] * 1;
	$sub_total = $qty * $harga;
	$total = $total + $sub_total;
	?>
    <td bgcolor="#FFFFFF"><div align="center"><?php echo $sub_total;?></div></td>
    </tr>
 <?php
 }
 ?>
  
   <?php
 }
 ?>
  <tr bgcolor="#FFFFFF">
    <td colspan="2">Jumlah : <?php echo $num_rows;?> resep</td>
    <td>Total pendapatan </td>
    <td>: Rp. <?php echo $total;?>,-</td>
    </tr>
</table>
</br>
<?php
$query3 = "SELECT * FROM data_klinik";
$hasil3 = mysql_query($query3);
$data3 = mysql_fetch_array($hasil3);
echo "".$data3['alamat2'].", ".$tanggal2."</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "".$_SESSION['nama']."";
echo "</br>";
?>
    <input class="noPrint" type="button" value="Print" onClick="window.print()">
</form>
</body>
</html>