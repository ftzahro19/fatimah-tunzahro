<?php
include "cek3.php";
session_start();
include "identitas.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Chocolate Brown 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20090413

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title></title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<script src="jquery.min.js"></script>
<script src="jquery.cluetip.js"></script>
<script src="jquery.ui.min.js"></script>
<link href="jquery.ui.datetimepicker.css" rel="stylesheet" type="text/css" />
<script src="jquery.ui.datetimepicker.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="jquery.cluetip.css" type="text/css" />

<script type="text/javascript">
$(function() {
                $('#demo2').datetimepicker({dateFormat: 'yyyy/mm/dd HH:MM'});
               });
			   
$('a.phonebook').cluetip({splitTitle: '|'});			   
</script> 

<script type="text/javascript">

  function selected(x)
  {
		if (x == 1) document.formku.kirim[0].checked = true;
		if (x == 2) document.formku.kirim[1].checked = true;
		if (x == 3) document.formku.kirim[2].checked = true;
		if (x == 4) document.formku.kirim[3].checked = true;
  }  

  function count()
  {
   document.formku.counter.value = document.formku.pesan.value.length;
  }
  
  function pilihan()
  {
     // membaca jumlah komponen dalam form bernama 'myform'
     var jumKomponen = document.myform.length;

     // jika checkbox 'Pilih Semua' dipilih
     if (document.myform.pilih.checked == true)
     {
        // semua checkbox pada data akan terpilih
        for (i=1; i<=jumKomponen; i++)
        {
            if (document.myform[i].type == "checkbox") document.myform[i].checked = true;
        }
     }
     // jika checkbox 'Pilih Semua' tidak dipilih
     else if (document.myform.pilih.checked == false)
        {
            // semua checkbox pada data tidak dipilih
            for (i=1; i<=jumKomponen; i++)
            {
               if (document.myform[i].type == "checkbox") document.myform[i].checked = false;
            }
        }
  }


  
  function konfirm(xxx)
  {
       tanya = confirm('Anda yakin ingin menghapus semua data ' + xxx + '?');
       if (tanya == true) return true;
       else return false;
  }
  
  
  function ajax1() 
  {
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
     xmlhttp=new XMLHttpRequest();
  }
  else
  {// code for IE6, IE5
     xmlhttp =new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	<?php
	if (basename($_SERVER['PHP_SELF']) == "report.php")
	{
     echo 'document.getElementById("sms").innerHTML = xmlhttp.responseText;';
	}
	?>
    }
  }
  
  <?php
	$hal2 = $_GET['page'];
  ?>
 
  xmlhttp.open("GET","smsreport.php?page=<?php echo $hal2; ?>");
  xmlhttp.send();
  setTimeout("ajax1()", 20000);
  }

  function ajax4() 
  {
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
     xmlhttp4=new XMLHttpRequest();
  }
  else
  {// code for IE6, IE5
     xmlhttp4 =new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  xmlhttp4.onreadystatechange=function()
  {
  if (xmlhttp4.readyState==4 && xmlhttp4.status==200)
    {
     document.getElementById("folder").innerHTML = xmlhttp4.responseText;
    }
  }
  
 
  xmlhttp4.open("GET","showfolder.php");
  xmlhttp4.send();
  setTimeout("ajax4()", 15000);
  }
  
  function ajax2()
  {
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
	 xmlhttp2=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
 	 xmlhttp2 =new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp2.onreadystatechange=function()
	{
		if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
		{
			<?php
			if (basename($_SERVER['PHP_SELF']) == "inbox.php")
			{
				echo 'document.getElementById("smsinbox").innerHTML = xmlhttp2.responseText;';
			}
			?>
		}
	}
	
	<?php
	$hal = $_GET['page'];
	?> 
	
	xmlhttp2.open("GET","runinbox.php?page=<?php echo $hal; ?>");
	xmlhttp2.send();  
	setTimeout("ajax2()", 15000);
  }
  
  function ajax3()
  {
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
	 xmlhttp3=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	 xmlhttp3 =new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp3.onreadystatechange=function()
	{
		if (xmlhttp3.readyState==4 && xmlhttp3.status==200)
		{
	
		document.getElementById("status").innerHTML = xmlhttp3.responseText;
		var ob = document.getElementsByTagName("script");

		for(var i=0; i<ob.length-1; i++)
		{
			if(ob[i+1].text!=null) eval(ob[i+1].text);
		}
	
		}
	}
	
	xmlhttp3.open("GET","run.php");
	xmlhttp3.send();
	setTimeout("ajax3()", 5000);
  
  }
  
  
  function ajaxservice()
  {
         if (window.XMLHttpRequest)
		 {// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttpservice=new XMLHttpRequest();
		 }
		 else
		 {// code for IE6, IE5
			xmlhttpservice =new ActiveXObject("Microsoft.XMLHTTP");
		 }
		 
		 xmlhttpservice.onreadystatechange=function()
		 {
			if (xmlhttpservice.readyState==4 && xmlhttpservice.status==200)
			{
				document.getElementById("service").innerHTML = xmlhttpservice.responseText;
			}
		 }
		 
		 xmlhttpservice.open("GET","service.php");
		 xmlhttpservice.send();
		 // setTimeout("ajaxservice()", 120000);
  }  
  
  </script>
  
  <script type="text/javascript">
