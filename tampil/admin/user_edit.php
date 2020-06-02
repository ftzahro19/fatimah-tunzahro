<?php 
include "../../config/config.php"; 
include "../librari/inc.koneksidb.php"; 

$username = $_REQUEST['username'];
$sql = "SELECT * FROM user WHERE username='$username'";
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
<form  enctype="multipart/form-data" action="user_edit_sim.php" method="post" name="form1" target="_self">
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
<tr align="left"> 
  <th colspan="2" scope="col">Tambah User</th>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td width="33%">Username</td>
  <td width="67%">
	<input name="username" type="text" size="20" maxlength="20" value="<?php echo $data['username'];?>">  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Nama</td>
  <td><input name="nama" type="text" size="20" maxlength="200" value="<?php echo $data['nama_user'];?>">  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td width="33%">Kategori</td>
  <td width="67%"><select name="kategori" id="kategori">
    <option value="" selected>[Pilih kategori]</option>
    <?php
	$sql1 = "SELECT * FROM gol_tm";
    $qry1 = @mysql_query($sql1, $koneksi) or die ("gagal Query");
	while ($data1 =mysql_fetch_array($qry1)) {
	if ($data1[kd_gol_tm]==$data[unit]) {
	$cek="selected";
	}
	else {
	$cek="";
	}
	echo "<option value='$data1[kd_gol_tm]' $cek>".$data1['gol_tm']."</option>";
	}
	?>
  </select></td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Spesialis</td>
  <td align="left"><select name="spesialis" id="spesialis">
    <option value="" selected>[Pilih spesialis]</option>
    <?php
	$sql2 = "SELECT * FROM klinikdb";
    $qry2 = @mysql_query($sql2, $koneksi) or die ("gagal Query");
	while ($data2 =mysql_fetch_array($qry2)) {
	if ($data2[kd_klinik]==$data[spesialis]) {
	$cek="selected";
	}
	else {
	$cek="";
	}
	echo "<option value='$data2[kd_klinik]' $cek>".$data2['nama_klinik']."</option>";
	}
	?>
  </select></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Alamat</td>
  <td><input type="text" name="alamat" value="<?php echo $data['alamat'];?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Kota</td>
  <td><input type="text" name="kota" id="kota" value="<?php echo $data['kota'];?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>No HP </td>
  <td><input type="text" name="hp" value="<?php echo $data['hp'];?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>No Telp </td>
  <td><input type="text" name="telp" value="<?php echo $data['telp'];?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Email</td>
  <td><input type="text" name="email" value="<?php echo $data['email'];?>"></td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Tanggal mulai praktek </td>
  <td><input name="tanggal_masuk" type="text" size="20" maxlength="200" value="<?php echo $data['tanggal_masuk'];?>">  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Photo</td>
  <td>
  <?php
  if($data[photo]=="") {?> <img src="gambar/no_pic.jpg" width="125" height="125"><?php }
  else {?> <img src="gambar/<?php echo $data['photo'];?>" width="125" height="125"><?php }
  ?>
   <a href="upload_photo.php?username=<?php echo $username;?>" onClick="NewWindow(this.href,'name','800','400','yes');return false"><b>Ganti photo</b></a>
    </tr>
<tr bgcolor="#FFFFFF"> 
  <td>&nbsp;</td>
  <td> 
	<input name="Submit" type="submit" value="Update">  </td>
</tr>
</table>
</form>
</body>
</html>