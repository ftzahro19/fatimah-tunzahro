<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.session.php";

$n = $_POST['n'];
for ($i=0; $i<=$n-1; $i++)
   {
   if (isset($_POST['lab'.$i]))
   {
   $tanggal_hasil	= $_POST['tanggal_hasil'];
   $jam_hasil		= $_POST['jam_hasil'];
   $lab 			= $_POST['lab'.$i];
   $dr_lab 			= $_POST['dr_lab'];
   $hasil 			= $_POST['hasil'.$i];
   {
   $query = "UPDATE lab SET tanggal_hasil='$tanggal_hasil',jam_hasil='$jam_hasil',hasil='$hasil',dr_lab='$dr_lab',status='Selesai' WHERE id='$lab'";
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