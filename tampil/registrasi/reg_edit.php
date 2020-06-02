<?php 
include "../librari/inc.koneksidb.php";
include "../librari/inc.kodeauto.php";

$kd_kunjungan = $_GET['kd_kunjungan'];
$sql = "SELECT * FROM data_pasien,reg WHERE data_pasien.prn=reg.prn AND kd_kunjungan='$kd_kunjungan' ";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry);
?>
<html>
<head>
<script src="../src/js/jscal2.js"></script>
<script src="../src/js/lang/en.js"></script>
<link rel="stylesheet" type="text/css" href="../src/css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="../src/css/border-radius.css" />
<link rel="stylesheet" type="text/css" href="../src/css/gold/gold.css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=klinik>
  $("#klinik").change(function(){
    var klinik = $("#klinik").val();
    $.ajax({
        url: "ambildokter.php",
        data: "klinik="+klinik,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=dokter>
            $("#dokter").html(msg);
        }
    });
  });
  $("#dokter").change(function(){
    var dokter = $("#dokter").val();
    $.ajax({
        url: "ambilkecamatan.php",
        data: "dokter="+dokter,
        cache: false,
        success: function(msg){
            $("#kec").html(msg);
        }
    });
  });
});

</script>
<title>PENDAFTARAN PASIEN</title></head>
<body>
<table width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <form name="demo" method="post" action="reg_edit_sim.php">
<tr bgcolor="#CCCCCC"> 
    <td colspan="4" align="left"><strong>PENDAFTARAN PASIEN </strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="208" align="left">PRN</td>
    <td width="244">
      <input name="kd_kunjungan" type="hidden" id="kd_kunjungan" maxlength="10" size="12" value="<?php echo $data['kd_kunjungan']; ?>">
      <input name="prn" type="text" id="prn" maxlength="8" size="10" value="<?php echo $data['prn']; ?>">   </td>
    <td width="190">Tanggal</td>
    <td width="286" colspan="2"><input name="tgl_reg" type="hidden" id="tgl_reg" value="<?php echo "".date('Y-m-d') ;?>">
      <input name="tgl_reg" type="text" size="8" value="<?php echo "".date('Y-m-d') ;?>" disabled="disabled"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left">Nama</td>
    <td><input name="nama" type="text" id="nama" value="<?php echo $data['nama'] ;?>"></td>
    <td>Jam Datang </td>
    <td colspan="2"><input name="jam_reg" type="text" id="jam_reg" size="8" value="<?php echo "".date('H:i:s') ;?>"></td>
  </tr>
<script language="JavaScript" type="text/JavaScript">
 
 function show_dokter()
 {
 <?php
 
 // membaca semua klinik
 $query = "SELECT * FROM klinik";
 $hasil = mysql_query($query);
 
 // membuat if untuk masing-masing pilihan klinik beserta isi option untuk combobox kedua
 while ($data = mysql_fetch_array($hasil))
 {
   $kd_klinik = $data['kd_klinik'];

   // membuat IF untuk masing-masing klinik
   echo "if (document.demo.klinik.value == \"".$kd_klinik."\")";
   echo "{";

   // membuat option nama dokter untuk masing-masing klinik
   $query2 = "SELECT * FROM user WHERE kd_klinik = $kd_klinik";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('user').innerHTML = \"";
   while ($data2 = mysql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['nama_user']."'>".$data2['nama_user']."</option>";   
   }
   $content .= "\"";
   echo $content;
   echo "}\n";   
 }

 ?> 
 }
</script>
 <tr bgcolor="#FFFFFF">
    <td align="left">Klinik</td>
    <td><select name="klinik" id="klinik">
      <option value="">--Pilih klinik--</option>
      <?php
//mengambil nama-nama klinik yang ada di database
$klinik = mysql_query("SELECT * FROM klinikdb ORDER BY kd_klinik");
while($p=mysql_fetch_array($klinik)){
echo "<option value=\"$p[kd_klinik]\">$p[nama_klinik]</option>\n";
}
?>
    </select></td>
    <td>Asuransi</td>
    <td><select name="kd_asuransi" id="_kd_asuransi">
      <option value="0" selected>[Pilih...]</option>
      <?php
	$sql = "SELECT * FROM asuransi_db";
      	$qry = @mysql_query($sql, $koneksi) or die ("gagal Query");
	while ($data =mysql_fetch_array($qry)) {
	if ($data[kd_asuransi]==$kd_asuransi) {
	$cek="selected";
	}
	else {
	$cek="";
	}
	echo "<option value='$data[kd_asuransi]' $cek>".$data['kd_asuransi']." | ".$data['nama_asuransi']."</option>";
	}
	?>
    </select></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td align="left">Dokter</td>
    <td align="left"><select name="dokter" id="dokter">
      <option value="">--Pilih Dokter--</option>
      <?php
//mengambil nama-nama klinik yang ada di database
$dokter = mysql_query("SELECT * FROM user ORDER BY username");
while($p=mysql_fetch_array($dokter)){
echo "<option value=\"$p[spesialis]\">$p[nama]</option>\n";
}
?>
    </select></td>
    <td align="left">Perujuk</td>
    <td align="left"><select name="kd_perujuk" id="kd_perujuk">
      <option value="0" selected>[Pilih...]</option>
      <?php
	$sql = "SELECT * FROM rujukan_db";
      	$qry = @mysql_query($sql, $koneksi) or die ("gagal Query");
	while ($data =mysql_fetch_array($qry)) {
	if ($data[kd_perujuk]==$kd_perujuk) {
	$cek="selected";
	}
	else {
	$cek="";
	}
	echo "<option value='$data[kd_perujuk]' $cek>".$data['kd_perujuk']." | ".$data['nama_perujuk']."</option>";
	}
	?>
    </select></td>
  </tr>
    <tr>
    <td bgcolor="#FFFFFF" colspan="5" align="left">
	<input type="submit" name="Submit" value="Daftar"></td>
  </tr>
   </form>
</table>
</body>
</html>
