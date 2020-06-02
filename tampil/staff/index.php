<?php 
include "../librari/inc.koneksidb.php";
include_once "../librari/inc.session.php";
$username = $_SESSION['klinik'];
$sql = "SELECT * FROM user WHERE username='$username'";
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
   <tr> 
      <td colspan="3" bgcolor="#DBEAF5"><div align="left">BIODATA</div></td>
    </tr>
<tr bgcolor="#FFFFFF"> 
  <td width="17%" rowspan="5">&nbsp;<?php
	$username = $data['username'];
	$photo = $data['photo'];
        if ($data[photo]=="") {
	echo "<img src='../staff/gambar/nopic.jpg' width='110' height='120' valign=top/>";
	}
	else {
	echo "<img src='../staff/gambar/".$data['photo']."' width='110' height='120' valign=top/>";
	}
	?></td>
  <td>Nama</td>
  <td><?php echo $data['nama']; ?>  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td width="16%">Username</td>
  <td width="67%"><?php echo $data['username']; ?>     </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Level</td>
  <td align="left"><?php echo $data['level']; ?></td>
</tr>
<tr bgcolor="#FFFFFF"> 
 <td>Tanggal Masuk</td>
 <td align="left"><?php echo $data['tanggal_masuk'] ;?> </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Status</td>
  <td><?php echo $data['status']; ?> </td>
</tr>
</table>
</body>
</html>