<?php 
include "../../config/config.php";
include "../librari/inc.koneksidb.php";

$prn = $_GET['prn'];
$kd_kunjungan = $_GET['kd_kunjungan'];
$sql = "SELECT * FROM data_pasien,reg WHERE data_pasien.prn=reg.prn AND data_pasien.prn='$prn' AND reg.kd_kunjungan='$kd_kunjungan'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry);
?>
<html>
<head>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=spesialis>
  $("#spesialis").change(function(){
    var spesialis = $("#spesialis").val();
    $.ajax({
        url: "ambilnama.php",
        data: "spesialis="+spesialis,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=nama>
            $("#nama").html(msg);
        }
    });
  });
  $("#nama").change(function(){
    var nama = $("#nama").val();
    $.ajax({
        url: "ambilbiaya.php",
        data: "nama="+nama,
        cache: false,
        success: function(msg){
            $("#biaya").val(msg);
        }
    });
  });
});

</script>
    <script src="<?php echo $url;?>media/kalendar/js/jscal2.js"></script>
    <script src="<?php echo $url;?>media/kalendar/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/steel/steel.css" />
<title>PENDAFTARAN PASIEN BARU</title></head>
<body>
<table width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <form name="form1" method="post" action="baru_edit2_sim.php?prn=<?php echo $data['prn']; ?>&kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>">
<tr bgcolor="#CCCCCC"> 
    <td colspan="4" align="left"><strong>Data Pasien</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="208" align="left">PRN</td>
    <td width="244">
<input name="kd_kunjungan" type="hidden" id="kd_kunjungan" maxlength="12" size="12" value="<?php echo $data['kd_kunjungan']; ?>">
      <input name="prn" type="text" id="prn" maxlength="8" size="10" value="<?php echo $data['prn']; ?>">   </td>
    <td width="190">Tanggal</td>
   
    <td width="286" colspan="2">
<input name="tgl_reg" type="hidden" id="tgl_reg" value="<?php echo "".date('Y-m-d') ;?>">
<input name="tanggal" type="hidden" id="tanggal" value="<?php echo "".date('Y-m-d') ;?>">
      <input name="tanggal" type="text" size="8" value="<?php echo $data['tanggal'] ;?>" disabled="disabled"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left">Nama</td>
    <td><input name="nama" type="text" id="nama" value="<?php echo $data['nama'] ;?>"></td>
    <td>Jam Datang </td>
    <td colspan="2">
<input name="jam" type="text" id="jam" size="8" value="<?php echo $data['jam'] ;?>">
<input name="jam_reg" type="hidden" id="jam_reg" size="8" value="<?php echo "".date('H:i') ;?>">
</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left">Tempat lahir </td>
    <td><input name="t4_lahir" type="text" id="t4_lahir" value="<?php echo $data['t4_lahir'] ;?>"></td>
    <td>Jenis Kelamin </td>
    <td width="286" colspan="3"><?php
	if ($data['jenis_kelamin']=="L") {
	$cek_l = "checked";
	$cek_p = "";
	}
	else {
	$cek_l = "";
	$cek_p = "checked";
	}
	?>
      <input name="jenis_kelamin" type="radio" value="L" <?php echo $cek_l;?>>
      Laki-laki
      <input name="jenis_kelamin" type="radio" value="P" <?php echo $cek_p;?>>
      Perempuan</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left">Tanggal Lahir </td>
    <td><input name="tgl_lahir" type="text" id="tgl_lahir" size="10" value="<?php echo $data['tgl_lahir'] ;?>">
	<image id="f_btn1" src="<?php echo $url;?>media/kalendar/calendar.jpg" width="16" height="15" border="0"></image>
		<script type="text/javascript">//<![CDATA[
      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: false
      });
      cal.manageFields("f_btn1", "tgl_lahir", "%Y-%m-%d");
     //]]></script>	</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left" colspan="1">Umur </td>
    <td align="left" colspan="2">
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
?>
</td>
    <td colspan="2" align="left">&nbsp;</td>
    </tr>
