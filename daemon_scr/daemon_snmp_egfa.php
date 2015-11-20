<?php
 



// $genericSnmpPath = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/php_scripts/oidget/genericSnmp.php";
// require_once($genericSnmpPath);  // to initialize snmp 
// $ip = "69.70.200.232";

// 	$value [0] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.2.0" );   // "Output Optical Power"
// 	$value [1] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.3.0" );    // "Input Optical Power";
// 	$value [2] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.4.1.4.1" );  // "Pump Temperature 1";
// 	$value [3] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.4.1.4.2" );  //"Pump Temperature 2";
// 	$value [4] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.4.1.4.3" );  // "Pump Temperature 3";
// 	$value [5] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.5.0" );  //"Number of DC Power Supply";
// 	$value [6] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.6.0" );   //"DC Power Supply Mode";
// 	$value [7] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.1" );   // "DC +5V"
// 	$value [8] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.2" );  // "DC -5V";
// 	$value [9] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.3" );  // "DC +3.3V"
// 	$value [10] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.4" );   //  "DC +12V";
// 	$value [11] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.5" );   // "Left +5V"
// 	$value [12] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.6" );  // "Right +5V";
// 	$value [13] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.7" );  // "Left -5V";
// 	$value [14] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.8" );  //  "Right -5V";
// 	$value [15] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.3.2.2.1.18.1"  );  // "Device Manufactoring Date";
// 	$value [16] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.3.2.2.1.19.1"  );  // Firmware Version";
// 	$value [17] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.3.0" );  //   Model";
// 	$value [18] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.4.0");  // Serial Number";
// 	$value [19] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.5.0" );  // "Vendor";
// 	$value [20] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.10.0" );  // Check Code";
// 	$value [21] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.12.0" );  // "Tamper Status";
// 	$value [22] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.13.0" );  // Internal Temperature";
// 	$value [23] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.17.0");  // "Craft Status";

// for ($i=0; $i < 24; $i++) { 
// 	# code...
// 	echo $value [$i] . "<br>";
// }










 // unit test  --- begin 

	//daemon_snmpScanIntoDb_egfa("10.100.0.50");


// unit -test --- end


