<?php
include "tab_order_poli.php";
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
<body id="tab1">
<table width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <form name="form1" method="post" action="lap_poli_edit_sim.php?kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>">
   <tr bgcolor="#FFFFFF">
    <td width="2%" bgcolor="#D9E8F3" colspan="4">CATATAN MEDIS</td>
   </tr>
   <tr bgcolor="#FFFFFF"><input name="prn" type="hidden" id="prn"  value="<?php echo $data['prn'];?>">
    <td width="25%" align="left"><strong>
      <input name="tgl_respon" type="hidden" id="tgl_respon" size="9" value="<?php echo "".date('Y-m-d') ;?>" onBlur="if(this.value=='') this.value='<?php echo "".date('Y-m-d') ;?>';" onFocus="if(this.value=='<?php echo "".date('Y-m-d') ;?>') this.value='';">
      <input name="jam_respon" type="hidden" id="jam_respon" size="7" value="<?php echo $data['jam_respon'];?>" onBlur="if(this.value=='') this.value='<?php echo $data['jam_respon'];?>';" onFocus="if(this.value=='<?php echo $data['jam_respon'];?>') this.value='';">
      Petugas</strong></td>
    <td width="19%" align="left"><select name="perawat" id="perawat">
    <option value="" selected>[Pilih...]</option>
	<?php
	$sql = "SELECT * FROM user WHERE status='Aktif'";
      	$qry = @mysql_query($sql, $koneksi) or die ("gagal Query");
	while ($data =mysql_fetch_array($qry)) {
	if ($data[nama]==$DataPerawat) {
	$cek="selected";
	}
	else {
	$cek="";
	}
	echo "<option value='$data[nama_user]' $cek>".$data['nama_user']."</option>";
	}
	?>
    </select></td>
    <td width="19%" align="left"><strong>Shift</strong></td>
    <td width="37%" align="left"><select name="shift" id="shift">
      <?php 
        if ($data['shift']=="Pagi") echo "<option value='Pagi' selected>Pagi</option>";
        else echo "<option value='Pagi'>Pagi</option>";
 		if ($data['shift']=="Sore") echo "<option value='Sore' selected>Sore</option>";
        else echo "<option value='Sore'>Sore</option>";
		if ($data['shift']=="Malam") echo "<option value='Malam' selected>Malam</option>";
        else echo "<option value='Malam'>Malam</option>";
        ?>
    </select></td>
    <?php 
$kd_kunjungan = $_GET['kd_kunjungan'];
$sql = "SELECT * FROM pasien_poliklinik WHERE kd_kunjungan='$kd_kunjungan'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
?>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left"><strong>Riwayat alergi </strong></td>
    <td align="left" colspan="3"><input type="text" name="alergi" value="<?php echo $data['alergi'];?>"> </td>
      </tr>
	  <tr bgcolor="#FFFFFF">
    <td colspan="4" align="left"><strong>Riwayat Penyakit</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left">
    <?php 
    if ($data['hepatitis']=="X") echo "<input type='checkbox' name='hepatitis' value='X' checked>Hepatitis";
    else echo "<input type='checkbox' name='hepatitis' value='X'>Hepatitis";
    ?>    </td>
    <td align="left"><?php 
    if ($data['hipertensi']=="X") echo "<input type='checkbox' name='hipertensi' value='X' checked>Hipertensi";
    else echo "<input type='checkbox' name='hipertensi' value='X'>Hipertensi";
    ?></td>
    <td><?php 
    if ($data['diabetes']=="X") echo "<input type='checkbox' name='diabetes' value='X' checked>Diabetes";
    else echo "<input type='checkbox' name='diabetes' value='X'>Diabetes";
    ?></td>
    <td><?php 
    if ($data['gastritis']=="X") echo "<input type='checkbox' name='gastritis' value='X' checked>Gastritis";
    else echo "<input type='checkbox' name='gastritis' value='X'>Gastritis";
    ?></td>
    </tr>
	  
	  
