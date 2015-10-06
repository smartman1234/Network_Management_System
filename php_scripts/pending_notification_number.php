<?php
//the method by CRUD
require "db_initialize.php";
$query = "SELECT 
  notifications.notifyid
FROM 
  public.notifications
WHERE 
  notifications.respondtime IS NULL ;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$arr = pg_fetch_all($result);
$total_pending_notification_number = count($arr);


pg_free_result($result);
pg_close($dbconn);

?>




