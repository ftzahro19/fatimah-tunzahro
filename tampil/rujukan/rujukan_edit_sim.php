<?php 
include "../librari/inc.koneksidb.php";
include "rujukan_view.php";
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
 
	$sql  = " UPDATE rujukan_db SET
			jenis_perujuk='$jenis_perujuk',
			nama_perujuk='$nama_perujuk',
			alamat1='$alamat1',
			alamat2='$alamat2',
			telp='$telp',
			fax='$fax',
			email='$email',
			fee='$fee'
			WHERE kd_perujuk='$kd_perujuk' ";
		mysql_query($sql, $koneksi) 
		  or die ("Maaf, proses update gagal !".mysql_error());

?>

