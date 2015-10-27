<?php

$dbpath = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/php_scripts/db_initialize.php";
require($dbpath);  // to initialize snmp 

$query = "SELECT DISTINCT ON (ipinterface.nodeid)
ipinterface.ipaddr,
node.nodesysoid
FROM 
public.ipinterface, 
public.node
WHERE 
ipinterface.nodeid = node.nodeid
ORDER BY
ipinterface.nodeid ASC;";

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($row = pg_fetch_object($result)){
	$device[] = $row->ipaddr;
	switch ($row->nodesysoid) {
		case ".1.3.6.1.4.1.3222.14.2.1.1":
			# code...
		$device_1550[] = $row->ipaddr;
		break;
		
		case ".1.3.6.1.4.1.5591.29317.1.11.1.3.1.1":
			# code...
		$device_elink[] = $row->ipaddr;
		break;

		case ".1.3.6.1.4.1.17409.1.11":
			# code...
		$device_egfa[] = $row->ipaddr;
		break;
	}

}

pg_free_result($result);
pg_close($dbconn);
return $device;


?>