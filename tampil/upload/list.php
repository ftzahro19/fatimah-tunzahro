<?php
include "form.html";
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Daftar peserta</title>
  <link href="../facebox/facebox.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="../facebox/faceplant.css" media="screen" rel="stylesheet" type="text/css" />
  <script src="../facebox/jquery.js" type="text/javascript"></script>
  <script src="../facebox/facebox.js" type="text/javascript"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loading_image : 'loading.gif',
        close_image   : 'closelabel.gif'
      }) 
    })
  </script>
</head>
<body>
<table align="center" width="100%" bgcolor="#CCCCCC"><tr>
    <td bgcolor="#FFFFFF">
<div class="example">
          <h2>Screenshots</h2>
<?php
mysql_connect('localhost','root','12345678');
    mysql_select_db('latihan');

$query  = "SELECT * FROM upload";
$hasil  = mysql_query($query);

while($data = mysql_fetch_array($hasil))
{
?>
                  <ul id="screenshots">
            <li><a href="data/<? echo $data['name'];?>" rel="facebox"><img src="data/<? echo $data['name'];?>" width=100 height=113></a></li>
          </ul>
<?php
}
?>
         </div>
</tr>
</table>
</body>
</html>
