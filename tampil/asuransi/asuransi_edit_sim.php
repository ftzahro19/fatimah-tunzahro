<?php 
include "../librari/inc.koneksidb.php";

# Baca variabel Form (If Register Global ON)
$kd_asuransi 	= $_REQUEST['kd_asuransi'];
$jenis_asuransi = $_REQUEST['jenis_asuransi'];
$nama_asuransi 	= $_REQUEST['nama_asuransi'];
$alamat1 		= $_REQUEST['alamat1'];
$alamat2 		= $_REQUEST['alamat2'];
$telp 			= $_REQUEST['telp'];
$fax 			= $_REQUEST['fax'];
$email 			= $_REQUEST['email'];
$charge 		= $_REQUEST['charge'];
 
	$sql  = " UPDATE asuransi_db SET
			jenis_asuransi='$jenis_asuransi',
			nama_asuransi='$nama_asuransi',
			alamat1='$alamat1',
			alamat2='$alamat2',
			telp='$telp',
			fax='$fax',
			email='$email',
			charge='$charge'
			WHERE kd_asuransi='$kd_asuransi' ";
		mysql_query($sql, $koneksi) 
		  or die ("Maaf, proses update gagal !".mysql_error());
		  
include "asuransi_view.php";
?>

