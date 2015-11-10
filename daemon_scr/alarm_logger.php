<?php

function alarmLogger($timestamp, $ip, $mac, $log, $sev){

	require("daemon_db_init.php");

	$ip = "'" . $ip . "'";
	$des = '';
	$mac = "'" . $mac . "'";
	$log = "'" . $log . "'";
	$ack = 'no';
	$sev = "'" . $sev . "'";

	$query = "INSERT INTO PUBLIC.daemonalarm VALUES ($timestamp, $ip, $des, $mac, $sev, $log, $ack);";

	$result = pg_query($query) or die('Query failed: ' . pg_last_error());

	pg_free_result($result);
	pg_close($dbconn);

}

?>