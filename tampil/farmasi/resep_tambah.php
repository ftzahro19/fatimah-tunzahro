<?php
include "../librari/inc.koneksidb.php";
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
</head>
<body id="tab2">
</hr>
  <table align="left" width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#DBEAF5">
      <tr bgcolor="#FFFFFF">
     	<td width="6%" align="center" bgcolor="#D9E8F3"><b>Cek</b></td>
     	<td width="30%" align="center" bgcolor="#D9E8F3"><b>Nama Obat</b></td>
      	<td width="3%" align="center" bgcolor="#D9E8F3"><b>Qty</b></td>
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
$no = 1;
while ($data = mysql_fetch_array($hasil))
{
?>
   	  <td width="6%" align="center" bgcolor="#FFFFFF"><input type="checkbox" value="<?php echo $data['kd_obat'];?>" name="rx<?php echo $no;?>" /></td>
      	<td width="30%" align="left" bgcolor="#FFFFFF">
	<input name="tanggal_rx" type="hidden" value="<?php echo "".date('Y-m-d');?>" />
    <input name="jam_rx" type="hidden" value="<?php echo "".date('H:i:s');?>" />
	<input name="kd_kunjungan" type="hidden" value="<?php echo $data['kd_kunjungan'];?>"/>
		<input name="nama_obat<?php echo $no;?>" type="hidden" value="<?php echo $data['nama_obat'];?>"/><?php echo $data['nama_obat'];?></td>
	<td width="3%" align="left" bgcolor="#FFFFFF"><input type="text" size="4" name="qty<?php echo $no;?>" /></td>
	<td width="11%" align="left" bgcolor="#FFFFFF"><select name="aturan<?php echo $no;?>" id="aturan">
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
   	  <td width="18%" align="left" bgcolor="#FFFFFF"><select name="rute<?php echo $no;?>" id="rute">
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
	<td width="12%" align="left" bgcolor="#FFFFFF"><input type="hidden" size="6" value="<?php echo $data['harga_jual'];?>" name="harga<?php echo $no;?>" /><?php echo $data['harga_jual'];?></td>
      <td width="20%" align="left" bgcolor="#FFFFFF"><input type="text" name="keterangan<?php echo $no;?>"><?php $no++;?></td>

   	</tr>
    <?php
}
?>
    <tr bgcolor="#FFFFFF">
   	  <td width="6%" bgcolor="#FFFFFF"><input type="hidden" name="jumMK" value="<?php echo $no-1; ?>" /></td>
   	  <td colspan="7" bgcolor="#FFFFFF"><input type="submit" name="Submit" value="Tambahkan">
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
