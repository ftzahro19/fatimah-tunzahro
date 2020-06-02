<?php
include_once "../librari/inc.session.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.kodeauto.php";
?>
<html>
<head>
<title>Tambah Spesialis</title>
</head>
<body>
<form action="spesialis_sim.php" method="post" name="form1" target="_self">
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
<tr align="left"> 
  <th colspan="2" scope="col">TAMBAH SPESIALIS</th>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td width="33%">Kode Spesialis</td>
  <td width="67%">
	<input name="kd_klinik" type="text" size="10" maxlength="35" value="<?php echo kdauto("klinikdb",""); ?>">  </td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Kategori</td>
  <td><select name="kategori" id="kategori">
    <option>[ Pilih kategori ]</option>
    <?php
//mengambil nama-nama kategori SDM yang ada di database
$kategori = mysql_query("SELECT * FROM gol_tm WHERE kd_gol_tm=1 || kd_gol_tm=2 ORDER BY kd_gol_tm");
while($p=mysql_fetch_array($kategori)){
echo "<option value=\"$p[kd_gol_tm]\">$p[gol_tm]</option>\n";
}
?>
  </select></td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Nama Spesialis</td>
  <td><input name="nama_klinik" type="text" size="70" maxlength="200">  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>&nbsp;</td>
  <td> 
	<input name="Submit" type="submit" value="Tambah">  </td>
</tr>
</table>
</form>
</body>
</html>
