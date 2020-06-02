<?php 
include "../librari/inc.koneksidb.php";

# Baca variabel Form (If Register Global ON)
$kd_kunjungan   = $_REQUEST['kd_kunjungan'];
$diagnosa_keluar= $_REQUEST['diagnosa_keluar'];
$alasan_keluar	= $_REQUEST['alasan_keluar'];
$tanggal_keluar	= $_REQUEST['tanggal_keluar'];
$jam_keluar		= $_REQUEST['jam_keluar'];
$keterangan		= $_REQUEST['keterangan'];


	$sql  = "UPDATE pasien_rawat SET
          diagnosa_keluar	= '$diagnosa_keluar',
          alasan_keluar		= '$alasan_keluar',
		  tanggal_keluar	= '$tanggal_keluar',
		  jam_keluar		= '$jam_keluar',
		  keterangan		= '$keterangan',
		  status			= 'Predischarge'
          WHERE kd_kunjungan= '$kd_kunjungan'";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());

include "pasien_terdaftar.php";
?>
