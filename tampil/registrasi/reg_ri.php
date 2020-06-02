<?php 
include "../librari/inc.koneksidb.php";
include "data_pasien.php";
$prn = $_GET['prn'];
$kd_kunjungan = $_GET['kd_kunjungan'];
$sql = "SELECT * FROM data_pasien,reg WHERE data_pasien.prn=reg.prn AND data_pasien.prn='$prn' AND reg.kd_kunjungan='$kd_kunjungan'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
?>
<html>
<head>
  <script src="../src/js/jscal2.js"></script>
    <script src="../src/js/lang/en.js"></script>
<script type="text/javascript">
    targetElement = null;
    function makeSelection2(form1, id) {
      if(!form1 || !id)
        return;
      targetElement = form1.elements[id];
      var handle = window.open('dpjp.php','Fullscreen', 'width=400, height=300, resizable=no, scrollbars=no');
    }
    function makeSelection(form1, id) {
      if(!form1 || !id)
        return;
      targetElement = form1.elements[id];
      var handle = window.open('modul.php','Fullscreen', 'width=400, height=300, resizable=no, scrollbars=no');
    }
    </script>

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=klinik>
  $("#ruang").change(function(){
    var ruang = $("#ruang").val();
    $.ajax({
        url: "ambilkamar.php",
        data: "ruang="+ruang,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=dokter>
            $("#kamar").html(msg);
        }
    });
  });
  
    $("#kamar").change(function(){
    var kamar = $("#kamar").val();
    $.ajax({
        url: "ambilkelas.php",
        data: "kamar="+kamar,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=dokter>
            $("#kelas").html(msg);
        }
    });
  });
  
});

</script>
    <link rel="stylesheet" type="text/css" href="../src/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../src/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="../src/css/steel/steel.css" />
<title>Pendaftaran pasien</title></head>
<body>
<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <tr bgcolor="#CCCCCC"> 
    <td colspan="4" align="left"><strong>PENDAFTARAN RAWAT INAP</strong></td>
  </tr>
  <form name="form1" method="post" action="reg_ri_sim.php">
<tr bgcolor="#FFFFFF">
    <td width="20%">Tanggal RI</td>
    <td width="25%"><input name="tgl_masuk" type="hidden" id="tgl_masuk" value="<?php echo "".date('Y-m-d') ;?>">
      <input name="tgl_masuk" type="text" size="8" value="<?php echo "".date('d-m-Y') ;?>" disabled="disabled">      </td>
    <td width="20%">Jam RI</td>
    <td width="25%"><input name="jam_masuk" type="text" id="jam_masuk" size="8" value="<?php echo "".date('H:i') ;?>"></td>
</tr>
  <tr bgcolor="#FFFFFF">
    <td width="20%">Ruangan</td>
    <td width="25%">
      <input name="kd_kunjungan" type="hidden" id="kd_kunjungan" maxlength="12" size="10" value="<?php echo $data['kd_kunjungan']; ?>">
      <input name="prn" type="hidden" id="prn" maxlength="8" size="10" value="<?php echo $data['prn']; ?>">
      <select name="ruang" id="ruang">
        <option value="">--Pilih Ruangan--</option>
        <?php
//mengambil nama-nama klinik yang ada di database
$ruang = mysql_query("SELECT * FROM ruang GROUP BY ruang");
while($p=mysql_fetch_array($ruang)){
echo "<option value=\"$p[ruang]\">$p[ruang]</option>\n";
}
?>
      </select></td>
    <td width="20%">Kamar</td>
    <td width="25%"><select name="kamar" id="kamar">
      <option value="">--Pilih Kamar--</option>
      <?php
//mengambil nama-nama klinik yang ada di database
$kamar = mysql_query("SELECT * FROM ruang");
while($p=mysql_fetch_array($kamar)){
echo "<option value=\"$p[kamar]\">$p[kamar]</option>\n";
}
?>
    </select>
    </tr>
  <tr bgcolor="#FFFFFF">
    <td>Kelas</td>
    <td><select name="kelas" id="kelas">
      <?php
//mengambil nama-nama klinik yang ada di database
$kelas = mysql_query("SELECT * FROM ruang GROUP BY kelas");
while($p=mysql_fetch_array($kelas)){
echo "<option value=\"$p[kelas]\">$p[kelas]</option>\n";
}
?>
    </select></td>
    <td>Bed</td>
    <td><input name="bed" type="text" id="bed" size="8" value="<?php echo $data['bed'];?>"></td>
  </tr>
<tr bgcolor="#FFFFFF">
  <td>Dokter penanggung jawab </td>
  <td colspan="3"><input name="dpjp" type="text" id="dpjp" value="<?php echo $data['dpjp'];?>">
    <input name="button" type="button" onClick="makeSelection2(this.form, 'dpjp');" value="Pilih"></td>
  </tr>
<tr bgcolor="#FFFFFF">
    <td align="left">Diagnosa medis </td>
    <td colspan="3"><input name="diagnosa_masuk" type="text" id="diagnosa_msk" value="<?php echo $data['diagnosa_masuk'];?>"></td>
</tr>
<tr> 
    <td colspan="4" bgcolor="#CCCCCC"><input type="submit" name="Submit" value="Daftar"></td>
</tr>
</form>
</table>
</body>
</html>

