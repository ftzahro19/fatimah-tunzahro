<?php 
include "../librari/inc.koneksidb.php"; 
include_once "../librari/inc.session.php";
?>
<html>
<head>
<title>DAFTAR SPESIALIS</title>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>
<body>
  <table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><div align="left"><strong>DAFTAR KATEGORI SDM </strong></div></td>
    </tr>
	<tr bgcolor="#FFFFFF">
      <td  colspan="3"><a href="tambah_kategori.php">Tambah</a></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="10%" bgcolor="#D9E8F3"><div align="center"><strong>KODE</strong></div></td>
      <td width="70%" bgcolor="#D9E8F3"><div align="center"><strong>KATEGORI</strong></div></td>
      <td width="20%" bgcolor="#D9E8F3">&nbsp;</td>
    </tr>

<?php 

	$sql = "SELECT * FROM gol_tm ORDER BY kd_gol_tm";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
  ?>
    <tr bgcolor="#FFFFFF">
      <td><?php echo $data['kd_gol_tm'];?></td>
      <td><?php echo $data['gol_tm'];?></td>
      <td><div align="center"><a href="kategori_edit.php?kdubah=<?php echo $data['kd_gol_tm']; ?>">Edit</a> 
      | <a href="kategori_hapus.php?kdhapus=<?php echo $data['kd_gol_tm']; ?>" class="style1">Hapus</a></div></td>
      <?php
}
?>
    </tr>
  </table>
</body>
</html>
