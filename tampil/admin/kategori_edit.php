<?php 
include "../librari/inc.koneksidb.php";
include_once "../librari/inc.session.php";
$kdubah = $_GET['kdubah'];
$sql = "SELECT * FROM gol_tm WHERE kd_gol_tm='$kdubah'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 

?>
<html>
<head>
<title>UPDATE KATEGORI</title>
</head>
<body>
<form action="kategori_edit_sim.php" method="post" name="form1" target="_self">
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
<tr align="left"> 
  <th colspan="2" scope="col">UPDATE KATEGORI</th>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td width="33%">KODE</td>
  <td width="67%">
	<input name="kd_gol_tm" type="hidden" size="22" maxlength="35" value="<?php echo $data['kd_gol_tm']; ?>">
        <input name="kd_gol_tm" type="text" size="22" maxlength="35" value="<?php echo $data['kd_gol_tm']; ?>" disabled="disabled">
  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Nama Kategori</td>
  <td><input name="gol_tm" type="text" size="70" maxlength="200" value="<?php echo $data['gol_tm']; ?>">
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
