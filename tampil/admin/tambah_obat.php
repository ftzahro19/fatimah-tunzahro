<?php
include_once "../librari/inc.session.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.kodeauto.php";
?>
<html>
<head>
<title>Tambah daftar obat</title>
<script>
function startCalc(){
interval = setInterval("calc()",1);
}
function calc(){
harga_beli = document.form1.harga_beli.value;
markup = document.form1.markup.value;
harga_markup = (harga_beli * 1) + harga_beli * (markup/100);
ppn = document.form1.ppn.value;
document.form1.harga_jual.value = (harga_beli * 1) + harga_beli*(markup/100) + harga_markup *(ppn/100);
}
function stopCalc(){
clearInterval(interval);
}
</script>
</head>
<body>
<form action="obat_sim.php" method="post" name="form1" target="_self">
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
<tr align="left"> 
  <th colspan="2" scope="col">Tambah daftar obat</th>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td width="33%">Kode Obat</td>
  <td width="67%">
	<input name="kd_obat" type="text" size="22" maxlength="10" value="<?php echo kdauto("obat_db","OH"); ?>">  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Golongan</td>
  <td><select name="gol_obat">
    <option value="" selected>[Pilih...]</option>
    <?php
	$sql = "SELECT * FROM gol_obat";
      	$qry = @mysql_query($sql, $koneksi) or die ("gagal Query");
	while ($data2 =mysql_fetch_array($qry)) {
	if ($data2[gol_obat]==$gol_obat) {
	$cek="selected";
	}
	else {
	$cek="";
	}
	echo "<option value='$data2[gol_obat]' $cek>".$data2['gol_obat']."</option>";
	}
	?>
  </select></td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Nama Obat </td>
  <td><input name="nama_obat" type="text" size="35" maxlength="200" value="<?php echo $data2['gol_obat'];?>">  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Harga Beli</td>
  <td><input name="harga_beli" type="text" size="10" maxlength="200" onFocus="startCalc();" onBlur="stopCalc();"></td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Markup</td>
  <td><input name="markup" type="text" size="1" maxlength="200" onFocus="startCalc();" onBlur="stopCalc();" value="45">
    %</td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>ppn 10% </td>
  <td><input name="ppn" type="text" size="1" maxlength="200" onFocus="startCalc();" onBlur="stopCalc();" value="10">
    %</td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Harga Jual</td>
  <td><input name="harga_jual" type="text" size="10" maxlength="200"></td>
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