function daemon_snmpScanIntoDb_egfa($ip){

	// TO-DO: 1) extract all snmp value from efga, 2) check if the table is existed, 3) if not existed, create it, and 4) put it into db. This action should be wrapped in a function. 

	// header for initialization
	$genericSnmpPath = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/php_scripts/oidget/genericSnmp.php";
	require_once($genericSnmpPath);  // to initialize snmp 
	require("daemon_db_init.php");  // to initialize database connection 

	// 1, extract all snmp value from efga 
	// $timestamp =  deco_egfa(date("j F Y h:i:s A"));
	
	global $timestamp;
	$sysDescr = deco_egfa(snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.1.0" ));
	$sysObjectID = deco_egfa(snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.2.0" ));
	$sysUpTime = deco_egfa(snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.3.0" ));
	$sysContact = deco_egfa(snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.4.0" ));
	$sysName = deco_egfa(snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.5.0" ));
	$sysLocation = deco_egfa(snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.6.0")) ;
	$sysService = deco_egfa(snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.7.0" ));

	$defaultIp = trim(deco_egfa(snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.9.0"  )));
	$defaultMac = deco_egfa(snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.2.1.1.1.0" ));

	$value [0] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.2.0" );   // "Output Optical Power"
	$value [1] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.3.0" );    // "Input Optical Power";
	$value [2] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.4.1.4.1" );  // "Pump Temperature 1";
	$value [3] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.4.1.4.2" );  //"Pump Temperature 2";
	$value [4] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.4.1.4.3" );  // "Pump Temperature 3";
	$value [5] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.5.0" );  //"Number of DC Power Supply";
	$value [6] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.6.0" );   //"DC Power Supply Mode";
	$value [7] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.1" );   // "DC +5V"
	$value [8] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.2" );  // "DC -5V";
	$value [9] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.3" );  // "DC +3.3V"
	$value [10] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.4" );   //  "DC +12V";
	$value [11] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.5" );   // "Left +5V"
	$value [12] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.6" );  // "Right +5V";
	$value [13] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.7" );  // "Left -5V";
	$value [14] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.8" );  //  "Right -5V";
	$value [15] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.3.2.2.1.18.1"  );  // "Device Manufactoring Date";
	$value [16] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.3.2.2.1.19.1"  );  // Firmware Version";
	$value [17] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.3.0" );  //   Model";
	$value [18] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.4.0");  // Serial Number";
	$value [19] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.5.0" );  // "Vendor";
	$value [20] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.10.0" );  // Check Code";
	$value [21] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.12.0" );  // "Tamper Status";
	$value [22] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.13.0" );  // Internal Temperature";
	$value [23] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.17.0");  // "Craft Status";

	for ($i=0; $i < 24; $i++) { 
			# code...
		$value [$i] = deco_egfa($value [$i]);
	}

	$lab [0] = "StatusIndex";
	$lab [1] = "IDcode";
	$lab [2] = "subID";
	$lab [3] = "FirmwareVersion";
	$lab [4] = "Laser IM";
	$lab [5] = "Laser Temperature (C)";
	$lab [6] = "Laser Bias";
	$lab [7] = "RF Modulation Level";
	$lab [8] = "DC24V Voltage";
	$lab [9] = "DC12V Voltage";
	$lab [10] = "DC5V Voltage";
	$lab [11] = "-5VDC Voltage";
	$lab [12] = "Tx Optical Power";
	$lab [13] = "Gain Control Setting";
	$lab [14] = "SBS CONTROL Setting";
	$lab [15] = "CTB_CONTROL_Setting";
	$lab [16] = "Tx RF Module Level";
	$lab [17] = "Present AC Power 1 status";
	$lab [18] = "Present AC Power 2 status";
	$lab [19] = "Tx AC Power supply status";

	// 2, check if the table "dameonSnmpEGFAValue" in the database "vanguardhe"

	$query_exist = "SELECT relname FROM pg_class 
	WHERE relname = 'daemonsnmpegfavalue';";

	$result_exist = pg_query($query_exist) or die('Query failed: ' . pg_last_error());

	$exist = 'not here';
	while ($row_exist = pg_fetch_object($result_exist)){

		$exist = $row_exist->relname;

	}

	// // 3, if not existed, create it 
	if ($exist != "daemonsnmpegfavalue") {
	# code...
		$query_construct = "CREATE TABLE PUBLIC.daemonsnmpegfavalue(
			time           TEXT    ,
			description            TEXT  ,
			oids       TEXT,
			uptime         TEXT,
			contact         TEXT,
			name        TEXT,
			location         TEXT,
			service        TEXT,
			ip         TEXT,
			mac         TEXT,
			outputopticalpower            TEXT  ,
			inputopticalpower       TEXT,
			pumptemp1         TEXT,
			pumptemp2         TEXT,
			pumptemp3        TEXT,
			dcpsnumber        TEXT,
			dcpsmode        TEXT,
			dc5v         TEXT,
			dcminor5v         TEXT,
			dc33v            TEXT  ,
			dc12v      TEXT,
			left5v         TEXT,
			right5v         TEXT,
			leftminor5v       TEXT,
			rightminor5v        TEXT,
			manudate       TEXT,
			firmware         TEXT,
			model        TEXT,
			sn         TEXT,
			vendor       TEXT,	
			checkcode         TEXT,
			tamperstatus        TEXT,
			internaltemp         TEXT,
			craftstatus       TEXT
			);";

	$result_construct = pg_query($query_construct) or die('Query failed: ' . pg_last_error());
	pg_free_result($result_construct);
	}

	// 4, insert data into the table 

	$query_insert = "INSERT INTO PUBLIC.daemonsnmpegfavalue VALUES ($timestamp, $sysDescr, $sysObjectID, $sysUpTime, $sysContact, $sysName, $sysLocation, 
		$sysService, $defaultIp, $defaultMac,  $value[0], $value[1], $value[2], $value[3], $value[4], $value[5], $value[6], $value[7], $value[8], $value[9], $value[10], $value[11], $value[12], $value[13], $value[14], $value[15], $value[16], $value[17], $value[18], $value[19], $value[20], $value[21], $value[22], $value[23]);";


	$result_insert = pg_query($query_insert) or die('Query failed: ' . pg_last_error());

	// 5, check if the table "daemonsnmpegfasummary" in the database "vanguardhe": this table is for the other maybe info further

	$query_exist_sum = "SELECT relname FROM pg_class 
	WHERE relname = 'daemonsnmpegfasummary';";

	$result_exist_sum = pg_query($query_exist_sum) or die('Query failed: ' . pg_last_error());

	$exist_sum = '';
	while ($row_exist_sum = pg_fetch_object($result_exist_sum)){

		$exist_sum = $row_exist_sum->relname;

	}

	// // 3, if not existed, create it 
	if ($exist_sum != "daemonsnmpegfasummary") {
	# code...
		$query_construct_sum = "CREATE TABLE PUBLIC.daemonsnmpegfasummary(
			description	Text,
			comments           TEXT  		);";

	$result_construct_sum = pg_query($query_construct_sum) or die('Query failed: ' . pg_last_error());
	pg_free_result($result_construct_sum);
	}


	pg_free_result($result_exist);
	pg_free_result($result_insert);

	pg_free_result($result_exist_sum);

	pg_close($dbconn);

}

// helper function for decorating 'xxxx'
function deco_egfa($str){
	return "'".$str."'";
}

?>