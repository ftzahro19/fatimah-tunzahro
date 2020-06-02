<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include "../poliklinik/tab_order_poli_edit.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>KLINIK GIGI</title>
    <link rel="author" type="text/html" href="http://www.robodesign.ro" 
    title="Marius and Mihai Şucan, ROBO Design">
    <!-- $URL: http://code.google.com/p/paintweb $
         $Date: 2010-06-26 22:58:56 +0300 $ -->

    <!-- This demo requires you to have TinyMCE. Please point to your TinyMCE 
    3 installation. -->
    <script type="text/javascript" 
      src="<?php echo $url;?>media/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
    <script type="text/javascript"><!--
tinyMCE.init({
  mode: "textareas",
  theme: "advanced",
  plugins: "contextmenu,paintweb,save,advimage,advlink,inlinepopups,searchreplace,paste",

  paintweb_config: {
    configFile: "config-example.json",
    tinymce: {
      paintwebFolder: "../../media/paintweb/build/",
      imageSaveDataURL: true,
      overlayButton: true,
      contextMenuItem: true,
      dblclickHandler: true,
      pluginBar: true,
      syncViewportSize: true
    }
  },

  // Theme options
  theme_advanced_buttons1: "paintwebEdit",
  theme_advanced_buttons2: "",
  theme_advanced_toolbar_location: "top",
  theme_advanced_toolbar_align: "left",
  theme_advanced_statusbar_location: "bottom",
  theme_advanced_resizing: true,

  // Example content CSS (should be your site CSS)
  content_css: "css/content.css"
});
// --></script>
  </head>
<body id="tab4">
<form name="form1"  method="post" action="gigi_sim.php">
    <p align="center"><input type="text" name="kd_kunjungan" value="<?php echo $data['kd_kunjungan'];?>">
      <textarea id="textarea" rows="30" cols="80" style="width: 100%" name="denture">
      &lt;p&gt;&lt;a title=&#34;Dentures&#34; 
        href=&#34;http://renpra.com&#34;&gt;&lt;img 
        src=&#34;teeth.jpg&#34; 
        alt=&#34;Dentures&#34;&gt;&lt;/a&gt;&lt;/p&gt;
          </textarea>
    </p>
    <input type="submit" name="Submit" value="Simpan">
</form>
    <!--[if lte IE 8]>
    <p>Please note that this application does not work in Internet Explorer 
    8. Please try this in Internet Explorer 9, or use any other modern web 
       browser: <a href="http://www.google.com/chrome">Chrome</a>, <a 
         href="http://www.mozilla.com">Firefox</a>, <a 
         href="http://www.apple.com/safari">Safari</a>, <a 
         href="http://www.opera.com">Opera</a> or <a 
         href="http://www.konqueror.org">Konqueror</a>.</p>
    <![endif]-->

    <!-- vim:set spell spl=en fo=tcroqwanl1 tw=80 ts=2 sw=2 sts=2 sta et ai cin fenc=utf-8 ff=unix: -->
</body>
</html>
