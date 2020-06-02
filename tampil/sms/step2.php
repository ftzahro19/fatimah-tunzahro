<?php include "menu2.php";?>

<h2>Langkah 2 - Test Koneksi GAMMU dengan HP</h2>

<p>Klik tombol di bawah ini untuk cek koneksi GAMMU dengan HP</p>

<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<input type="submit" name="submit" value="CEK KONEKSI"></td></tr>
</form>

<?php
if ($_POST['submit'])
{
   echo "<b>Status :</b><br>";
   echo "<hr>Modem/HP 1<br>";
   echo "<pre>";
   passthru("gammu -s 0 -c gammurc identify", $hasil);
   echo "</pre>";
   echo "<hr>Modem/HP 2<br>";
   echo "<pre>";
   passthru("gammu -s 1 -c gammurc identify", $hasil);
   echo "</pre>";
   echo "<hr>Modem/HP 3<br>";
   echo "<pre>";
   passthru("gammu -s 2 -c gammurc identify", $hasil);
   echo "</pre>";
   echo "<hr>Modem/HP 4<br>";
   echo "<pre>";
   passthru("gammu -s 3 -c gammurc identify", $hasil);
   echo "</pre>";

}
?> 
