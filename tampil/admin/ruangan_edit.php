<?php 
include "../librari/inc.koneksidb.php";
include_once "../librari/inc.session.php";
$kdubah = $_GET['kdubah'];
$sql = "SELECT * FROM ruang WHERE kd_ruang='$kdubah'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
$ruang = $data['ruang'];
?>
<html>
<head>
<title>UPDATE RUANGAN</title>
</head>
<body>
<form action="ruangan_edit_sim.php" method="post" name="form1" target="_self">
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
<tr align="left"> 
  <th colspan="2" scope="col">UPDATE SPESIALIS</th>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td width="33%">Nomor</td>
  <td width="67%">
	<input name="kd_ruang" type="hidden" size="22" maxlength="35" value="<?php echo $data['kd_ruang']; ?>">
    <input name="kd_ruang" type="text" size="22" maxlength="35" value="<?php echo $data['kd_ruang']; ?>" disabled="disabled">  </td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Ruangan</td>
  <td><select name="ruang" id="ruang">
    <option>[ Pilih Ruangan ]</option>
    <?php
	$sql = "SELECT * FROM ruang GROUP BY ruang";
     $qry = @mysql_query($sql, $koneksi) or die ("gagal Query");
	while ($data1 =mysql_fetch_array($qry)) {
	if ($data1[ruang]==$ruang) {
	$cek="selected";
	}
	else {
	$cek="";
	}
	echo "<option value='$data1[ruang]' $cek>".$data1['ruang']."</option>";
	}
	?>
  </select></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Kamar</td>
  <td><input name="kamar" type="text" size="70" maxlength="200" value="<?php echo $data['kamar']; ?>"></td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Kelas</td>
  <td><input name="kelas" type="text" size="70" maxlength="200" value="<?php echo $data['kelas']; ?>">  </td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Harga</td>
  <td><input name="harga" type="text" size="70" maxlength="200" value="<?php echo $data['harga']; ?>"></td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>&nbsp;</td>
  <td> 
	<input name="Submit" type="submit" value="Update">  </td>
</tr>
</table>
</form>
</body>
</html>
