<?php
include "../librari/inc.koneksidb.php";
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
<title>TINDAKAN</title>
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
-->
</style>
</head>
<body id="tab2">
</hr>
  <table align="left" width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#DBEAF5">
      <tr bgcolor="#FFFFFF">
     	<td width="5%" align="center" bgcolor="#D9E8F3"><b>Cek</b></td>
     	<td width="42%" align="center" bgcolor="#D9E8F3"><b>Nama Tindakan </b></td>
	<td width="10%" align="center" bgcolor="#D9E8F3"><b>Harga</b></td>
      	<td width="11%" align="center" bgcolor="#D9E8F3"><b>Operator</b></td>
      	<td width="21%" align="center" bgcolor="#D9E8F3"><strong>Keterangan</strong></td>
   	</tr>
  <form name="form1" method="post" action="tm_sim.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>">

  <tr bgcolor="#FFFFFF">
<?php
$kd_kunjungan=$_GET["kd_kunjungan"];
$q=$_GET["q"];
$query = "SELECT * FROM tm_db,reg WHERE reg.kd_kunjungan='$kd_kunjungan' AND tm_db.nama_tm LIKE '%".$q."%'";
$hasil = mysql_query($query);
$no = 1;
while ($data = mysql_fetch_array($hasil))
{
?>
   	  <td width="5%" align="center" bgcolor="#FFFFFF"><input type="checkbox" value="<?php echo $data['kd_tm'];?>" name="kd_tm<?php echo $no;?>" /></td>
      	<td width="42%" align="left" bgcolor="#FFFFFF"><input name="nama_tm<?php echo $no;?>" type="hidden" value="<?php echo $data['nama_tm'];?>"/>
          <input name="kd_kunjungan" type="hidden" value="<?php echo $data['kd_kunjungan'];?>"/>
          <input name="tanggal_tm" type="hidden" value="<?php echo "".date('Y-m-d');?>" />
          <input name="jam_tm" type="hidden" value="<?php echo "".date('H:i');?>" />
          <?php echo $data['nama_tm'];?> [<?php echo $data['gol_tm'];?>]</td>
   	  <td width="10%" align="left" bgcolor="#FFFFFF"><input type="hidden" size="6" value="<?php echo $data['harga_tm'];?>" name="harga_tm<?php echo $no;?>" />
   	    <input type="hidden" size="6" value="<?php echo $data['jasa_tm'];?>" name="jasa_tm<?php echo $no;?>" />
      <?php echo $data['harga_tm'];?></td>
      <td width="11%" align="left" bgcolor="#FFFFFF"><select name="operator<?php echo $no;?>" id="operator">
        <option value="" selected>[Pilih...]</option>
        <?php
	$sql = "SELECT * FROM user";
    $qry = @mysql_query($sql, $koneksi) or die ("gagal Query");
	while ($data2 =mysql_fetch_array($qry)) {
	if ($data2[username]==$operator) {
	$cek="selected";
	}
	else {
	$cek="";
	}
	echo "<option value='$data2[username]' $cek>".$data2['username']."</option>";
	}
	?>
      </select></td>
      <td width="21%" align="left" bgcolor="#FFFFFF"><input type="text" size="25" name="keterangan_tm<?php echo $no;?>" /><?php $no++;?></td>
   	</tr>
    <?php
}
?>
    <tr bgcolor="#FFFFFF">
   	  <td width="5%" bgcolor="#FFFFFF"><input type="hidden" name="jumMK" value="<?php echo $no-1; ?>" /></td>
      	<td colspan="4" bgcolor="#FFFFFF"><input type="submit" name="Submit" value="Tambahkan"></td>
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
document.form1.jam_tm.value=hours+":"+minutes+":"+seconds+" "+dn
setTimeout("show()",1000)
}
show()
//-->
</script>
</table>
</body>
</html></br></br>
