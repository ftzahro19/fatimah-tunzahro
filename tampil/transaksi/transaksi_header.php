<?php
include "../librari/inc.koneksidb.php";
include "../../config/config.php";
$sql = "SELECT * FROM data_klinik";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
?>
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<title>KWITANSI PEMBAYARAN</title>
<style type="text/css">
<!--
.style2 {font-size: 9px}
.style2 {font-size: 9px}
-->
</style>
</head>
<body>
<table width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#FFFFFF">
  <tr bgcolor="#FFFFFF">
    <td width="10%" align="left"><?php
        if ($data['logo']=="") {
	echo "<img src='../admin/gambar/no_pic.jpg' width='125' height='125' valign=top align='center'/>";
	}
	else {
	echo "<img src='../admin/gambar/".$data['logo']."' width='110' height='120' valign=top align='center'/>";
	}
	?></td>
    <td width="90%"><h2><?php echo $data['nama_klinik'];?></h2>
      Alamat : <?php echo $data['alamat'];?> <br>
      No Telp : <?php echo $data['telpon'];?>, HP : <?php echo $data['hp'];?>, PIN BB : <?php echo $data['pin_bb'];?>
    </td>
  </tr>
</table>
</body>
</html> 

