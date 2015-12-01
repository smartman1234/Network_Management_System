<?php











// $genericSnmpPath = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/php_scripts/oidget/genericSnmp.php";
// require_once($genericSnmpPath);  // to initialize snmp 
// $ip = "69.70.200.249";

// $ps[0] = deco_elink(snmpget_smallp1($ip, ".1.3.6.1.4.1.5591.1.11.2.2.1.1.1.1.3.16.0")); // input v
//     $ps[1] = deco_elink(snmpget_smallp1($ip, ".1.3.6.1.4.1.5591.1.11.2.2.1.1.2.1.2.16.0")); // output v
//     $ps[2] = deco_elink(snmpget_smallp1($ip, ".1.3.6.1.4.1.5591.1.11.2.2.1.1.2.1.3.16.0")); // output ma
//     $ps[3] = deco_elink(snmpget_smallp1($ip, ".1.3.6.1.4.1.5591.1.11.2.2.1.1.2.1.4.16.0")); // output W

// for ($i=0; $i < 4; $i++) { 
// 	# code...
// echo $ps[$i] . "<br>";
// }




// 1, check and record the slot positions
// 2, get all required snmp value 
// 3, check if the db is existed 
// 4, put all value into the db


// unit test    --- begin 

//daemon_snmpScanIntoDb_elink("69.70.200.249");
// unit test    --- end 


// helper function for decorating 'xxxx'
function deco_elink($str){
	return "'".$str."'";
}


