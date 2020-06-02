<?php
include "../librari/inc.koneksidb.php";
$handle = @fopen("smsdrc1", "r");
if ($handle) {
    while (!feof($handle)) {
        $buffer = fgets($handle);

		if (substr_count($buffer, 'user = ') > 0)
		{
		   $split = explode("user = ", $buffer);
		   $user = str_replace("\r\n", "", $split[1]);
		}

		if (substr_count($buffer, 'password = ') > 0)
		{
		   $split = explode("password = ", $buffer);
		   $pass = str_replace("\r\n", "", $split[1]);
		}

		if (substr_count($buffer, 'database = ') > 0)
		{
		   $split = explode("database = ", $buffer);
		   $db = str_replace("\n", "", $split[1]);
		}
		
    }
    fclose($handle);
}

mysql_connect('localhost', $user, $pass);
mysql_select_db($db);
?>
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
<tr bgcolor="#FFFFFF">
      <td width="22%" bgcolor="#D9E8F3"><div align="center"><strong>TGL/JAM TERIMA </strong></div></td>
      <td width="15%" bgcolor="#D9E8F3"><div align="center"><strong>NO PENGIRIM </strong></div></td>
      <td width="46%" bgcolor="#D9E8F3"><div align="center"><strong>ISI PESAN </strong></div></td>
      <td width="10%" bgcolor="#D9E8F3"><div align="center"><strong>PHONE ID </strong></div></td>
      <td width="7%" bgcolor="#D9E8F3"><div align="center"><strong>AKSI</strong></div></td>
    </tr>
<?php
$query = "SELECT * FROM sms_inbox ORDER BY ID DESC";
$hasil = mysql_query($query) or die(mysql_error());
while ($data = mysql_fetch_array($hasil))
{
?>
	
	<tr    onmouseover="this.bgColor='lightyellow'"
onmouseout="this.bgColor='#ffffff'" bgcolor="#ffffff"
>
      <td><?php echo $data['time'];?></td>
      <td><?php echo $data['sender'];?></td>
      <td><?php echo $data['msg'];?></td>
      <td><?php echo $data['idmodem'];?></td>
      <td><div align="center"><a href="inbox_hapus.php?ID=<?php echo $data['id']; ?>" class="style1">Hapus</a></div></td>
      <?php
}
?>
</table>