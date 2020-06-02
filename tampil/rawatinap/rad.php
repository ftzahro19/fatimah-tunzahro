<?php 
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.session.php";
include "rad_search.php";
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
<title>RADIOLOGI</title>
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
<body>
</hr>
  <table align="left" width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
      <tr bgcolor="#FFFFFF">
     	<td width="3%" align="center" bgcolor="#D9E8F3"><b>Cek</b></td>
     	<td width="54%" align="center" bgcolor="#D9E8F3"><b>Item Radiologi </b></td>
      	<td width="13%" align="center" bgcolor="#D9E8F3"><b>Harga</b></td>
	<td width="30%" align="center" bgcolor="#D9E8F3"><b>Keterangan</b></td>
   	</tr>
  <form name="form1" method="post" action="rad_sim.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>">
    <input name="kd_kunjungan" type="hidden" value="<?php echo $data['kd_kunjungan'];?>"/>
    <input name="tanggal_rad" type="hidden" value="<?php echo "".date('Y-m-d');?>" />
    <input name="jam_rad" type="hidden" value="<?php echo "".date('H:i');?>" />
	<input name="dr_pengirim" type="hidden" value="<?php echo "".$_SESSION['klinik']."";?>"/>
  <tr bgcolor="#FFFFFF">
<?php
$kd_kunjungan=$_GET["kd_kunjungan"];
$q=$_REQUEST['q'];
$query = "SELECT * FROM rad_db WHERE nama_rad LIKE '%$q%'";
$hasil = mysql_query($query);
$i = 0;
while ($data = mysql_fetch_array($hasil))
{
?>
   	  <td width="3%" align="center" bgcolor="#FFFFFF"><input type="checkbox" value="<?php echo $data['kd_rad'];?>" name="rad<?php echo $i;?>" /></td>
      	<td width="54%" align="left" bgcolor="#FFFFFF"><input type="hidden" value="<?php echo $data['nama_rad'];?>" name="nama_rad<?php echo $i;?>" />
		<?php echo $data['nama_rad'];?></td>
	<td width="13%" align="left" bgcolor="#FFFFFF"><input type="text" size="6" value="<?php echo $data['harga_rad'];?>" name="harga_rad<?php echo $i;?>" /></td>
	<td width="30%" align="left" bgcolor="#FFFFFF"><input type="text" size="30" name="ket<?php echo $i;?>"/><?php $i++;?></td>
   	</tr>
    <?php
}
?>
    <tr bgcolor="#FFFFFF">
   	  <td width="3%" bgcolor="#FFFFFF"><input type="hidden" name="n" value="<?php echo $i; ?>" /></td>
      	<td colspan="5" bgcolor="#FFFFFF"><input type="submit" name="Submit" value="Tambahkan"></td>
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
