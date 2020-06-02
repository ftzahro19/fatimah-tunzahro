<?php 
include "../librari/inc.koneksidb.php";
include "../librari/inc.kodeauto.php";
# Baca variabel Form (If Register Global ON)
$kd_lab			= kdauto("lab_db","lab");
$gol_lab		= $_REQUEST['gol_lab'];
$nama_lab		= $_REQUEST['nama_lab'];
$nilai_bawah	= $_REQUEST['nilai_bawah'];
$nilai_atas		= $_REQUEST['nilai_atas'];
$harga_lab		= $_REQUEST['harga_lab'];
$discount		= $_REQUEST['discount'];

$sql  = "INSERT INTO lab_db (kd_lab,gol_lab,nama_lab,nilai_atas,nilai_bawah,harga_lab,discount)";
$sql .= "VALUES ('$kd_lab','$gol_lab','$nama_lab','$nilai_atas','$nilai_bawah','$harga_lab','$discount')";
		mysql_query($sql, $koneksi) or die ("SQL Error".mysql_error());

echo "<script>
opener.location.reload(true);".
"self.close()".
"</script>";
exit();
?>