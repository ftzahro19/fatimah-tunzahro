IP address script:

<?
$ip=$_SERVER['REMOTE_ADDR'];
echo "IP Address= $ip";
?>

Hostname script:

<?
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
echo "Nama Komputer: $hostname";
?>
