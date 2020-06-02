<?php

// koneksi ke mysql
include "../librari/inc.koneksidb.php";

// pesan asli
$no_tujuan = $_POST['nohp'];
$isi_sms = $_POST['sms'];

// menghitung jumlah pecahan
$jmlSMS = ceil(strlen($isi_sms)/153);

// memecah pesan asli
$pecah  = str_split($isi_sms, 153);

// proses untuk mendapatkan ID record yang akan disisipkan ke tabel OUTBOX
$query = "SHOW TABLE STATUS LIKE 'outbox'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$newID = $data['Auto_increment'];

// proses penyimpanan ke tabel mysql untuk setiap pecahan
for ($i=1; $i<=$jmlSMS; $i++)
{
   // membuat UDH untuk setiap pecahan, sesuai urutannya
   $udh = "050003A7".sprintf("%02s", $jmlSMS).sprintf("%02s", $i);

   // membaca text setiap pecahan
   $msg = $pecah[$i-1];

   if ($i == 1)
   {
      // jika merupakan pecahan pertama, maka masukkan ke tabel OUTBOX
      $query = "INSERT INTO outbox (DestinationNumber, UDH, TextDecoded, ID, MultiPart, CreatorID)
                VALUES ('$no_tujuan', '$udh', '$msg', '$newID', 'true', 'Gammu')";
   }
   else
   {
      // jika bukan merupakan pecahan pertama, simpan ke tabel OUTBOX_MULTIPART
      $query = "INSERT INTO outbox_multipart(UDH, TextDecoded, ID, SequencePosition)
                VALUES ('$udh', '$msg', '$newID', '$i')";
   }

   // jalankan query
   mysql_query($query);
}
include "outbox.php";
?>
