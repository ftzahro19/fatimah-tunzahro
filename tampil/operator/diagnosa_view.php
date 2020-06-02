<?php
include "../librari/inc.koneksidb.php";
include "tab_order_poli.php";
include "../librari/terbilang.php";
include "../librari/fungsi_indotgl.php";
$kd_kunjungan = $_REQUEST['kd_kunjungan'];
if ($kd_kunjungan !="") {
   $sql = "SELECT * FROM reg WHERE kd_kunjungan='$kd_kunjungan'";
   $qry = mysql_query($sql,$koneksi)
      or die ("SQL Error".mysql_error());
   $data=mysql_fetch_array($qry);
}
if (isset($_GET['action'])) {
if ($_GET['action'] == "del")
{
   // membaca nilai n dari hidden value
   $n = $_POST['n'];
   for ($i=0; $i<=$n-1; $i++)

   {
     if (isset($_POST['dx'.$i]))
     {
       $dx = $_POST['dx'.$i];
       $query = "DELETE FROM diagnosa WHERE id='$dx'";
       mysql_query($query);
     }
   }
}
}
?>
<html>
<head>
  <script type="text/javascript">

  function pilihan()
  {
     // membaca jumlah komponen dalam form bernama 'myform'
     var jumKomponen = document.form1.length;

     // jika checkbox 'Pilih Semua' dipilih
     if (document.form1[0].checked == true)
     {
        // semua checkbox pada data akan terpilih
        for (i=1; i<=jumKomponen; i++)
        {
            if (document.form1[i].type == "checkbox") document.form1[i].checked = true;
        }
     }
     // jika checkbox 'Pilih Semua' tidak dipilih
     else if (document.form1[0].checked == false)
        {
            // semua checkbox pada data tidak dipilih
            for (i=1; i<=jumKomponen; i++)
            {
               if (document.form1[i].type == "checkbox") document.form1[i].checked = false;
            }
        }
  }

  </script>
  <script language="javascript">
var win = null;
function NewWindow(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
}
</script>
<title>diagnosa</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252"><style type="text/css">
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
<body id="tab4">
<a href="diagnosa.php?kd_kunjungan=<?php echo $kd_kunjungan;?>" onClick="NewWindow(this.href,'name','800','400','yes');return false"><b>+ Tambah diagnosa </b>
</a>
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?kd_kunjungan=<?php echo $kd_kunjungan;?>&action=del">
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
 <tr bgcolor="#FFFFFF">
    <td width="5%" bgcolor="#D9E8F3"><div align="center">
    <input type="checkbox" name="pilih" onClick="pilihan()" /></div>    </td>
    <td width="10%" bgcolor="#D9E8F3"><div align="center">Tanggal</div></td>
    <td width="10%" bgcolor="#D9E8F3"><div align="center">Jam</div></td>
    <td width="10%" bgcolor="#D9E8F3"><div align="center">ICD-X</div></td>
    <td width="45%" bgcolor="#D9E8F3"><div align="center">Diagnosa Medis</div></td>
    <td width="20%" bgcolor="#D9E8F3"><div align="center">Keterangan</div></td>
 </tr>

<?php
// query untuk mencari file berdasarkan kategori
$query = "SELECT * FROM diagnosa WHERE kd_kunjungan='$kd_kunjungan'";
$hasil = mysql_query($query);
$adadata = mysql_num_rows($hasil);
if ($adadata >=1) {
while ($data = mysql_fetch_array($hasil))
{
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1" align="center">
    <input type="checkbox" name="dx<?php echo $i;?>" value="<?php echo $data['id'];?>"/></td>
    <td class="style1"><?php echo $data['tanggal_dx'];?></td>
    <td class="style1"><?php echo $data['jam_dx'];?></td>
    <td class="style1"><?php echo $data['kd_diagnosa'];?></td>
    <td class="style1"><?php echo $data['nama_diagnosa'];?></td>
	<td class="style1"><?php echo $data['keterangan'];?><?php $i++;?></td>
  </tr>
  <?php
}
?>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan="9"><input type="hidden" name="n" value="<?php echo $i;?>"/>
      <input type="submit" value="Hapus" name="submit">    </tr>
<?php
}
else {
?>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan="9">
	<?php echo "Tidak ditemukan data!";?>   
	</td>
	</tr>
<?php
}
?>
</table>
</div>
</body>
</html>
