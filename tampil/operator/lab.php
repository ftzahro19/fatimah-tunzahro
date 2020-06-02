<?php 
include "../librari/inc.koneksidb.php";
include "tab_dokter.php";
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
.style1 {font-size: 16px}
-->
</style>
</head>
<body id="tab3">
</hr>
  <table align="left" width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
    <tr bgcolor="#FFFFFF">
   	<td width="3%" align="center" bgcolor="#D9E8F3"><b>Cek</b></td>
   	<td width="66%" align="center" bgcolor="#D9E8F3"><b>Nama Lab</b></td>
   	<td width="31%" align="center" bgcolor="#D9E8F3"><b>Keterangan</b></td>
   	</tr>
  <form name="form1" method="post" action="lab_sim.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>">
  <tr bgcolor="#FFFFFF">
<?php
$query = "SELECT * FROM lab_db";
$hasil = mysql_query($query);
$i = 0;
while ($data = mysql_fetch_array($hasil))
{
?>
   	<td width="3%" align="center" bgcolor="#FFFFFF"><input type="checkbox" value="<?php echo $data['kd_lab'];?>" name="lx<?php echo $i;?>" />
	<input name="kd_kunjungan" type="hidden" value="<?php echo $kd_kunjungan;?>"/>
    <input name="tanggal_lab" type="hidden" value="<?php echo "".date('Y-m-d');?>" />
    <input name="jam_lab" type="hidden" value="<?php echo "".date('H:i');?>" />
	<input name="dr_pengirim" type="hidden" value="<?php echo $_SESSION['klinik'];?>"/>
	</td>
   	<td width="66%" align="left" bgcolor="#FFFFFF"><input type="hidden" size="4" value="<?php echo $data['nama_lab'];?>" name="nama_lab<?php echo $i;?>" />
	<?php echo $data['nama_lab'];?></td>
	<td width="31%" align="left" bgcolor="#FFFFFF"><input type="text" size="6" value="<?php echo $data['harga_lab'];?>" name="harga_lab<?php echo $i;?>" /><?php $i++;?></td>
   	</tr>
    <?php
}
?>
    <tr bgcolor="#FFFFFF">
   	  <td width="3%" bgcolor="#FFFFFF"><input type="hidden" name="n" value="<?php echo $i; ?>" /></td>
   	  <td colspan="7" bgcolor="#FFFFFF"><input type="submit" name="Submit" value="Tambahkan"></td>
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
document.form1.jam_dx.value=hours+":"+minutes+":"+seconds+" "+dn
setTimeout("show()",1000)
}
show()
//-->
</script>
</table>
</body>
</html>
