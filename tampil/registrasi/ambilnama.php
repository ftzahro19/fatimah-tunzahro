<?php
mysql_connect("localhost","root","12345678");
mysql_select_db("klinikdb");
$spesialis = $_GET['spesialis'];
$nama = mysql_query("SELECT * FROM user WHERE spesialis='$spesialis'");
echo "<option value=''>--Pilih nama--</option>";
while($k = mysql_fetch_array($nama)){
    echo "<option value=\"".$k['nik']."\">".$k['nama']."</option>\n";
}
?>
