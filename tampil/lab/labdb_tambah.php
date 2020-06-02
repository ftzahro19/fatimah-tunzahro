<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include_once "../librari/inc.session.php";
?>
<html>
<head>
<title>TAMBAH DATABASE LABORATORIUM</title>
<style type="text/css">
<!--
a:link {
	color: #000080;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #0000FF;
}
a:hover {
	text-decoration: none;
	color: #FF0000;
}
a:active {
	text-decoration: none;
}
.style1 {font-size: 16px}
-->
</style>
</head>
<body id="tab2">
</hr>
  <table align="left" width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#DBEAF5">
  <form name="form1" method="post" action="labdb_sim.php">
      <tr bgcolor="#FFFFFF">
     	<td colspan="2" bgcolor="#D9E8F3">TAMBAH DATABASE LABORATORIUM</td>
   	</tr>
  <tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF">Golongan</td>
    <td width="70%" bgcolor="#FFFFFF">
	<select name="gol_lab" id="gol_lab">
	<option value="">--Golongan Lab--</option>
	<?php
	//mengambil nama-nama klinik yang ada di database
	$lab = mysql_query("SELECT * FROM gol_lab");
	while($l=mysql_fetch_array($lab)){
	echo "<option value=\"$l[gol_lab]\">$l[gol_lab]</option>\n";
	}
	?>
	</select>
	</td>
  </tr>
  <tr bgcolor="#FFFFFF">
   	  <td width="30%" bgcolor="#FFFFFF">Nama pemeriksaan </td>
      	<td align="left" bgcolor="#FFFFFF"><input type="text" name="nama_lab"></td>
	</tr>
    <tr bgcolor="#FFFFFF">
      <td bgcolor="#FFFFFF">Nilai normal atas </td>
      <td colspan="2" bgcolor="#FFFFFF"><input type="text" name="nilai_atas"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td bgcolor="#FFFFFF">Nilai normal bawah </td>
      <td colspan="2" bgcolor="#FFFFFF"><input type="text" name="nilai_bawah"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td bgcolor="#FFFFFF">Harga</td>
      <td colspan="2" bgcolor="#FFFFFF"><input type="text" name="harga_lab"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td bgcolor="#FFFFFF">Discount</td>
      <td colspan="2" bgcolor="#FFFFFF"><input type="text" name="discount"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
   	  <td width="30%" bgcolor="#FFFFFF"><input type="submit" name="Submit" value="Tambahkan"></td>
      	<td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
	  </form>
</table>
</body>
</html></br></br>
