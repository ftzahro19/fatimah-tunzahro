<?php
session_start();
include "../librari/inc.koneksidb.php";
include_once "../librari/inc.session.php";
include "../librari/inc.kodeauto.php";
?>
<input name="prn" type="text" id="prn" maxlength="8" size="10" value="<? echo kdauto("data_pasien",""); ?>">
