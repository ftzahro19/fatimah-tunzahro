<?php 
include "../librari/inc.koneksidb.php";
	
# Baca variabel Form (If Register Global ON)
$no_faktur	= $_REQUEST['no_faktur'];
$kd_obat	= $_REQUEST['kd_obat'];
$jumlah		= $_REQUEST['jumlah'];
$keterangan	= $_REQUEST['keterangan'];
 
	$sql  = " INSERT INTO obat_stock (no_faktur,kd_obat,jumlah,keterangan)";
	$sql .=	" VALUES ('$no_faktur','$kd_obat','$jumlah','Inprogress')";
	mysql_query($sql, $koneksi) 
		  or die ("Error, data tidak dapat disimpan !".mysql_error());
		  
echo "<script>
opener.location.reload(true);".
"</script>";
include "obat_detail_tambah.php";
exit();
?>