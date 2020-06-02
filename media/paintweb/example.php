<?
//ImageEdit Class Example
require "ImageEdit.class.php";

header('Content-Type: image/jpeg');	//tell the browser that it's jpg

$img = new ImageEdit("Desert.jpg");

$img->resize(400);	//resize the image to certain Width, hold the ratio

$img->watermark("wm2.png", -1, -1, 150);
	//make a water mark, position: 1px, 1px from the right bottom corner
	//resize the water mark to certain width, hold the ratio

$img->effect("EDGEDETECT");	//add a effect
$img->effect("BLUR");	//add a effect

//Note that the order of watermark and effect will cause different results

//*You can modify the image resource directly using $img->image

$img->output("JPG", NULL, 50);	//output directly to the browser, reduce the quality to 50%
?>