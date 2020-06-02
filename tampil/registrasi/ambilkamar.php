<?php
include "../librari/inc.koneksidb.php";
$ruang = $_GET['ruang'];
$kamar = mysql_query("SELECT * FROM ruang WHERE ruang='$ruang'");
echo "<option value=''>-- Pilih Kamar --</option>";
while($k = mysql_fetch_array($kamar)){
    echo "<option value=\"".$k['kamar']."\">".$k['kamar']."</option>\n";
}
?>
