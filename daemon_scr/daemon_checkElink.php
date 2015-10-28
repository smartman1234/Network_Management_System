<?php

// todo: check and record the slot positions

function elinkSlot($ip){

	$genericSnmpPath = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/php_scripts/oidget/genericSnmp.php";
	require_once($genericSnmpPath);  // to initialize snmp 

    $slot[0] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.1");
    $slot[1] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.2");
    $slot[2] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.3");
    $slot[3] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.4");
    $slot[4] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.5");
    $slot[5] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.6");
    $slot[6] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.7");
    $slot[7] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.8");
    $slot[8] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.9");
    $slot[9] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.10");
    $slot[10] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.11");
    $slot[11] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.12");
    $slot[12] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.13");
    $slot[13] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.14");
    $slot[14] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.15");
    $slot[15] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.16");

	for ($i=0; $i < 16; $i++) { 
    	# code...
    	if (substr($slot[$i], 0, 3) != "(no") {
    		# code...
    		switch ($slot[$i]) {
    			case 'EL-EMS2"':
    				# code...
    				$deviceName[] = 'EL-EMS2';
    				$devicePos[] = $i + 1;
    				break;
    			case 'EL-RRX-44N"':
    				# code...
    				$deviceName[] = 'EL-RRX';
    				$devicePos[] = $i + 1;
    				break;
    			case 'EL-FTX"':
    				# code...
    				$deviceName[] = 'EL-FTX';
    				$devicePos[] = $i + 1;
    				break;
    			case 'EL-FTX-II"':
    				# code...
    				$deviceName[] = 'EL-FTX';
    				$devicePos[] = $i + 1;
    				break;    				
     			case 'EL-RRX-42N"':
    				# code...
    				$deviceName[] = 'EL-RRX';
    				$devicePos[] = $i + 1;
    				break;    			
     			case 'EL-PS"':
    				# code...
    				$deviceName[] = 'EL-PS';
    				$devicePos[] = $i + 1;
    				break; 
    		}
    	}
    }

    return array($deviceName, $deviceName);

    }

}

?>