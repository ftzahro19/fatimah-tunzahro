<?php
include "cek.php";
include "menu.php";
?>

				<h2 class="title">Atur Group Phonebook</h2>
				
				<div class="entry">
<img src="images/group.jpg" style="float: right;">
<p>&nbsp;</p>
<p>&nbsp;</p>
			
					<p>
				    <?php
					
					if ($_GET['op'] == "update")
{
// proses update data
?>
<?php

	$id = $_POST['id'];
	$idgroup = $_POST['idgroup'];
	$group = str_replace("'", "", $_POST['group']);
	
	$query = "UPDATE sms_group SET sms_group.group = '$group', idgroup = '$idgroup' WHERE idgroup = '$id'";
	$hasil = mysql_query($query);
	if ($hasil) echo "<p>&nbsp;</p><p>Nama group sudah diupdate</p>";
	else echo "<p>&nbsp;</p><p>Nama group gagal diupdate</p>";

}

if ($_GET['op'] == "add")
{
// proses tambah data group
?>
<p>&nbsp;</p>
<form name="formku" method="post" action="<?php $_SERVER['PHP_SELF'];?>?op=simpan">
ID Group <input type="text" name="idgroup" size="5"> Nama Group (tanpa spasi) : <input type="text" name="group"> 
<input type="submit" name="submit" value="Simpan Group" class='tombolku'>
<br><br>
<b>Keterangan:</b><br><br>
Masukkan nomor ID group berupa angka misalnya: 1, 2, atau 3 dst. <br>Nomor ID Group harus unik (tidak boleh sama dengan group lain)
</form>


<?php
}

if ($_GET['op'] == "simpan")
{
// proses penyimpanan data group yang baru
   $group = str_replace("'", "", $_POST['group']);
   $idgroup = $_POST['idgroup'];
   $query = "INSERT INTO sms_group(`group`, idgroup) VALUES ('$group', '$idgroup')";
   $hasil = mysql_query($query);
   if ($hasil) echo "<p>Data sudah disimpan</p>";
   else echo "<p>Data gagal disimpan atau ID group sudah ada</p>";
}

if ($_GET['op'] == "hapus")
{
// proses menghapus data group
    $id = $_GET['id'];
	$query = "DELETE FROM sms_group WHERE idgroup = '$id'";
	mysql_query($query);
	
	$query = "SELECT id FROM sms_autoresponder WHERE idgroup = '$id'";
	$hasil = mysql_query($query);
	while ($data = mysql_fetch_array($hasil))
	{
		$grid = $data['id'];
		$query2 = "DELETE FROM sms_autolist WHERE id = '$grid'";
		mysql_query($query2);
	}
	
	$query = "DELETE FROM sms_autoresponder WHERE idgroup = '$id'";
	mysql_query($query);
	
	$query = "DELETE FROM sms_message WHERE idgroup = '$id'";
	mysql_query($query);
		
	echo "<p>Data group sudah dihapus</p>";
}

