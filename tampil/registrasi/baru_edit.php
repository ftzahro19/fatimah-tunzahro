<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.kodeauto.php";

$prn = $_GET['prn'];
$sql = "SELECT * FROM data_pasien WHERE prn='$prn'";
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
    <script src="<?php echo $url;?>media/kalendar/js/lang/en.js">
	// The list of allowed image MIME types associated to
// file extensions.
$imgallowedtypes = array(
    'image/png'  => 'png',
    'image/jpeg' => 'jpg'
);

$imgdataurl = &$_POST['dataURL'];

if (empty($imgdataurl)) {
  die('error');
}

// A data URL starts like this:
// data:[<MIME-type>][;charset="<encoding>"][;base64],<data>

// Here we find the comma delimiter.
$comma = strpos($imgdataurl, ',');
if (!$comma) {
  die('error');
}

$imginfo = substr($imgdataurl, 0, $comma);
if (empty($imginfo) || !isset($imgdataurl{($comma+2)})) {
  die('error');
}

// Split by ':' to find the 'data' prefix and the rest of
// the info.
$imginfo = explode(':', $imginfo);

// The array must have exactly two elements and the
// second element must not be empty.
if (count($imginfo) !== 2 || $imginfo[0] !== 'data' ||
    empty($imginfo[1])) {
  die('error');
}

// The MIME type must be given and it must be base64-encoded.
$imginfo = explode(';', $imginfo[1]);

if (count($imginfo) < 2 ||
    !array_key_exists($imginfo[0], $imgallowedtypes) ||
    ($imginfo[1] !== 'base64' && $imginfo[2] !== 'base64')) {
  die('error');
}

$imgdest = 'tmpImages/' . sha1($imgdataurl) . '.' .
            $imgallowedtypes[$imginfo[0]];
$imgdataurl = substr($imgdataurl, $comma + 1);

if (!file_put_contents($imgdest, base64_decode($imgdataurl))) {
  die('error');
}

echo json_encode(array('successful' => true, 'urlNew' => $imgdest));
	</script>
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/steel/steel.css" />
	
<title>PENDAFTARAN PASIEN BARU</title>
<style type="text/css">
body { background-image: url('hendi.jpg'); background-repeat: no-repeat; background-position: top left; background-attachment: scroll; }
</style>
</head>
<body id="tab1">
<table width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <form name="form1" method="post" action="reg.php?prn=<?php echo $data['prn']; ?>">
<tr bgcolor="#CCCCCC"> 
    <td colspan="4"><strong>DATA PASIEN</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>PRN</td>
    <td>
<input name="kd_kunjungan" type="hidden" id="kd_kunjungan" maxlength="10" size="12" value="<?php echo kdauto("reg","HND"); ?>">
      <input name="prn" type="text" id="prn" maxlength="8" size="10" value="<?php echo $data['prn']; ?>">   </td>
    <td>Tanggal</td>
   
    <td>
<input name="tgl_reg" type="hidden" id="tgl_reg" value="<?php echo "".date('Y-m-d') ;?>">
<input name="tanggal" type="text" id="tanggal" value="<?php echo "".date('Y-m-d') ;?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Nama</td>
    <td><input name="nama" type="text" id="nama" value="<?php echo $data['nama'] ;?>"></td>
    <td>Jam Datang </td>
    <td>
<input name="jam" type="text" id="jam" size="8" value="<?php echo $data['jam'] ;?>">
<input name="jam_reg" type="hidden" id="jam_reg" size="8" value="<?php echo "".date('H:i') ;?>">
</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Tempat lahir </td>
    <td><input name="t4_lahir" type="text" id="t4_lahir" value="<?php echo $data['t4_lahir'] ;?>"></td>
    <td>Jenis Kelamin </td>
    <td><?php
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
    <td>Tanggal Lahir </td>
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
    <td>&nbsp;</td>
    </tr>
  <tr bgcolor="#FFFFFF">
    <td>Umur </td>
    <td>
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
    <td>&nbsp;</td>
<td>&nbsp;</td>
    </tr>
<?php 
$prn = $_GET['prn'];
$sql = "SELECT * FROM data_pasien WHERE prn='$prn'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry);
?>
<tr bgcolor="#CCCCCC">
    <td colspan="2"><b>Alamat</b></td>
    <td colspan="2"><b>Nomor Telpon</b></td>
    </tr>
  <tr bgcolor="#FFFFFF">
    <td>Alamat</td>
    <td><input name="alamat" type="text" id="alamat" value="<?php echo $data['alamat']; ?>"></td>
    <td>Telpon Rumah</td>
    <td><input name="telp_rumah" type="text" id="telp_rumah" value="<?php echo $data['telp_rumah']; ?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>RT/RT</td>
    <td><input name="rt" type="text" id="rt" value="<?php echo $data['rt']; ?>"></td>
    <td>Telpon Kantor</td>
    <td><input name="telp_kantor" type="text" id="telp_kantor" value="<?php echo $data['telp_kantor']; ?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Desa/Kelurahan</td>
    <td><input name="kel" type="text" id="kel" value="<?php echo $data['kel']; ?>"></td>
    <td>Handphone 1 </td>
    <td><input name="hp1" type="text" id="hp1" value="<?php echo $data['hp1']; ?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Kecamatan</td>
    <td><input name="kec" type="text" id="kec" value="<?php echo $data['kec']; ?>"></td>
    <td>Handphone 2 </td>
    <td><input name="hp2" type="text" id="hp2" value="<?php echo $data['hp2']; ?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Kota/Kabupaten</td>
    <td><input name="kab" type="text" id="kab" value="<?php echo $data['kab']; ?>"></td>
    <td>Handphone 3 </td>
    <td><input name="hp3" type="text" id="hp3" value="<?php echo $data['hp3']; ?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Provinsi</td>
    <td><input name="prov" type="text" id="prov" value="<?php echo $data['prov']; ?>"></td>
    <td  colspan="2">&nbsp;</td>
    </tr>
<tr bgcolor="#CCCCCC">
    <td colspan="2"><b>Penanggung Jawab</b></td>
    <td colspan="2"><b></b></td>
    </tr>
  <tr bgcolor="#FFFFFF">
    <td>Nama</td>
    <td><input name="nama_pj" type="text" id="nama_pj" value="<?php echo $data['nama_pj']; ?>"></td>
    <td>Telpon Rumah</td>
    <td><input name="telp_rumah_pj" type="text" id="telp_rumah_pj" value="<?php echo $data['telp_rumah_pj']; ?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Alamat</td>
    <td><input name="alamat_pj" type="text" id="alamat_pj" value="<?php echo $data['alamat_pj']; ?>"></td>
    <td>Telpon Kantor</td>
    <td><input name="telp_kantor_pj" type="text" id="telp_kantor_pj" value="<?php echo $data['telp_kantor_pj']; ?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Hubungan</td>
    <td><input name="hub" type="text" id="hub" value="<?php echo $data['hub']; ?>"></td>
    <td>Handphone</td>
    <td><input name="hp_pj" type="text" id="hp_pj" value="<?php echo $data['hp_pj']; ?>"></td>
  </tr>
<tr>
    <td bgcolor="#FFFFFF" colspan="4">
    <input type="submit" name="submit" value="Update" onClick="form1.action='baru_edit_sim.php?prn=<?php echo $data['prn'];?>'; return true;">
    <input type="submit" name="Submit" value="Daftar">
    </td>
  </tr>
   </form>
</table>
</body>
</html>
