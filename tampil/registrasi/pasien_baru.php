<?php
include "../librari/inc.koneksidb.php";
include "../librari/inc.kodeauto.php";
?>
<html>
<head>
<script src="../src/js/jscal2.js"></script>
    <script src="../src/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="../src/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../src/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="../src/css/steel/steel.css" />
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
<title>Pendaftaran pasien</title></head>
<body>
<table width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <tr bgcolor="#CCCCCC"> 
    <td colspan="6" align="left"><strong>Pasien Baru</strong></td>
  </tr>
  <form name="form1" method="post" action="pasien_baru_sim.php">
  <tr bgcolor="#FFFFFF">
    <td width="171" align="left">PRN</td>
    <td colspan="3">
	<input name="kd_kunjungan" type="hidden" value="<? echo kdauto("data_pasien","BSD"); ?>">
      <input name="prn" type="text" id="prn" maxlength="8" size="10">   </td>
    <td width="168">Tanggal</td>
    <td width="302" colspan="3"><input name="tanggal" type="hidden" id="tanggal" value="<? echo "".date('Y-m-d') ;?>">
      <input name="TxtTanggal" type="text" size="8" value="<? echo "".date('d-m-Y') ;?>" disabled="disabled"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left">Nama</td>
    <td width="169"><input name="nama" type="text" id="nama"></td>
    <td width="20">
      <input name="karyawan" type="checkbox" id="karyawan" value="Ya">
    </td>
    <td width="104">Karyawan</td>
    <td>Jam</td>
    <td colspan="3"><input name="jam" type="text" id="jam" size="8" value="<? echo "".date('H:i') ;?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left">Tanggal Lahir </td>
    <td colspan="3"><input name="tgl_lahir" type="text" id="tgl_lahir" size="10">
	<image id="f_btn1" src="calendar.jpg" width="16" height="15" border="0"></image>
		<script type="text/javascript">//<![CDATA[

      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: false
      });
      cal.manageFields("f_btn1", "tgl_lahir", "%Y-%m-%d");
     //]]></script>	</td>
    <td>Ruangan</td>
    <td width="302" colspan="3"><select name="ruang" id="ruang">
	<option value="" selected>----------------------</option>
      <option value="UPI">UPI</option>
      <option value="NICU">NICU</option>
	<option value="OK">OK</option>
	<option value="Intermediet">Intermediet</option>
      <option value="Shorea">Shorea</option>
	<option value="Pinus">Pinus</option>
	<option value="Cantleya">Cantleya</option>
	<option value="Eucaliptus">Eucaliptus</option>
	<option value="Acacia">Acacia</option>
    </select></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left">Jenis Kelamin </td>
    <td colspan="3">
      <input name="sex" type="radio" value="L">
      Laki-laki
      <input name="sex" type="radio" value="P">
      Perempuan</td>
    <td>No Kamar</td>
    <td colspan="3">
      <input name="kamar" type="text" id="kamar" size="13"></td>
    </tr>
<tr bgcolor="#FFFFFF">
    <td align="left">No HP</td>
    <td colspan="3"><input name="noHP" type="text" id="noHP">
    <td>Kelas</td>
    <td colspan="3"><select name="kelas" id="kelas">
	<option value="" selected>----------------------</option>
      <option value="P Suite">P Suite</option>
      <option value="Suite">Suite</option>
	<option value="VIP">VIP</option>
	<option value="Standar Plus">Standar Plus</option>
	<option value="Standar">Standar</option>
	<option value="Basic">Basic</option>
    </select></td>
   </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left">Alamat</td>
    <td colspan="3">
<input name="alamat" type="text" id="alamat">
</td>
    <td>DPJP</td>
    <td colspan="3">
      <input name="dpjp" type="text" id="dpjp"><input type="button" value="Pilih" onClick="makeSelection2(this.form, 'dpjp');"></td>
    </tr>
 <tr bgcolor="#FFFFFF">
    <td align="left">Diagnosa Medis</td>
    <td colspan="3">
<input name="diagnosa_msk" type="text" id="diagnosa_msk">
</td>
    <td>Ka. Modul</td>
    <td colspan="3">
      <input name="modul" type="text" id="modul"><input type="button" value="Pilih" onClick="makeSelection(this.form, 'modul');"></td>
    </tr>
  <tr> 
    <td colspan="6" bgcolor="#CCCCCC"><input type="submit" name="Submit" value="Daftar"></td>
  </tr>
   </form>
</table>
</body>
</html>
