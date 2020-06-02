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
      <td colspan="6" bgcolor="#CCCCCC"><div align="left"><strong>DAFTAR PERUJUK </strong></div></td>
    </tr>
	    <tr bgcolor="#FFFFFF">
      <td  colspan="6"><a href="rujukan_tambah.php">Tambah</a></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="13%" bgcolor="#D9E8F3"><div align="center"><strong>KODE</strong></div></td>
      <td width="13%" bgcolor="#D9E8F3"><div align="center"><strong>NAMA</strong></div></td>
	        <td width="33%" bgcolor="#D9E8F3"><div align="center"><strong>ALAMAT</strong></div></td>
      <td width="14%" bgcolor="#D9E8F3"><div align="center"><strong>TELPON</strong></div></td>
      <td width="16%" bgcolor="#D9E8F3"><div align="center"><strong>FAX </strong></div></td>
      <td width="11%" bgcolor="#D9E8F3"><div align="center"><strong>EMAIL</strong></div></td>
    </tr>
<?php 

	$sql = "SELECT * FROM rujukan_db";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
  ?>
    <tr bgcolor="#FFFFFF">
      <td><div align="center"><?php echo $data['jenis_perujuk'];?><?php echo $data['kd_perujuk'];?></div></td>
      <td><?php echo $data['nama_perujuk'];?></td>
	  <td><?php echo $data['alamat1'];?></td>
	  <td><?php echo $data['telp'];?></td>
	  <td><?php echo $data['fax'];?></td>
      <td><div align="center"><a href="rujukan_edit.php?kdubah=<?php echo $data['kd_perujuk']; ?>">Edit</a> 
      | <a href="tindakan_hapus.php?kdhapus=<?php echo $data['kd_tm']; ?>" class="style1">Hapus</a></div></td>
      <?php
}
?>
    </tr>
  </table>
</body>
</html>
