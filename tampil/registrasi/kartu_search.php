<?php
include "../../config/config.php";
?>
<html>
<head>
    <script src="<?php echo $url;?>media/kalendar/js/jscal2.js"></script>
    <script src="<?php echo $url;?>media/kalendar/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/steel/steel.css" />
<style type="text/css">
body { background-image: url('hendi.jpg'); background-repeat: no-repeat; background-position: top left; background-attachment: scroll; }
</style>
<title>PENDAFTARAN RAWAT JALAN</title></head>
<body>
<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <form name="form1" method="post" action="kartu.php">
<tr bgcolor="#CCCCCC"> 
    <td colspan="2" align="left"><strong>CETAK KARTU  PASIEN</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="150" align="left">PRN</td>
    <td>
      <input name="prn" type="text" id="prn" maxlength="8" size="10">   </td>
    </tr>
  

<tr>
    <td bgcolor="#FFFFFF" colspan="2" align="left"><input type="submit" name="Submit" value="CETAK KARTU">
      <input type="submit" name="submit" value="CETAK MEDREK" onClick="form1.action='kartu2.php'; return true;" title="Cetak Buku MR"></td>
  </tr>
  </form>
</table>
</body>
</html>
