<?php 
include "../librari/inc.koneksidb.php";
include_once "../librari/inc.session.php";
?>
<html>
<head>
<title>DAFTAR TINDAKAN</title>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>
<body>
  <table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
      <td colspan="6" bgcolor="#CCCCCC"><div align="left"><strong>DAFTAR TINDAKAN</strong></div></td>
    </tr>
	    <tr bgcolor="#FFFFFF">
      <td  colspan="6"><a href="tambah_tindakan.php">Tambah</a></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="13%" bgcolor="#D9E8F3"><div align="center"><strong>KODE</strong></div></td>
      <td width="13%" bgcolor="#D9E8F3"><div align="center"><strong>OPERATOR</strong></div></td>
	        <td width="33%" bgcolor="#D9E8F3"><div align="center"><strong>NAMA TINDAKAN</strong></div></td>
      <td width="14%" bgcolor="#D9E8F3"><div align="center"><strong>HARGA</strong></div></td>
      <td width="16%" bgcolor="#D9E8F3"><div align="center"><strong>JASA OPERATOR </strong></div></td>
      <td width="11%" bgcolor="#D9E8F3">&nbsp;</td>
    </tr>
<?php 

	$sql = "SELECT * FROM tm_db ORDER BY nama_tm";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
  ?>
    <tr bgcolor="#FFFFFF">
      <td><?php echo $data['kd_tm'];?></td>
      <td><?php echo $data['gol_tm'];?></td>
	  <td><?php echo $data['nama_tm'];?></td>
	  <td><?php echo $data['harga_tm'];?></td>
	  <td><?php echo $data['jasa_tm'];?></td>
      <td><div align="center"><a href="tindakan_edit.php?kdubah=<?php echo $data['kd_tm']; ?>">Edit</a> 
      | <a href="tindakan_hapus.php?kdhapus=<?php echo $data['kd_tm']; ?>" class="style1">Hapus</a></div></td>
      <?php
}
?>
    </tr>
  </table>
</body>
</html>
