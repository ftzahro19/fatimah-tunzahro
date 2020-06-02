<?php 
include "../../config/config.php"; 
include "../librari/inc.koneksidb.php"; 
include "../librari/inc.session.php";
include "tab_staff.php"; 

	$username = $_SESSION['klinik'];
$sql = "SELECT * FROM user WHERE username='$username'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
?>
<html>
<head>
</script>
    <script src="<? echo $url;?>media/kalendar/js/jscal2.js"></script>
    <script src="<? echo $url;?>media/kalendar/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="<? echo $url;?>media/kalendar/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="<? echo $url;?>media/kalendar/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="<? echo $url;?>media/kalendar/css/steel/steel.css" />
<title>Update Database Staff</title>
</head>
<body id=tab1>
<form action="staff_edit_sim.php" method="post" name="form1" target="_self">
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
<?php
	$username = $data['username'];
	$photo = $data['photo'];
        if ($data[photo]=="") {
	echo "<img src='../staff/gambar/nopic.jpg' width='54' height='54' />";
	}
	else {
	echo "<img src='../staff/gambar/".$data['photo']."' width='54' height='54' />";
	}
	?>
<tr bgcolor="#FFFFFF"> 
  <td>Nama</td>
  <td><input name="nama" type="text" size="40" maxlength="200" value="<? echo $data['nama']; ?>">
  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td width="33%">NIK</td>
  <td width="67%">
	<input name="username" type="hidden" size="10" maxlength="35" value="<? echo $data['username']; ?>">
        <input name="username" type="text" size="6" maxlength="35" value="<? echo $data['username']; ?>" disabled="disabled">
  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Profesi</td>
  <td align="left"><select name="profesi" id="profesi">
      <?php 
        if ($data['profesi']=="") echo "<option value='' selected>[Pilih...]</option>";
        else echo "<option value=''>[Pilih...]</option>";
        if ($data['profesi']=="PERAWAT") echo "<option value='PERAWAT' selected>PERAWAT</option>";
        else echo "<option value='PERAWAT'>PERAWAT</option>";
        if ($data['profesi']=="DOKTER UMUM") echo "<option value='DOKTER UMUM' selected>DOKTER UMUM</option>";
        else echo "<option value='DOKTER UMUM'>DOKTER UMUM</option>";
        ?>
    </select></td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Unit</td>
  <td align="left"><select name="profesi" id="profesi">
      <?php 
        if ($data['profesi']=="") echo "<option value='' selected>[Pilih...]</option>";
        else echo "<option value=''>[Pilih...]</option>";
        ?>
    </select></td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Tanggal Masuk</td>
  <td><input name="tanggal_masuk" type="text" id="tanggal_masuk" size="10" value="<? echo $data['tanggal_masuk'] ;?>">
	<image id="f_btn1" src="<? echo $url;?>media/kalendar/calendar.jpg" width="16" height="15" border="0"></image>
		<script type="text/javascript">//<![CDATA[
      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: false
      });
      cal.manageFields("f_btn1", "tanggal_masuk", "%Y-%m-%d");
     //]]></script>	
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
