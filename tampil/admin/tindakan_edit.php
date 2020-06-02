<?php 
include "../librari/inc.koneksidb.php";

$kdubah = $_GET['kdubah'];
$sql = "SELECT * FROM tm_db WHERE kd_tm='$kdubah'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
$gol_tm		= $data['gol_tm'];
?>
<html>
<head>
<title>Update Diagnosa</title>
</head>
<body>
<form action="tindakan_edit_sim.php" method="post" name="form1" target="_self">
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
<tr align="left"> 
  <th colspan="2" scope="col">Update Tindakan</th>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td width="33%">Kode Tindakan</td>
  <td width="67%">
	<input name="kd_tm" type="hidden" size="22" maxlength="10" value="<?php echo $data['kd_tm']; ?>">
        <input name="kd_tm" type="text" size="22" maxlength="10" value="<?php echo $data['kd_tm']; ?>" disabled="disabled">
  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Operator</td>
  <td><select name="gol_tm">
    <option value="" selected>[Pilih...]</option>
    <?php
	$sql = "SELECT * FROM gol_tm";
      	$qry = @mysql_query($sql, $koneksi) or die ("gagal Query");
	while ($data2 =mysql_fetch_array($qry)) {
	if ($data2[gol_tm]==$gol_tm) {
	$cek="selected";
	}
	else {
	$cek="";
	}
	echo "<option value='$data2[gol_tm]' $cek>".$data2['gol_tm']."</option>";
	}
	?>
  </select></td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Nama Tindakan</td>
  <td><input name="nama_tm" type="text" size="70" maxlength="200" value="<?php echo $data['nama_tm']; ?>">
  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Harga Tindakan </td>
  <td><input name="harga_tm" type="text" size="20" maxlength="200" value="<?php echo $data['harga_tm']; ?>">
  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Jasa Operator </td>
  <td><input name="jasa_tm" type="text" size="20" maxlength="200" value="<?php echo $data['jasa_tm']; ?>">
  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>&nbsp;</td>
  <td> 
	<input name="Submit" type="submit" value="Update">
  </td>
</tr>
</table>
</form>
</body>
</html>
