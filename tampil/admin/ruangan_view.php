<?php 
include "../librari/inc.koneksidb.php"; 
include_once "../librari/inc.session.php";
?>
<html>
<head>
<title>PENGATURAN RUANG PERAWATAN</title>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>
<body>
  <table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
      <td colspan="6" bgcolor="#CCCCCC"><div align="left"><strong>PENGATURAN RUANG PERAWATAN </strong></div></td>
    </tr>
	<tr bgcolor="#FFFFFF">
      <td  colspan="6"><a href="tambah_ruangan.php">Tambah</a></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="3%" bgcolor="#D9E8F3"><div align="center"><strong>NO </strong></div></td>
      <td width="42%" bgcolor="#D9E8F3"><div align="center"><strong>RUANGAN</strong></div></td>
      <td width="14%" bgcolor="#D9E8F3"><div align="center"><strong>KAMAR</strong></div></td>
      <td width="13%" bgcolor="#D9E8F3"><div align="center"><strong>KELAS</strong></div></td>
      <td width="12%" bgcolor="#D9E8F3"><div align="center"><strong>HARGA/HARI</strong></div></td>
      <td width="16%" bgcolor="#D9E8F3"><div align="center"><strong></strong></div></td>
    </tr>

<?php 

	$sql = "SELECT * FROM ruang";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
  ?>
    <tr bgcolor="#FFFFFF">
      <td><?php echo $data['kd_ruang'];?></td>
      <td><?php echo $data['ruang'];?></td>
      <td><?php echo $data['kamar'];?></td>
      <td><?php echo $data['kelas'];?></td>
      <td><?php echo $data['harga'];?></td>
      <td><div align="center"><a href="ruangan_edit.php?kdubah=<?php echo $data['kd_ruang']; ?>">Edit</a> 
      | <a href="ruangan_hapus.php?kdhapus=<?php echo $data['kd_ruang']; ?>" class="style1">Hapus</a></div></td>
      <?php
}
?>
    </tr>
  </table>
</body>
</html>
