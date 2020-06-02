<?php 
include "../librari/inc.koneksidb.php"; 
?>
<html>
<head>
<title>Daftar pasien per tanggal <?php echo date("d-m-Y");?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<style type="text/css">
<!--
a:link {
	color: #FF0000;
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
.style1 {font-size: 16px}
-->
</style>
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
</head>
<body><form name="form1" method="post" action="pasien_terdaftar.php?kd_unit='$kd_unit'">
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
    <tr bgcolor="#D9E8F3">
      <td colspan="7">Ruangan :
        <select name="ruang" id="ruang">
          <option value="%%%" selected>[Pilih...]</option>
          <?php
	$sql = "SELECT * FROM ruang group by ruang";
    $qry = @mysql_query($sql, $koneksi) or die ("gagal Query");
	while ($data =mysql_fetch_array($qry)) {
	if ($data[ruang]==$ruang) {
	$cek="selected";
	}
	else {
	$cek="";
	}
	echo "<option value='$data[ruang]' $cek>".$data['ruang']."</option>";
	}
	?>
        </select>
        <input type="submit" name="Submit" value="Tampilkan">      </td>
    </tr>
	<tr bgcolor="#FFFFFF">
      <td width="4%" bgcolor="#D9E8F3"><div align="center"><strong>No</strong></div></td>
      <td width="14%" bgcolor="#D9E8F3"><div align="center"><strong>Nama [ PRN ]</strong></div></td>
      <td width="10%" bgcolor="#D9E8F3"><div align="center"><strong>Tanggal Lahir</strong></div></td>
      <td width="10%" bgcolor="#D9E8F3"><div align="center"><strong>Tanggal Masuk</strong></div></td>
      <td width="10%" bgcolor="#D9E8F3"><div align="center"><strong>Kamar/Kelas</strong></div></td>
      <td width="14%" bgcolor="#D9E8F3"><div align="center"><strong>Diagnosa</strong></div></td>
      <td width="12%" bgcolor="#D9E8F3">&nbsp;</td>
    </tr>
<?php 
$ruang = $_REQUEST['ruang'];
$query ="SELECT * FROM ruang,pasien_rawat,data_pasien WHERE pasien_rawat.prn=data_pasien.prn AND ruang.ruang=pasien_rawat.ruang AND ruang.ruang LIKE '$ruang%'  AND pasien_rawat.status='Aktif' GROUP BY pasien_rawat.ruang";
$result =mysql_query($query) or die(mysql_error());
$no = 1;
while($data=mysql_fetch_array($result)){

  ?>
    <tr bgcolor="#D9E8F3">
      <td colspan="7"><?php echo $data['ruang'];?></td>
    </tr>  
<?php 

	$ruang2 = $data[ruang];
	$sql = "SELECT * FROM data_pasien,pasien_rawat WHERE data_pasien.prn=pasien_rawat.prn AND ruang='$ruang2' AND pasien_rawat.status='Aktif' ORDER BY kamar";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {

$tanggal = date("Y:m:d");
$tgl_lahir = $data['tgl_lahir'];
$query = "SELECT datediff('$tanggal', '$tgl_lahir')
          as selisih";

$hasil = mysql_query($query);
$data_u = mysql_fetch_array($hasil);

$tahun = floor($data_u['selisih']/365);
$bulan = floor(($data_u['selisih'] - ($tahun * 365))/30);
$hari = $data_u['selisih'] - $bulan * 30 - $tahun * 365;

  ?>
    <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff" span class="style1">
	<td><?php echo $no++ ;?> </td>
      <td><a href="tab_ranap.php?kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>"><?php echo $data['nama'];?> [<?php echo $data['prn'];?>]</a></td>
      <td><a href="tab_ranap.php?kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>"><?php echo $data['tgl_lahir'];?></br> [<?php echo "$tahun";?> thn,<?php echo "$bulan";?> bln]</a></td>
      <td><a href="tab_ranap.php?kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>"><?php echo $data['tanggal'];?></a></td>
      <td><a href="tab_ranap.php?kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>"><?php echo $data['kamar'];?>/<?php echo $data['kelas'];?></a></td>      
<td><a href="tab_ranap.php?kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>"><?php echo $data['diagnosa_masuk'];?></a></td>
<td width="12%" bgcolor="#FFFFFF">
<div align="center"><a href="../registrasi/reg_ri_edit.php?kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>" onClick="NewWindow(this.href,'name','800','600%','yes');return false">Update</a> | <a href="discharge_form.php?kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>" title="Untuk mendischarge pasien...!">Discharge</a></div></td>
<?php
}
}
?>
  </table>
        </form>
</body>
</html>
