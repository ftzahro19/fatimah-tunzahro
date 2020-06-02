<?php

//koneksi ke mysql dan db nya
include "koneksi.php";
include "tampil/librari/inc.kodeauto.php";

// query untuk membaca SMS yang belum diproses
$query = "SELECT * FROM sms_inbox WHERE msg LIKE '%REG%' AND flagRead = '0'";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
  // membaca ID SMS
  $id = $data['id'];

  // membaca no pengirim
  
  $noPengirim = $data['sender'];

  // membaca pesan SMS dan mengubahnya menjadi kapital
  $msg = strtoupper($data['msg']);

  // proses parsing 

  // memecah pesan berdasarkan karakter <spasi>
  $pecah = explode("/", $msg);

  // jika kata terdepan dari SMS adalah 'REG' maka input ke dalam tabel data_pasien
  if ($pecah[0] == "REG")
  {
     // FORMAT SMS REG/NAMA/TEMPAT LAHIR/TANGGAL LAHIR, CONTOH : REG HENDI TASIKMALAYA 1975-10-17 
	 // FORMAT TGL LAHIR TAHUN-BULAN-TANGGAL 
      $nama 		= $pecah[1];
	 $t4_lahir 	= $pecah[2];
	 $tgl_lahir	= $pecah[3];
	 $prn		= kdauto("data_pasien","");
	 $tanggal	= date('Y-m-d');
	 $jam		= date('H:i:s');
	 $hp1		= $data['sender'];
     // cari Laporan berdasar PRN
	 $query2 = "INSERT INTO data_pasien (prn,nama,t4_lahir,tgl_lahir,tanggal,jam,hp1,batal) VALUES ('$prn','$nama','$t4_lahir','$tgl_lahir','$tanggal','$jam','$hp1','sms')";
     $hasil2 = mysql_query($query2);
	 $reply  = "Pendaftaran berhasil, no id pasien anda adalah $prn.";
	 }
  else $reply = "Maaf perintah salah";

	// Cari data pasien dengan prn dan sms
	$query4 = "SELECT * FROM data_pasien WHERE prn='$prn' AND batal='sms'";
	$hasil4 = mysql_query($query4);
	$data4 = mysql_num_rows($hasil4);
	if ($data4>=1)
	{	
  // membuat SMS balasan

  $query5 = "INSERT INTO outbox(DestinationNumber, TextDecoded) VALUES ('$noPengirim', '$reply')";
  $hasil5 = mysql_query($query5);

  // ubah nilai 'processed' menjadi 'true' untuk setiap SMS yang telah diproses

  $query6 = "UPDATE sms_inbox SET flagRead = '1' WHERE id = '$id'";
  $hasil6 = mysql_query($query6);
  
  $query3 = "UPDATE data_pasien SET batal = 'No' WHERE prn = '$prn'";
  $hasil3 = mysql_query($query3);
  }
}
?>