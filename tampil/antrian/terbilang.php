<?php
/**
 * @package : TerbilangSuara
 * @author  : Gibransyah (http://zona90.wordpress.com)
 * @version : v0.1
 * @date    : 15 November 2009
 **/

include "FungsiTerbilang.php";
terbilangSuara(terbilang($_GET['bilangan']));
?>
<script>
var howLong = 3000;
t = null;
function closeMe(){
t = setTimeout("self.close()",howLong);
}
</script>
<!-- Membuat mp3 player menggunakan playlist dari file xml yg dibuat terbilangSuara -->
 <script type="text/javascript" src="swfobject.js"></script>
 <div id="flashPlayer">
  This text will be replaced by the flash music player.
 </div>

 <script type="text/javascript">
   var so = new SWFObject("playerMultipleList.swf", "mymovie", "370", "250", "7", "#FFFFFF"); 
   so.addVariable("autoPlay","yes")
   so.addVariable("repeat","false")
   so.addVariable("playlistPath","playlist.xml")
   so.write("flashPlayer");
</script>