<?php
include "../librari/inc.koneksidb.php";
include "../librari/inc.kodeauto.php";
$prn = $_GET['prn'];
$sql = "SELECT * FROM data_pasien WHERE prn='$prn'";
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
});

</script>
<title>PENDAFTARAN RAWAT JALAN</title></head>
<body>
<table width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <form name="form1" method="post" action="reg_sim.php">
<tr bgcolor="#CCCCCC"> 
    <td colspan="4" align="left"><strong>PENDAFTARAN PASIEN</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="25%">PRN</td>
    <td width="25%"><input name="kd_kunjungan" type="hidden" id="kd_kunjungan" maxlength="10" size="12" value="<?php echo kdauto("reg","HND"); ?>">
      <input name="prn" type="hidden" id="prn" maxlength="8" size="10" value="<?php echo $data['prn']; ?>">
      <?php echo $data['prn']; ?> </td>
    <td width="25%">Tanggal Datang</td>
    <td width="25%"><input name="tgl_reg" type="text" id="tgl_reg" value="<?php echo "".date('Y-m-d') ;?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Nama</td>
    <td><input name="nama" type="hidden" id="nama" value="<?php echo $data['nama'] ;?>">
      <?php echo $data['nama'] ;?></td>
    <td>Jam Datang </td>
    <td><input name="jam_reg" type="hidden" id="jam_reg" size="8" value="<?php echo "".date('H:i') ;?>">
      <?php echo "".date('H:i') ;?></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="25%" align="left">Tanggal Lahir</td>
    <td><input name="tgl_lahir" type="hidden" id="tgl_lahir" size="10" value="<?php echo $data['tgl_lahir'] ;?>">
      <?php echo $data['tgl_lahir'] ;?></td>
    <td>Sex / Umur</td>
    <td><?php echo $data['jenis_kelamin'];?> /
      <?php
$tanggal = $data['tanggal'];
$tgl_lahir = $data['tgl_lahir'];
$query = "SELECT datediff('$tanggal', '$tgl_lahir')
          as selisih";

$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);

$tahun = floor($data['selisih']/365);
$bulan = floor(($data['selisih'] - ($tahun * 365))/30);
$hari = $data['selisih'] - $bulan * 30 - $tahun * 365;
echo "".$tahun." Thn, ".$bulan." Bln";
?></td>
  </tr>
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
   <td><select name="dokter" id="dokter">
   </select></td>
   <td>Rujukan</td>
   <td><select name="kd_perujuk" id="kd_perujuk">
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
    <td bgcolor="#FFFFFF" colspan="4" align="left"><input type="submit" name="Submit" value="Daftar"></td>
  </tr>
   </form>
</table>
</body>
</html>