if ($_GET['op'] == "edit")
{
// proses edit data group
    $id = $_GET['id'];
    $query = "SELECT * FROM sms_group WHERE idgroup = '$id'";
	$hasil = mysql_query($query);
	$data = mysql_fetch_array($hasil);
?>

<h3>Edit Group</h3>
<p>&nbsp;</p>
<form name="formku" method="post" action="<?php $_SERVER['PHP_SELF'];?>?op=update">
ID Group <input type="text" value="<?php echo $data['idgroup']; ?>" size="5" disabled> Nama Group : <input type="text" name="group" value="<?php echo $data['group']; ?>"> 
<input type="hidden" name="idgroup" value="<?php echo $data['idgroup']; ?>" size="5">
<input type="submit" name="submit" value="Simpan Group" class='tombolku'>
<input type="hidden" name="id" value="<?php echo $data['idgroup'];?>">
</form>


<?php	
}
else if (($_GET['op'] == 'show') || ($_GET['op'] == "simpan") || ($_GET['op'] == "hapus") || ($_GET['op'] == "edit") || ($_GET['op'] == "update")) 
{
// menampilkan seluruh data group

$query = "SELECT * FROM sms_group";
$hasil = mysql_query($query);
echo "<br><br>";
echo "<table width='100%' id='tabelku'>";
echo "<tr><th>ID GROUP</th><th>NAMA GROUP</th><th>ATUR</th></tr>";
while ($data = mysql_fetch_array($hasil))
{
   $i++;
   $idgroup = $data['idgroup'];
   $query2 = "SELECT count(*) AS jum FROM sms_phonebook WHERE idgroup LIKE '%|$idgroup|%'";
   $hasil2 = mysql_query($query2);
   $data2  = mysql_fetch_array($hasil2);
   
   echo "<tr><td>".$data['idgroup']."</td><td><a href='".$_SERVER['PHP_SELF']."?op=show&action=list&group=".$data['idgroup']."'>".$data['group']."</a> (".$data2['jum']." numbers)</td><td><a href='".$_SERVER['PHP_SELF']."?op=edit&id=".$data['idgroup']."'>EDIT</a> | <a href='".$_SERVER['PHP_SELF']."?op=hapus&id=".$data['idgroup']."'>DEL</a></td></tr>";
}
echo "</table>";

if ($_GET['action'] == 'list')
{
$group = $_GET['group'];

$query = "SELECT `group` FROM sms_group WHERE idgroup = '$group'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$namagroup = $data['group'];

$dataPerPage = 20;
 
if(isset($_GET['page']))
{
    $noPage = $_GET['page'];
} 
else $noPage = 1;
 
$offset = ($noPage - 1) * $dataPerPage;

// menampilkan seluruh data phonebook

if (isset($_GET['sortby']))
{
   if ($_GET['sortby'] == 'nama')  $query = "SELECT * FROM sms_phonebook WHERE idgroup LIKE '%|$group|%' ORDER BY nama LIMIT $offset, $dataPerPage";
   else if ($_GET['sortby'] == 'notelp')  $query = "SELECT * FROM sms_phonebook WHERE idgroup LIKE '%|$group|%' ORDER BY noTelp LIMIT $offset, $dataPerPage";
   else if ($_GET['sortby'] == 'group')  $query = "SELECT * FROM sms_phonebook WHERE idgroup LIKE '%|$group|%' ORDER BY idgroup LIMIT $offset, $dataPerPage";
   else if ($_GET['sortby'] == 'alamat')  $query = "SELECT * FROM sms_phonebook WHERE idgroup LIKE '%|$group|%' ORDER BY alamat LIMIT $offset, $dataPerPage";
}
else $query = "SELECT * FROM sms_phonebook WHERE idgroup LIKE '%|$group|%' ORDER BY nama LIMIT $offset, $dataPerPage";

$hasil = mysql_query($query);

echo "<p>&nbsp;</p>";
echo "<p><b>Data Phonebook Group '".$namagroup."'</b></p>";
echo "<table width='100%' id='tabelku'>";
echo "<tr><th width='5%'>NO</th><th width='70%'><a href='".$_SERVER['PHP_SELF']."?op=show&action=list&group=".$group."&sortby=nama'><font color='#ffffff'>NAMA</font></a> </b></th><th><a href='".$_SERVER['PHP_SELF']."?op=show&action=list&group=".$group."&sortby=notelp'><font color='#ffffff'>NO. HP</font></a></th></tr>";

$i = ($noPage-1)*$dataPerPage;
while ($data = mysql_fetch_array($hasil))
{
   $i++;
   $groups = explode('|', $data['idgroup']);
   $listgroup = '';
   for($q=1; $q<=count($groups)-2; $q++)
   {
	  $query2 = "SELECT `group` FROM sms_group WHERE idgroup = '$groups[$q]'";
	  $hasil2 = mysql_query($query2);
      $data2  = mysql_fetch_array($hasil2);
	  $listgroup .= $data2['group'].', ';
   }

	if ($i % 2 == 0) $style = "genap";
    else $style = "ganjil";
   
   echo "<tr class='".$style."'><td>".$i."</td><td><a class='phonebook' title='".strtoupper($data['nama'])."|<b>No. Handphone:</b> ".$data['noTelp']."<br><br> <b>Alamat:</b> ".$data['alamat']."<br><br><b>Group:</b> ".$listgroup."<br><br><b>Tgl Lahir:</b> ".$data['datebirth']."'>".$data['nama']."</a></td><td>".$data['noTelp']."</td></tr>";
   
}
echo "</table><br>";

$query  = "SELECT COUNT(*) AS jumData FROM sms_phonebook WHERE idgroup LIKE '%|$group|%'";
$hasil  = mysql_query($query);
$data   = mysql_fetch_array($hasil);
 
$jumData = $data['jumData'];
  
$jumPage = ceil($jumData/$dataPerPage);

echo "Halaman: "; 

if (isset($_GET['sortby']))
{

if ($noPage > 1) echo  "<a href='".$_SERVER['PHP_SELF']."?op=show&action=list&group=".$group."&sortby=".$_GET['sortby']."&page=".($noPage-1)."'>&lt;&lt; Prev</a>";
  
for($page = 1; $page <= $jumPage; $page++)
{
         if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) 
         {   
            if (($showPage == 1) && ($page != 2))  echo "..."; 
            if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "...";
            if ($page == $noPage) echo " <b>".$page."</b> ";
            else echo " <a href='".$_SERVER['PHP_SELF']."?op=show&action=list&group=".$group."&sortby=".$_GET['sortby']."&page=".$page."'>".$page."</a> ";
            $showPage = $page;          
         }
}
 
if ($noPage < $jumPage) echo "<a href='".$_SERVER['PHP_SELF']."?op=show&action=list&group=".$group."&sortby=".$_GET['sortby']."&page=".($noPage+1)."'>Next &gt;&gt;</a>";

}
else
{

if ($noPage > 1) echo  "<a href='".$_SERVER['PHP_SELF']."?op=show&action=list&group=".$group."&page=".($noPage-1)."'>&lt;&lt; Prev</a>";
  
for($page = 1; $page <= $jumPage; $page++)
{
         if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) 
         {   
            if (($showPage == 1) && ($page != 2))  echo "..."; 
            if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "...";
            if ($page == $noPage) echo " <b>".$page."</b> ";
            else echo " <a href='".$_SERVER['PHP_SELF']."?op=show&action=list&group=".$group."&page=".$page."'>".$page."</a> ";
            $showPage = $page;          
         }
}
 
if ($noPage < $jumPage) echo "<a href='".$_SERVER['PHP_SELF']."?op=show&action=list&group=".$group."&page=".($noPage+1)."'>Next &gt;&gt;</a>";

}
}

}
				?>	
					</p>
				</div>
			</div>
			</div>
			</div>
			
		<div style="clear: both;">&nbsp;</div>
		</div>
		<!-- end #content -->
		<div id="sidebar">
			<ul>
				<li>
					<h2>Sub menu</h2>
					<ul>
					    <li><a href="<?php echo $_SERVER['PHP_SELF']?>?op=show">Tampilkan Semua Group</a></li>
						<li><a href="<?php echo $_SERVER['PHP_SELF']?>?op=add">Tambah Group</a></li>
						<?php
						if (isset($_SESSION['login']))
						{
						echo '<li><a href="indeks.php?op=logout">Logout</a></li>';
						}
						?>
					</ul>
				</li>
				
				
					
			</ul>
			<img src="images/sms.jpg">
		</div>
		
<?php
include "footer.php";
?>