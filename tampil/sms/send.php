<?php

// koneksi ke database Gammu
include "../librari/inc.koneksidb.php";

// baca no tujuan
$no_tujuan = $_POST['nohp'];

// baca isi sms
$isi_sms = $_POST['sms'];

// baca format sms
$pilih_format = $_POST['format'];

if ($pilih_format == "flash")
{
   // jika format yang dipilih 'flash'

   // query kirim sms format flash
   $query = "INSERT INTO outbox(DestinationNumber, TextDecoded, CreatorID, Class)
             VALUES ('$no_tujuan', '$isi_sms', 'Gammu', '0')";

   // jalankan query
   mysql_query($query);
}
else if ($pilih_format == "normal")
{
   // jika format yang dipilih 'normal'

   // query kirim sms normal
   $query = "INSERT INTO outbox(DestinationNumber, TextDecoded, CreatorID, Class)
             VALUES ('$no_tujuan', '$isi_sms', 'SIK', '-1')";   

   // jalankan query
   mysql_query($query);
}
else echo "Anda belum memilih format SMS";
include "outbox.php";
?>