<?php 
include "../librari/inc.koneksidb.php";
	
# Baca variabel Form (If Register Global ON)
$kd_obat   = $_REQUEST['kd_obat'];
$gol_obat   = $_REQUEST['gol_obat'];
$nama_obat   = $_REQUEST['nama_obat'];
$qty_obat   = $_REQUEST['qty_obat'];
$harga_beli   = $_REQUEST['harga_beli'];
$harga_jual   = $_REQUEST['harga_jual'];
$markup   = $_REQUEST['markup'];
 
	$sql  = " UPDATE obat_db SET
	gol_obat='$gol_obat',
	nama_obat='$nama_obat',
	qty_obat='$qty_obat',
	harga_beli='$harga_beli',
	harga_jual='$harga_jual',
	markup='$markup'
                  WHERE kd_obat='$kd_obat' ";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());

	$pesan= "Data berhasil disimpan";
	header("Location: obat_view.php");

?>
