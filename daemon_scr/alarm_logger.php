<?php

function alarmLogger($timestamp, $ip, $mac, $log){

	require("daemon_db_init.php");

	$ip = "'" . $ip . "'";
	$des = '';
	$mac = "'" . $mac . "'";
	$log = "'" . $log . "'";
	$ack = 'no';

	$query = "INSERT INTO PUBLIC.daemonalarm VALUES ($timestamp, $ip, $des, $mac, $log, $ack);";

	$result = pg_query($query) or die('Query failed: ' . pg_last_error());

	pg_free_result($result);
	pg_close($dbconn);

}

?>