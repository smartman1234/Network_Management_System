<?php
// Array with names



$dbpath = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/daemon_scr/daemon_db_init.php";
require($dbpath);  // to initialize snmp 

$query = "SELECT DISTINCT ON (daemonalarm.ip)
  daemonalarm.ip
FROM 
  public.daemonalarm;";

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$total_alarm_number = pg_num_rows($result);

$a=[];
while ($row = pg_fetch_object($result)) {	
	$a[] = trim($row->ip);
}

pg_free_result($result);
pg_close($dbconn);

$json = json_encode($a);





// $q = $_REQUEST["q"];



// $hint = "";

// // lookup all hints from array if $q is different from "" 
// if ($q !== "") {
// 	$q = strtolower($q);
// 	$len=strlen($q);
// 	foreach($a as $name) {
// 		if (stristr($q, substr($name, 0, $len))) {
// 			if ($hint === "") {
// 				$hint = $name;
// 			} else {
// 				$hint .= ", $name";
// 			}
// 		}
// 	}
// }

// // Output "no suggestion" if no hint was found or output correct values 
// echo $hint === "" ? "Unavailable IP" : "Potential IPs are: " . $hint;
?>