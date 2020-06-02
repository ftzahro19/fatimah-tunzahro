<?php
// menggunakan class phpExcelReader
include "excel_reader2.php";

// koneksi ke mysql
mysql_connect("localhost", "root", "12345678");
mysql_select_db("emr");

// membaca file excel yang diupload
$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

// membaca jumlah baris dari data excel
$baris = $data->rowcount($sheet_index=0);

// nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
$sukses = 0;
$gagal = 0;

// import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)
for ($i=2; $i<=$baris; $i++)
{
// membaca data username (kolom ke-1)
  $username = $data->val($i, 1);
// membaca data password (kolom ke-2)
  $password = $data->val($i, 2);
// membaca data nama (kolom ke-3)
  $nama = $data->val($i, 3);
// membaca data profesi (kolom ke-4)
  $profesi = $data->val($i, 4);
// membaca data unit (kolom ke-5)
  $unit = $data->val($i, 5);
// membaca data tanggal masuk (kolom ke-6)
  $tanggal_masuk = $data->val($i, 6);
// membaca data photo (kolom ke-7)
  $photo = $data->val($i, 7);
// membaca data photo (kolom ke-7)
  $ext = $data->val($i, 8);
// membaca data status (kolom ke-7)
  $status = $data->val($i, 9);

  // setelah data dibaca, sisipkan ke dalam tabel mhs
  $query = "INSERT INTO user VALUES ('$username','$password','$nama','$profesi','$unit','$tanggal_masuk','$photo$ext','$status')";
  $hasil = mysql_query($query);

  // jika proses insert data sukses, maka counter $sukses bertambah
  // jika gagal, maka counter $gagal yang bertambah
  if ($hasil) $sukses++;
  else $gagal++;
}

// tampilan status sukses dan gagal
echo "<h3>Proses import data selesai.</h3>";
echo "<p>Jumlah data yang sukses diimport : ".$sukses."<br>";
echo "Jumlah data yang gagal diimport : ".$gagal."</p>";

?>




































..................................
