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
</head>
<body><form name="form1" method="post" action="daftar_pasien.php?klinik='$klinik'">
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
    <tr bgcolor="#D9E8F3">
      <td colspan="7">
        <select name="klinik" id="klinik">
          <option value="*" selected>[Pilih...]</option>
          <?php
	$sql1 = "SELECT * FROM klinikdb";
    $qry1 = mysql_query($sql1, $koneksi) or die ("gagal Query");
	while ($data1 =mysql_fetch_array($qry1)) {
	echo "<option value='$data1[kd_klinik]' $cek>".$data1['nama_klinik']."</option>";
	}
	?>
        </select>
        <input type="submit" name="Submit" value="Tampilkan">
      </td>
    </tr>
	<tr bgcolor="#FFFFFF">
      <td width="6%" bgcolor="#D9E8F3"><div align="center"><strong>No</strong></div></td>
      <td width="19%" bgcolor="#D9E8F3"><div align="center"><strong>Nama [ PRN ]</strong></div></td>
      <td width="13%" bgcolor="#D9E8F3"><div align="center"><strong>Tanggal Lahir</strong></div></td>
      <td width="13%" bgcolor="#D9E8F3"><div align="center"><strong>Jam Daftar </strong></div></td>
      <td width="13%" bgcolor="#D9E8F3"><div align="center"><strong>Klinik</strong></div></td>
      <td width="24%" bgcolor="#D9E8F3"><div align="center"><strong>Dokter</strong></div></td>
      <td width="12%" bgcolor="#D9E8F3"><div align="center"><strong>Keterangan</strong></div></td>
    </tr>
<?php 
$klinik = $_REQUEST['klinik'];
$query2 ="SELECT * FROM reg,klinikdb WHERE reg.klinik=klinikdb.kd_klinik AND reg.klinik LIKE '$klinik%' GROUP BY reg.klinik";
$result2 =mysql_query($query2) or die(mysql_error());
$no = 1;
while($data2=mysql_fetch_array($result2)){

  ?>
    <tr bgcolor="#D9E8F3">
      <td colspan="7">Klinik <?php echo $data2['nama_klinik'];?></td>
    </tr>  
<?php 
	$tanggal = date("Y:m:d");
	$klinik2 = $data2[klinik];
	$sql3 = "SELECT * FROM reg,data_pasien,klinikdb WHERE reg.prn=data_pasien.prn AND reg.klinik=klinikdb.kd_klinik AND reg.klinik='$klinik2'";
	$qry3 = mysql_query($sql3, $koneksi) 
		 or die ("SQL Error".mysql_error());
		while ($data3=mysql_fetch_array($qry3)) {	 
		if($data3['selesai']=="Aktif"){

  ?>
    <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff" span class="style1">
	<td><?php echo $no++ ;?> </td>
      <td><a href="../poliklinik/lap_poli.php?kd_kunjungan=<?php echo $data3['kd_kunjungan']; ?>"><?php echo $data3['nama'];?> [<?php echo $data3['prn'];?>]</a></td>
      <td><a href="../poliklinik/lap_poli.php?kd_kunjungan=<?php echo $data3['kd_kunjungan']; ?>"><?php echo $data3['tgl_lahir'];?></a></td>
      <td><a href="../poliklinik/lap_poli.php?kd_kunjungan=<?php echo $data3['kd_kunjungan']; ?>"><?php echo $data3['tanggal'];?></a></td>
      <td><a href="../poliklinik/lap_poli.php?kd_kunjungan=<?php echo $data3['kd_kunjungan']; ?>"><?php echo $data3['nama_klinik'];?></a></td>      
      <td>
	<?php
	$dokter = $data3['dokter'];
	$sql4 = "SELECT * FROM user WHERE username='$dokter'";
    $qry4 = mysql_query($sql4, $koneksi) or die ("gagal Query");
	$data4 =mysql_fetch_array($qry4);?>
	  <a href="../poliklinik/lap_poli.php?kd_kunjungan=<?php echo $data3['kd_kunjungan']; ?>">
	  <?php echo $data4['nama'];?></a></td>
<td width="12%" bgcolor="#FFFFFF">
<div align="center"><a href="../poliklinik/lap_poli.php?kd_kunjungan=<?php echo $data3['kd_kunjungan']; ?>"><?php echo $data3['selesai'];?></a></div></td>
</tr>
<?php
}
elseif($data3['selesai']=="Proses") {
?>
<tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff" span class="style1">
	<td><?php echo $no++ ;?> </td>
      <td><a href="../poliklinik/lap_poli_edit.php?kd_kunjungan=<?php echo $data3['kd_kunjungan']; ?>"><?php echo $data3['nama'];?> [<?php echo $data3['prn'];?>]</a></td>
      <td><a href="../poliklinik/lap_poli_edit.php?kd_kunjungan=<?php echo $data3['kd_kunjungan']; ?>"><?php echo $data3['tgl_lahir'];?></a></td>
      <td><a href="../poliklinik/lap_poli_edit.php?kd_kunjungan=<?php echo $data3['kd_kunjungan']; ?>"><?php echo $data3['tanggal'];?></a></td>
      <td><a href="../poliklinik/lap_poli_edit.php?kd_kunjungan=<?php echo $data3['kd_kunjungan']; ?>"><?php echo $data3['nama_klinik'];?></a></td>      
      <td><a href="../poliklinik/lap_poli_edit.php?kd_kunjungan=<?php echo $data3['kd_kunjungan']; ?>">
	  <?php
	$dokter = $data3['dokter'];
	$sql4 = "SELECT * FROM user WHERE username='$dokter'";
    $qry4 = mysql_query($sql4, $koneksi) or die ("gagal Query");
	$data4 =mysql_fetch_array($qry4);?> <?php echo $data4['nama'];?></a></td>
      <td width="12%" bgcolor="#FFFFFF">
<div align="center"><a href="../poliklinik/lap_poli_edit.php?kd_kunjungan=<?php echo $data3['kd_kunjungan']; ?>"><?php echo $data3['selesai'];?></a></div></td>
</tr>
<?php
}
}
}
?>
  </table>
        </form>
</body>
</html>
