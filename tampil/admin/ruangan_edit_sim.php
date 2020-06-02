<?php 
include "../librari/inc.koneksidb.php";
	
# Baca variabel Form (If Register Global ON)
$kd_ruang   = $_REQUEST['kd_ruang'];
$ruang   = $_REQUEST['ruang'];
$kamar   = $_REQUEST['kamar'];
$kelas   = $_REQUEST['kelas'];
$harga   = $_REQUEST['harga'];
	
	$sql  = "UPDATE ruang SET
             ruang='$ruang',
			 kamar='$kamar',
			 kelas='$kelas',
			 harga='$harga'
                  WHERE kd_ruang='$kd_ruang' ";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());

	$pesan= "Data berhasil disimpan";
	header("Location: ../admin/ruangan_view.php");

?>
