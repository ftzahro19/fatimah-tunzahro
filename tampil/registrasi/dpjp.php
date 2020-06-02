<?php 
include "../librari/inc.koneksidb.php";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
            "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv"Script-Content-Type" content="text/javascript">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Expires" content="0"> <!-- disable caching -->
    <title>DAFTAR NAMA DOKTER PENANGGUNG JAWAB PASIEN</title>
    <script type="text/javascript">
    function makeSelection(form1, id) {
      if(!form1 || !id)
        return;
      var elem = form1.elements[id];
      if(!elem)
        return;
      var val = elem.options[elem.selectedIndex].value;
      opener.targetElement.value = val;
      this.close();
    }
    </script>
</head>
<body>
  <form id="form1" name="form1" action="#">
    <div align="center">
     <select name="nameSelection" size="15" id="nameSelection2">
	<option value="" selected></option>
        <?php
	$sql = "SELECT * FROM user";
      	$qry = @mysql_query($sql, $koneksi) or die ("gagal Query");
	while ($data =mysql_fetch_array($qry)) {
	if ($data[nama]==$nama) {
	$cek="selected";
	}
	else {
	$cek="";
	}
	echo "<option value='$data[nama]' $cek>".$data['nama']."</option>";
	}
	?>
      </select>
      <input name="button" type="button" onClick="makeSelection(this.form, 'nameSelection');" value="Pilih">
    </div></br>
  </form>
</body>
</html>

