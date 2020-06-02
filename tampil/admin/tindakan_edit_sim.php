<?php 
include "../librari/inc.koneksidb.php";
	
# Baca variabel Form (If Register Global ON)
$kd_tm		= $_REQUEST['kd_tm'];
$gol_tm		= $_REQUEST['gol_tm'];
$nama_tm	= $_REQUEST['nama_tm'];
$harga_tm	= $_REQUEST['harga_tm'];
$jasa_tm	= $_REQUEST['jasa_tm'];
 
	$sql  = " UPDATE tm_db SET
                  gol_tm='$gol_tm',
				  nama_tm='$nama_tm',
				  harga_tm='$harga_tm',
				  jasa_tm='$jasa_tm'
                  WHERE kd_tm='$kd_tm' ";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());

	$pesan= "Data berhasil disimpan";
	header("Location: ../admin/tindakan_view.php");

?>
