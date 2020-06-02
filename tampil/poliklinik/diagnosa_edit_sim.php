<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.session.php";

if ($_GET['action'] == "update")
{
   // membaca nilai n dari hidden value
   $n = $_POST['n'];

   for ($i=0; $i<=$n-1; $i++)
   {
     if (isset($_POST['rx'.$i]))
     {
       $rx 		= $_POST['rx'.$i];
	   $qty 	= $_POST['qty'.$i];
	   $aturan 	= $_POST['aturan'.$i];
	   $rute	= $_POST['rute'.$i];
       $query 	= "UPDATE diagnosa SET qty='$qty', aturan='$aturan', rute='$rute' WHERE id='$rx'";
       mysql_query($query);
     }
   }
}
include "diagnosa_view.php";
?>
