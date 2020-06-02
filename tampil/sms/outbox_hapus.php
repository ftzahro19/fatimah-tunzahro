<?php 
include "../librari/inc.koneksidb.php";
$ID = $_REQUEST['ID'];

if ($ID !="") {
$sql = "DELETE FROM sentitems WHERE ID='$ID'";
mysql_query($sql, $koneksi) or die ("SQL Error".mysql_error());

	$pesan= "Data berhasil disimpan";
}
include "outbox.php";
?>

