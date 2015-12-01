<?php


// unit test   --- begin

// for ($i=0; $i < 300 ; $i++) { 
// 	# code...3
// 	alarmLogger("20151118140214", "10.100.0.4", "00 B9 A0 12 05 D3", "Havr problem", "High-High");

// }

//alarmLogger("20151118150000", "69.70.200.232", "00 B9 A0 12 05 D3", "Havr problem", "High-High");

// unit test   --- end



function alarmLogger($timestamp, $ip, $mac, $log, $sev){

	require("daemon_db_init.php");
	require_once("daemon_getDeviceIdPerIp.php"); 
	$deviceid=getDeviceIdPerIp($ip);

	$ip = "'" . $ip . "'";
	$des = "'" . "" . "'";
	$mac = "'" . $mac . "'";
	$log = "'" . $log . "'";
	$ack = "'" . "no" . "'";
	$sev = "'" . $sev . "'";

	$query = "INSERT INTO PUBLIC.daemonalarm (deviceid, time, ip, description, mac, severity, logs, ack) VALUES (
		$deviceid,
		$timestamp,
		$ip,
		$des,
		$mac,
		$sev,
		$log,
		$ack);";

	$result = pg_query($query) or die('Query failed: ' . pg_last_error());

	pg_free_result($result);
	pg_close($dbconn);

	//echo "Alarm ok!";
}

?>

	