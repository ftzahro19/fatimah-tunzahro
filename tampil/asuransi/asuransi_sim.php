<?php 
include "../librari/inc.koneksidb.php";
# Baca variabel Form (If Register Global ON)
$kd_asuransi 	= $_REQUEST['kd_asuransi'];
$jenis_asuransi 	= $_REQUEST['jenis_asuransi'];
$nama_asuransi 	= $_REQUEST['nama_asuransi'];
$alamat1 		= $_REQUEST['alamat1'];
$alamat2 		= $_REQUEST['alamat2'];
$telp 			= $_REQUEST['telp'];
$fax 			= $_REQUEST['fax'];
$email 			= $_REQUEST['email'];
$charge 			= $_REQUEST['charge'];
 
	$sql  = " INSERT INTO asuransi_db (jenis_asuransi,nama_asuransi,alamat1,alamat2,telp,fax,email,charge)";
	$sql .=	" VALUES ('$jenis_asuransi','$nama_asuransi','$alamat1','$alamat2','$telp','$fax','$email','$charge')";
	mysql_query($sql, $koneksi) 
		  or die ("Error, data tidak dapat disimpan !"); 
		  
include "asuransi_view.php";
?>

