<?php 
include "../librari/inc.koneksidb.php";
	
# Baca variabel Form (If Register Global ON)
$kd_cm		= $_REQUEST['kd_cm'];
$kd_kunjungan	= $_REQUEST['kd_kunjungan'];
$tgl_cm	= $_REQUEST['tgl_cm'];
$jam_cm	= $_REQUEST['jam_cm'];
$shift	= $_REQUEST['shift'];
$template= $_REQUEST['template'];
$keterangan	= $_REQUEST['keterangan'];

	$sql  = " UPDATE catatanmedis SET
              	  kd_kunjungan='$kd_kunjungan',
		  tgl_cm='$tgl_cm',
		  jam_cm='$jam_cm',
		  shift='$shift',
		  catatanmedis='$template',
		  keterangan='$keterangan'
		  WHERE  kd_cm='$kd_cm'";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());

include "catatanmedis_form.php";
?>
