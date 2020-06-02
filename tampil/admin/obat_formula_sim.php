<?php 
include "../librari/inc.koneksidb.php";
	
# Baca variabel Form (If Register Global ON)
$kd_obat		= $_REQUEST['kd_obat'];
$nama_bahan		= $_REQUEST['nama_bahan'];
$keterangan		= $_REQUEST['keterangan'];
 
	$sql  = " INSERT INTO obat_formula (kd_obat,nama_bahan,keterangan)";
	$sql .=	" VALUES ('$kd_obat','$nama_bahan','$keterangan')";
	mysql_query($sql, $koneksi) 
		  or die ("Error, data tidak dapat disimpan !".mysql_error());
		  
echo "<script>
opener.location.reload(true);".
"self.close()".
"</script>";
exit();
?>