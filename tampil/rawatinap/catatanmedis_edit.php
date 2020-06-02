<?php 
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include "tab_ranap.php";

$kd_cm = $_REQUEST['kd_cm'];
$kd_kunjungan = $_REQUEST['kd_kunjungan'];
$tgl_cm = $_REQUEST['tgl_cm'];
$jam_cm = $_REQUEST['jam_cm'];
$sql = "SELECT * FROM catatanmedis WHERE kd_cm='$kd_cm' AND kd_kunjungan='$kd_kunjungan'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
?>
<html>
<head>
<script type="text/javascript" src="<?php echo $url;?>media/ckeditor/ckeditor.js"></script>
<script src="<?php echo $url;?>media/ckeditor/_samples/sample.js" type="text/javascript"></script>
<link href="<?php echo $url;?>media/ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo $url;?>media/kalendar/js/jscal2.js"></script>
    <script src="<?php echo $url;?>media/kalendar/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/steel/steel.css" />
<script type="text/javascript">
 function count()
  {
   document.form1.counter.value = document.form1.template.value.length;
  }
//Create an array
  var allPageTags = new Array();

  function doSomethingWithClasses(theClass) {
//Populate the array with all the page tags
    var allPageTags=document.getElementsByTagName("*");
//Cycle through the tags using a for loop
    for (var i=0; i<allPageTags.length; i++) {
//Pick out the tags with our class name
      if (allPageTags[i].className==theClass) {
//Manipulate this in whatever way you want
        allPageTags[i].style.display='none';
      }
    }
  }

function Show(ids) {
  doSomethingWithClasses('RBtnTab');

  var obj = document.getElementById(ids);
  if (obj.style.display != 'block') { obj.style.display = 'block'; }
                               else { obj.style.display = 'none'; }
}
</script>
<title>HANDOVER</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<style type="text/css">
<!--
a:link {
	color: #FF0000;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #0000FF;
}
a:hover {
	text-decoration: none;
	color: #FF0000;
}
a:active {
	text-decoration: none;
}
.style1 {font-size: 16px}

div.RBtnTab { display:none}
-->
</style>
</head>
<body id="tab1">
  <table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
      <td colspan="6" bgcolor="#D9E8F3">UPDATE CATATAN HANDOVER</td>
    </tr>
<form name="form1" method="post" action="catatanmedis_edit_sim.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>">
<input name="kd_cm" type="hidden" value="<?php echo $data['kd_cm'];?>"/>
<input name="kd_kunjungan" type="hidden" value="<?php echo $data['kd_kunjungan'];?>"/>
    <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
      <td>Tanggal / Jam</td>
      <td><input name="tgl_cm" type="text" id="tgl_cm" size="10" value="<?php echo $data['tgl_cm'];?>"> / <input name="jam_cm" type="text" id="jam_cm" size="10" value="<?php echo $data['jam_cm'];?>"> WIB</td>
    </tr>
    <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
      <td>Shift</td>
      <td><select name="shift" id="shift">
      <?php 
	  if ($data['shift']=="Pagi") echo "<option value='Pagi' selected>Pagi</option>";
        else echo "<option value='Pagi'>Pagi</option>";
        if ($data['shift']=="Sore") echo "<option value='Sore' selected>Sore</option>";
        else echo "<option value='Sore'>Sore</option>";
        if ($data['shift']=="Malam") echo "<option value='Malam' selected>Malam</option>";
        else echo "<option value='Malam'>Malam</option>";        
?>
    </select></td>
    </tr>
    <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
      <td>Isi</td>
      <td><textarea cols="80" rows="10" name="template">
<?php echo $data['catatanmedis'];?></textarea>
	<script type="text/javascript">
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
		</script></td>
    </tr>
    <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
      <td>SMS pengingat</td>
      <td><input type="radio" name='sms' value='Tidak' onClick="Show('DIV1')">Tidak
	  <input type="radio" name='sms' value='Ya' onClick="Show('DIV2')">Ya
	  <div id='DIV2' class="RBtnTab">HP Perawat Pj <input name="nohp" type="text" id="nohp" value="<?php echo $data['nohp'];?>"></div>
      </td>
    </tr>  
<tr> 
    <td colspan="6" bgcolor="#CCCCCC">
    <input type='submit' name='Update' value='Update' onClick="this.form.target='_self';return true;">
    </td>
  </tr>
   </form>
</table>
</body>
</html>

