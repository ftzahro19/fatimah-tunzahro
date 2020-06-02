Pada form tersebut mari kita lihat, ketikkan saja angka (3) pada field Jumlah Barang lalu ketikkan angka (25000) pada field harga satuan, sementara field pajak secara default bernilai 10 persen, maka secara otomatis tertulislah angka pada field total harga dan grand total. Dengan menggunakan sedikit javascript anda bisa membuatnya seperti itu, perhatikan skripnya dibawah ini :

<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Grand total</title>

<script>
function startCalc(){
interval = setInterval("calc()",1);
}
function calc(){
one = document.frmAdd.txtharga.value;
two = document.frmAdd.txtjumlah.value;
three = document.frmAdd.txttotal.value;
four = document.frmAdd.txttotal.value = one * two ;
document.frmAdd.txtgrand.value = (four * 10/100) + four;
}
function stopCalc(){
clearInterval(interval);
}
</script>

</head>

<body>
<table width="30%" border="3" bordercolor="#000000">
<tr>
<td>
<form name="frmAdd">
<table width="100%" cellpadding="2">
<tr>
<td colspan="3"><strong>Grand Total</strong></td>
</tr>
<tr>
<td>Jumlah Barang</td>
<td>:</td>
<td><input type="text" name="txtjumlah" size="5" onFocus="startCalc();" onBlur="stopCalc();"></td>
</tr>
<tr>
<td>Harga satuan</td>
<td>:</td>
<td>Rp <input type="text" name="txtharga" size="30" onFocus="startCalc();" onBlur="stopCalc();"></td>
</tr>
<tr>
<td>Total Harga</td>
<td>:</td>
<td>Rp <input type="text" name="txttotal" size="30" onFocus="startCalc();" onBlur="stopCalc();" style="background-color:#CCCCCC" readonly></td>
</tr>
<tr>
<td>Pajak</td>
<td>:</td>
<td><input type="text" name="txtpajak" size="5" value="10" onFocus="startCalc();" onBlur="stopCalc();" style="background-color:#CCCCCC" readonly>%</td>
</tr>
<tr>
<td>Grand Total</td>
<td>:</td>
<td>Rp <input type="text" name="txtgrand" size="30" style="background-color:#CCCCCC"readonly></td>
</tr>
<tr>
<td colspan="3" align="right"><input type="reset" value="Kosongkan" /></td>
</tr>
</table>
</form>
</td>
</tr>
</table>

</body>
</html>
