<?php


function ifAlarmInfoDbNotExistCreateIt(){

	require("daemon_db_init.php");

	// 1) check if the table "dameonAlarm" in the database "vanguardhe"

	$query_exist = "SELECT relname FROM pg_class 
	WHERE relname = 'daemonalarm';";

	$result_exist = pg_query($query_exist) or die('Query failed: ' . pg_last_error());

	$exist = '';
	while ($row_exist = pg_fetch_object($result_exist)){

		$exist = $row_exist->relname;

	}

	// // 3, if not existed, create it 
	if ($exist != "daemonalarm") {
	# code...
		$query_construct = "CREATE TABLE PUBLIC.daemonalarm(
			time           TEXT    NOT NULL,
			ip	Text,
			description            TEXT  ,
			mac       TEXT,
			severity       TEXT,
			logs         TEXT,
			Ack		TEXT);";

	$result_construct = pg_query($query_construct) or die('Query failed: ' . pg_last_error());
	pg_free_result($result_construct);
	}


	pg_free_result($result_exist);

	pg_close($dbconn);


}



?>