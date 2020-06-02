<?php 
include "../librari/inc.koneksidb.php";
include_once "../librari/inc.session.php";
?>
<html>
<head>
<script language="javascript">
var win = null;
function NewWindow(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
}
</script>
<title>FAKTUR OBAT</title></head>
<body>
  <table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
      <td colspan="5" bgcolor="#CCCCCC"><div align="left"><strong>RIWAYAT PENAMBAHAN  OBAT </strong></div></td>
    </tr>
	    
    <tr bgcolor="#FFFFFF">
      <td colspan="5" bgcolor="#FFFFFF"><a href="obat_faktur_tambah.php" title="Tambah faktur pembelian" onClick="NewWindow(this.href,'name','800','400','yes');return false"><img src="../../media/image/file_add.png" width="20" height="20">Tambah</a></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="6%" bgcolor="#D9E8F3">&nbsp;</td>
      <td width="14%" bgcolor="#D9E8F3"><div align="center"><strong>TANGGAL </strong></div></td>
	  <td width="19%" bgcolor="#D9E8F3"><div align="center"><strong>FAKTUR </strong></div></td>
	  <td width="11%" bgcolor="#D9E8F3"><div align="center"><strong>USER</strong></div></td>
	  <td width="50%" bgcolor="#D9E8F3"><div align="center"><B>KETERANGAN</B></div></td>
    </tr>
<?php 
	$sql = "SELECT * FROM obat_faktur";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
?>
    <tr bgcolor="#FFFFFF">
      <td>
	  <a href="obat_detail_view.php?no_faktur=<?php echo $data['no_faktur'];?>" title="Lihat detail faktur"><img src="../../media/image/file_search.png" width="20" height="20"></a>
<?php
if ($data['keterangan']=="Closed"){?> 
<img src="../../media/image/file_edit_disabled.png" width="20" height="20">
<?php }
else {?>
	  <a href="obat_faktur_edit.php?no_faktur=<?php echo $data['no_faktur'];?>" title="Update faktur"  onClick="NewWindow(this.href,'name','800','400','yes');return false"><img src="../../media/image/file_edit.png" width="20" height="20"></a>
<?php
}
?>
	  </td>
      <td><?php echo $data['tanggal'];?></td>
      <td><?php echo $data['faktur'];?></td>
	  <td align="center"><?php echo $data['user'];?></td>
	  <td align="center"><?php echo $data['keterangan'];?></td>
	  <?php
}
?>
    </tr>
  </table>
</body>
</html>
