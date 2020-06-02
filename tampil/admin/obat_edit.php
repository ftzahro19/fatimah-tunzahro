<?php 
include "../librari/inc.koneksidb.php";

$kdubah = $_GET['kdubah'];
$sql = "SELECT * FROM obat_db WHERE kd_obat='$kdubah'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 

?>
<html>
<head>
<title>Update Daftar Obat</title>
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
<form action="obat_edit_sim.php" method="post" name="form1" target="_self">
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
<tr align="left"> 
  <th colspan="2" scope="col">UPDATE DAFTAR OBAT </th>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td width="33%">Kode Obat </td>
  <td width="67%">
	<input name="kd_obat" type="hidden" size="22" maxlength="10" value="<?php echo $data['kd_obat']; ?>">
        <input name="kd_obat" type="text" size="22" maxlength="35" value="<?php echo $data['kd_obat']; ?>" disabled="disabled">  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Golongan</td>
  <td><input name="gol_obat" type="text" size="35" maxlength="200" value="<?php echo $data['gol_obat']; ?>">  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Nama Obat </td>
  <td><input name="nama_obat" type="text" size="35" maxlength="200" value="<?php echo $data['nama_obat']; ?>">  </td>
</tr>

<tr bgcolor="#FFFFFF"> 
  <td>Harga Beli</td>
  <td><input name="harga_beli" type="text" size="10" maxlength="200" value="<?php echo $data['harga_beli']; ?>"  onFocus="startCalc();" onBlur="stopCalc();">  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Markup</td>
  <td><input name="markup" type="text" size="1" value="<?php echo $data['markup']; ?>" onFocus="startCalc();" onBlur="stopCalc();">
    %</td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Ppn</td>
  <td><input name="ppn" type="text" size="1" value="<?php echo $data['ppn']; ?>" onFocus="startCalc();" onBlur="stopCalc();">
    %</td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Harga Jual</td>
  <td><input name="harga_jual" type="text" size="10" maxlength="200" value="<?php echo $data['harga_jual']; ?>"></td>
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
