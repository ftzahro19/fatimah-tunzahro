<?php
include "../librari/inc.koneksidb.php";
include "../librari/inc.session.php";
if (isset($_GET['action'])) {
if ($_GET['action'] == "add")
{
   // membaca nilai n dari hidden value
   $n = $_POST['n'];

   for ($i=0; $i<=$n-1; $i++)
   {
     if (isset($_POST['kd_sub_menu'.$i]))
     {
       $username = $_POST['username'];
	   $kd_menu = $_POST['kd_menu'.$i];
	   $kd_sub_menu = $_POST['kd_sub_menu'.$i];
       $query = "INSERT INTO menu_user  VALUES('$username','$kd_menu','$kd_sub_menu')";
       mysql_query($query);
     }
   }
}
}
?>
<html>
<head>
<title>MENU USER</title>
</head>
<body>
<form name="myform" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?action=add">
<table width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
<?php
$username = $_REQUEST['username'];
$sql1 = "SELECT * FROM user WHERE username='$username'";
$qry1 = mysql_query($sql1);
$data1 = mysql_fetch_array($qry1); 
?>
<h3>Nama User : <?php echo $data1['nama_user'];?></h3>
  <tr>
    <td width="50%" height="21"><div align="center">DATABASE MENU</div></td>
    <td width="50%"><div align="center">MENU USER </div></td>
  </tr>

  <tr bgcolor="#ffffff">
    <td valign="top">
	<input type="hidden" value="<?php echo $data1['username'];?>" name="username" />
      <?php
$sql2 = "SELECT * FROM menu_sub";
$qry2 = mysql_query($sql2,$koneksi)
       or die ("SQL Error".mysql_error());
	   $i = 0;
while ($data2=mysql_fetch_array($qry2)){;
?>
      <input type="checkbox" value="<?php echo $data2['kd_sub_menu'];?>" name="kd_sub_menu<?php echo $i;?>" id="kd_sub_menu<?php echo $i;?>"/>
      <input type="hidden" value="<?php echo $data2['kd_menu'];?>" name="kd_menu<?php echo $i;?>" />
      <label for="kd_sub_menu<?php echo $i;?>"><?php echo $data2['nama_sub_menu'];?></label>
      <?php $i++;?></br>
      <?php	  
}
?>
      <input type="hidden" name="n" value="<?php echo $i;?>"/></td>
    <td valign="top"><?php
$sql3 = "SELECT * FROM menu_sub,menu_user WHERE menu_sub.kd_sub_menu=menu_user.kd_sub_menu AND username='$username'";
$qry3 = mysql_query($sql3,$koneksi)
       or die ("SQL Error".mysql_error());
	   $i = 0;
while ($data3=mysql_fetch_array($qry3)){;
?>
      <input type="checkbox" value="<?php echo $data3['kd_sub_menu'];?>" name="ksm<?php echo $i;?>" id="ksm<?php echo $i;?>"/>
      <input type="hidden" value="<?php echo $data3['kd_menu'];?>" name="kd_menu<?php echo $i;?>" />
	  <label for="ksm<?php echo $i;?>"><?php echo $data3['nama_sub_menu'];?></label>
      <?php $i++;?></br>
      <?php	  
}
?></td>
  </tr>
  <tr bgcolor="#ffffff">  
    <td valign="top"><input type="submit" value="add" name="submit">
    </a></td>
    <td valign="top">
	<input type="submit" name="submit" value="Hapus" onClick="myform.action='menu_hapus.php?ksm=<?php echo $data['kd_sub_menu'];?>'; return true;"></td>
  </tr>
</table>
</form>
</body>
</html>
