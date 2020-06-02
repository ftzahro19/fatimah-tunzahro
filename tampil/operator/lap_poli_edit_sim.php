<?php 
include "../librari/inc.koneksidb.php";

# Baca variabel Form (If Register Global ON)
$kd_kunjungan   = $_REQUEST['kd_kunjungan'];
$shift          = $_REQUEST['shift'];
$prn		= $_REQUEST['prn'];
$tgl_respon    	= $_REQUEST['tgl_respon'];
$jam_respon	= $_REQUEST['jam_respon'];
$rujukan	= $_REQUEST['rujukan'];
$alergi		= $_REQUEST['alergi'];
$hepatitis	= $_REQUEST['hepatitis'];
$hipertensi	= $_REQUEST['hipertensi'];
$diabetes	= $_REQUEST['diabetes'];
$gastritis	= $_REQUEST['gastritis'];
$keluhan	= $_REQUEST['keluhan'];
$group_diagnosa	= $_REQUEST['group_diagnosa'];
$diagnosa	= $_REQUEST['diagnosa'];
$tindakan	= $_REQUEST['tindakan'];
$infus		= $_REQUEST['infus'];
$jenis_kasus	= $_REQUEST['jenis_kasus'];
$dokter		= $_REQUEST['dokter'];
$perawat	= $_REQUEST['perawat'];
$keterangan	= $_REQUEST['keterangan'];
$lab		= $_REQUEST['lab'];
$ro		= $_REQUEST['ro'];
$usg		= $_REQUEST['usg'];
$ekg		= $_REQUEST['ekg'];
$selesai	= $_REQUEST['selesai'];
$batal		= $_REQUEST['batal']; 

	$sql  = " UPDATE pasien_poliklinik SET
          shift='$shift',
 		  prn='$prn',
		  tgl_respon='$tgl_respon',
          jam_respon='$jam_respon',
  		  rujukan='$rujukan',	
		  alergi='$alergi',
		  hepatitis='$hepatitis',
		  hipertensi='$hipertensi',
		  diabetes='$diabetes',
		  gastritis='$gastritis',
		  keluhan='$keluhan',
          group_diagnosa='$group_diagnosa',
          diagnosa='$diagnosa',
          tindakan='$tindakan',
          infus='$infus',         
          jenis_kasus='$jenis_kasus',
          dokter='$dokter',
          perawat='$perawat',
		  lab='$lab',
		  ro='$ro',
		  usg='$usg',
		  ekg='$ekg',
		  selesai='Aktif',
		  batal='Tidak'
                  WHERE kd_kunjungan='$kd_kunjungan' ";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());

include "lap_poli_edit.php";
?>
