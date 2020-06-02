<?php 
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include "tab_ranap.php";
$kd_kunjungan = $_REQUEST['kd_kunjungan'];
if ($kd_kunjungan !="") {
   $sql = "SELECT * FROM reg WHERE kd_kunjungan='$kd_kunjungan'";
   $qry = mysql_query($sql,$koneksi)
      or die ("SQL Error".mysql_error());
   $data=mysql_fetch_array($qry);
}
?>
<html>
<head>
<title>CATATAN MEDIS</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" src="<?php echo $url;?>media/ckeditor/ckeditor.js"></script>
<script src="<?php echo $url;?>media/ckeditor/_samples/sample.js" type="text/javascript"></script>
<link href="<?php echo $url;?>media/ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo $url;?>media/kalendar/js/jscal2.js"></script>
    <script src="<?php echo $url;?>media/kalendar/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/steel/steel.css" />
</head>
<body id=tab1>
  <table align="center" width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
      <td colspan="2" bgcolor="#D9E8F3">CATATAN MEDIS </td>
    </tr>
<form name="form1" method="post" action="catatanmedis_sim.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>">
<input name="kd_kunjungan" type="hidden" value="<?php echo $data['kd_kunjungan'];?>"/>
    <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
      <td>Tanggal/Jam</td>
      <td><input name="tgl_cm" type="text" id="tgl_cm" size="10" value="<?php echo "".date('Y-m-d') ;?>"> /
 	<input name="jam_cm" type="text" id="jam_cm" size="6" value="<?php echo "".date('H:i') ;?>"> WIB
	</td>
    </tr>
    <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
      <td>Shift</td>
      <td><select name="shift" id="shift">
        <option value="Pagi">Pagi</option>
        <option value="Sore">Sore</option>
	<option value="Malam">Malam</option>
    </select>
      </td>
    </tr>
    <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
      <td valign=top>Laporan</td>
      <td><textarea cols="80" rows="8" name="template"></textarea><script type="text/javascript">
		//<![CDATA[

			// Replace the <textarea id="editor"> with an CKEditor
			// instance, using default configurations.
			CKEDITOR.replace( 'template',
				{
					skin : 'office2003',
					extraPlugins : 'uicolor',
					uiColor: '#DC0C4B',
					toolbar :
					[
						[ 'SelectAll','Copy','Cut','Paste','-','Bold', 'Italic','Underline','Strike','Superscript','Subscript','TextColor','BGColor','Smiley','-', 'NumberedList', 'BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','Indent','Outdent','-','Undo','Redo' ]

					]
				} );

		//]]>
		</script>
    </td>
    </tr>
  <tr> 
    <td colspan="2" bgcolor="#CCCCCC"><input type="submit" name="Submit" value="Simpan"></td>
  </tr>
   </form>
</table>
</body>
</html>
<?php
include "catatanmedisview.php";
?>
