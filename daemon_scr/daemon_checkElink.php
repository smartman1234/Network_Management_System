<?php

// todo: check and record the slot positions


// unit test --- begin 
    //var_dump(elinkSlot("10.100.0.80"));

    // $onlineDev = elinkSlot("10.100.0.80");
  
    // for ($j=0; $j < sizeof($onlineDev[0]); $j++) { 
    //     # code...
    //     $dev[] = $onlineDev[0][$j];
    //     $devSlot[] = $onlineDev[1][$j];
    // }

    // var_dump($dev);
    // var_dump($devSlot);

// unit test --- end    


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
    	if (substr($slot[$i], 1, 2) != "no") {
    		# code...
    		switch (substr($slot[$i], 0, 4)) {
    			case 'EL-E':
    				# code...
    				$deviceName[] = 'EL-EMS2';
    				$devicePos[] = $i + 1;
                    //echo $slot[$i];
    				break;
    			case 'EL-R':
    				# code...
    				$deviceName[] = 'EL-RRX';
    				$devicePos[] = $i + 1;
                    //echo $slot[$i];
    				break;
    			case 'EL-F':
    				# code...
    				$deviceName[] = 'EL-FTX';
    				$devicePos[] = $i + 1;
                    //echo $slot[$i];
    				break;
    			case 'EL-P':
    				// # code...
    				$deviceName[] = 'EL-PS';
    				$devicePos[] = $i + 1;
                    //echo $slot[$i];
    				break; 
    		}
    	}
    }

    return array($deviceName, $devicePos);

}

?>