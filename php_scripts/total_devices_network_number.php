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

?>
