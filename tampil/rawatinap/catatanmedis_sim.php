<?php 
include "../librari/inc.koneksidb.php";
	
$template   = $_REQUEST['template'];

if (trim($template)=="") {

	include "catatanmedis_form.php"; exit;
}

# Baca variabel Form (If Register Global ON)
$kd_cm		= $_REQUEST['kd_cm'];
$kd_kunjungan	= $_REQUEST['kd_kunjungan'];
$tgl_cm		= $_REQUEST['tgl_cm'];
$jam_cm		= $_REQUEST['jam_cm'];
$shift		= $_REQUEST['shift'];
$template	= $_REQUEST['template'];
$keterangan	= $_REQUEST['keterangan'];

$sql  = " INSERT INTO catatanmedis (kd_kunjungan,tgl_cm,jam_cm,shift,catatanmedis,keterangan)";
	$sql .=	" VALUES ('$kd_kunjungan','$tgl_cm','$jam_cm','$shift','$template','$keterangan')";
	mysql_query($sql, $koneksi) 
		  or die ("Laporan Shift sudah dibuat ! Silahkan tekan tombol 'BACK'");

include "catatanmedis_form.php";
?>
