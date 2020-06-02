<?php
include "../librari/inc.koneksidb.php";

// baca tanggal sekarang
$tglNow = date("d");

// baca bulan sekarang
$blnNow = date("m");

// baca tahun-bulan-tanggal sekarang
$tanggal = date("Y-m-d");
$jam = date("H:i");

// cari data teman yang bulan lahir dan tanggal lahir sesuai pada current date
$query = "SELECT * FROM adl,data_pasien WHERE adl.kd_kunjungan=data_pasien.kd_kunjungan AND adl.tanggal='$tanggal' AND adl.jam='$jam' AND adl.sms='Ya' AND adl.status='Inprogress'";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
   // baca nomor HP dan nama teman
   $nama = $data['nama'];
   $kd_kunjungan =  $data['kd_kunjungan'];
   $kd_adl = $data['kd_adl'];
   $nohp = $data['nohp'];
   $adl = $data['adl'];


   // proses kirim sms via insert data ke tabel outbox
      $query2 = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) VALUES ('$nohp', '($tanggal/$jam) Nama Pasien : $nama : $adl ', 'Hendi')";
      mysql_query($query2);

   // proses kirim sms via insert data ke tabel outbox
      $query2 = "UPDATE adl SET sms='SENT' WHERE kd_adl='$kd_adl'";
      mysql_query($query2);
   }
?>
