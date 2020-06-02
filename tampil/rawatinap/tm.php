<?php
include "../librari/inc.koneksidb.php";
include "../librari/inc.session.php";
include "tm_search.php";
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
.style3 {
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
     	<td width="2%" align="center" bgcolor="#D9E8F3"><strong>O</strong></td>
	    <td width="42%" align="center" bgcolor="#D9E8F3"><b>Nama Tindakan </b></td>
	    <td width="21%" align="center" bgcolor="#D9E8F3"><b>Harga</b></td>
	    <td width="31%" align="center" bgcolor="#D9E8F3"><strong>Keterangan</strong></td>
   	</tr>
  <form name="form1" method="post" action="tm_sim.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>">

  <tr bgcolor="#FFFFFF">
<?php
$kd_kunjungan=$_REQUEST["kd_kunjungan"];
$q=$_REQUEST["q"];
$query = "SELECT * FROM tm_db,reg WHERE reg.kd_kunjungan='$kd_kunjungan' AND tm_db.nama_tm LIKE '%$q%' LIMIT 30";
$hasil = mysql_query($query);
$i = 0;
while ($data = mysql_fetch_array($hasil))
{
?>
   	  <td align="center" bgcolor="#FFFFFF">
	  <input type="checkbox" value="<?php echo $data['kd_tm'];?>" name="kd_tm<?php echo $i;?>" /></td>
      	<td align="left" bgcolor="#FFFFFF"><input name="nama_tm<?php echo $i;?>" type="hidden" value="<?php echo $data['nama_tm'];?>"/>
		  <input type="hidden" value="<?php echo $_SESSION['klinik'];?>" name="operator" />
          <input name="kd_kunjungan" type="hidden" value="<?php echo $data['kd_kunjungan'];?>"/>
          <input name="tanggal_tm" type="hidden" value="<?php echo "".date('Y-m-d');?>" />
          <input name="jam_tm" type="hidden" value="<?php echo "".date('H:i');?>" />
          <?php echo $data['nama_tm'];?> [<?php echo $data['gol_tm'];?>]</td>
      <td align="left" bgcolor="#FFFFFF"><input type="hidden" size="6" value="<?php echo $data['harga_tm'];?>" name="harga_tm<?php echo $i;?>" />
      	  <input type="hidden" size="6" value="<?php echo $data['jasa_tm'];?>" name="jasa_tm<?php echo $i;?>" />
   	    <?php echo $data['harga_tm'];?></td>
	<td align="left" bgcolor="#FFFFFF"><input type="text" size="25" name="keterangan_tm<?php echo $i;?>" /><?php $i++;?></td>
   	</tr>
    <?php
}
?>
    <tr bgcolor="#FFFFFF">
   	  <td bgcolor="#FFFFFF"><input type="hidden" name="n" value="<?php echo $i; ?>" /></td>
   	  <td colspan="4" bgcolor="#FFFFFF"><input type="submit" name="Submit" value="Tambahkan">
   	    <span class="style3">      	*Batas tampilan data adalah 50, silahkan perbaiki kata kunci jika belum tampil. </span></td>
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