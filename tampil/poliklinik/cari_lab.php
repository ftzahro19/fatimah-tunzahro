<?php
include "../librari/inc.session.php";
include "tab_dokter.php";
$kd_kunjungan 	= $_REQUEST['kd_kunjungan'];
$nama_lab	= $_REQUEST['nama_lab'];
if ($kd_kunjungan !="") {
   $sql = "SELECT * FROM reg WHERE kd_kunjungan='$kd_kunjungan'";
   $qry = mysql_query($sql,$koneksi)
      or die ("SQL Error".mysql_error());
   $data=mysql_fetch_array($qry);
}
?>
<html>
<head>
<title>LABORATORIUM</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252"><style type="text/css">
<!--
a:link {
	color: #000080;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #0000FF;
}
a:hover {
	text-decoration: none;
	color: #FF0000;
}
a:active {
	text-decoration: none;
}
.style1 {font-size: 14px}
-->
</style>
</head>
<body id="tab3">
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#DBEAF5">
<form name="form1" method="post" action="lab_sim.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>">
    <input name="kd_kunjungan" type="hidden" value="<?php echo $data['kd_kunjungan'];?>"/>
    <input name="tanggal_lab" type="hidden" value="<?php echo "".date('Y-m-d');?>" />
    <input name="jam_lab" type="hidden" value="<?php echo "".date('H:i');?>" />
 <tr bgcolor="#FFFFFF">
    <td width="3%" bgcolor="#D9E8F3"><div align="left">Cek</div></td>
    <td width="23%" bgcolor="#D9E8F3"><div align="left">Nama Laboratorium</div></td>
    <td width="11%" bgcolor="#D9E8F3"><div align="left">Harga</div></td>
    <td width="11%" bgcolor="#D9E8F3"><div align="left">Keterangan</div></td>
 </tr>

  <?php
// query untuk mencari file berdasarkan kategori

$gol_lab	= $_REQUEST['gol_lab'];
$nama_lab	= $_REQUEST['nama_lab'];

$query = "SELECT * FROM lab_db WHERE gol_lab LIKE '%$gol_lab%' AND nama_lab LIKE '%$nama_lab%'";
$hasil = mysql_query($query);
$no = 1;
while ($data = mysql_fetch_array($hasil))
{
$harga_lab = $data['harga_lab'];
$harga_total = $harga_total + $harga_lab;
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><input type="checkbox" value="<?php echo $data['nama_lab'];?>" name="lab<?php echo $no;?>" /></td>
    <td class="style1"><?php echo $data['nama_lab'];?></td>
    <td class="style1">
	<input name="harga_lab<?php echo $no;?>" type="hidden" id="harga_lab" size="8" value="<?php echo $harga_lab ;?>">
	<input name="harga_lab<?php echo $no;?>" type="text" id="harga_lab" size="8" value="<?php echo $harga_lab ;?>" disabled="disabled">
    </td>
    <td class="style1"><input name="keterangan<?php echo $no;?>" type="text" value="<?php echo $keterangan ;?>"><?php$no++;?></td>
  </tr>
  <?php
}
?>
<tr bgcolor="#FFFFFF">
      <td width="5%" bgcolor="#FFFFFF"><input type="hidden" name="jumMK" value="<?php echo $no-1; ?>" /></td>
      <td width="55%" bgcolor="#FFFFFF" colspan="2"><input type="submit" name="Submit" value="Tambahkan"></td>
<td width="40%"><span class="style1"></span></td>
    </tr>
	  </form>
</table>
</body>
</html>


