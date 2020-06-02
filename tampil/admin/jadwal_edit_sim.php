<?php 
include "../librari/inc.koneksidb.php";
	
   $n = $_POST['n'];

   for ($i=0; $i<=$n-1; $i++)
   {
     if (isset($_POST['no'.$i]))
     {
	   $kd_dokter = $_POST['kd_dokter'];
       $no = $_POST['no'.$i];
       $jam_mulai = $_POST['jam_mulai'.$i];
	   $jam_selesai = $_POST['jam_selesai'.$i];
	   $keterangan = $_POST['keterangan'.$i];
       $query = "UPDATE jadwal_praktek SET 
	   jam_mulai='$jam_mulai',
	   jam_selesai='$jam_selesai',
	   keterangan='$keterangan' 
	   WHERE no='$no'";
       mysql_query($query);
     }
   }
echo "<script>
opener.location.reload(true);".
"self.close()".
"</script>";
exit();
?>
