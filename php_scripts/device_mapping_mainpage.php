<?php
require "db_initialize.php";
$query = "SELECT 
node.nodelabel
FROM 
public.node
ORDER BY
node.nodeid;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$arr = pg_fetch_all($result);
$total_device_number = count($arr);

$lable_list = array();  // the list containing the nodes, except the map (root)

for ($i = 0; $i < $total_device_number; $i++) {
	$lable_list[$i] = $arr[$i][nodelabel];
}

$lable_list_json = json_encode($lable_list);  



pg_free_result($result);
pg_close($dbconn);
?>