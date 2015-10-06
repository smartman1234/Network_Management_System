<?php
// Array with names



require "db_initialize.php";

$query = "SELECT DISTINCT ON (ipinterface.nodeid)
ipinterface.nodeid, 
ipinterface.ipaddr
FROM 
public.ipinterface
ORDER BY
ipinterface.nodeid;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$total_alarm_number = pg_num_rows($result);


while ($row = pg_fetch_object($result)) {	
	$a[] = $row->
	ipaddr;
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