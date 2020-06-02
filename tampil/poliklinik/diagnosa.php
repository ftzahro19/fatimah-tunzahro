<?php
include "../librari/inc.koneksidb.php";
include "../librari/inc.session.php";
include "diagnosa_search.php";
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
<title>diagnosa</title>
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
<body id="tab6">
</hr>
<table align="left" width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#DBEAF5">
  <tr bgcolor="#FFFFFF">
    <td width="5%" align="center" bgcolor="#D9E8F3"><b>Cek</b></td>
    <td width="12%" align="center" bgcolor="#D9E8F3"><b>ICD-X</b></td>
    <td width="57%" align="center" bgcolor="#D9E8F3"><b>Diagnosa Medis</b></td>
    <td width="26%" align="center" bgcolor="#D9E8F3"><b>Keterangan</b></td>
  </tr>
  <form name="form1" method="post" action="diagnosa_sim.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>">
    <tr bgcolor="#FFFFFF">
<?php
$kd_kunjungan=$_GET["kd_kunjungan"];
$q=$_REQUEST['q'];
$query = "SELECT * FROM mrconso WHERE STR LIKE '%$q%' LIMIT 100";
$hasil = mysql_query($query);
$i = 0;
while ($data = mysql_fetch_array($hasil))
{
?>
      <td width="5%" align="center" bgcolor="#FFFFFF"><input type="checkbox" value="<?php echo $data['CODE'];?>" name="dx<?php echo $i;?>" />
	  </td>
      <td width="12%" align="left" bgcolor="#FFFFFF">
	  <?php echo $data['CODE'];?>
	  <input name="tanggal_dx" type="hidden" value="<?php echo "".date('Y-m-d');?>" />
    <input name="jam_dx" type="hidden" value="<?php echo "".date('H:i:s');?>" />
	<input name="kd_kunjungan" type="hidden" value="<?php echo $kd_kunjungan;?>"/>
	<input name="username" type="hidden" value="<?php echo $_SESSION['klinik'];?>"/>
      </td>
      <td width="57%" align="left" bgcolor="#FFFFFF">
	  <?php echo $data['STR'];?>
	  <input name="nama_diagnosa<?php echo $i;?>" type="hidden" value="<?php echo $data['STR'];?>">
	  <td width="26%" align="left" bgcolor="#FFFFFF"><input type="text" name="keterangan<?php echo $i;?>">
          <?php $i++;?>
	  </td>
    </tr>
    <?php
}
?>
    <tr bgcolor="#FFFFFF">
      <td width="5%" bgcolor="#FFFFFF"><input type="hidden" name="n" value="<?php echo $i; ?>" /></td>
      <td colspan="8" bgcolor="#FFFFFF"><input type="submit" name="Submit" value="Tambahkan">
          <span class="style1"> *Batas tampilan data adalah 50, silahkan perbaiki kata kunci jika belum tampil. </span></td>
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
</html></br></br>