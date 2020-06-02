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
      <td colspan="6" bgcolor="#CCCCCC"><div align="left"><strong>DAFTAR ASURANSI </strong></div></td>
    </tr>
	    <tr bgcolor="#FFFFFF">
      <td  colspan="6"><a href="asuransi_tambah.php">Tambah</a></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="10%" bgcolor="#D9E8F3"><div align="center"><strong>KODE</strong></div></td>
      <td width="20%" bgcolor="#D9E8F3"><div align="center"><strong>NAMA</strong></div></td>
	        <td width="25%" bgcolor="#D9E8F3"><div align="center"><strong>ALAMAT</strong></div></td>
      <td width="15%" bgcolor="#D9E8F3"><div align="center"><strong>TELPON</strong></div></td>
      <td width="15%" bgcolor="#D9E8F3"><div align="center"><strong>FAX </strong></div></td>
      <td width="15%" bgcolor="#D9E8F3"><div align="center"><strong>EMAIL</strong></div></td>
    </tr>
<?php 

	$sql = "SELECT * FROM asuransi_db";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
  ?>
    <tr bgcolor="#FFFFFF">
      <td><div align="center"><?php echo $data['jenis_asuransi'];?><?php echo $data['kd_asuransi'];?></div></td>
      <td><?php echo $data['nama_asuransi'];?></td>
	  <td><?php echo $data['alamat1'];?></td>
	  <td><?php echo $data['telp'];?></td>
	  <td><?php echo $data['fax'];?></td>
      <td><div align="center"><a href="asuransi_edit.php?kd_asuransi=<?php echo $data['kd_asuransi']; ?>">Edit</a> 
      | <a href="asuransi_hapus.php?kdhapus=<?php echo $data['kd_tm']; ?>" class="style1">Hapus</a></div></td>
      <?php
}
?>
    </tr>
  </table>
</body>
</html>
