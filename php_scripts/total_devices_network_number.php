<?php


$dbpath = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/daemon_scr/daemon_db_init.php";
require_once($dbpath);  // to initialize snmp 


$query = "SELECT 
  daemondevice.ip
FROM 
  public.daemondevice;";



$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$arr = pg_fetch_all($result);
$total_device_number = count($arr);

?>
