<?php
include "../librari/inc.koneksidb.php";
$kamar = $_GET['kamar'];
$kelas = mysql_query("SELECT * FROM ruang WHERE kamar='$kamar'");
while($kls = mysql_fetch_array($kelas)){
    echo "<option value=\"".$kls['kelas']."\">".$kls['kelas']."</option>\n";
}
?>
