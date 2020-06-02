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
      <td colspan="4" bgcolor="#CCCCCC"><div align="left"><strong>DAFTAR SPESIALIS</strong></div></td>
    </tr>
	<tr bgcolor="#FFFFFF">
      <td  colspan="4"><a href="tambah_spesialis.php">Tambah</a></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="10%" bgcolor="#D9E8F3"><div align="center"><strong>KODE</strong></div></td>
      <td width="21%" bgcolor="#D9E8F3"><div align="center"><strong>KATEGORI</strong></div></td>
      <td width="49%" bgcolor="#D9E8F3"><div align="center"><strong>NAMA SPESIALIS</strong></div></td>
      <td width="20%" bgcolor="#D9E8F3">&nbsp;</td>
    </tr>

<?php 

	$sql = "SELECT * FROM klinikdb,gol_tm WHERE klinikdb.kd_gol_tm=gol_tm.kd_gol_tm ORDER BY kd_klinik";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
  ?>
    <tr bgcolor="#FFFFFF">
      <td><?php echo $data['kd_klinik'];?></td>
      <td><?php echo $data['gol_tm'];?></td>
      <td><?php echo $data['nama_klinik'];?></td>
      <td><div align="center"><a href="spesialis_edit.php?kdubah=<?php echo $data['kd_klinik']; ?>">Edit</a> 
      | <a href="spesialis_hapus.php?kdhapus=<?php echo $data['kd_klinik']; ?>" class="style1">Hapus</a></div></td>
      <?php
}
?>
    </tr>
  </table>
</body>
</html>
