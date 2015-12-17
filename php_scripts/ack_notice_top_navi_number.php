<?php
//the method by CRUD
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

$arr = pg_fetch_all($result);
$ack_number = count($arr);


pg_free_result($result);
pg_close($dbconn);
?>




