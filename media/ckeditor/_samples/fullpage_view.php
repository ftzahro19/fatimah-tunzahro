<?php 
$my['host']	= "localhost";
$my['user']	= "root";
$my['pass']	= "12345678";
$my['dbs']	= "test";

$koneksi	= mysql_connect($my['host'], 
							$my['user'], 
							$my['pass']);
if (! $koneksi) {
  echo "Gagal koneksi boss..!";
  mysql_error();
}
mysql_select_db($my['dbs'])
	 or die ("Database nggak ada tuh".mysql_error());
?>
<html>
<head>
<title>DAFTAR DIAGNOSA</title>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>
<body>
  <table align="center" width="100%" border="0" cellpadding="2" cellspacing="1">
    <tr>
      <td colspan="6" bgcolor="#CCCCCC"><div align="left"><strong>DAFTAR DIAGNOSA</strong></div></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="30%" bgcolor="#D9E8F3"><div align="center"><strong>KODE</strong></div></td>
      <td width="50%" bgcolor="#D9E8F3"><div align="center"><strong>NAMA DIAGNOSA</strong></div></td>
      <td width="20%" bgcolor="#D9E8F3">&nbsp;</td>
    </tr>
<?php 

	$sql = "SELECT * FROM fullpage";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
	$no++;
  ?>
    <tr bgcolor="#FFFFFF">
      <td><? echo $data['no'];?></td>
      <td><? echo $data['fullpage'];?></td>
      <td><div align="center"><a href="diagnosa_edit.php?kdubah=<? echo $data['id_diagnosa']; ?>">Edit</a> 
      | <a href="hapus_diagnosa.php?kdhapus=<? echo $data['id_diagnosa']; ?>" class="style1">Hapus</a></div></td>
      <?php
}
?>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td  colspan="3"><a href="tambah_diagnosa.php">Tambah</a></td>
    </tr>
  </table>
</body>
</html>
