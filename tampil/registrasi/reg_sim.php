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

//cari data registrasi
$query_reg = "SELECT * FROM reg WHERE prn='$prn' AND selesai!='Selesai'";
$hasil_reg = mysql_query($query_reg);
$data_reg = mysql_fetch_array($hasil_reg);
$data_reg = mysql_num_rows($hasil_reg);


if (trim($dokter)=="") {
	$pesan[] = "Nama dokter masih kosong!";
}
if (trim($klinik)=="") {
	$pesan[] = "Nama dokter masih kosong!";
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

if ($data_reg >= 1) {
echo "PRN $prn sudah terdaftar atau masih aktif di rawat, silahkan hubungi Admin!";
}

else {
	$sql  = " INSERT INTO reg (kd_kunjungan,prn,tgl_reg,jam_reg,kd_perujuk,kd_asuransi,klinik,spesialisasi,dokter,batal,selesai)";
	$sql .=	" VALUES ('$kd_kunjungan','$prn','$tgl_reg','$jam_reg','$kd_perujuk','$kd_asuransi','$klinik','$spesialisasi','$dokter','Tidak','Aktif')";
	mysql_query($sql, $koneksi) 
		  or die ("Pendaftaran GAGAL, pasien telah terdaftar ! <a href=\"javascript:history.back()\" align=\"center\">kembali</a>");
} 
include "".$url."tampil/antrian/";
?>
