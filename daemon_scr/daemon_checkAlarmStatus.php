<?php

function getAlarmStatus($ip){
	$ip = "'" . $ip . "'";
	require("daemon_db_init.php");

	$query = "SELECT 
		daemonalarm.ip
		FROM 
		public.daemonalarm
		WHERE daemonalarm.ack='no' and daemonalarm.ip=$ip;";

	$result = pg_query($query) or die('Query failed: ' . pg_last_error());

	$number = pg_num_rows($result);    

	if ($number==0) {
		# code...
		return "Normal";

	}


	if ($number>0) {
		# code...
		return "Alarmed";

	}


	pg_free_result($result);
	
	pg_close($dbconn);


}




?>