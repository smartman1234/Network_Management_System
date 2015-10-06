<?php

require "nodeidInAlarmToArray.php";
require "nodeidInElementToArray.php";

$nodeid = $_REQUEST["nodeid"];

if (in_array($nodeid, $nodeid_online)) {
	echo "<b>Status</b>:" . " <a style=color:#6B8E23>Online</a>";
}else{

	echo "<b>Status</b>:" . "<a style=color:#DC143C>Offline</a>";

}


echo "<hr>";




if (!in_array($nodeid, $nodeid_alarm)) {
	echo "<b>Alarm</b>: No current alarm";
}else{
	echo "<b>Alarm:</b>";
	require "severity_nodeid.php";
}


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




