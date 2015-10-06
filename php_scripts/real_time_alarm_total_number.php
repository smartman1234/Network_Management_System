<?php
//the method by CRUD
require "db_initialize.php";
$query = "SELECT 
  alarms.alarmid
FROM 
  public.alarms
ORDER BY
  alarms.alarmid;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$arr = pg_fetch_all($result);
$total_alarm_number = count($arr);

pg_free_result($result);
pg_close($dbconn);




// // the method by REST 
// include("curl_manipulation.php");
// $alarm_total_count = getStringData("alarms/count");
// $alarm_total_count = (int) $alarm_total_count;

?>




