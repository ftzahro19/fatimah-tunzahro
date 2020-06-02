<html>
<head>
<title>Tampilan Biodata staff</title>
<style type="text/css">
<!--
.style1 {
	color: #000000;
	font-weight: bold;
	font-size: 24px;
}
-->
</style>
</head>
<body>
<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#DBEAF5">
  <tr bgcolor="#33FFFF"> 
    <td colspan="3" bgcolor="#DBEAF5"><div align="left">PENGALAMAN KERJA</div></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td><div align="center"><strong>Institusi</strong></div></td>
    <td><div align="center"><strong>Unit</strong></div></td>
    <td><div align="center"><strong>Tahun</strong></div></td>
  </tr>
  <?php 
	$sql = "SELECT * FROM pengalaman WHERE nik='$username'";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
	$no++;
  ?>
  <tr bgcolor="#FFFFFF">
    <td width="50%"><?php echo $data['institusi']; ?></td>
    <td width="35%"><?php echo $data['unit']; ?></td>
    <td width="15%"><?php echo $data['waktu']; ?></td>
  </tr>
  
    <?php
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td colspan="3" bgcolor="#DBEAF5"><div align="center"></div></td>
  </tr>

</table>
</body>
</html>
