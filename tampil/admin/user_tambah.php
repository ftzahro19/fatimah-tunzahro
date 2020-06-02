<?php
include "../librari/inc.koneksidb.php";
include "../../config/config.php";

$query_rsData = "SELECT * FROM kec";
$rsData = mysql_query($query_rsData, $koneksi) or die(mysql_error());
$row_rsData = mysql_fetch_assoc($rsData);
$totalRows_rsData = mysql_num_rows($rsData);
?>
<html>
<head>
<title>Tambah User</title>
<link href="<?php echo $url;?>media/css/autocomplete.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo $url;?>media/jquery/themes/base/jquery.ui.all.css">
 <script src="<?php echo $url;?>media/jquery/jquery-1.9.1.js"></script>
 <script src="<?php echo $url;?>media/jquery/ui/jquery.ui.core.js"></script>
 <script src="<?php echo $url;?>media/jquery/ui/jquery.ui.widget.js"></script>
 <script src="<?php echo $url;?>media/jquery/ui/jquery.ui.position.js"></script>
 <script src="<?php echo $url;?>media/jquery/ui/jquery.ui.menu.js"></script>
 <script src="<?php echo $url;?>media/jquery/ui/jquery.ui.autocomplete.js"></script>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=kategori>
  $("#kategori").change(function(){
    var kategori = $("#kategori").val();
    $.ajax({
        url: "ambilspesialis.php",
        data: "kategori="+kategori,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=spesialis>
            $("#spesialis").html(msg);
        }
    });
  });
  $("#spesialis").change(function(){
    var spesialis = $("#spesialis").val();
    $.ajax({
        url: "ambilkecamatan.php",
        data: "spesialis="+spesialis,
        cache: false,
        success: function(msg){
            $("#kec").html(msg);
        }
    });
  });
});

</script>
 <script>
 $(function() {
 var availableTags = [
 <?php do { ?>
"<?php echo $row_rsData['nama_kec']; ?>",
<?php } while($row_rsData = mysql_fetch_assoc($rsData)); ?>
 ];
 $( "#kota" ).autocomplete({
 source: availableTags
 });
 });
 </script>
</head>
<body>
<form  enctype="multipart/form-data" action="user_sim.php" method="post" name="form1" target="_self">
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
<tr align="left"> 
  <th colspan="2" scope="col">Tambah User</th>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td width="33%">Username</td>
  <td width="67%">
	<input name="username" type="text" size="20" maxlength="20">  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td width="33%">Password</td>
  <td width="67%">
	<input name="password" type="password" size="20" maxlength="20">  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Nama</td>
  <td><input name="nama" type="text" size="20" maxlength="200">  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td width="33%">Kategori</td>
  <td width="67%"><select name="kategori" id="kategori">
    <option>[ Pilih kategori ]</option>
    <?php
//mengambil nama-nama kategori SDM yang ada di database
$kategori = mysql_query("SELECT * FROM gol_tm ORDER BY kd_gol_tm");
while($p=mysql_fetch_array($kategori)){
echo "<option value=\"$p[kd_gol_tm]\">$p[gol_tm]</option>\n";
}
?>
  </select></td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Spesialis</td>
  <td align="left"><select name="spesialis" id="spesialis">
    <option>[ Pilih spesialis ]</option>
    <?php
//mengambil nama-nama klinik yang ada di database
$spesialis = mysql_query("SELECT * FROM klinikdb ORDER BY kd_klinik");
while($p=mysql_fetch_array($spesialis)){
echo "<option value=\"$p[kd_klinik]\">$p[nama_klinik]</option>\n";
}
?>
  </select></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Alamat</td>
  <td><input type="text" name="alamat"></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Kota</td>
  <td><input type="text" name="kota" id="kota"></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>No HP </td>
  <td><input type="text" name="hp"></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>No Telp </td>
  <td><input type="text" name="telp"></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Email</td>
  <td><input type="text" name="email"></td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Tanggal mulai praktek </td>
  <td><input name="tanggal_masuk" type="text" size="20" maxlength="200">  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Upload photo</td>
  <td><input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
    <input name="userfile" type="file" /></tr>
<tr bgcolor="#FFFFFF"> 
  <td>&nbsp;</td>
  <td> 
	<input name="Submit" type="submit" value="Tambah">  </td>
</tr>
</table>
</form>
</body>
</html>
