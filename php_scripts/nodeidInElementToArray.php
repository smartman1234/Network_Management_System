<?php

require "db_initialize.php";

$query = "SELECT 
  element.elementid
FROM 
  public.element;";


$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$total_online_number = pg_num_rows($result);


while ($row = pg_fetch_object($result)) {	
	$nodeid_online[] = $row->elementid;
}




pg_free_result($result);
pg_close($dbconn);




?>



