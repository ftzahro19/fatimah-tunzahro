<?php

// script untuk reset password admin dan perbaiki tabel

include "koneksi.php";

$query = "SHOW TABLES";
$hasil = mysql_query($query);
while ($data = mysql_fetch_row($hasil))
{
	$query2 = "REPAIR TABLE `".$data[0]."`";
	$hasil2 = mysql_query($query2);
	$data2  = mysql_fetch_array($hasil2);
	echo $query2."<br>".$data2[3]."<br><br>";
}

$query = "INSERT INTO `sms_user` VALUES ('admin', 'e10adc3949ba59abbe56e057f20f883e')";
mysql_query($query);
$query = "UPDATE `sms_user` SET `password` = 'e10adc3949ba59abbe56e057f20f883e' WHERE username = 'admin'";
mysql_query($query);

?>