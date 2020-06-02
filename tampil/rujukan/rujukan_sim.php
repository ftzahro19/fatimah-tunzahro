<?php 
include "../librari/inc.koneksidb.php";
# Baca variabel Form (If Register Global ON)
$kd_perujuk 	= $_REQUEST['kd_perujuk'];
$jenis_perujuk 	= $_REQUEST['jenis_perujuk'];
$nama_perujuk 	= $_REQUEST['nama_perujuk'];
$alamat1 		= $_REQUEST['alamat1'];
$alamat2 		= $_REQUEST['alamat2'];
$telp 			= $_REQUEST['telp'];
$fax 			= $_REQUEST['fax'];
$email 			= $_REQUEST['email'];
$fee 			= $_REQUEST['fee'];

 
	$sql  = " INSERT INTO rujukan_db (jenis_perujuk,nama_perujuk,alamat1,alamat2,telp,fax,email,fee)";
	$sql .=	" VALUES ('$jenis_perujuk','$nama_perujuk','$alamat1','$alamat2','$telp','$fax','$email','$fee')";
	mysql_query($sql, $koneksi) 
		  or die ("Error, data tidak dapat disimpan !"); 
		  
include "rujukan_view.php";
?>

