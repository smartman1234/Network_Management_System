<?php
// Array with names



require "db_initialize.php";

$query = "SELECT 
node.nodelabel
FROM 
public.node;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$total_alarm_number = pg_num_rows($result);


while ($row = pg_fetch_object($result)) {	
	$a[] = $row->nodelabel;
}

pg_free_result($result);
pg_close($dbconn);


$q = $_REQUEST["q"];



$hint = "";

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
	$q = strtolower($q);
	$len=strlen($q);
	foreach($a as $name) {
		if (stristr($q, substr($name, 0, $len))) {
			if ($hint === "") {
				$hint = $name;
			} else {
				$hint .= ", $name";
			}
		}
	}
}

// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "Unavailable IP" : "Potential IPs are: " . $hint;
?>