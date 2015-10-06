<?php
//the method by CRUD
require "db_initialize.php";
$query = "SELECT 
  outages.outageid
FROM 
  public.outages
WHERE 
  outages.ifregainedservice IS NULL ;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$arr = pg_fetch_all($result);
$total_unsolved_outage_number = count($arr);


pg_free_result($result);
pg_close($dbconn);

?>




