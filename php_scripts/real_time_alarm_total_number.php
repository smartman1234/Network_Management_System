<?php

$dbpath = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/daemon_scr/daemon_db_init.php";
require_once($dbpath);  // to initialize snmp 

$query = "SELECT 
  daemonalarm.alarmid
FROM 
  public.daemonalarm
WHERE daemonalarm.ack='no';";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$arr = pg_fetch_all($result);
$total_alarm_number = count($arr);




$query = "SELECT 
  daemonalarm.alarmid
FROM 
  public.daemonalarm;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$arr = pg_fetch_all($result);
$alarm_records_number = count($arr);



pg_free_result($result);
pg_close($dbconn);




// // the method by REST 
// include("curl_manipulation.php");
// $alarm_total_count = getStringData("alarms/count");
// $alarm_total_count = (int) $alarm_total_count;

?>




