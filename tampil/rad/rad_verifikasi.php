<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.session.php";

$n = $_POST['n'];
for ($i=0; $i<=$n-1; $i++)
   {
   if (isset($_POST['rad'.$i]))
   {
   $tanggal_hasil	= $_POST['tanggal_hasil'];
   $jam_hasil		= $_POST['jam_hasil'];
   $rad 			= $_POST['rad'.$i];
   $dr_radiologi 	= $_POST['dr_radiologi'];
   $template		= $_POST['template'];
   {
   $query = "UPDATE rad SET tanggal_hasil='$tanggal_hasil',jam_hasil='$jam_hasil',expertise='$template',dr_radiologi='$dr_radiologi',status='Selesai' WHERE id='$rad'";
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