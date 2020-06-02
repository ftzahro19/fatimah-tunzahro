<?php 
include "../librari/inc.koneksidb.php";
include "../../config/config.php";

# Baca variabel Form (If Register Global ON)
$kd_kunjungan	= $_REQUEST['kd_kunjungan'];
$prn			= $_REQUEST['prn'];
$tgl_reg		= $_REQUEST['tgl_reg'];
$jam_reg		= $_REQUEST['jam_reg'];
$kd_perujuk		= $_REQUEST['kd_perujuk'];
$kd_asuransi	= $_REQUEST['kd_asuransi'];
$klinik			= $_REQUEST['klinik'];
$spesialisasi	= $_REQUEST['spesialisasi'];
$dokter			= $_REQUEST['dokter'];
$batal			= $_REQUEST['batal'];
$selesai		= $_REQUEST['selesai'];

if (trim($dokter)=="") {
	$pesan[] = "Nama dokter masih kosong!";
}
if (trim($klinik)=="") {
	$pesan[] = "Nama Klinik masih kosong!";
}
if (! count($pesan)==0) {

echo "<b>ERROR :</b><br>";
foreach ($pesan as $indeks=>$pesan_tampil) {
$urut_pesan++;
echo "$urut_pesan . $pesan_tampil<br>";
}
echo "<a href=javascript:history.back()>Kembali</a>";
exit;
}
 
	$sql  = " UPDATE reg SET
	prn='$prn',	
	tgl_reg='$tgl_reg',
	jam_reg='$jam_reg',
	kd_perujuk='$kd_perujuk',
	kd_asuransi='$kd_asuransi',
	klinik='$klinik',
	spesialisasi='$spesialisasi',
	dokter='$dokter'
	WHERE kd_kunjungan='$kd_kunjungan' ";
	mysql_query($sql, $koneksi) 
		  or die ("Maaf, pendaftaran belum berhasil di-update !".mysql_error());
include "".$url."tampil/antrian/";
?>
