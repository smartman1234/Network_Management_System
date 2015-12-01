<?php

// unit test    --- begin 
// for ($i=0; $i < 200; $i++) { 
// 	# code...
//daemon_scanTime();
// }

// unit test    --- end 


function daemon_scanTime(){
	require("daemon_db_init.php");  // to initialize database connection 

	// 1, get timestamp 
	// $time = date("j F Y h:i:s A");
	 // $timestamp = "'" . date('YmdGis') . "'";
	global $timestamp;

	// 2, check if the table "dameontimestamp" in the database "vanguardhe"

	$query_exist = "SELECT relname FROM pg_class 
	WHERE relname = 'dameontimestamp';";

	$result_exist = pg_query($query_exist) or die('Query failed: ' . pg_last_error());

	$exist = '';

	while ($row_exist = pg_fetch_object($result_exist)){

		$exist = $row_exist->relname;

	}


	// // 3, if not existed, create it 
	if ($exist != "dameontimestamp") {
	# code...
		$query_construct = "CREATE TABLE PUBLIC.dameontimestamp(
			scanid SERIAL PRIMARY KEY,
			time           TEXT,
			alarmcount           TEXT );";

	$result_construct = pg_query($query_construct) or die('Query failed: ' . pg_last_error());
	pg_free_result($result_construct);
	}


	// 4, insert data into the table 

	$query_insert = "INSERT INTO PUBLIC.dameontimestamp (time) VALUES ($timestamp);";

	$result_insert = pg_query($query_insert) or die('Query failed: ' . pg_last_error());


	pg_free_result($result_exist);
	pg_free_result($result_insert);



}

// helper function for decorating 'xxxx'
function deco_time($str){
	return "'".$str."'";
}



?>