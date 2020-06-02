<?php 
include "../librari/inc.koneksidb.php";
include_once "../librari/inc.session.php";
$kdubah = $_GET['kdubah'];
$sql = "SELECT * FROM klinikdb WHERE kd_klinik='$kdubah'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
$kategori = $data['kd_gol_tm'];
?>
<html>
<head>
<title>UPDATE SPESIALISASI</title>
</head>
<body>
<form action="spesialis_edit_sim.php" method="post" name="form1" target="_self">
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
<tr align="left"> 
  <th colspan="2" scope="col">UPDATE SPESIALIS</th>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td width="33%">KODE</td>
  <td width="67%">
	<input name="kd_klinik" type="hidden" size="22" maxlength="35" value="<?php echo $data['kd_klinik']; ?>">
        <input name="kd_klinik" type="text" size="22" maxlength="35" value="<?php echo $data['kd_klinik']; ?>" disabled="disabled">  </td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Kategori</td>
  <td><select name="kategori" id="kategori">
    <option>[ Pilih kategori ]</option>
    <?php
	$sql = "SELECT * FROM gol_tm WHERE kd_gol_tm=1 || kd_gol_tm=2";
     $qry = @mysql_query($sql, $koneksi) or die ("gagal Query");
	while ($data1 =mysql_fetch_array($qry)) {
	if ($data1[kd_gol_tm]==$kategori) {
	$cek="selected";
	}
	else {
	$cek="";
	}
	echo "<option value='$data1[kd_gol_tm]' $cek>".$data1['gol_tm']."</option>";
	}
	?>
  </select></td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Spesialis</td>
  <td><input name="nama_klinik" type="text" size="70" maxlength="200" value="<?php echo $data['nama_klinik']; ?>">  </td>
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
