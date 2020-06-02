<?php 
include "../librari/inc.koneksidb.php";
$kd_kunjungan = $_GET['kd_kunjungan'];

	$sql  = " UPDATE reg SET selesai='Selesai'
                  WHERE kd_kunjungan='$kd_kunjungan' ";
			mysql_query($sql, $koneksi) 
		  	or die ("SQL Error".mysql_error()); 

include "pasien_rj.php";
?>