//menuju ke fungsi show_date() 1000 milidetik atau 1 detik kemudian
window.setTimeout("show_date()",1000);

function show_date(){

var tanggal = new Date();

document.getElementById("tempat_tanggal").innerHTML= tanggal.toDateString() + ", Pukul: " + tanggal.toLocaleTimeString();

//kembali ke awal fungsi show_date() 1000 milidetik atau 1 detik kemudian
setTimeout("show_date()",1000);
}
</script>

</head>
<body onload="<?php if (basename($_SERVER['PHP_SELF']) == 'report.php') echo "ajax1();"; ?> <?php if (basename($_SERVER['PHP_SELF']) == 'inbox.php') echo "ajax2(); ajax4();"; ?> ajax3(); show_date(); <?php if ($_GET['op'] == 'service') echo "ajaxservice();"; ?>">
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<h1 style="font-family: verdana; color: #ffffff;">
			<?php
				if ($_SESSION['level'] == '1')
				{
			?>
				<a href="indeks.php?op=main" title="Pengaturan Konfigurasi"><?php echo $namasoftware; ?></a>
			<?php
				}
				else
				{
					echo $namasoftware;
				}
			?>		
			</h1>
		</div>
	</div>
	<!-- end #header -->
	<div id="menu">
		<ul>
		    <?php
			if (isset($_SESSION['login']))
			{
				if ($_SESSION['level'] == '1')
				{
			?>
			<li class="current_page_item"><a href="inbox.php?page=1" title="SMS Inbox">INBOX</a></li>
			<li><a href="group.php?op=show" title="Pengaturan Group">GROUP</a></li>
			<li><a href="listphone.php?op=show" title="Pengaturan Data Phonebook">PHONEBOOK</a></li>
			<li><a href="sendsms.php?op=single" title="Kirim SMS Langsung">INSTANT SMS</a></li>
			<li>ON SCHEDULED SMS</li>
			<li>AUTORESPONDER</li>
			<li>PLUGINS</li>
			<li><a href="report.php?op=show&page=1" title="Outbox SMS">OUTBOX</a></li>
			<?php
				}
				else
				{
			?>
			<li class="current_page_item"><a href="inbox.php?page=1" title="SMS Inbox">INBOX</a></li>
			<li><a href="group.php?op=show" title="Pengaturan Group">GROUP</a></li>
			<li><a href="listphone.php?op=show" title="Pengaturan Data Phonebook">PHONEBOOK</a></li>
			<li><a href="sendsms.php?op=single" title="Kirim SMS Langsung">INSTANT SMS</a></li>
			<li>ON SCHEDULED SMS</li>
			<li>AUTORESPONDER</li>
			<li>PLUGINS</li>
			<li><a href="report.php?op=show&page=1" title="Outbox SMS">OUTBOX</a></li>

			<?php	
				}
			}
			else
			{
			?>
			<li class="current_page_item">INBOX</li>
			<li>GROUP</li>
			<li>PHONEBOOK</li>
			<li>INSTANT SMS</li>
			<li>ON SCHEDULED SMS</li>			
			<li>AUTORESPONDER</li>
			<li>PLUGINS</li>
			<li>OUTBOX</li>
			<?php
			}
			?>
		</ul>
		
	</div>

	<!-- end #menu -->
	<div id="page">
	<div id="tempat_tanggal" style="float: left; margin-left: 710px; color: #000000; font-size: 12px; font-weight: bold"></div>
</div>
	<div id="page-bgtop">
	<div id="page-bgbtm">
		<div id="content" style="font-size: 11px;">
			<div class="post">
			<div class="post-bgtop">
			<div class="post-bgbtm">