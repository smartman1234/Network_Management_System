<?php

require "db_initialize.php";






$query = "SELECT 
  notifications.respondtime, 
  notifications.answeredby, 
  notifications.nodeid, 
  notifications.notifconfigname, 
  node.nodesysoid, 
  node.nodelabel
FROM 
  public.notifications, 
  public.node
WHERE 
  notifications.nodeid = node.nodeid AND
  notifications.respondtime IS NOT NULL AND
  notifications.answeredby != 'auto-acknowledged'  
ORDER BY
  notifications.respondtime DESC;";

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($row = pg_fetch_object($result)) { 
  $time[] = $row->respondtime;
  $ip[] = $row->nodelabel;
  $notice[] = $row->notifconfigname;

}

$time0 = $time[0];
$time1 = $time[1];
$time2 = $time[2];



$ip0 = $ip[0];
$ip1 = $ip[1];
$ip2 = $ip[2];

$notice0 = $notice[0];
$notice1 = $notice[1];
$notice2 = $notice[2];



pg_free_result($result);
pg_close($dbconn);







?>




