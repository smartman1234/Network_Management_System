<?php
// Array with names



require "db_initialize.php";
require "device_category_from_OID.php";

$query = "SELECT DISTINCT ON (ipinterface.nodeid)
ipinterface.ipaddr, 
node.nodeid,
node.nodesysoid
FROM 
public.ipinterface, 
public.node
WHERE 
ipinterface.nodeid = node.nodeid
ORDER BY 
ipinterface.nodeid;
";



$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$total_node_number = pg_num_rows($result);


while ($row = pg_fetch_object($result)) {	
	$ip =  $row->ipaddr;
	$deviceCategory = deviceCat($row->nodesysoid);
	$item = $deviceCategory .  ": " . $ip; 
	// echo "<li>" . $deviceCategory . "(" . $ip . ")</li>";

	if ($row->nodesysoid == ".1.3.6.1.4.1.3222.14.2.1.1" || $row->nodesysoid == ".1.3.6.1.4.1.5591.29317.1.11.1.3.1.1" || $row->nodesysoid == ".1.3.6.1.4.1.17409.1.11") {
		# code...
		echo "<li><a href=php_scripts/display_status_value.php?nodeid=$row->nodeid target=_blank >" . $item ."</a></li>";
	}else {
		# code...
		echo "<li><a href=php_scripts/display_status_value.php?nodeid=$row->nodeid target=_blank >" . $item ."</a></li>";
		//echo "<li><a href=# onClick=MyWindow=window.open(php_scripts/display_status_value.php?nodeid=$row->nodeid) target=_blank >" . $item ."</a></li>";
	}
	
}

pg_free_result($result);
pg_close($dbconn);



?>