function daemon_snmpScanIntoDb_elink($ip){
	$genericSnmpPath = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/php_scripts/oidget/genericSnmp.php";
	require_once("daemon_checkElink.php");
	require_once($genericSnmpPath);  // to initialize snmp 
	require("daemon_db_init.php");  // to initialize database connection 

	require_once("daemon_getDeviceIdPerIp.php");  // to initialize database connection 

	// 1, extract all snmp value from 1550 
	//$timestamp = "'" . date('YmdGis') . "'";

	$deviceid=getDeviceIdPerIp($ip);

	// get device map 
	$onlineDev = elinkSlot($ip);
	// $timestamp = deco_elink(date("j F Y h:i:s A"));

	global $timestamp;
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
    $sysDescr    = deco_elink(snmpget_smallp($ip, ".1.3.6.1.2.1.1.1.0"));
    $sysObjectID = deco_elink(snmpget_smallp($ip, ".1.3.6.1.2.1.1.2.0"));
    $sysUpTime   = deco_elink(snmpget_smallp($ip, ".1.3.6.1.2.1.1.3.0"));
    $sysContact  = deco_elink(snmpget_smallp($ip, ".1.3.6.1.2.1.1.4.0"));
    $sysName     = deco_elink(snmpget_smallp($ip, ".1.3.6.1.2.1.1.5.0"));
    $sysLocation = deco_elink(snmpget_smallp($ip, ".1.3.6.1.2.1.1.6.0"));
    $sysService  = deco_elink(snmpget_smallp($ip, ".1.3.6.1.2.1.1.7.0"));
    $alarm       = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.2.4.0"));
    $ipadd       = trim(deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.9.0")));

    $ems = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.1"));
    $ems_sn = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.4.1"));
    $ems_temp = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.1.0"));
    $nms[0] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.5.0")); // vendro
    $nms[1] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.8.0")); // alarm detection
    $nms[2] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.9.0"));  // ip
    $nms[3] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.10.0"));  // check code
    $nms[4] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.12.0"));  // tamper status
    $nms[5] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.13.0"));  // internal temperarure
    $nms[6] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.17.0"));  // craft status 

	// get PS all of snmp value 
	$pos_ps = "16";
	$psu = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.16"));
	$psu_sn = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.4.16"));
	$psu_temp = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.16.0"));
    $ps[0] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.2.1.1.1.1.3.16.0")); // input v
    $ps[1] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.2.1.1.2.1.2.16.0")); // output v
    $ps[2] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.2.1.1.2.1.3.16.0")); // output ma
    $ps[3] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.2.1.1.2.1.4.16.0")); // output W

    // get FAN all of snmp value, 1 is normal, 2 is fault 
    $fan[0] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.3.1.1.2.1.3.1.0")); 
    $fan[1] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.3.1.1.2.1.3.2.0")); 
    $fan[2] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.3.1.1.2.1.3.3.0")); 
    $fan[3] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.3.1.1.2.1.3.4.0")); 
    $fan[4] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.3.1.1.2.1.3.5.0")); 
    $fan[5] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.3.1.1.2.1.3.6.0")); 
    $fan[6] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.3.1.1.2.1.3.7.0")); 
    $fan[7] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.3.1.1.2.1.3.8.0")); 


    // get RRX all of snmp value 
    for ($i=0; $i < sizeof($slot_rrx); $i++) { 
    	# code...
    	//echo $slot_rrx[$i];
    	$pos_rrx[] = $slot_rrx[$i];
    	$rrx_name[] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.".$slot_rrx[$i]));
		$rrx_sn[] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.4.".$slot_rrx[$i]));
		$rrx_temp[] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.".$slot_rrx[$i].".0"));
    	$rrx_input1[] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.2.".$slot_rrx[$i].".1"));  // input power dBm
    	$rrx_input2[] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.2.".$slot_rrx[$i].".2"));    	
    	$rrx_input3[] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.2.".$slot_rrx[$i].".3"));
    	$rrx_input4[] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.2.".$slot_rrx[$i].".4"));
    	$rrx_status1[] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.4.".$slot_rrx[$i].".1"));  // status, 1 is normal, 2 is fault 
    	$rrx_status2[] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.4.".$slot_rrx[$i].".2"));    	
    	$rrx_status3[] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.4.".$slot_rrx[$i].".3"));
    	$rrx_status4[] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.4.".$slot_rrx[$i].".4"));
    }


 	// get FTX all of snmp value 
 	for ($i=0; $i < sizeof($slot_ftx); $i++) { 
 		//echo $slot_ftx[$i];
 		$pos_ftx[] = $slot_ftx[$i];
 		$ftx_name[] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.".$slot_ftx[$i]));
		$ftx_sn[] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.4.".$slot_ftx[$i]));
		$ftx_temp[] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.".$slot_ftx[$i].".0"));
 		$ftx_rfinputpower[] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.2.1.2.".$slot_ftx[$i].".1"));  // input power dBmV
 		$ftx_agcmode[] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.2.1.4.".$slot_ftx[$i].".0"));  // AGC MODE   1 OFF , 2 ON 
 		$ftx_lasertemp[] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.2.".$slot_ftx[$i].".0"));  // laser temp, C
 		$ftx_laserbiascurent[] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.3.".$slot_ftx[$i].".0"));  // laer bias current, mA
 		$ftx_outputpower[] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.4.".$slot_ftx[$i].".0"));  // laser output power, dBm
 		$ftx_thermoeleccoolercurrent[] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.5.".$slot_ftx[$i].".0"));  // thermal electroc cooler current, mA
 		$ftx_lasertype[] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.6.".$slot_ftx[$i].".0"));  // laser type
 		$ftx_wavelength[] = deco_elink(snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.7.".$slot_ftx[$i].".0"));  // laser wavelength, nm 
 	}


	// DB1	chech if the table "daemonsnmpelinksummary" in the database "vanguardhe"； this table is for MAC address and maybe other use 
	$query_exist_sum = "SELECT relname FROM pg_class 
	WHERE relname = 'daemonsnmpelinksummary';";

	$result_exist_sum = pg_query($query_exist_sum) or die('Query failed: ' . pg_last_error());

	$exist_sum = '';
	while ($row_exist_sum = pg_fetch_object($result_exist_sum)){

		$exist_sum = $row_exist_sum->relname;

	}

	// if not existed, create it 
	if ($exist_sum != "daemonsnmpelinksummary") {
		# code...
		$query_construct_sum = "CREATE TABLE PUBLIC.daemonsnmpelinksummary(
			mac           TEXT,
			decription	Text,
			comments            TEXT );";

		$result_construct_sum = pg_query($query_construct_sum) or die('Query failed: ' . pg_last_error());
		pg_free_result($result_construct_sum);
	}

	// DB2:  chech if the table "daemonsnmpelinkems" in the database "vanguardhe"； this table is for EMS
	$query_exist_ems = "SELECT relname FROM pg_class 
	WHERE relname = 'daemonsnmpelinkems';";

	$result_exist_ems = pg_query($query_exist_ems) or die('Query failed: ' . pg_last_error());

	$exist_ems = '';
	while ($row_exist_ems = pg_fetch_object($result_exist_ems)){

		$exist_ems = $row_exist_ems->relname;

	}

	// if not existed, create it 
	if ($exist_ems != "daemonsnmpelinkems") {
		# code...
		$query_construct_ems = "CREATE TABLE PUBLIC.daemonsnmpelinkems(
			deviceid int,
			time           TEXT    ,
			slot	TEXT,  
			description            TEXT  ,
			oids       TEXT,
			uptime         TEXT,
			contact         TEXT,
			name        TEXT,
			location         TEXT,
			service        TEXT,
			ip         TEXT,
			alarm         TEXT,
			model        TEXT,
			sn       TEXT,
			temp         TEXT,
			vendor        TEXT,
			alarmdetection         TEXT,
			ipaddress        TEXT,
			checkcode         TEXT,
			tamperstatus         TEXT,
			internaltemp        TEXT,
			craftstatus       TEXT
			);";

		$result_construct_ems = pg_query($query_construct_ems) or die('Query failed: ' . pg_last_error());
		pg_free_result($result_construct_ems);
	}

	// insert data into the table 
	$query_insert_ems = "INSERT INTO PUBLIC.daemonsnmpelinkems VALUES ($deviceid, $timestamp, $pos_ems, $sysDescr, $sysObjectID, $sysUpTime, $sysContact, $sysName, $sysLocation, $sysService, $ipadd, $alarm, $ems, $ems_sn, $ems_temp, $nms[0], $nms[1], $nms[2], $nms[3], $nms[4], $nms[5], $nms[6]);";

	$result_insert_ems = pg_query($query_insert_ems) or die('Query failed: ' . pg_last_error());


	// DB3:  chech if the table "daemonsnmpelinkps" in the database "vanguardhe"； this table is for PS
	$query_exist_ps = "SELECT relname FROM pg_class 
	WHERE relname = 'daemonsnmpelinkps';";

	$result_exist_ps = pg_query($query_exist_ps) or die('Query failed: ' . pg_last_error());

	$exist_ps = '';
	while ($row_exist_ps = pg_fetch_object($result_exist_ps)){

		$exist_ps = $row_exist_ps->relname;

	}

	// if not existed, create it 
	if ($exist_ps != "daemonsnmpelinkps") {
		# code...
		$query_construct_ps = "CREATE TABLE PUBLIC.daemonsnmpelinkps(
			deviceid 	INT,
			time           TEXT    ,
			slot	TEXT,  
			model        TEXT,
			sn       TEXT,
			temp         TEXT,
			inputv        TEXT,
			outputv         TEXT,
			outputma        TEXT,
			outputw         TEXT
			);";

		$result_construct_ps = pg_query($query_construct_ps) or die('Query failed: ' . pg_last_error());
		pg_free_result($result_construct_ps);
	}

	// insert data into the table 
	$query_insert_ps = "INSERT INTO PUBLIC.daemonsnmpelinkps VALUES ($deviceid, $timestamp, $pos_ps, $psu, $psu_sn, $psu_temp, $ps[0], $ps[1], $ps[2], $ps[3]);";

	$result_insert_ps = pg_query($query_insert_ps) or die('Query failed: ' . pg_last_error());

	// DB4:  chech if the table "daemonsnmpelinkfan" in the database "vanguardhe"； this table is for fan 
	$query_exist_fan = "SELECT relname FROM pg_class 
	WHERE relname = 'daemonsnmpelinkfan';";

	$result_exist_fan = pg_query($query_exist_fan) or die('Query failed: ' . pg_last_error());

	$exist_fan = '';
	while ($row_exist_fan = pg_fetch_object($result_exist_fan)){

		$exist_fan = $row_exist_fan->relname;

	}

	// if not existed, create it 
	if ($exist_fan != "daemonsnmpelinkfan") {
		# code...
		$query_construct_fan = "CREATE TABLE PUBLIC.daemonsnmpelinkfan(
			deivceid 	INT,
			time           TEXT   , 
			fan1        TEXT,
			fan2       TEXT,
			fan3         TEXT,
			fan4        TEXT,
			fan5         TEXT,
			fan6        TEXT,
			fan7         TEXT,
			fan8		TEXT
			);";

		$result_construct_fan = pg_query($query_construct_fan) or die('Query failed: ' . pg_last_error());
		pg_free_result($result_construct_fan);
	}

	// insert data into the table 
	$query_insert_fan = "INSERT INTO PUBLIC.daemonsnmpelinkfan VALUES ($deviceid, $timestamp, $fan[0], $fan[1], $fan[2], $fan[3], $fan[4], $fan[5], $fan[6], $fan[7]);";

	$result_insert_fan = pg_query($query_insert_fan) or die('Query failed: ' . pg_last_error());


	// DB5:  chech if the table "daemonsnmpelinkrrx" in the database "vanguardhe"； this table is for RRX
	$query_exist_rrx = "SELECT relname FROM pg_class 
	WHERE relname = 'daemonsnmpelinkrrx';";

	$result_exist_rrx = pg_query($query_exist_rrx) or die('Query failed: ' . pg_last_error());

	$exist_rrx = '';
	while ($row_exist_rrx = pg_fetch_object($result_exist_rrx)){

		$exist_rrx = $row_exist_rrx->relname;

	}

	// if not existed, create it 
	if ($exist_rrx != "daemonsnmpelinkrrx") {
		# code...
		$query_construct_rrx = "CREATE TABLE PUBLIC.daemonsnmpelinkrrx(
			deviceid 	INT,
			time           TEXT    , 
			slot	TEXT,  
			model        TEXT,
			sn       TEXT,
			temp         TEXT,
			input1         TEXT,
			input2        TEXT,
			input3        TEXT,
			input4		TEXT,
			status1         TEXT,
			status2        TEXT,
			status3        TEXT,
			status4		TEXT
			);";

		$result_construct_rrx = pg_query($query_construct_rrx) or die('Query failed: ' . pg_last_error());
		pg_free_result($result_construct_rrx);
	}

	// insert data 
	for ($i=0; $i < sizeof($slot_rrx); $i++) {

		// insert data into the table 
		$query_insert_rrx = "INSERT INTO PUBLIC.daemonsnmpelinkrrx VALUES ($deviceid, $timestamp, $pos_rrx[$i], $rrx_name[$i], $rrx_sn[$i], $rrx_temp[$i], $rrx_input1[$i], $rrx_input2[$i], $rrx_input3[$i], $rrx_input4[$i], $rrx_status1[$i], $rrx_status2[$i], $rrx_status3[$i], $rrx_status4[$i]);";

		$result_insert_rrx = pg_query($query_insert_rrx) or die('Query failed: ' . pg_last_error());
	}



	// DB6:  chech if the table "daemonsnmpelinkftx" in the database "vanguardhe"； this table is for RRX
	$query_exist_ftx = "SELECT relname FROM pg_class 
	WHERE relname = 'daemonsnmpelinkftx';";

	$result_exist_ftx = pg_query($query_exist_ftx) or die('Query failed: ' . pg_last_error());

	$exist_ftx = '';
	while ($row_exist_ftx = pg_fetch_object($result_exist_ftx)){

		$exist_ftx = $row_exist_ftx->relname;

	}



	// if not existed, create it 
	if ($exist_ftx != "daemonsnmpelinkftx") {
		# code...
		$query_construct_ftx = "CREATE TABLE PUBLIC.daemonsnmpelinkftx(
			deviceid 	INT,
			time           TEXT    , 
			slot	TEXT,  
			model        TEXT,
			sn       TEXT,
			temp         TEXT,
			rfinputpower         TEXT,
			agcmode        TEXT,
			lasertemp        TEXT,
			laserbiascurrent		TEXT,
			outputpower         TEXT,
			thccurrent        TEXT,
			lasertype        TEXT,
			wavelength		TEXT
			);";

		$result_construct_ftx = pg_query($query_construct_ftx) or die('Query failed: ' . pg_last_error());
		pg_free_result($result_construct_ftx);
	}

	// insert data 
	for ($i=0; $i < sizeof($slot_ftx); $i++) {

		// insert data into the table 
		$query_insert_ftx = "INSERT INTO PUBLIC.daemonsnmpelinkftx VALUES ($deviceid, $timestamp, $pos_ftx[$i], $ftx_name[$i], $ftx_sn[$i], $ftx_temp[$i], $ftx_rfinputpower[$i], $ftx_agcmode[$i], $ftx_lasertemp[$i], $ftx_laserbiascurent[$i], $ftx_outputpower[$i], $ftx_thermoeleccoolercurrent[$i], $ftx_lasertype[$i], $ftx_wavelength[$i]);";

		$result_insert_ftx = pg_query($query_insert_ftx) or die('Query failed: ' . pg_last_error());

	}

	// pg_free_result($result_exist);
	// pg_free_result($result_insert);
	// pg_free_result($result_construct);
	pg_free_result($result_exist_sum);

	pg_free_result($result_exist_ems);
	pg_free_result($result_insert_ems);

	pg_free_result($result_exist_ps);
	pg_free_result($result_insert_ps);

	pg_free_result($result_exist_fan);
	pg_free_result($result_insert_fan);

	pg_free_result($result_exist_rrx);
	pg_free_result($result_insert_rrx);

	pg_free_result($result_exist_ftx);
	pg_free_result($result_insert_ftx);

	pg_close($dbconn);

}

?>