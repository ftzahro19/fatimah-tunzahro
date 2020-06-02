<?php
include "koneksi.php";
$nama = $_POST['nama'];
?>
<html>
<head>
  <title>SMS Template</title>
    <link href="style2.css" rel="stylesheet" type="text/css" media="screen" />
  <script type="text/javascript">
  
  function insertinto(x)
  {
     opener.document.formku.pesan.value = x;
  }
  
  </script>
</head>
<body>
<h2 style="font-family: calibri;">Cari Template</h2>

<div style="font-family: calibri; font-size: 13px;">
<form method="post" action="template.php?op=search">
Keyword <input type="text" name="nama" value="<?php echo $nama; ?>"> <input type="submit" value="SEARCH"><br><br>
</form>

</div>

<?php

if ($_GET['act'] == 'del')
{
	$id = $_GET['id'];
	$query = "DELETE FROM sms_template WHERE id = '$id'";
	mysql_query($query);
}

if ($_GET['op'] == "search")
{

   $query = "SELECT * FROM sms_template WHERE template LIKE '%$nama%'";
   $hasil = mysql_query($query);
   echo "<table id='tabelku' width='100%' style='font-family: calibri; font-size: 13px;'>";
   echo "<tr bgcolor='#000000' style='color: #ffffff;'><th>PILIH</th><th>TEMPLATE</b></th><th>HAPUS</th></tr>";

   while ($data = mysql_fetch_array($hasil))
   {
   $i++;
   
   echo "<tr valign='top'><td><a href='#' onClick=\"opener.document.formku.pesan.value ='".str_replace('<br>', '
', $data['template'])."'\">Pilih</a></td><td>".$data['template']."</td><td align='center'><a href='template.php?act=del&id=".$data['id']."'>X</a></td></tr>";
   }
   echo "</table>";
   // link tambah data phonebook
   
}
else
{
$dataPerPage = 10;
 
if(isset($_GET['page']))
{
    $noPage = $_GET['page'];
} 
else $noPage = 1;
 
$offset = ($noPage - 1) * $dataPerPage;

// menampilkan seluruh data phonebook

$query = "SELECT * FROM sms_template ORDER BY id LIMIT $offset, $dataPerPage";

$hasil = mysql_query($query);
echo "<table id='tabelku' width='100%' style='font-family: calibri; font-size: 13px;'>";
echo "<tr bgcolor='#000000' style='color: #ffffff;'><th>PILIH</th><th>TEMPLATE</th><th>HAPUS</th></tr>";
$i = ($noPage-1)*$dataPerPage;
while ($data = mysql_fetch_array($hasil))
{
   $i++;
   
   echo "<tr valign='top'><td><a href='#' onClick=\"insertinto('".str_replace('<br>', '
', str_replace("'", "\'", str_replace('"', '&quot;', $data['template'])))."'); \">Pilih</a></td><td>".$data['template']."</td><td align='center'><a href='template.php?act=del&id=".$data['id']."'>X</a></td></tr>";
   
}
echo "</table>";

$query  = "SELECT COUNT(*) AS jumData FROM sms_template";
$hasil  = mysql_query($query);
$data   = mysql_fetch_array($hasil);
 
$jumData = $data['jumData'];
  
$jumPage = ceil($jumData/$dataPerPage);

echo "<p style='font-family: calibri; font-size: 13px;'>Halaman: "; 

if (isset($_GET['sortby']))
{

if ($noPage > 1) echo  "<a href='".$_SERVER['PHP_SELF']."?op=show&sortby=".$_GET['sortby']."&page=".($noPage-1)."'>&lt;&lt; Prev</a>";
  
for($page = 1; $page <= $jumPage; $page++)
{
         if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) 
         {   
            if (($showPage == 1) && ($page != 2))  echo "..."; 
            if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "...";
            if ($page == $noPage) echo " <b>".$page."</b> ";
            else echo " <a href='".$_SERVER['PHP_SELF']."?op=show&sortby=".$_GET['sortby']."&page=".$page."'>".$page."</a> ";
            $showPage = $page;          
         }
}
 
if ($noPage < $jumPage) echo "<a href='".$_SERVER['PHP_SELF']."?op=show&sortby=".$_GET['sortby']."&page=".($noPage+1)."'>Next &gt;&gt;</a>";

}
else
{

if ($noPage > 1) echo  "<a href='".$_SERVER['PHP_SELF']."?op=show&page=".($noPage-1)."'>&lt;&lt; Prev</a>";
  
for($page = 1; $page <= $jumPage; $page++)
{
         if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) 
         {   
            if (($showPage == 1) && ($page != 2))  echo "..."; 
            if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "...";
            if ($page == $noPage) echo " <b>".$page."</b> ";
            else echo " <a href='".$_SERVER['PHP_SELF']."?op=show&page=".$page."'>".$page."</a> ";
            $showPage = $page;          
         }
}
 
if ($noPage < $jumPage) echo "<a href='".$_SERVER['PHP_SELF']."?op=show&page=".($noPage+1)."'>Next &gt;&gt;</a>";


}
echo "</p>";
}
?>
</body>
</html>