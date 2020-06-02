<?php
include "../librari/inc.koneksidb.php";
include "../librari/inc.session.php";
include "resep_search.php";
$kd_kunjungan = $_REQUEST['kd_kunjungan'];
if ($kd_kunjungan !="") {
   $sql = "SELECT * FROM reg WHERE kd_kunjungan='$kd_kunjungan'";
   $qry = mysql_query($sql,$koneksi)
      or die ("SQL Error".mysql_error());
   $data=mysql_fetch_array($qry);
}
?>
<html>
<head>
<title>RESEP</title>
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
.style1 {
	color: #333333;
	font-style: italic;
}
-->
</style>
<script>
function startCalc(){
interval = setInterval("calc()",1);
}
function calc(){
one = document.form1.qty0.value;
two = document.form1.kaji_awal78.value;
three = document.form1.kaji_awal79.value;
document.form1.kaji_awal80.value = (one*1) + (two*1) + (three*1);
}
function stopCalc(){
clearInterval(interval);
}
</script>
</head>
<body id="tab2">
</hr>
  <table align="left" width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#DBEAF5">
      <tr bgcolor="#FFFFFF">
     	<td width="6%" align="center" bgcolor="#D9E8F3"><b>Cek</b></td>
     	<td width="30%" align="center" bgcolor="#D9E8F3"><b>Nama Obat</b></td>
      	<td width="1%" align="center" bgcolor="#D9E8F3"><b>Qty</b></td>
	    <td width="2%" align="center" bgcolor="#D9E8F3"><b>Stock</b></td>
	    <td width="11%" align="center" bgcolor="#D9E8F3"><b>Aturan</b></td>
	<td width="18%" align="center" bgcolor="#D9E8F3"><b>Rute</b></td>
	<td width="12%" align="center" bgcolor="#D9E8F3"><b>Harga</b></td>
   	<td width="20%" align="center" bgcolor="#D9E8F3"><b>Keterangan</b></td>
   	</tr>
  <form name="form1" method="post" action="resep_sim.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>">

  <tr bgcolor="#FFFFFF">
<?php
$kd_kunjungan=$_GET["kd_kunjungan"];
$q=$_REQUEST['q'];
$query = "SELECT * FROM obat_db,reg WHERE reg.kd_kunjungan='$kd_kunjungan' AND obat_db.nama_obat LIKE '%$q%'";
$hasil = mysql_query($query);
$i = 0;
while ($data = mysql_fetch_array($hasil))
{
?>
   	  <td width="6%" align="center" bgcolor="#FFFFFF"><input type="checkbox" value="<?php echo $data['kd_obat'];?>" name="rx<?php echo $i;?>" /></td>
      	<td width="30%" align="left" bgcolor="#FFFFFF">
	<input name="tanggal_rx" type="hidden" value="<?php echo "".date('Y-m-d');?>" />
    <input name="jam_rx" type="hidden" value="<?php echo "".date('H:i:s');?>" />
	<input name="kd_kunjungan" type="hidden" value="<?php echo $data['kd_kunjungan'];?>"/>
	<input name="username" type="hidden" value="<?php echo $_SESSION['klinik'];?>"/>
	<input name="nama_obat<?php echo $i;?>" type="hidden" value="<?php echo $data['nama_obat'];?>"/><?php echo $data['nama_obat'];?></td>
	<td width="1%" align="left" bgcolor="#FFFFFF"><input type="text" size="4" name="qty<?php echo $i;?>" /></td>
	<td width="2%" align="left" bgcolor="#FFFFFF">
	<?php
	  $kd_obat = $data['kd_obat'];
	  $sql7 = "SELECT kd_obat,SUM(jumlah) FROM obat_stock WHERE kd_obat='$kd_obat' GROUP BY kd_obat";
	  $qry7 = mysql_query($sql7, $koneksi) 
		 	 or die ("SQL Error".mysql_error());
			 while ($data7=mysql_fetch_array($qry7)) {

	  $sql8 = "SELECT kd_item,SUM(qty_item) FROM transaksi  WHERE kd_item='$kd_obat' GROUP BY kd_item";
	  $qry8 = mysql_query($sql8, $koneksi) 
		 	 or die ("SQL Error".mysql_error());
			 while ($data8=mysql_fetch_array($qry8)) {

	  $masuk  = $data7['SUM(jumlah)'];
	  $keluar = $data8['SUM(qty_item)'];
	  $sisa   = $masuk - $keluar;
	  echo "$sisa";

	  }}
	  ?>
	</td>
	<td width="11%" align="left" bgcolor="#FFFFFF"><select name="aturan<?php echo $i;?>" id="aturan">
      <option value="" selected>[Pilih...]</option>
      <?php
	$sql = "SELECT * FROM aturan";
    $qry = @mysql_query($sql, $koneksi) or die ("gagal Query");
	while ($data1 =mysql_fetch_array($qry)) {
	if ($data1[aturan]==$aturan) {
	$cek="selected";
	}
	else {
	$cek="";
	}
	echo "<option value='$data1[aturan]' $cek>".$data1['aturan']."</option>";
	}
	?>
    </select></td>
   	  <td width="18%" align="left" bgcolor="#FFFFFF"><select name="rute<?php echo $i;?>" id="rute">
        <option value="" selected>[Pilih...]</option>
        <?php
	$sql = "SELECT * FROM rute";
      	$qry = @mysql_query($sql, $koneksi) or die ("gagal Query");
	while ($data2 =mysql_fetch_array($qry)) {
	if ($data2[rute]==$rute) {
	$cek="selected";
	}
	else {
	$cek="";
	}
	echo "<option value='$data2[rute]' $cek>".$data2['rute']."</option>";
	}
	?>
      </select></td>
	<td width="12%" align="left" bgcolor="#FFFFFF"><input type="hidden" size="6" value="<?php echo $data['harga_jual'];?>" name="harga<?php echo $i;?>" /><?php echo $data['harga_jual'];?></td>
      <td width="20%" align="left" bgcolor="#FFFFFF"><input type="text" name="keterangan<?php echo $i;?>"><?php $i++;?></td>
   	</tr>
    <?php
}
?>
    <tr bgcolor="#FFFFFF">
   	  <td width="6%" bgcolor="#FFFFFF"><input type="hidden" name="n" value="<?php echo $i; ?>" /></td>
   	  <td colspan="8" bgcolor="#FFFFFF"><input type="submit" name="Submit" value="Tambahkan">
        <span class="style1">      *Batas tampilan data adalah 50, silahkan perbaiki kata kunci jika belum tampil. </span></td>
    </tr>
	  </form>
	  <script>
<!--
/*By George Chiang(JK's JavaScript tutorial)http://javascriptkit.com 
Credit must stay intact for use*/
function show(){
var Digital=new Date()
var hours=Digital.getHours()
var minutes=Digital.getMinutes()
var seconds=Digital.getSeconds()
var dn="AM"
if(hours>11){
dn="PM"
hours=hours-12
}
if (hours==0)
hours=12
if (minutes<=9)
minutes="0"+minutes
if (seconds<=9)
seconds="0"+seconds
document.form1.jam_rx.value=hours+":"+minutes+":"+seconds+" "+dn
setTimeout("show()",1000)
}
show()
//-->
</script>
</table>
</body>
</html></br></br>