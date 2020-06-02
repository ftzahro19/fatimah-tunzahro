<?php 
include "../librari/inc.koneksidb.php";
	
# Baca variabel Form (If Register Global ON)
$kd_kunjungan = $_REQUEST['kd_kunjungan'];
$prn		= $_REQUEST['prn'];
$nama		= $_REQUEST['nama'];
$karyawan	= $_REQUEST['karyawan'];
$tgl_lahir  = $_REQUEST['tgl_lahir'];
$sex 		= $_REQUEST['sex']; 
$alamat 		= $_REQUEST['alamat'];
$noHP 	= $_REQUEST['noHP']; 
$tanggal	= $_REQUEST['tanggal'];
$jam		= $_REQUEST['jam'];
$ruang	= $_REQUEST['ruang'];
$kamar	= $_REQUEST['kamar'];
$kelas	= $_REQUEST['kelas'];
$dpjp		= $_REQUEST['dpjp'];
$modul	= $_REQUEST['modul'];
$diagnosa_msk	= $_REQUEST['diagnosa_msk'];


	$sql  = " INSERT INTO data_pasien (kd_kunjungan,prn,nama,karyawan,tgl_lahir,sex,alamat,noHP,tanggal,jam,ruang,kamar,kelas,dpjp,modul,diagnosa_msk,status)";
	$sql .=	" VALUES ('$kd_kunjungan','$prn','$nama','$karyawan','$tgl_lahir','$sex','$alamat','$noHP','$tanggal','$jam','$ruang','$kamar','$kelas','$dpjp','$modul','$diagnosa_msk','Aktif')";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());

	$pesan= "Data berhasil disimpan";
	header("Location: ../data/pasien_view.php");
?>
