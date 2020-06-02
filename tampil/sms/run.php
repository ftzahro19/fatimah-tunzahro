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

include "../librari/inc.koneksidb.php";
?>
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
<tr bgcolor="#FFFFFF">
      <td width="22%" bgcolor="#D9E8F3"><div align="center"><strong>TGL/JAM KIRIM </strong></div></td>
    <td width="19%" bgcolor="#D9E8F3"><div align="center"><strong>NO TUJUAN</strong></div></td>
      <td width="42%" bgcolor="#D9E8F3"><div align="center"><strong>ISI PESAN </strong></div></td>
      <td width="10%" bgcolor="#D9E8F3"><div align="center"><strong>STATUS</strong></div></td>
      <td width="7%" bgcolor="#D9E8F3"><div align="center"><strong>AKSI</strong></div></td>
  </tr>
<?php
$query = "SELECT * FROM sentitems";
$hasil = mysql_query($query) or die(mysql_error());
while ($data = mysql_fetch_array($hasil))
{
?>
	
	<tr    onmouseover="this.bgColor='lightyellow'"
onmouseout="this.bgColor='#ffffff'" bgcolor="#ffffff"
>
      <td><?php echo $data['SendingDateTime'];?></td>
      <td><?php echo $data['DestinationNumber'];?><br/><?php echo $data['nama'];?></td>
      <td><?php echo $data['TextDecoded'];?></td>
      <td><?php echo $data['Status'];?></td>
      <td><div align="center"><a href="outbox_hapus.php?ID=<?php echo $data['ID']; ?>" class="style1">Hapus</a></div></td>
      <?php
}
?>
</table>