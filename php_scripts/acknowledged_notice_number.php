<?php

require "db_initialize.php";
require "service_id.php";
require "severity_vis.php";
require "device_category_from_OID.php";
require "outage_status.php";
require "notice_type.php";

$query = "SELECT 
  notifications.notifconfigname, 
  notifications.serviceid,  
  notifications.nodeid, 
  notifications.answeredby,  
  notifications.pagetime,  
  notifications.respondtime,  
  notifications.subject, 
  node.nodelabel, 
  node.nodesysoid
FROM 
  public.notifications, 
  public.node
WHERE 
  notifications.nodeid = node.nodeid AND
  notifications.respondtime IS NOT NULL 
ORDER BY
  notifications.nodeid ASC;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$arr = pg_fetch_all($result);
$total_ack_notification_number = count($arr);


pg_free_result($result);
pg_close($dbconn);

?>




