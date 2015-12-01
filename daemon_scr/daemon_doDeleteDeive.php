<?php

require("daemon_db_init.php");
require("daemon_getDeviceIdPerIp.php");
$deviceid = getDeviceIdPerIp($_GET['ip']);


$query = "DELETE FROM public.daemondevice WHERE daemondevice.id=$deviceid;";

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

pg_free_result($result);
pg_close($dbconn);



echo "<br>";

echo "<br>";
echo "The discovery has been done!";
echo "<br>";
echo "<br>";


echo "<button onclick=closeWin()>Close</button>";
echo
"<script>
function closeWin() {
	window.close();
}
</script>";

?>