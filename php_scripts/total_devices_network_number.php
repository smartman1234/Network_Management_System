<?php


$dbpath = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/daemon_scr/daemon_db_init.php";
require_once($dbpath);  // to initialize snmp 


$query = "SELECT 
  daemondevice.mib 
FROM 
  public.daemondevice;";

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$total_device_number=0;

while ($row = pg_fetch_object($result)) {	
$criteria = trim($row->mib);


if ($criteria == ".1.3.6.1.4.1.3222.14.2.1.1" || $criteria == ".1.3.6.1.4.1.5591.29317.1.11.1.3.1.1" || $criteria == ".1.3.6.1.4.1.17409.1.11" || $criteria == "SNMPv2-SMI::enterprises.3222.14.2.1.1" || $criteria == "SNMPv2-SMI::enterprises.5591.29317.1.11.1.3.1.1"|| $criteria == "SNMPv2-SMI::enterprises.17409.1.11" || $criteria == "SNMPv2-SMI::enterprises.5802.1.3.1.2" || $criteria == ".1.3.6.1.4.1.5802.1.3.1.2") {

$total_device_number=$total_device_number+1;


}
}






?>
