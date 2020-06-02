<?php

function bilangRatusan($x)
{
   // function untuk membilang bilangan pada setiap kelompok

   $kata = array('', 'satu ', 'dua ', 'tiga ' , 'empat ', 'lima ', 'enam ', 'tujuh ', 'delapan ', 'sembilan ');

   $string = '';

   $ratusan = floor($x/100);
   $x = $x % 100;
   if ($ratusan > 1) $string .= $kata[$ratusan]."ratus "; // membentuk kata '... ratus'
   else if ($ratusan == 1) $string .= "seratus "; // membentuk kata khusus 'seratus '

   $puluhan = floor($x/10);
   $x = $x % 10;
   if ($puluhan > 1)
   {
      $string .= $kata[$puluhan]."puluh "; // membentuk kata '... puluh'
      $string .= $kata[$x]; // membentuk kata untuk satuan
   }
   else if (($puluhan == 1) && ($x > 0)) $string .= $kata[$x]."belas "; // kejadian khusus untuk bilangan yang berbentuk kata '... belas'
   else if (($puluhan == 1) && ($x == 0)) $string .= $kata[$x]."sepuluh "; // kejadian khusus untuk bilangan 10
   else if ($puluhan == 0) $string .= $kata[$x];	 // membentuk kata untuk satuan	

   return $string;
}

function terbilang($x)
{
// membentuk format bilangan XXX.XXX.XXX.XXX.XXX
$x = number_format($x, 0, "", ".");

// memecah kelompok ribuan berdasarkan tanda '.'
$pecah = explode(".", $x);

$string = "";

// membentuk format terbilang '... trilyun ... milyar ... juta ... ribu ...'
for($i = 0; $i <= count($pecah)-1; $i++)
{
   if ((count($pecah) - $i == 5) && ($pecah[$i] != 0)) $string .= bilangRatusan($pecah[$i])."triliyun "; // membentuk kata '... trilyun'
   else if ((count($pecah) - $i == 4) && ($pecah[$i] != 0)) $string .= bilangRatusan($pecah[$i])."milyar "; // membentuk kata '... milyar'
   else if ((count($pecah) - $i == 3) && ($pecah[$i] != 0)) $string .= bilangRatusan($pecah[$i])."juta "; // membentuk kata '... juta'
   else if ((count($pecah) - $i == 2) && ($pecah[$i] == 1)) $string .= "seribu "; // kejadian khusus untuk bilangan dalam format 1XXX (yang mengandung kata 'seribu')
   else if ((count($pecah) - $i == 2) && ($pecah[$i] != 0)) $string .= bilangRatusan($pecah[$i])."ribu "; // membentuk kata '... ribu'
   else if ((count($pecah) - $i == 1) && ($pecah[$i] != 0)) $string .= bilangRatusan($pecah[$i]);
}

return $string;
}
?>

