<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include_once "../librari/inc.session.php";
include "../librari/inc.kodeauto.php";
?>
<html>
<head>
    <script src="<?php echo $url;?>media/kalendar/js/jscal2.js"></script>
    <script src="<?php echo $url;?>media/kalendar/js/lang/en.js"></script>
	<SCRIPT language=javascript id=clientEventHandlersJS>
<!--
function form1_onsubmit() 
{   
       if (document.form1.nama.value =="")
       {
	   alert("Anda belum mengisi kolom NAMA!")
       return false;
	   }
	   if (document.form1.jenis_kelamin.value =="")
       {
	   alert("Anda belum menentukan JENIS KELAMIN!")
       return false;
	   }
}
//-->
</SCRIPT>
    <link rel="stylesheet" type="text/css" href="<?php echo "".$url."";?>media/kalendar/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo "".$url."";?>media/kalendar/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo "".$url."";?>media/kalendar/css/steel/steel.css" />
<title>PENDAFTARAN PASIEN BARU</title></head>
<body>
<table width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <form name="form1" method="post" action="baru_sim.php"  onsubmit="return form1_onsubmit()" >
<tr bgcolor="#CCCCCC"> 
    <td colspan="4" align="left"><strong>PENDAFTARAN PASIEN BARU</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>PRN *</td>
    <td><input name="prn" type="text" id="prn" maxlength="8" size="10" value="<?php echo kdauto("data_pasien",""); ?>">
    </td>
    <td>Tanggal</td>
    <td><input name="tanggal" type="text" id="tanggal" value="<?php echo "".date('Y-m-d') ;?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left">Nama *</td>
    <td><input name="nama" type="text" id="nama" value=""></td>
    <td>Jam  </td>
    <td><input name="jam" type="text" id="jam" size="8" value="<?php echo "".date('H:i') ;?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Tempat lahir</td>
    <td><input name="t4_lahir" type="text" id="t4_lahir" value=""></td>
    <td>Jenis Kelamin *</td>
    <td>
      <input name="jenis_kelamin" type="radio" value="L">
      Laki-laki
      <input name="jenis_kelamin" type="radio" value="P">
      Perempuan</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Tanggal Lahir</td>
    <td><input name="tgl_lahir" type="text" id="tgl_lahir" size="10" value="">
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
    <td>Thn Bln</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td colspan="2" align="left"><b>Alamat</b></td>
    <td colspan="2" align="left"><b>Nomor Telpon</b></td>
    </tr>
  <tr bgcolor="#FFFFFF">
    <td>Alamat</td>
    <td><input name="alamat" type="text" id="alamat" value=""></td>
    <td>Telpon Rumah</td>
    <td><input name="telp_rumah" type="text" id="telp_rumah" value=""></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>RT/RT</td>
    <td><input name="rt" type="text" id="rt" value=""></td>
    <td>Telpon Kantor</td>
    <td><input name="telp_kantor" type="text" id="telp_kantor" value=""></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Desa/Kelurahan</td>
    <td><input name="kel" type="text" id="kel" value=""></td>
    <td>Handphone</td>
    <td><input name="hp1" type="text" id="hp1" value=""></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Kecamatan</td>
    <td><input name="kec" type="text" id="kec" value=""></td>
    <td>Email</td>
    <td><input name="hp2" type="text" id="hp2" value=""></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Kota/Kabupaten</td>
    <td><input name="kab" type="text" id="kab" value=""></td>
    <td>Fax</td>
    <td><input name="hp3" type="text" id="hp3" value=""></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Provinsi</td>
    <td><input name="prov" type="text" id="prov" value=""></td>
    <td colspan="2">&nbsp;</td>
    </tr>
<tr bgcolor="#CCCCCC">
    <td colspan="2" align="left"><b>Penanggung Jawab</b></td>
    <td colspan="2" align="left"><b></b></td>
    </tr>
  <tr bgcolor="#FFFFFF">
    <td>Nama</td>
    <td><input name="nama_pj" type="text" id="nama_pj" value=""></td>
    <td>Telpon Rumah</td>
    <td><input name="telp_rumah_pj" type="text" id="telp_rumah_pj" value=""></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Alamat</td>
    <td><input name="alamat_pj" type="text" id="alamat_pj" value=""></td>
    <td>Telpon Kantor</td>
    <td><input name="telp_kantor_pj" type="text" id="telp_kantor_pj" value=""></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Hubungan</td>
    <td><input name="hub" type="text" id="hub" value=""></td>
    <td>Handphone</td>
    <td><input name="hp_pj" type="text" id="hp_pj" value=""></td>
  </tr>
<tr>
    <td bgcolor="#FFFFFF" colspan="4" align="left"><input type="submit" name="Submit" value="Simpan"></td>
  </tr>
   </form>
</table>
</body>
</html>
