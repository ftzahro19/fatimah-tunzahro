<?php
include "../../config/config.php"; 
include "../librari/inc.koneksidb.php"; 

$kode = $_GET['kode'];
$sql = "SELECT * FROM data_klinik WHERE kode='$kode'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Daftar Peserta</title>
</head>
<body>
<form enctype="multipart/form-data" action="klinik_photo_sim.php" method="POST">
    <input type="hidden" name="kode" value="<?php echo $data['kode'];?>" />
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
    Pilih File: <input name="userfile" type="file" />
    <input type="submit" value="Upload" />
</form>
</body>
</html>
