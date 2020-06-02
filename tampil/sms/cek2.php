<p>Maaf, Anda belum memasukkan Serial Number yang benar</p><p>Masukkan <a href='install.php'>Serial Number</a></p>

<?php

if ($_SESSION['registered'] != 'TRUE')
{
	echo "<p>Maaf, Anda belum memasukkan Serial Number yang benar</p>";
	echo "<p>Masukkan <a href='install.php'>Serial Number</a></p>";
	exit;
}


?>