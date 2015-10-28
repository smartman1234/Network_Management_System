<?php

// 1, check and record the slot positions
// 2, get all required snmp value 
// 3, check if the db is existed 
// 4, put all value into the db

function daemon_snmpScanIntoDb_elink($ip){

	require_once("daemon_checkElink.php");
	require_once($genericSnmpPath);  // to initialize snmp 
	require("daemon_db_init.php");  // to initialize database connection 

	// get device map 
	$onlineDev = elinkSlot($ip);

	for ($j=0; $j < sizeof($onlineDev[0]); $j++) { 
		# code...
		$dev[] = $onlineDev[0][$j];
		$devSlot[] = $onlineDev[1][$j];
	}

	// get different device array, and ps/ems always at 16/1 slot 
	for ($i=0; $i < sizeof($dev); $i++) { 
		# code...
		switch ($dev[$i]) {
			case 'EL-RRX':
				# code...
				$slot_rrx[] = $devSlot[$i];
				break;
			case 'EL-FTX':
				# code...
				$slot_ftx[] = $devSlot[$i];
		}
	}

	// get EMS all of snmp value 
	$pos_ems = "1";
    $sysDescr    = snmpget_smallp($ip, ".1.3.6.1.2.1.1.1.0");
    $sysObjectID = snmpget_smallp($ip, ".1.3.6.1.2.1.1.2.0");
    $sysUpTime   = snmpget_smallp($ip, ".1.3.6.1.2.1.1.3.0");
    $sysContact  = snmpget_smallp($ip, ".1.3.6.1.2.1.1.4.0");
    $sysName     = snmpget_smallp($ip, ".1.3.6.1.2.1.1.5.0");
    $sysLocation = snmpget_smallp($ip, ".1.3.6.1.2.1.1.6.0");
    $sysService  = snmpget_smallp($ip, ".1.3.6.1.2.1.1.7.0");
    $alarm       = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.2.4.0");
    $ipadd       = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.9.0");

    $ems = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.1");
    $ems_sn = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.4.1");
    $ems_temp = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.1.0");
    $nms[0] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.5.0"); // vendro
    $nms[1] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.8.0"); // alarm detection
    $nms[2] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.9.0");  // ip
    $nms[3] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.10.0");  // check code
    $nms[4] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.12.0");  // tamper status
    $nms[5] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.13.0");  // internal temperarure
    $nms[6] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.17.0");  // craft status 

	// get PS all of snmp value 
	$pos_ps = "16";
	$psu = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.16");
	$psu_sn = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.4.16");
	$psu_temp = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.16.0");
    $ps[0] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.2.1.1.1.1.3.16.0"); // input v
    $ps[1] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.2.1.1.2.1.2.16.0"); // output v
    $ps[2] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.2.1.1.2.1.3.16.0"); // output ma
    $ps[3] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.2.1.1.2.1.4.16.0"); // output W

    // get FAN all of snmp value, 1 is normal, 2 is fault 
    $fan[0] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.3.1.1.2.1.3.1.0"); 
    $fan[1] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.3.1.1.2.1.3.2.0"); 
    $fan[2] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.3.1.1.2.1.3.3.0"); 
    $fan[3] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.3.1.1.2.1.3.4.0"); 
    $fan[4] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.3.1.1.2.1.3.5.0"); 
    $fan[5] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.3.1.1.2.1.3.6.0"); 
    $fan[6] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.3.1.1.2.1.3.7.0"); 
    $fan[7] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.3.1.1.2.1.3.8.0"); 


    // get RRX all of snmp value 
    for ($i=0; $i < sizeof($slot_rrx); $i++) { 
    	# code...
    	$pos_rrx[] = $slot_rrx[$i];
    	$rrx_name[] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.".$slot_rrx[$i]);
		$rrx_sn[] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.4.1.".$slot_rrx[$i]);
		$rrx_temp[] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.".$slot_rrx[$i]."0");
    	$rrx_input1[] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.2.".$slot_rrx[$i]."1");  // input power dBm
    	$rrx_input2[] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.2.".$slot_rrx[$i]."2");    	
    	$rrx_input3[] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.2.".$slot_rrx[$i]."3");
    	$rrx_input4[] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.2.".$slot_rrx[$i]."4");
    	$rrx_status1[] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.4.".$slot_rrx[$i]."1");  // status, 1 is normal, 2 is fault 
    	$rrx_status2[] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.4.".$slot_rrx[$i]."2");    	
    	$rrx_status3[] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.4.".$slot_rrx[$i]."3");
    	$rrx_status4[] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.4.".$slot_rrx[$i]."4");
    }


 	// get FTX all of snmp value 
 	for ($i=0; $i < sizeof($slot_ftx); $i++) { 
 		$pos_ftx[] = $slot_ftx[$i];
 		$ftx_name[] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.".$slot_ftx[$i]);
		$ftx_sn[] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.4.1.".$slot_ftx[$i]);
		$ftx_temp[] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.".$slot_ftx[$i]."0");
 		$ftx_rfinputpower[] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.2.1.2.".$slot_rrx[$i]."1");  // input power dBmV
 		$ftx_agcmode[] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.2.1.4.".$slot_rrx[$i]."0");  // AGC MODE   1 OFF , 2 ON 
 		$ftx_lasertemp[] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.2.".$slot_rrx[$i]."0");  // laser temp, C
 		$ftx_laserbiascurent[] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.3.".$slot_rrx[$i]."0");  // laer bias current, mA
 		$ftx_outputpower[] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.4.".$slot_rrx[$i]."0");  // laser output power, dBm
 		$ftx_thermoeleccoolercurrent[] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.5.".$slot_rrx[$i]."0");  // thermal electroc cooler current, mA
 		$ftx_lasertype[] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.6.".$slot_rrx[$i]."0");  // laser type
 		$ftx_wavelength[] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.7.".$slot_rrx[$i]."0");  // laser wavelength, nm 
 	}


	// chech if the table "daemonSnmpElinkValue" in the database "vanguardhe"

	$query_exist = "SELECT relname FROM pg_class 
	WHERE relname = 'daemonSnmpElinkValue';";

	$result_exist = pg_query($query_exist) or die('Query failed: ' . pg_last_error());

	$exist = '';
	while ($row_exist = pg_fetch_object($result_exist)){

		$exist = $row_exist->relname;

	}


	// 3, if not existed, create it 
	if ($exist != "daemonSnmpElinkValue") {
		# code...
		$query_construct = "CREATE TABLE PUBLIC.daemonSnmpElinkValue(
			time           TEXT    NOT NULL,
			recordip	Text,
			description            TEXT  ,
			oids       TEXT,
			uptime         TEXT,
			contact         TEXT,
			name        TEXT,
			location         TEXT,
			service        TEXT,
			ip         TEXT,
			mac         TEXT,
			statusindex            TEXT  ,
			idcode       TEXT,
			subID         TEXT,
			FirmwareVersion         TEXT,
			LaserIM        TEXT,
			LaserTemperature        TEXT,
			LaserBias        TEXT,
			RFModulationLevel         TEXT,
			DC24VVoltage         TEXT,
			DC12VVoltage            TEXT  ,
			DC5VVoltage      TEXT,
			minor5VDCVoltage         TEXT,
			TxOpticalPower         TEXT,
			GainControlSetting        TEXT,
			SBSCONTROLSetting        TEXT,
			CTBCONTROLSetting       TEXT,
			TxRFModuleLevel         TEXT,
			PresentACPower1status        TEXT,
			PresentACPower2status         TEXT,
			TxACPowersupplystatus       TEXT			);";

		$result_construct = pg_query($query_construct) or die('Query failed: ' . pg_last_error());
	}


pg_free_result($result_exist);
pg_free_result($result_insert);
pg_free_result($result_construct);
pg_close($dbconn);

}


// helper function for decorating 'xxxx'
function deco_elink($str){
	return "'".$str."'";
}



?>