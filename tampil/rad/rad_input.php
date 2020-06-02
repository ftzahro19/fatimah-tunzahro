<?php 
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.session.php";
include "../rawatinap/data_pasien.php";
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
<title>ORDER LABORATORIUM</title>
<script type="text/javascript" src="<?php echo $url;?>media/ckeditor/ckeditor.js"></script>
<script src="<?php echo $url;?>media/ckeditor/_samples/sample.js" type="text/javascript"></script>
<link href="<?php echo $url;?>media/ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
a:link {
	color: #000080;
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
-->
</style>
</head>
<body>
</hr>
  <table align="left" width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
      <tr bgcolor="#FFFFFF">
     	<td colspan="4" align="center" bgcolor="#D9E8F3"><b>EXPERTISE</b><b></b></td>
   	</tr>
  <form name="form1" method="post" action="rad_input_sim.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>">
  <input name="kd_kunjungan" type="hidden" value="<?php echo $data['kd_kunjungan'];?>"/>
  <input name="tanggal_hasil" type="hidden" value="<?php echo "".date('Y-m-d');?>" />
  <input name="jam_hasil" type="hidden" value="<?php echo "".date('H:i');?>" />
  <input name="dr_radiologi" type="hidden" value="<?php echo "".$_SESSION['klinik']."";?>"/>
  <tr bgcolor="#FFFFFF">
<?php
$kd_kunjungan=$_GET["kd_kunjungan"];
$query = "SELECT * FROM rad WHERE kd_kunjungan='$kd_kunjungan' AND status='Order'";
$hasil = mysql_query($query);
$i = 0;
while ($data = mysql_fetch_array($hasil))
{
?>
    <td colspan="4" align="center" bgcolor="#FFFFFF"><radel></radel>
	  <div align="left">
	    <input type="hidden" value="<?php echo $data['id'];?>" name="rad<?php echo $i;?>" />
	    <input type="hidden" size="6" value="<?php echo $data['nama_rad'];?>" name="nama_rad<?php echo $i;?>" />
	    <?php echo $data['nama_rad'];?></div></td>
    </tr>
	<tr bgcolor="#FFFFFF">
    <td colspan="4" align="center" bgcolor="#FFFFFF"><textarea cols="80" rows="8" name="template"><?php echo $data['expertise'];?></textarea><script type="text/javascript">
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
	  <?php $i++;?></td>
    </tr>
    <?php
}
?>
    <tr bgcolor="#FFFFFF">
      	<td width="3%" bgcolor="#FFFFFF"><input type="hidden" name="n" value="<?php echo $i; ?>" /></td>
   	  <td colspan="5" bgcolor="#FFFFFF"><input type="submit" name="Submit" value="Simpan">
   	    <input type="submit" name="submit" value="Verifikasi" onClick="form1.action='rad_verifikasi.php?kd_kunjungan=<?php echo $kd_kunjungan;?>'; return true;"></td>
    </tr>
	  </form>
	  <script>
<!--
/*By George Chiang(JK's JavaScript tutorial)http://javascriptkit.com 
Credit must stay intact for use*/
function show(){
var Digital=new Date()
var hours=Digital.getHours()
var minutes=Digital.getMinutes()
var seconds=Digital.getSeconds()
var dn="AM"
if(hours>11){
dn="PM"
hours=hours-12
}
if (hours==0)
hours=12
if (minutes<=9)
minutes="0"+minutes
if (seconds<=9)
seconds="0"+seconds
document.form1.jam_dx.value=hours+":"+minutes+":"+seconds+" "+dn
setTimeout("show()",1000)
}
show()
//-->
</script>
</table>
</body>
</html>