<?php 
$kd_kunjungan = $_GET['kd_kunjungan'];
$sql = "SELECT * FROM pasien_poliklinik WHERE kd_kunjungan='$kd_kunjungan'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
?>
  <tr bgcolor="#FFFFFF">
    <td colspan="4" align="left"><strong>Keluhan</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="4" align="left"><textarea cols="80" id="keluhan" name="keluhan" rows="10"><?php echo $data['keluhan']; ?></textarea>
			<script type="text/javascript">
		//<![CDATA[

			// Replace the <textarea id="editor"> with an CKEditor
			// instance, using default configurations.
			CKEDITOR.replace( 'keluhan',
				{
					skin : 'office2003',
					extraPlugins : 'uicolor',
					uiColor: '#DC0C4B',
					toolbar :
					[
						[ 'NewPage','Save','Preview','Print','-','SelectAll','Copy','Cut','Paste','-','Bold', 'Italic','Underline','Strike','Superscript','Subscript','TextColor','BGColor','Smiley','-', 'NumberedList', 'BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','Indent','Outdent','-','Undo','Redo' ]

					]
				} );

		//]]>
		</script></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="4" align="left"><strong>Diagnosa</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
   <td align="left" colspan="2" ><select name="group_diagnosa" id="group_diagnosa">
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
    </select></td>
<?php 
$kd_kunjungan = $_GET['kd_kunjungan'];
$sql = "SELECT * FROM pasien_poliklinik WHERE kd_kunjungan='$kd_kunjungan'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
?>
    <td height="26" colspan="2" align="left">
      <input name="diagnosa" type="text" id="diagnosa" value="<?php echo $data['diagnosa']; ?>" size="40" col="5">    </td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="4" align="left">
      <strong>Infus</strong> : 
    <select name="infus" id="infus">
      <?php 
        if ($data['infus']=="Tidak pasang") echo "<option value='Tidak pasang' selected>Tidak pasang</option>";
        else echo "<option value='Tidak pasang'>Tidak pasang</option>";
        if ($data['infus']=="1") echo "<option value='1' selected>1 kali</option>";
        else echo "<option value='1'>1 kali</option>";
 	if ($data['infus']=="2") echo "<option value='2' selected>2 kali</option>";
        else echo "<option value='2'>2 kali</option>";
 	if ($data['infus']=="Lebih dari 2") echo "<option value='Lebih dari 2' selected>Lebih dari 2</option>";
        else echo "<option value='Lebih dari 2'>Lebih dari 2</option>";
 	?>
    </select></td>
    </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="4" align="left"><strong>Pemeriksaan penunjang </strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left">
    <?php 
    if ($data['lab']==1) echo "<input type='checkbox' name='lab' value='1' checked>Lab";
    else echo "<input type='checkbox' name='lab' value='1'>Lab";
    ?>    </td>
    <td align="left"><?php 
    if ($data['usg']==1) echo "<input type='checkbox' name='usg' value='1' checked>USG";
    else echo "<input type='checkbox' name='usg' value='1'>USG";
    ?></td>
    <td><?php 
    if ($data['ro']==1) echo "<input type='checkbox' name='ro' value='1' checked>Rontgen";
    else echo "<input type='checkbox' name='ro' value='1'>Rontgen";
    ?></td>
    <td><?php 
    if ($data['ekg']==1) echo "<input type='checkbox' name='ekg' value='1' checked>EKG";
    else echo "<input type='checkbox' name='ekg' value='1'>EKG";
    ?></td>
    </tr>
  <tr> 
    <td colspan="4" bgcolor="#FFFFFF"><label>
    <input name="jam_keluar" type="hidden" id="jam_keluar" value="<?php echo "".date('H:i') ;?>">
    <input type="submit" name="Submit" value="Update" title="Simpan laporan">
    </label></td>
  </tr>
  </form>
</table>
</body>
</html> 
