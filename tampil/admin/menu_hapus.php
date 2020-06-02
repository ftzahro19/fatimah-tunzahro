<?php
include "../librari/inc.koneksidb.php";
   // membaca nilai n dari hidden value
   $n = $_POST['n'];
   for ($i=0; $i<=$n-1; $i++)
   {
     if (isset($_POST['ksm'.$i]))
     {
       $ksm = $_POST['ksm'.$i];
       $query = "DELETE FROM menu_user WHERE kd_sub_menu='$ksm'";
       mysql_query($query);
     }
   }
include "menu_view.php"
?>