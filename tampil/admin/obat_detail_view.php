<?php 
include "../librari/inc.koneksidb.php";
include_once "../librari/inc.session.php";
$no_faktur = $_REQUEST['no_faktur'];
$sql1 = "SELECT * FROM obat_faktur WHERE no_faktur='$no_faktur'";
$qry1 = mysql_query($sql1, $koneksi) 
	 or die ("SQL Error".mysql_error());
$data1=mysql_fetch_array($qry1);
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
<title>FAKTUR OBAT</title>
</head>
<body>
  <table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
      <td colspan="5" bgcolor="#CCCCCC"><div align="left"><strong>DETAIL TAMBAHAN OBAT</strong></div></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td colspan="5" bgcolor="#FFFFFF">
<?php
if ($data1['keterangan']=="Closed"){?> 
<img src="../../media/image/file_add_disabled.png" width="20" height="20">Tambah
<?php }
else {?>
	  <a href="obat_detail_tambah.php?no_faktur=<?php echo $no_faktur;?>" onClick="NewWindow(this.href,'name','800','200','yes');return false"><img src="../../media/image/file_add.png" width="20" height="20">Tambah</a>
<?php
}
?>	  </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td colspan="5" bgcolor="#FFFFFF">Nomor Faktur : <?php echo $data1['faktur'];?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="6%" bgcolor="#D9E8F3">&nbsp;</td>
      <td width="16%" bgcolor="#D9E8F3"><div align="center"><strong>KODE OBAT </strong></div></td>
	  <td width="30%" bgcolor="#D9E8F3"><div align="center"><strong>NAMA OBAT </strong></div></td>
	  <td width="9%" bgcolor="#D9E8F3"><div align="center"><strong>JUMLAH</strong></div></td>
	  <td width="16%" bgcolor="#D9E8F3"><div align="center"><B>KETERANGAN</B></div></td>
    </tr>
<?php 
	$sql2 = "SELECT * FROM obat_db,obat_stock WHERE obat_db.kd_obat=obat_stock.kd_obat AND no_faktur='$no_faktur'";
	$qry2 = mysql_query($sql2, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data2=mysql_fetch_array($qry2)) {
?>
    <tr bgcolor="#FFFFFF">
      <td>
<?php	  
if ($data1['keterangan']=="Closed"){?> 
	  <img src="../../media/image/file_edit_disabled.png" width="20" height="20">
	  <img src="../../media/image/file_delete_disabled.png" width="20" height="20">	  
<?php }
else {?>
	  <a href="obat_detail_edit.php?no=<?php echo $data2['no'];?>" onClick="NewWindow(this.href,'name','800','200','yes');return false"><img src="../../media/image/file_edit.png" width="20" height="20"></a>
	  <a href="obat_detail_hapus.php?no=<?php echo $data2['no'];?>&no_faktur=<?php echo $data2['no_faktur'];?>"><img src="../../media/image/file_delete.png" width="20" height="20"></a>	  
<?php
}
?>	  </td>
      <td><?php echo $data2['kd_obat'];?></td>
      <td><?php echo $data2['nama_obat'];?></td>
	  <td align="center"><?php echo $data2['jumlah'];?></td>
	  <td align="center"><?php echo $data2['keterangan'];?></td>
	  <?php
}
?>
    </tr>
  </table>
</body>
</html>
