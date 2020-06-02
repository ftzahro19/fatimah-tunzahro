<?php
include "../librari/inc.koneksidb.php";
include "../../config/config.php";
$kategori = $_GET['kategori'];
$spesialis = mysql_query("SELECT * FROM klinikdb WHERE kd_gol_tm='$kategori'");
echo "<option value=\"".$k['kd_klinik']."\">[ Pilih Spesialis ]</option>";
while($k = mysql_fetch_array($spesialis)){
    echo "<option value=\"".$k['kd_klinik']."\">".$k['nama_klinik']."</option>\n";
}
?>
