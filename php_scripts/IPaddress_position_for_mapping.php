<?php
// Array with names



require "db_initialize.php";

$query = "SELECT 
  assets.latitude, 
  assets.longitude, 
  node.nodelabel
FROM 
  public.assets, 
  public.node
WHERE 
  assets.nodeid = node.nodeid;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());




while ($row = pg_fetch_object($result)) {	



$position[$i]



}

pg_free_result($result);
pg_close($dbconn);



?>