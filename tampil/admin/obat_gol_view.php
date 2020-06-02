<?php 
include "../librari/inc.koneksidb.php";
include_once "../librari/inc.session.php";
?>
<html>
<head>
<title>DAFTAR OBAT</title>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>
<body>
  <table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><div align="left"><strong>DAFTAR GOLONGAN OBAT </strong></div></td>
    </tr>
	    <tr bgcolor="#FFFFFF">
      <td  colspan="3"><a href="tambah_gol_obat.php">Tambah</a></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="25%" bgcolor="#D9E8F3"><div align="center"><strong>KODE GOLONGAN </strong></div></td>
	  <td width="53%" bgcolor="#D9E8F3"><div align="center"><strong>NAMA GOLONGAN OBAT </strong></div></td>
      <td width="22%" bgcolor="#D9E8F3">&nbsp;</td>
    </tr>
<?php 

	$sql = "SELECT * FROM gol_obat ORDER BY kd_gol_obat";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {

  ?>
    <tr bgcolor="#FFFFFF">
      <td><?php echo $data['kd_gol_obat'];?></td>
      <td><?php echo $data['gol_obat'];?></td>
	  <td><div align="center"><a href="obat_gol_edit.php?kdubah=<?php echo $data['kd_gol_obat']; ?>">Edit</a> 
      | <a href="obat_gol_hapus.php?kdhapus=<?php echo $data['kd_gol_obat']; ?>" class="style1">Hapus</a></div></td>
      <?php
}
?>
    </tr>
  </table>
</body>
</html>
