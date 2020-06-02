<?php
include "tab_ranap.php";
include "../../config/config.php";
include "../librari/inc.koneksidb.php";

$kd_kunjungan = $_REQUEST['kd_kunjungan'];
$sql = "SELECT * FROM pasien_poliklinik WHERE kd_kunjungan='$kd_kunjungan'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry);
$DataPerawat = $data['perawat'];
$DataDokter = $data['dokter'];
$keluhan = $data['keluhan'];
$group_diagnosa = $data['group_diagnosa'];
?>
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<script type="text/javascript" src="<?php echo $url;?>media/ckeditor/ckeditor.js"></script>
<script src="<?php echo $url;?>media/ckeditor/_samples/sample.js" type="text/javascript"></script>
<link href="<?php echo $url;?>media/ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">
  function konfirmasi (kd_kunjungan) {
   tanya = confirm('Yakin akan disimpan ?');
   if (tanya == true) return true;
   else return false;
   }
</script>
<script src="../src/js/jscal2.js"></script>
    <script src="../src/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="../src/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../src/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="../src/css/steel/steel.css" />
<title>POLIKLINIK</title>
<style type="text/css">
<!--
.style2 {font-size: 9px}
.style2 {font-size: 9px}
-->
</style>
</head>
<body id="tab8">
<table width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
<form name="form1" method="post" action="predischarge_sim.php?kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>">
<?php 
$sql = "SELECT * FROM pasien_poliklinik WHERE kd_kunjungan='$kd_kunjungan'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
?>
   <tr bgcolor="#FFFFFF">
    <td width="2%" bgcolor="#D9E8F3" colspan="4">PERSIAPAN PASIEN PULANG </td>
   </tr>
  <tr bgcolor="#FFFFFF">
   <td width="19%" align="left" ><strong>Diagnosa Akhir </strong></td>
   <td width="81%" height="26" align="left" ><select name="diagnosa_keluar" id="diagnosa_keluar">
     <option value="" selected>[Pilih...]</option>
     <?php
	$sql = "SELECT * FROM group_diagnosa";
      	$qry = @mysql_query($sql, $koneksi) or die ("gagal Query");
	while ($data =mysql_fetch_array($qry)) {
	if ($data[group_diagnosa]==$group_diagnosa) {
	$cek="selected";
	}
	else {
	$cek="";
	}
	echo "<option value='$data[group_diagnosa]' $cek>".$data['group_diagnosa']."</option>";
	}
	?>
   </select>
<?php 
$kd_kunjungan = $_GET['kd_kunjungan'];
$sql = "SELECT * FROM pasien_rawat WHERE kd_kunjungan='$kd_kunjungan'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
?></td>

  </tr>
 <tr bgcolor="#FFFFFF">
    <td align="left"><strong>Alasan Pulang </strong></td>
    <td align="left"><select name="alasan_keluar" id="alasan_keluar">
        <?php 
        if ($data['alasan_keluar']=="") echo "<option value='' selected>[Pilih...]</option>";
        else echo "<option value=''>[Pilih...]</option>";
        if ($data['alasan_keluar']=="Sembuh/perbaikan") echo "<option value='Sembuh/perbaikan' selected>Sembuh/perbaikan</option>";
        else echo "<option value='Sembuh/perbaikan'>Sembuh/perbaikan</option>";
        if ($data['alasan_keluar']=="Atas permintaan sendiri") echo "<option value='Atas permintaan sendiri' selected>Atas permintaan sendiri</option>";
        else echo "<option value='Atas permintaan sendiri'>Atas permintaan sendiri</option>";
        if ($data['alasan_keluar']=="Rujuk") echo "<option value='Rujuk' selected>Rujuk</option>";
        else echo "<option value='Rujuk'>Rujuk</option>";
        if ($data['alasan_keluar']=="Meninggal < 24 jam") echo "<option value='Meninggal < 24 jam' selected>Meninggal < 24 jam</option>";
        else echo "<option value='Meninggal < 24 jam'>Meninggal < 24 jam</option>";
        if ($data['alasan_keluar']=="Meninggal > 24 jam") echo "<option value='Meninggal > 24 jam' selected>Meninggal > 24 jam</option>";
        else echo "<option value='Meninggal > 24 jam'>Meninggal > 24 jam</option>";
        ?>             
        </select></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left"> <strong>Keterangan</strong></td>
    <td colspan="3" align="left"><input name="keterangan" type="text" id="keterangan" value="<?php echo $data['keterangan']; ?>">
      * <span class="style2">Isi dengan RS atau Ward  tujuan atau alasan dirujuk </span></td>
  </tr>
  <tr> 
    <td colspan="2" bgcolor="#FFFFFF"><label>
    <input name="jam_keluar" type="hidden" id="jam_keluar" value="<?php echo "".date('H:i') ;?>">
	<input name="tanggal_keluar" type="hidden" id="tanggal_keluar" value="<?php echo "".date('Y-m-d') ;?>">
    <input type="submit" name="Submit" value="Submit" title="Predisharge">
    </label></td>
  </tr>
  </form>
</table>
</body>
</html> 
