<?php
// the main entrance of daemon thread

require("daemon_scanTime.php");   // scan timestamp 
require("daemon_findTargetDeviceToArray.php");   // smartly find device and store into array 1) $device_1550[]: ip address 2) $device_elink[] 3) $device_egfa[]
require("daemon_snmp_1550.php");   // get snmp value and put it into db 




// update the timestamp 
daemon_scanTime();
daemon_snmpScanIntoDb_1550("10.100.0.50");






// 1550 module: get snmp value and put it into database
for ($i=0; $i < sizeof($device_1550); $i++) { 
	# code...
	daemon_snmpScanIntoDb_1550($device_1550[$i]);
}







?>