<?php 
include "../librari/inc.koneksidb.php";
	
# Baca variabel Form (If Register Global ON)
$kd_kunjungan 	= $_REQUEST['kd_kunjungan'];
$prn		= $_REQUEST['prn'];
$tgl_masuk	= $_REQUEST['tgl_masuk'];
$jam_masuk	= $_REQUEST['jam_masuk'];
$ruang		= $_REQUEST['ruang'];
$kamar		= $_REQUEST['kamar'];
$kelas		= $_REQUEST['kelas'];
$bed		= $_REQUEST['bed'];
$dpjp		= $_REQUEST['dpjp'];
$modul		= $_REQUEST['modul'];
$diagnosa_masuk	= $_REQUEST['diagnosa_masuk'];
$diagnosa_keluar= $_REQUEST['diagnosa_keluar'];
$status		= $_REQUEST['status'];
$tgl_keluar	= $_REQUEST['tgl_keluar'];
$jam_keluar	= $_REQUEST['jam_keluar'];
 
	$sql  = " UPDATE pasien_rawat SET
prn='$prn',
tgl_masuk='$tgl_masuk',
jam_masuk='$jam_masuk',
ruang='$ruang',
kamar='$kamar',
kelas='$kelas',
bed='$bed',
dpjp='$dpjp',
modul='$modul',
diagnosa_masuk='$diagnosa_masuk',
diagnosa_keluar='$diagnosa_keluar',
status='Selesai',
tgl_keluar='$tgl_keluar',
jam_keluar='$jam_keluar'
	WHERE kd_kunjungan='$kd_kunjungan' ";
	mysql_query($sql, $koneksi) 
		  or die ("Maaf, proses pulang gagal !".mysql_error());

# Baca variabel Form (If Register Global ON)
$kd_kunjungan 	= $_REQUEST['kd_kunjungan'];
 
	$sql2  = " UPDATE reg SET selesai='Selesai'
	WHERE kd_kunjungan='$kd_kunjungan' ";
	mysql_query($sql2, $koneksi) 
		  or die ("Maaf, proses pulang gagal !".mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="0;url=pasien_ri.php" />
<title>Terima kasih !</title>
</head>
<body>
<h3 align="center">Sedang menyimpan...</h3>
<h3 align="center"><img src="../image/loading2.gif"/></h3>
</div>
</body>
</html>
