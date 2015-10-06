<?php
// Array with names



require "db_initialize.php";
require "device_category_from_OID.php";

$query = "SELECT DISTINCT ON (ipinterface.nodeid)
  ipinterface.ipaddr, 
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
	$ip =  $row->nodelabel;
	$deviceCategory = deviceCat($row->nodesysoid);
	$item = $deviceCategory .  ": " . $ip; 
	// echo "<li>" . $deviceCategory . "(" . $ip . ")</li>";
	echo "<li><a href= http://$row->nodelabel target=_blank>" . $item ."</a></li>";

}

pg_free_result($result);
pg_close($dbconn);



?>