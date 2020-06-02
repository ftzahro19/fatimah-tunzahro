<?php
mysql_connect("localhost","root","12345678") or die("Gagal Akses Server");
mysql_select_db("klinikdb") or die("Gagal Akses Database");
$hari_ini=date("Y-n-j");
$query="SELECT tanggal,antrian FROM tb_antrian WHERE tanggal='$hari_ini' LIMIT 1";
$result=mysql_query($query) or die(mysql_error());
if(mysql_num_rows($result)>0)
{
	$row=mysql_fetch_array($result);
	$antrian=$row['antrian'];
	$query="UPDATE tb_antrian set antrian=antrian+1 WHERE tanggal='$hari_ini' LIMIT 1";
	mysql_query($query) or die(mysql_error());
}
else
{
	$antrian=1;
	$query="INSERT INTO tb_antrian(tanggal,antrian) VALUES('$hari_ini',1)";
	mysql_query($query) or die(mysql_error());
}
if(strlen($antrian)<2) $antrian="0".$antrian;
echo "<h1>Nomor Antrian : ".$antrian."</h1>";
?>