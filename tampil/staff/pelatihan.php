<html>
<head>
<title>Upload file</title></head>
<body>
  <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#DBEAF5">
    <tr> 
      <td colspan="2" bgcolor="#DBEAF5"><div align="left">PELATIHAN</div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="50%" align="center"><b>Nama Pelatihan</b></td>
      <td width="35%" align="center"><b>Tempat Pelatihan</b></td>
      <td width="15%" align="center"><b>Tahun</b></td>
    </tr>
<?php
$query = "SELECT * FROM pelatihan WHERE nik='$username'";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
?>
    <tr bgcolor="#FFFFFF">
      <td><? echo $data['nama_plth'];?></td>
      <td><? echo $data['tempat'];?></td>
      <td><? echo $data['tahun'];?></td>
      <?php
   }
   ?>
    </tr>
  </table>
</body>
</html>
