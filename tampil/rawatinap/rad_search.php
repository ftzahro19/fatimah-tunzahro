<?php
include "../librari/inc.koneksidb.php";
$kd_kunjungan = $_REQUEST['kd_kunjungan'];
if ($kd_kunjungan !="") {
   $sql = "SELECT * FROM reg WHERE kd_kunjungan='$kd_kunjungan'";
   $qry = mysql_query($sql,$koneksi)
      or die ("SQL Error".mysql_error());
   $data=mysql_fetch_array($qry);
}
?>
<html>
<head>
</head>
<body id="tab2">
<form name="form1" method="post" action="rad.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>" target="_self">
  <input type="text" name="q" placeholder="Cari item radiologi">
  <input type="submit" name="Submit" value="Cari...">
</form>
<body>
</html> 