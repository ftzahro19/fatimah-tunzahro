<?php 
include "../librari/inc.koneksidb.php";
include "../../config/config.php";
	
# Baca variabel Form (If Register Global ON)
$kd_kunjungan	= $_REQUEST['kd_kunjungan'];
$prn		= $_REQUEST['prn'];
$tgl_reg	= $_REQUEST['tgl_reg'];
$jam_reg	= $_REQUEST['jam_reg'];
$klinik		= $_REQUEST['klinik'];
$dokter		= $_REQUEST['dokter'];
$batal		= $_REQUEST['batal'];
$selesai	= $_REQUEST['selesai'];
 
	$query  = " UPDATE reg SET
	Selesai='Proses'
	WHERE kd_kunjungan='$kd_kunjungan' ";
	mysql_query($query, $koneksi) 
		  or die ("Maaf, pendaftaran belum berhasil di-update !".mysql_error());
	
# Baca variabel Form (If Register Global ON)
$kd_kunjungan   = $_REQUEST['kd_kunjungan'];
$shift          = $_REQUEST['shift'];
$prn		= $_REQUEST['prn'];
$tgl_respon	= $_REQUEST['tgl_respon'];
$jam_respon	= $_REQUEST['jam_respon'];
$jam_dpjp	= $_REQUEST['jam_dpjp'];
$jam_keluar	= $_REQUEST['jam_keluar'];
$rujukan	= $_REQUEST['rujukan'];
$alergi		= $_REQUEST['alergi'];
$hepatitis	= $_REQUEST['hepatitis'];
$hipertensi	= $_REQUEST['hipertensi'];
$diabetes	= $_REQUEST['diabetes'];
$gastritis	= $_REQUEST['gastritis'];
$keluhan	= $_REQUEST['keluhan'];
$group_diagnosa	= $_REQUEST['group_diagnosa'];
$diagnosa	= $_REQUEST['diagnosa'];
$tindakan	= $_REQUEST['tindakan'];
$infus		= $_REQUEST['infus'];
$jenis_kasus	= $_REQUEST['jenis_kasus'];
$dokter		= $_REQUEST['dokter'];
$perawat	= $_REQUEST['perawat'];
$tindak_lanjut  = $_REQUEST['tindak_lanjut'];
$keterangan	= $_REQUEST['keterangan'];
$lab		= $_REQUEST['lab'];
$ro		= $_REQUEST['ro'];
$usg		= $_REQUEST['usg'];
$ekg		= $_REQUEST['ekg'];
$selesai	= $_REQUEST['selesai'];
$batal		= $_REQUEST['batal'];
	$sql  = " INSERT INTO pasien_poliklinik (kd_kunjungan,shift,prn,tgl_respon,jam_respon,rujukan,alergi,hepatitis,hipertensi,diabetes,gastritis,keluhan,group_diagnosa,diagnosa,tindakan,infus,jenis_kasus,dokter,perawat,tindak_lanjut,keterangan,lab,ro,usg,ekg,selesai,batal)";
	$sql .=	" VALUES ('$kd_kunjungan','$shift','$prn','$tgl_respon','$jam_respon','$rujukan','$alergi','$hepatitis','$hipertensi','$diabetes','$gastritis','$keluhan','$group_diagnosa','$diagnosa','$tindakan','$infus','$jenis_kasus','$dokter','$perawat','$tindak_lanjut','$keterangan','$lab','$ro','$usg','$ekg','Aktif','Tidak')";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
	$kd_kunjungan = $_REQUEST['kd_kunjungan'];
	$sql = "SELECT * FROM pasien_poliklinik";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
	$no++;
  ?>
<meta http-equiv="refresh" content="0;url=lap_poli_edit.php?kd_kunjungan=<?=$kd_kunjungan;?>" />
<?php
}
?>
<title>Terima kasih !</title>
</head>
<body>
<h3 align="center">Sedang menyimpan...</h3>
<h3 align="center"><img src="<?php echo $url;?>media/image/facebook.gif"/></h3>
</div>
</body>
</html>
