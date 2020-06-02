<?php

//koneksi ke mysql dan db nya
include "koneksi.php";
include "tampil/librari/inc.kodeauto.php";

// query untuk membaca SMS yang belum diproses
$query = "SELECT * FROM sms_inbox WHERE msg LIKE '%REG2%' AND flagRead = '0'";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
  // membaca ID SMS
  $id = $data['id'];

  // membaca no pengirim
    $noPengirim = $data['sender'];

  // membaca pesan SMS dan mengubahnya menjadi kapital
  $msg = strtoupper($data['msg']);

  // memecah pesan berdasarkan karakter <spasi>
  $pecah = explode("/", $msg);

  // jika kata terdepan dari SMS adalah 'REG' maka input ke dalam tabel data_pasien
  if ($pecah[0] == "REG2")
  {
     // FORMAT SMS REG2/PRN/KDKLINIK/KDDOKTER/TANGGAL/JAM 	CONTOH : REG2/00001234/1/1/2014-05-25/16:00 
	 // FORMAT TGL LAHIR TAHUN-BULAN-TANGGAL 
	 $kd_kunjungan	= kdauto("reg","");
      $prn 		= $pecah[1];
	 $kd_klinik 	= $pecah[2];
	 $kd_dokter	= $pecah[3];
	 $tgl_reg		= $pecah[4];
	 $jam_reg		= $pecah[5];
	 
	//Cari data pasien
	$query_prn = "SELECT * FROM data_pasien WHERE prn='$prn'";
	$hasil_prn = mysql_query($query_prn);
	$data_prn = mysql_num_rows($hasil_prn);
	$data_prn = mysql_fetch_array($hasil_prn);
	$nama_pasien = $data_prn['nama']; 
	$sex = $data_prn['jenis_kalamin']; 
	
	//Cari data dokter
	$query_dr = "SELECT * FROM user WHERE username='$kd_dokter'";
	$hasil_dr = mysql_query($query_dr);
	$data_dr = mysql_num_rows($hasil_dr);
	$data_dr = mysql_fetch_array($hasil_dr);	
	$dokter = $data_dr['nama'];
	$spesialisasi = $data_dr['unit'];
	
	//Cari data klinik
	$query_klinik = "SELECT * FROM klinikdb WHERE kd_klinik='$kd_klinik'";
	$hasil_klinik = mysql_query($query_klinik);
	$data_klinik = mysql_num_rows($hasil_klinik);
	$data_klinik = mysql_fetch_array($hasil_klinik);
	$klinik = $data_klinik['nama_klinik'];
	
	//cari data registrasi
	$query_reg = "SELECT * FROM reg WHERE prn='$prn' AND (selesai='Aktif' || selesai='Proses') AND batal='Tidak'";
	$hasil_reg = mysql_query($query_reg);
	$data_reg = mysql_num_rows($hasil_reg);
	$data_reg = mysql_fetch_array($hasil_reg);

    if ($data_prn <= 0) {
 	$reply = "Data Pasien Tidak Ditemukan. Silahkan melakukan pendaftaran pasien baru. FORMAT SMS : REG/NAMA/TEMPAT LAHIR/TANGGAL LAHIR (TAHUN-BLN-TGL)";
    }
	elseif ($data_dr <= 0) {
 	$reply = "Kode dokter salah, silakan ulangi FORMAT SMS : REG2/PRN/KODE KLINIK/KODE DOKTER/TANGGAL/JAM BEROBAT";
    }
	elseif ($data_klinik <= 0) {
 	$reply = "Kode KLINIK salah, silakan ulangi FORMAT SMS : REG2/PRN/KODE KLINIK/KODE DOKTER/TANGGAL/JAM BEROBAT";
    }
	elseif ($data_reg >= 1) {
 	$reply = "PRN $prn sudah terdaftar, silahkan hubungi petugas pendaftaran kami!";
    }
	//Insert SMS_INBOX ke tabel reg 
	else {
	$dokter = $data_dr['nama'];
	$spesialisasi = $data_dr['unit'];
	$klinik = $data_klinik['nama_klinik'];
	$query2 = "INSERT INTO reg(kd_kunjungan,prn,tgl_reg,jam_reg,klinik,spesialisasi,dokter,batal,selesai) VALUES ('$kd_kunjungan','$prn','$tgl_reg','$jam_reg','$kd_klinik','$spesialisasi','$kd_dokter','Tidak','Aktif')";
    $hasil2 = mysql_query($query2);
	$reply  = "Terima kasih Bpk/Ibu $nama_pasien, No anda : $prn, telah terdaftar di Klinik $klinik dengan $dokter. Silahkan datang 1/2 jam sebelum $tgl_reg, jam $jam_reg";
	}
	
	//Balas ke HP Pendaftar
	  $query3 = "INSERT INTO outbox(DestinationNumber, TextDecoded) VALUES ('$noPengirim', '$reply')";
      $hasil3 = mysql_query($query3);
  
      $query4 = "UPDATE sms_inbox SET flagRead = '1' WHERE id = '$id'";
      $hasil4 = mysql_query($query4);
  }
}
?>