<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Database Obat</title>
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
<td><input type="text" name="qty" size="5" onFocus="startCalc();" onBlur="stopCalc();"></td>
</tr>
<tr>
<td>Harga satuan</td>
<td>:</td>
<td>Rp <input type="text" name="harga_jual" size="30" onFocus="startCalc();" onBlur="stopCalc();"></td>
</tr>
<tr>
<td>Total Harga</td>
<td>:</td>
<td>Rp <input type="text" name="total_harga" size="30" onFocus="startCalc();" onBlur="stopCalc();" style="background-color:#CCCCCC" readonly></td>
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
