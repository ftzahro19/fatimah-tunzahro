<?php 
include "../librari/inc.koneksidb.php";

# Baca variabel Form (If Register Global ON)
$kd_kunjungan   = $_REQUEST['kd_kunjungan'];
$shift          = $_REQUEST['shift'];
$prn		= $_REQUEST['prn'];
$tgl_respon    	= $_REQUEST['tgl_respon'];
$jam_respon	= $_REQUEST['jam_respon'];
$rujukan	= $_REQUEST['rujukan'];
$keluhan	= $_REQUEST['keluhan'];
$group_diagnosa	= $_REQUEST['group_diagnosa'];
$diagnosa	= $_REQUEST['diagnosa'];
$tindakan	= $_REQUEST['tindakan'];
$infus		= $_REQUEST['infus'];
$jenis_kasus	= $_REQUEST['jenis_kasus'];
$dokter		= $_REQUEST['dokter'];
$perawat	= $_REQUEST['perawat'];
$tindak_lanjut  = $_REQUEST['tindak_lanjut'];
$keterangan	= $_REQUEST['keterangan'];
$lab		= $_REQUEST['lab'];
$ro		= $_REQUEST['ro'];
$usg		= $_REQUEST['usg'];
$ekg		= $_REQUEST['ekg'];
$selesai	= $_REQUEST['selesai'];
$batal		= $_REQUEST['batal']; 

	$sql  = "UPDATE pasien_poliklinik SET
          group_diagnosa='$group_diagnosa',
          diagnosa='$diagnosa',
          tindak_lanjut='$tindak_lanjut',
		  keterangan='$keterangan',
		  selesai='Aktif',
		  batal='Tidak'
                  WHERE kd_kunjungan='$kd_kunjungan' ";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());
		  
	$query  = " UPDATE reg SET
	tindak_lanjut	= '$tindak_lanjut',
	Selesai			='Proses'
	WHERE kd_kunjungan='$kd_kunjungan' ";
	mysql_query($query, $koneksi) 
		  or die ("Maaf, pendaftaran belum berhasil di-update !".mysql_error());

include "daftar_pasien.php";
?>
