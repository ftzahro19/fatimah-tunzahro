<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: KALKULATOR TETESAN INFUS</title>

<script>
function startCalc(){
interval = setInterval("calc()",1);
}
function calc(){
isi = document.frmAdd.txtisi.value;
dosis = document.frmAdd.txtdosis.value;
cairan = document.frmAdd.txtcairan.value;
faktor = document.frmAdd.txtfaktor.value;
document.frmAdd.aliran.value = ( dosis * cairan * 60 ) / ( isi * 1000 );
document.frmAdd.txttetesan.value = ( faktor * dosis * cairan ) / ( isi * 1000 );
}
function stopCalc(){
clearInterval(interval);
}
</script>
</head>
<body>
<table width="98%" border="0">
<tr>
<td>
<form name="frmAdd">
<table width="100%" cellpadding="2">
<tr>
<td height="78" colspan="3" align="center"><strong>KALKULATOR DOSIS OBAT  (TIDAK MENGGUNAKAN BERAT BADAN) </strong></td>
</tr>
<tr>
<td width="22%">Isi Obat (mg)</td>
<td width="1%">:</td>
<td width="77%"><input type="text" name="txtisi" size="10" onFocus="startCalc();" onBlur="stopCalc();"> 
mg </td>
</tr>
<tr>
<td>Dosis yang diberikan</td>
<td>:</td>
<td><input type="text" name="txtdosis" size="10" onFocus="startCalc();" onBlur="stopCalc();">
microgram/menit</td>
</tr>
<tr>
<td>Jumlah cairan</td>
<td>:</td>
<td><input type="text" name="txtcairan" size="10" onFocus="startCalc();" onBlur="stopCalc();">
ml</td>
</tr>
<td>Kecepatan ml/jam </td>
<td>:</td>
<td><input type="text" name="aliran" size="10" style="background-color:#CCCCCC"readonly> 
ml/jam</td>
</tr>
<tr>
<td>Faktor tetesan</td>
<td>:</td>
<td><select name="txtfaktor" onFocus="startCalc();" onBlur="stopCalc();">
  <option value="15">15</option>
  <option value="20">20</option>
  <option value="60">60</option>
</select></td>
</tr>
<tr>
<td>Kecepatan Tetesan</td>
<td>:</td>
<td><input type="text" name="txttetesan" size="10" style="background-color:#CCCCCC"readonly> tetes/menit</td>
</tr>
<tr>
<td colspan="3" align="left"><input type="reset" value="Kosongkan" /></td>
</tr>
</table>
</form>
</td>
</tr>
</table>

</body>
</html>
