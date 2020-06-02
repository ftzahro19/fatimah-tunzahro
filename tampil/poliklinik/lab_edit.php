<?php 
include "../librari/inc.koneksidb.php";

$id_lab = $_GET['id_lab'];
$sql = "SELECT * FROM group_lab WHERE id_lab='$id_lab'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 

?>
<html>
<head>
<title>Laboratorium</title>
</head>
<body>
<form action="lab_sim.php" method="post" name="form1" target="_self">
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
<tr align="left"> 
  <th colspan="2" scope="col">Tambah Laboratorium</th>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td width="33%">ID Laboratorium</td>
  <td width="67%">
	<input name="id_lab" type="text" size="22" maxlength="35" value="<?php echo $data['id_lab']; ?>">
  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Nama Laboratorium</td>
  <td><input name="group_lab" type="text" size="70" maxlength="200">
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
