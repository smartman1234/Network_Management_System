<?php
// the main entrance of daemon thread

require("daemon_scanTime.php");   // scan timestamp 
require("daemon_findTargetDeviceToArray.php");   // smartly find device and store into array 1) $device_1550[]: ip address 2) $device_elink[] 3) $device_egfa[]
require("daemon_snmp_1550.php");   // get snmp value and put it into db 
require("daemon_snmp_elink.php");
require("daemon_snmp_egfa.php");
require("daemon_compare_1550.php");
require("daemon_compare_elink.php");
require("daemon_compare_egfa.php");
require("checkAlarmInfoDb.php");   
require("daemon_checkAlarmInfoDb.php");  

// $device_1550[] = "69.70.200.246";
// $device_elink[] = "69.70.200.249";

// $device_egfa[] = "69.70.200.232";


// update the timestamp 
$timestamp = "'" . date('YmdGis') . "'";

daemon_scanTime();
ifAlarmInfoDbNotExistCreateIt();

//daemon_snmpScanIntoDb_1550("10.100.0.51");
//1550 module: get snmp value and put it into database
for ($i=0; $i < sizeof($device_1550); $i++) { 
	# code...
	if (ifPingable($device_1550[$i]) != false) {
		# code...
		daemon_snmpScanIntoDb_1550($device_1550[$i]);   // should be problem-free if having multiple 1550 

	}
}

// elink: get snmp value and put it into database
for ($i=0; $i < sizeof($device_elink); $i++) { 
	# code...
	if (ifPingable($device_elink[$i]) != false) {
		# code...
		daemon_snmpScanIntoDb_elink($device_elink[$i]);   // should be problem-free if having multiple 1550
		 
	}
}

// egfa: get snmp value and put it into database
for ($i=0; $i < sizeof($device_egfa); $i++) { 
	# code...
	if (ifPingable($device_egfa[$i]) != false) {
		# code...
		daemon_snmpScanIntoDb_egfa($device_egfa[$i]);   // should be problem-free if having multiple 1550 
		
	}
}


// compare with threshold value; use the global timestamp to distinguish the online device 
alarmCompare_1550($timestamp);
alarmCompare_elink($timestamp);
alarmCompare_egfa($timestamp); 

// use timestamp as the key to check if there is any new alarm record inserted. If yes, take action!
checkAlarmUpdatedIfYesTakeAction($timestamp);

//


// the helper function that double chekcs the device is really reachable 
function ifPingable($host, $timeout = 1) {
	/* ICMP ping packet with a pre-calculated checksum */
	$package = "\x08\x00\x7d\x4b\x00\x00\x00\x00PingHost";
	$socket  = socket_create(AF_INET, SOCK_RAW, 1);
	socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => $timeout, 'usec' => 0));
	socket_connect($socket, $host, null);
	$ts = microtime(true);
	socket_send($socket, $package, strLen($package), 0);
	if (socket_read($socket, 255))
		$result = microtime(true) - $ts;
	else    $result = false;
	socket_close($socket);
	return $result;
}

?>