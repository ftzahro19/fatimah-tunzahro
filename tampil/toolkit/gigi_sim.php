<?php 
include "../../config/config.php";
include "../librari/inc.koneksidb.php";


# Baca variabel Form (If Register Global ON)
$kd_kunjungan	= $_REQUEST['kd_kunjungan'];
$denture		= $_REQUEST['denture'];
$keterangan		= $_REQUEST['keterangan'];

	$sql  = " INSERT INTO toolkit (kd_kunjungan,denture,keterangan)";
	$sql .=	" VALUES ('$kd_kunjungan','$denture','No')";
	mysql_query($sql, $koneksi) 
		  or die ("Error, data tidak dapat disimpan !"); 
?>