<?php 
include "../librari/inc.koneksidb.php";
include "../librari/inc.kodeauto.php";
# Baca variabel Form (If Register Global ON)
$kd_rad			= kdauto("rad_db","rad");
$gol_rad		= $_REQUEST['gol_rad'];
$nama_rad		= $_REQUEST['nama_rad'];
$harga_rad		= $_REQUEST['harga_rad'];
$discount		= $_REQUEST['discount'];
$keterangan		= $_REQUEST['keterangan'];

$sql  = "INSERT INTO rad_db (kd_rad,gol_rad,nama_rad,harga_rad,discount,keterangan)";
$sql .= "VALUES ('$kd_rad','$gol_rad','$nama_rad','$harga_rad','$discount','$keterangan')";
		mysql_query($sql, $koneksi) or die ("SQL Error".mysql_error());

echo "<script>
opener.location.reload(true);".
"self.close()".
"</script>";
exit();
?>