<?php 
$prn = $_GET['prn'];
$kd_kunjungan = $_GET['kd_kunjungan'];
$sql = "SELECT * FROM data_pasien,reg WHERE data_pasien.prn=reg.prn AND data_pasien.prn='$prn' AND reg.kd_kunjungan='$kd_kunjungan'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry);
?>
<tr bgcolor="#CCCCCC">
    <td colspan="2" align="left"><b>Alamat</b></td>
    <td colspan="2" align="left"><b>Nomor Telpon</b></td>
    </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="1" align="left">Alamat</td>
    <td align="left"><input name="alamat" type="text" id="alamat" value="<?php echo $data['alamat']; ?>"></td>
    <td align="left">Telpon Rumah</td>
    <td align="left"><input name="telp_rumah" type="text" id="telp_rumah" value="<?php echo $data['telp_rumah']; ?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="1" align="left">RT/RT</td>
    <td align="left"><input name="rt" type="text" id="rt" value="<?php echo $data['rt']; ?>"></td>
    <td width="190" align="left">Telpon Kantor</td>
    <td width="286" align="left"><input name="telp_kantor" type="text" id="telp_kantor" value="<?php echo $data['telp_kantor']; ?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="1" align="left">Desa/Kelurahan</td>
    <td align="left"><input name="kel" type="text" id="kel" value="<?php echo $data['kel']; ?>"></td>
    <td align="left">Handphone 1 </td>
    <td align="left"><input name="hp1" type="text" id="hp1" value="<?php echo $data['hp1']; ?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="1" align="left">Kecamatan</td>
    <td align="left"><input name="kec" type="text" id="kec" value="<?php echo $data['kec']; ?>"></td>
    <td align="left">Handphone 2 </td>
    <td align="left"><input name="hp2" type="text" id="hp2" value="<?php echo $data['hp2']; ?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="1" align="left">Kota/Kabupaten</td>
    <td align="left"><input name="kab" type="text" id="kab" value="<?php echo $data['kab']; ?>"></td>
    <td align="left">Handphone 3 </td>
    <td align="left"><input name="hp3" type="text" id="hp3" value="<?php echo $data['hp3']; ?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="208" colspan="1" align="left">Provinsi</td>
    <td width="244" align="left"><input name="prov" type="text" id="prov" value="<?php echo $data['prov']; ?>"></td>
    <td colspan="2" align="left">&nbsp;</td>
    </tr>
<tr bgcolor="#CCCCCC">
    <td colspan="2" align="left"><b>Penanggung Jawab</b></td>
    <td colspan="2" align="left"><b></b></td>
    </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="1" align="left">Nama</td>
    <td align="left"><input name="nama_pj" type="text" id="nama_pj" value="<?php echo $data['nama_pj']; ?>"></td>
    <td align="left">Telpon Rumah</td>
    <td align="left"><input name="telp_rumah_pj" type="text" id="telp_rumah_pj" value="<?php echo $data['telp_rumah_pj']; ?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="1" align="left">Alamat</td>
    <td align="left"><input name="alamat_pj" type="text" id="alamat_pj" value="<?php echo $data['alamat_pj']; ?>"></td>
    <td width="190" align="left">Telpon Kantor</td>
    <td width="286" align="left"><input name="telp_kantor_pj" type="text" id="telp_kantor_pj" value="<?php echo $data['telp_kantor_pj']; ?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="1" align="left">Hubungan</td>
    <td align="left"><input name="hub" type="text" id="hub" value="<?php echo $data['hub']; ?>"></td>
    <td align="left">Handphone</td>
    <td align="left"><input name="hp_pj" type="text" id="hp_pj" value="<?php echo $data['hp_pj']; ?>"></td>
  </tr>
<tr>
    <td bgcolor="#FFFFFF" colspan="5" align="left">
    <input type='submit' name='Update' value='Update' onClick="this.form.target='_self';return true;">
    <input type='submit' name='Daftar' value='Daftar RI' onClick="form1.action='reg_ri.php?prn=<?php echo $data['prn']; ?>&kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>'; return true;"> 
    </td>
  </tr>
   </form>
</table>
</body>
</html>
