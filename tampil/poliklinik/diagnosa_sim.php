<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.session.php";

$n = $_POST['n'];
for ($i=0; $i<=$n-1; $i++)
   {
   if (isset($_POST['dx'.$i]))
   {
   $kd_kunjungan = $_POST['kd_kunjungan'];
   $tanggal_dx   = $_POST['tanggal_dx'];
   $jam_dx   	 = $_POST['jam_dx'];
   $dx 			 = $_POST['dx'.$i];
   $nama_diagnosa= $_POST['nama_diagnosa'.$i];
   $username   	 = $_POST['username'];
   $keterangan   = $_POST['keterangan'.$i];
   {
      $query = "INSERT INTO diagnosa (kd_kunjungan,tanggal_dx,jam_dx,kd_diagnosa,nama_diagnosa,username,keterangan)
	  VALUES('$kd_kunjungan','$tanggal_dx','$jam_dx','$dx','$nama_diagnosa','$username','$keterangan')";
      mysql_query($query);	  
   }
   } 
}
echo "<script>
opener.location.reload(true);".
"self.close()".
"</script>";
exit();
?>

