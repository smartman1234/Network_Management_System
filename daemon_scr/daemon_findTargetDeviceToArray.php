<?php

require_once("daemon_db_init.php");  // to initialize snmp 

$query = "SELECT daemondevice.ip, 
  daemondevice.mib
FROM 
  public.daemondevice;";

$device_1550= [];
$device_elink= [];
$device_egfa= [];

$result = pg_query($query) or die('Query failed: ' . pg_last_error());


while ($row = pg_fetch_object($result)){
	// echo $row->mib . " : " . $row->ip . "<br>";
	switch (trim($row->mib)) {
		case ".1.3.6.1.4.1.3222.14.2.1.1":
			# code...
		$device_1550[] = $row->ip;
		
		break;

		case "SNMPv2-SMI::enterprises.3222.14.2.1.1":
			# code...
		$device_1550[] = $row->ip;
	
		break;		
		
		case ".1.3.6.1.4.1.5591.29317.1.11.1.3.1.1":
			# code...
		$device_elink[] = $row->ip;
		
		break;

		case "SNMPv2-SMI::enterprises.5591.29317.1.11.1.3.1.1":
			# code...
		$device_elink[] = $row->ip;
	
		break;

		case ".1.3.6.1.4.1.17409.1.11":
			# code...
		$device_egfa[] = $row->ip;
	
		break;

		case "SNMPv2-SMI::enterprises.17409.1.11":
			# code...
		$device_egfa[] = $row->ip;
		
		break;
	}

}

pg_free_result($result);
pg_close($dbconn);

//unit test    --- begin 
//var_dump($device_1550);
//var_dump($device_elink);
//var_dump($device_egfa);
//unit test    --- end  

?>