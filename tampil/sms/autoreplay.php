<h1>SMS Server running....</h1>
<?php

//koneksi ke mysql dan db nya
include "../librari/inc.koneksidb.php";

// query untuk membaca SMS yang belum diproses
$query = "SELECT * FROM inbox WHERE TextDecoded LIKE '%TL%' AND Processed = 'false'";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
  // membaca ID SMS
  $id = $data['ID'];

  // membaca no pengirim
  
  $noPengirim = $data['SenderNumber'];

  // membaca pesan SMS dan mengubahnya menjadi kapital
  $msg = strtoupper($data['TextDecoded']);

  // proses parsing 

  // memecah pesan berdasarkan karakter <spasi>
  $pecah = explode(" ", $msg);

  // jika kata terdepan dari SMS adalah 'TINDAK LANJUT' maka cari TINDAK LANJUT PASIEN
  if ($pecah[0] == "TL")
  {
     // baca PRN dari Laporan
     $prn = $pecah[1];

     // cari Laporan berdasar PRN
	 $query2 = "SELECT nama, tindak_lanjut FROM laporan WHERE prn = '$prn'";
     $hasil2 = mysql_query($query2);

     // cek bila data nilai tidak ditemukan
     if (mysql_num_rows($hasil2) == 0) $reply = "Pasien dengan PRN $nama tidak ditemukan";
     else
     {
        // bila nilai ditemukan
        $data2 = mysql_fetch_array($hasil2);
        $tindak_lanjut = $data2['tindak_lanjut'];
		$nama = $data2['nama'];
        $reply = "Nama $nama PRN $prn  : ".$tindak_lanjut;
     }
  }
  else $reply = "Maaf perintah salah";

  // membuat SMS balasan

  $query3 = "INSERT INTO outbox(DestinationNumber, TextDecoded) VALUES ('$noPengirim', '$reply')";
  $hasil3 = mysql_query($query3);

  // ubah nilai 'processed' menjadi 'true' untuk setiap SMS yang telah diproses

  $query3 = "UPDATE inbox SET Processed = 'true' WHERE ID = '$id'";
  $hasil3 = mysql_query($query3);
}
?>
