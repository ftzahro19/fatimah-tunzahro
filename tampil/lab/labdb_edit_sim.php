<?php
include "../librari/inc.koneksidb.php";

   // membaca nilai n dari hidden value
   $n = $_POST['n'];

   for ($i=0; $i<=$n-1; $i++)
   {
     if (isset($_POST['lab'.$i]))
     {
       $lab 		= $_POST['lab'.$i];
	   $nama_lab 	= $_POST['nama_lab'.$i];
	   $nilai_atas 	= $_POST['nilai_atas'.$i];
	   $nilai_bawah	= $_POST['nilai_bawah'.$i];
	   $harga_lab 	= $_POST['harga_lab'.$i];
	   $discount	= $_POST['discount'.$i];
       $query 	= "UPDATE lab_db SET nama_lab='$nama_lab', nilai_atas='$nilai_atas', nilai_bawah='$nilai_bawah', harga_lab='$harga_lab', discount='$discount' WHERE kd_lab='$lab'";
       mysql_query($query);
     }
   }
include "pengaturan.php";
?>
