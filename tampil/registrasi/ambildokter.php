<?php
include "../librari/inc.koneksidb.php";
$klinik = $_GET['klinik'];
$dokter = mysql_query("SELECT * FROM user WHERE spesialis='$klinik' order by username");
echo "<option value=''>-- Pilih Dokter --</option>";
while($k = mysql_fetch_array($dokter)){
    echo "<option value=\"".$k['username']."\">".$k['nama_user']."</option>\n";
}
?>
