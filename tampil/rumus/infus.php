<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Rumus Pintar Obat - Renpra.Com</title>
<script>
function startCalc(){
interval = setInterval("calc()",1);
}
function calc(){
one = document.frmAdd.txtcairan.value;
two = document.frmAdd.txtfaktor.value;
three = document.frmAdd.txtjam.value;
document.frmAdd.txttetesan.value = (one * two) / (three * 60);
}
function stopCalc(){
clearInterval(interval);
}
</script>
<style type="text/css">
<!--
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
</head>
<body>
<table width="99%" border="0">
  <tr>
    <td><div align="left" class="style3">
      <p><strong>Rumus Kecepatan Tetesan Infus</strong> (tetes/menit): </p>
      <p><u>Jumlah cairan yang akan diberikan x Faktor tetesan </u><br>
        Lama pemberian (jam) x 60      </p>
      <p><hr></p>
      <form name="frmAdd">
Jumlah cairan yang akan diberikan (ml) :<br>
            <input name="txtcairan" type="text"  onFocus="startCalc();" onBlur="stopCalc();" size="10%"/><br>
Lama pemberian (jam) :<br>
            <input name="txtjam" type="text"  onFocus="startCalc();" onBlur="stopCalc();" size="10%"/><br>
Faktor tetesan :<br>
	  	    <select name="txtfaktor" onFocus="startCalc();" onBlur="stopCalc();">
	  	      <option value="15">15</option>
	  	      <option value="20">20</option>
	  	      <option value="60">60</option>
  	        </select>
	  	    <br>
Kecepatan tetesan infus :<br />
            <input name="txttetesan" type="text" value="" size="10%" style="background-color:#CCCCCC"readonly/>
      tetes/menit.<br>
	  <input type="reset" value="Kosongkan" />
      </form>
    </div></td>
  </tr>
</table>
</body>
</html>
