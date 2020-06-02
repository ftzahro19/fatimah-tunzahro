<?php 
include "../librari/inc.koneksidb.php";
include_once "../librari/inc.session.php";
$sql = "SELECT * FROM data_klinik";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
?>
<html>
<head>
</script>
    <script src="<?php echo $url;?>media/kalendar/js/jscal2.js"></script>
    <script src="<?php echo $url;?>media/kalendar/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/steel/steel.css" />
<title>Update Database Staff</title>
</head>
<body id=tab1>
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
<form name="form1" method="post" action="data_klinik_sim.php">
   <tr> 
      <td colspan="3" bgcolor="#DBEAF5"><div align="left">PROFIL KLINIK </div></td>
    </tr>
<tr bgcolor="#FFFFFF"> 
  <td width="17%" rowspan="9" valign="top">&nbsp;<?php
    if ($data['photo']=="") {
	echo "<img src='gambar/no_pic.jpg' width='125' height='125' valign=top/>";
	}
	else {
	echo "<img src='gambar/".$data['logo']."' width='125' height='125' valign=top/>";
	}
	?></br></td>
  <td>Identitas klinik </td>
  <td>
    
    <input type="hidden" name="kode" value="<?php echo $data['kode']; ?>">
    <input type="text" name="nama_klinik" value="<?php echo $data['nama_klinik']; ?>" size="60">  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td width="26%">Keterangan</td>
  <td width="57%"><input type="text" name="keterangan" value="<?php echo $data['keterangan']; ?>"></td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Alamat</td>
  <td align="left">
    <input type="text" name="alamat1" value="<?php echo $data['alamat1']; ?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Kota</td>
  <td align="left">
    <input type="text" name="alamat2" value="<?php echo $data['alamat2']; ?>"></td>
</tr>
<tr bgcolor="#FFFFFF"> 
 <td>Telpon 1 </td>
 <td align="left">
   <input type="text" name="telpon1" value="<?php echo $data['telpon1']; ?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Telpon 2 </td>
  <td>
    <input type="text" name="telpon2" value="<?php echo $data['telpon2']; ?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Email</td>
  <td>
    <input type="text" name="email" value="<?php echo $data['email']; ?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Fax</td>
  <td><input type="text" name="fax" value="<?php echo $data['fax']; ?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td><input name="Update" type="submit" value="Update"></td>
  <td>&nbsp;</td>
</tr>
  </form>
</table>
</body>
</html>