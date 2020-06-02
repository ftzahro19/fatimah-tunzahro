<?php
include_once "../librari/inc.session.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.kodeauto.php";
?>
<html>
<head>
<title>Tambah Tindakan</title>
</head>
<body>
<form action="tindakan_sim.php" method="post" name="form1" target="_self">
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
<tr align="left"> 
  <th colspan="2" scope="col">TAMBAH TINDAKAN</th>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td width="33%">Kode Tindakan</td>
  <td width="67%">
	<input name="kd_tm" type="text" size="22" maxlength="10" value="<?php echo kdauto("tm_db","TM"); ?>">
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
  <td><input name="nama_tm" type="text" size="70" maxlength="200">
  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Harga Tindakan </td>
  <td><input name="harga_tm" type="text" size="20" maxlength="200">
  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Jasa Operator </td>
  <td><input name="jasa_tm" type="text" size="20" maxlength="200">
  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>&nbsp;</td>
  <td> 
	<input name="Submit" type="submit" value="Tambah">
  </td>
</tr>
</table>
</form>
</body>
</html>
