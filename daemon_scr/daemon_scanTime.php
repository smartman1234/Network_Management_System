<?php

function daemon_scanTime(){

require("daemon_db_init.php");  // to initialize database connection 
// 1, get timestamp 
$time = date("j F Y h:i:s A");
$timestamp =  deco(date("j F Y h:i:s A"));


// 2, check if the table "dameontimestamp" in the database "vanguardhe"

$query_exist = "SELECT relname FROM pg_class 
WHERE relname = 'dameontimestamp';";

$result_exist = pg_query($query_exist) or die('Query failed: ' . pg_last_error());

while ($row_exist = pg_fetch_object($result_exist)){

	$exist = $row_exist->relname;

}


// // 3, if not existed, create it 
if ($exist != "dameontimestamp") {
# code...
	$query_construct = "CREATE TABLE PUBLIC.dameontimestamp(
		time           TEXT );";

$result_construct = pg_query($query_construct) or die('Query failed: ' . pg_last_error());
}


// 4, insert data into the table 

$query_insert = "INSERT INTO PUBLIC.dameontimestamp VALUES ($timestamp);";

$result_insert = pg_query($query_insert) or die('Query failed: ' . pg_last_error());


pg_free_result($result_exist);
pg_free_result($result_insert);
pg_free_result($result_construct);
pg_close($dbconn);



}

// helper function for decorating 'xxxx'
function deco($str){
	return "'".$str."'";
}



?>