<?php
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

<?php
$query = "SELECT * FROM inbox ORDER BY ID DESC";
$hasil = mysql_query($query) or die(mysql_error());
while ($data = mysql_fetch_array($hasil))
{
?>
	
	<tr    onmouseover="this.bgColor='lightyellow'"
onmouseout="this.bgColor='#ffffff'" bgcolor="#ffffff"
>
      <td width="22%"><?php echo $data['ReceivingDateTime'];?></td>
      <td width="15%"><?php echo $data['SenderNumber'];?></td></br><?php echo $data['nama'];?></td>
      <td width="46%"><?php echo $data['TextDecoded'];?></td>
      <td width="10%"><?php echo $data['RecipientID'];?></td>
      <td width="7%"><div align="center"><a href="inbox_hapus.php?ID=<?php echo $data['ID']; ?>" class="style1">Hapus</a></div></td>
      <?php
}
?>
</table>
