<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {color: #FFFF00}
.style3 {color: #00FF00}
.style4 {color: #0000FF}
-->
</style>
</head>

<body>
<p>PENDAFTARAN PASIEN VIA SMS  GATEWAYS</p>
<p><strong>Pasien baru </strong></p>
<p>Format SMS : REG/NAMA/TEMPAT LAHIR/TANGGAL LAHIR <br />
  CONTOH : REG/HENDI/TASIKMALAYA/1985-10-17 <br />
  Data akan tersimpan dalam database pasien klinik.</p>
<p><strong>Pendaftaran pasien ke klinik yang  dituju </strong></p>
<p>Format SMS : <br />
  <span class="style1">REG2</span>/<span class="style2">PRN</span>/<span class="style3">KDKLINIK</span>/<span class="style4">KDDOKTER</span>/TANGGAL/JAM &nbsp;&nbsp; <br />
  CONTOH : <span class="style1">REG2</span>/<span class="style2">0001</span>/<span class="style3">1</span>/<span class="style4">admin</span>/2014-05-25/16:00</p>
<p>* <em>Format tanggal yang diizinkan : Tahun-bulan-tanggal, format  yang salah menyebabkan kegagalan pendaftaran.</em></p>
<p><strong>Pengaturan kode-kode</strong></p>
<p>KDKLINIK adalah kode yang tersimpan dalam database sistem.<br />
  KDDOKTER adalah username dokter yang tersimpan dalam  sistem.</p>
<p><strong>Rekomendasi kode-kode :</strong></p>
<p>Kode untuk klinik :<br />
  1 | Klinik Umum<br />
  2 | Klinik Penyakit Dalam<br />
  3 | Klinik Anak<br />
  4 | Klinik Obgyn</p>
<p>  Kode dokter/username dokter : <br />
  Ambil satu hurup pertama dan nama belakang, contoh : <strong>htoha</strong> untuk Hendi Toha.</p>
Gunakan hurup kecil tanpa spasi untuk kode  dokter/username

</body>
</html>
