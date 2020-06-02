<html>
<head>
  <script type="text/javascript">

  function pilihan()
  {
     // membaca jumlah komponen dalam form bernama 'myform'
     var jumKomponen = document.myform.length;

     // jika checkbox 'Pilih Semua' dipilih
     if (document.myform[0].checked == true)
     {
        // semua checkbox pada data akan terpilih
        for (i=1; i<=jumKomponen; i++)
        {
            if (document.myform[i].type == "checkbox") document.myform[i].checked = true;
        }
     }
     // jika checkbox 'Pilih Semua' tidak dipilih
     else if (document.myform[0].checked == false)
        {
            // semua checkbox pada data tidak dipilih
            for (i=1; i<=jumKomponen; i++)
            {
               if (document.myform[i].type == "checkbox") document.myform[i].checked = false;
            }
        }
  }

  </script>
<title>RESEP</title>
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
<body>
<?php
// membaca file koneksi.php
include "koneksi.php";

echo "<h1>Dump MySQL</h1>";
echo "<h3>Nama Database: ".$dbName."</h3>";
echo "<h3>Daftar Tabel</h3>";

// query untuk menampilkan semua tabel dalam database
$query = "SHOW TABLES";
$hasil = mysql_query($query);

// menampilkan semua tabel dalam form
echo "<form name='myform' method='post' action='proses.php'>";
echo "<table>";
echo "<tr><td><input type='checkbox' name='pilih' onclick='pilihan()' ></td><td><b>Pilih Semua</b></td></tr></hr>";
while ($data = mysql_fetch_row($hasil))
{
   echo "<tr><td><input type='checkbox' name='tabel[]' value='".$data[0]."'></td><td>".$data[0]."</td></tr>";
}
echo "</table><br>";
echo "<input type='submit' name='submit' value='Backup Data'>";
echo "</form>";

?></body>
</html>
