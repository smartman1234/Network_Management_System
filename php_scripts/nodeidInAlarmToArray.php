<?php

require "db_initialize.php";


// $nodeid = $_REQUEST["nodeid"];   // maybe troublsome 

$query = "SELECT 
  alarms.nodeid
FROM 
  public.alarms;";


$result = pg_query($query) or die('Query failed: ' . pg_last_error());



while ($row = pg_fetch_object($result)) {	
	$nodeid_alarm[] = $row->nodeid;
}


pg_free_result($result);
pg_close($dbconn);




?>



