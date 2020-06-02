<?php 
include "../librari/inc.koneksidb.php";
include_once "../librari/inc.session.php";
$sql = "SELECT * FROM data_klinik";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
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
<title>Update Database Staff</title>
</head>
<body id=tab1>
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
   <tr> 
      <td colspan="3" bgcolor="#DBEAF5"><div align="left">PROFIL KLINIK </div></td>
    </tr>
<tr bgcolor="#FFFFFF"> 
  <td width="17%" rowspan="9" valign="top">&nbsp;<?php
    if ($data['logo']=="") {
	echo "<img src='gambar/no_pic.jpg' width='125' height='125' valign=top align='center'/>";
	}
	else {
	echo "<img src='gambar/".$data['logo']."' width='125' height='125' valign=top align='center'/>";
	}
	?></br><a href="klinik_photo.php?kode=<?php echo $data['kode'];?>" onClick="NewWindow(this.href,'name','800','400','yes');return false"><div align="center"<b>Ganti photo</b></div></a></td>
  <td>Identitas klinik </td>
  <td><?php echo $data['nama_klinik']; ?>  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td width="26%">Keterangan</td>
  <td width="57%"><?php echo $data['keterangan']; ?>     </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Alamat</td>
  <td align="left"><?php echo $data['alamat1']; ?></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Kota</td>
  <td align="left"><?php echo $data['alamat2']; ?></td>
</tr>
<tr bgcolor="#FFFFFF"> 
 <td>Telpon 1 </td>
 <td align="left"><?php echo $data['telpon1']; ?></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Telpon 2 </td>
  <td><?php echo $data['telpon2']; ?></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Email</td>
  <td><?php echo $data['email']; ?></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Fax</td>
  <td><?php echo $data['fax']; ?></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td><a href="data_klinik.php?kode=<?php echo $data['kode'];?>">Update</a></td>
  <td>&nbsp;</td>
</tr>
</table>
</body>
</html>