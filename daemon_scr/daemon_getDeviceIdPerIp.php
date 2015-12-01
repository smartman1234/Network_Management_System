<?php

function getDeviceIdPerIp($ip){
	$ip = "'" . trim($ip) . "'";
	require("daemon_db_init.php");  // to initialize database connection 
	$query = "SELECT 
		daemondevice.id
		FROM 
		public.daemondevice
		WHERE daemondevice.ip=$ip;";

	$id=0;

	$result = pg_query($query) or die('Query failed: ' . pg_last_error());

	while ($row = pg_fetch_object($result)){

		$id=$row->id;

	}



	return $id;

}


?>