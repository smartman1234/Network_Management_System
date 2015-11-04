<?php
// will use the public variable 

// unit test --- begin
//alarmCompare_1550();

// unit test --- end 

// todo:  1) check if the threshold table exsits, if true, go ahead; 2) extract all value, and data treatment from alarm thres table,
//3) extract all value, and data treatment from snmp table,  4) under the condition, compare the resutl, if abnormal, do an action 

function alarmCompare_1550(){

	require_once("alarm_logger.php");

	global $timestamp;
	// $timestamp = "'4 November 2015 08:29:27 AM'";   for debug purpose 

	require("daemon_db_init.php");

	// 1) check if the alarm thres 1550 table exist, if yes, go down the following codes	
	$query_exist = "SELECT relname FROM pg_class 
	WHERE relname = 'daemonalarmthres1550';";

	$result_exist = pg_query($query_exist) or die('Query failed: ' . pg_last_error());

	$exist = '';
	while ($row_exist = pg_fetch_object($result_exist)){

		$exist = $row_exist->relname;

	}

	// only if existed, following function will perform  
	if ($exist == "daemonalarmthres1550") {

		// extract the real-time value :   raw data 
		$query_value = "SELECT 
			  dameonsnmp1550value.ip, 
			  dameonsnmp1550value.mac, 
			  dameonsnmp1550value.laserim, 
			  dameonsnmp1550value.lasertemperature, 
			  dameonsnmp1550value.laserbias, 
			  dameonsnmp1550value.rfmodulationlevel, 
			  dameonsnmp1550value.dc24vvoltage, 
			  dameonsnmp1550value.dc12vvoltage, 
			  dameonsnmp1550value.dc5vvoltage, 
			  dameonsnmp1550value.minor5vdcvoltage, 
			  dameonsnmp1550value.txopticalpower, 
			  dameonsnmp1550value.txrfmodulelevel, 
			  dameonsnmp1550value.presentacpower1status, 
			  dameonsnmp1550value.presentacpower2status 
			FROM 
			  public.dameonsnmp1550value
			WHERE 
			  dameonsnmp1550value.time = $timestamp;";

		$result_value = pg_query($query_value) or die('Query failed: ' . pg_last_error());

		$number = pg_num_rows($result_value);
		

		while ($row = pg_fetch_object($result_value)) {	
			$ip[] = $row->ip;
			$mac[] = $row->mac;
			$laserim[] = floatval($row->laserim);
			$lasertemperature[] = floatval($row->lasertemperature);
			$laserbias[] = floatval($row->laserbias);
			$rfmodulationlevel[] = floatval($row->rfmodulationlevel);
			$dc24vvoltage[] = floatval($row->dc24vvoltage);
			$dc12vvoltage[] = floatval($row->dc12vvoltage);
			$dc5vvoltage[] = floatval($row->dc5vvoltage);
			$minor5vdcvoltage[] = floatval($row->minor5vdcvoltage);
			$txopticalpower[] = floatval($row->txopticalpower);
			$txrfmodulelevel[] = floatval($row->txrfmodulelevel);
			$presentacpower1status[] = $row->presentacpower1status;
			$presentacpower2status[] = $row->presentacpower2status;
		}

		// debug purpose 
		// for ($i=0; $i < $number; $i++) { 
		// 	# code...
		// 	var_dump( $ip[$i] );
		// 	var_dump( $mac[$i]) ;
		// 	var_dump( $laserim[$i] );
		// 	var_dump( $lasertemperature[$i] );
		// 	var_dump( $laserbias[$i] );
		// 	var_dump( $rfmodulationlevel[$i] );
		// 	var_dump( $dc24vvoltage[$i] );
		// 	var_dump( $dc12vvoltage[$i] );
		// 	var_dump( $dc5vvoltage[$i] );
		// 	var_dump( $minor5vdcvoltage[$i] );
		// 	var_dump( $txopticalpower[$i] );
		// 	var_dump( $txrfmodulelevel[$i] );
		// 	var_dump( $presentacpower1status[$i] );
		// 	var_dump( $presentacpower2status[$i] );		}


		// getting alarm info from threshold, upper and lower bound. 1 is uppder, and 2 is lower  
		$query_t = "SELECT 
			  daemonalarmthres1550.laserim1, 
			  daemonalarmthres1550.lasertemperature1, 
			  daemonalarmthres1550.laserbias1, 
			  daemonalarmthres1550.rfmodulationlevel1, 
			  daemonalarmthres1550.dc24vvoltage1, 
			  daemonalarmthres1550.dc12vvoltage1, 
			  daemonalarmthres1550.dc5vvoltage1, 
			  daemonalarmthres1550.minor5vdcvoltage1, 
			  daemonalarmthres1550.txopticalpower1, 
			  daemonalarmthres1550.txrfmodulelevel1, 
			  daemonalarmthres1550.presentacpower1status, 
			  daemonalarmthres1550.presentacpower2status,
			  daemonalarmthres1550.laserim2,
			  daemonalarmthres1550.lasertemperature2, 
			  daemonalarmthres1550.laserbias2, 
			  daemonalarmthres1550.rfmodulationlevel2, 
			  daemonalarmthres1550.dc24vvoltage2, 
			  daemonalarmthres1550.dc12vvoltage2, 
			  daemonalarmthres1550.dc5vvoltage2, 
			  daemonalarmthres1550.minor5vdcvoltage2, 
			  daemonalarmthres1550.txopticalpower2, 
			  daemonalarmthres1550.txrfmodulelevel2
			FROM 
			  public.daemonalarmthres1550;";

		$result_t = pg_query($query_t) or die('Query failed: ' . pg_last_error());

		while ($row = pg_fetch_object($result_t)) {
			$laserim_1 = $row->laserim1;
			$lasertemperature_1 = $row->lasertemperature1;
			$laserbias_1 = $row->laserbias1;
			$rfmodulationlevel_1 = $row->rfmodulationlevel1;
			$dc24vvoltage_1 = $row->dc24vvoltage1;
			$dc12vvoltage_1 = $row->dc12vvoltage1;
			$dc5vvoltage_1 = $row->dc5vvoltage1;
			$minor5vdcvoltage_1 = $row->minor5vdcvoltage1;
			$txopticalpower_1 = $row->txopticalpower1;
			$txrfmodulelevel_1 = $row->txrfmodulelevel1;
			$presentacpower1status_t = $row->presentacpower1status;
			$presentacpower2status_t = $row->presentacpower2status;
			$laserim_2 = $row->laserim2;
			$lasertemperature_2 = $row->lasertemperature2;
			$laserbias_2 = $row->laserbias2;
			$rfmodulationlevel_2 = $row->rfmodulationlevel2;
			$dc24vvoltage_2 = $row->dc24vvoltage2;
			$dc12vvoltage_2 = $row->dc12vvoltage2;
			$dc5vvoltage_2 = $row->dc5vvoltage2;
			$minor5vdcvoltage_2 = $row->minor5vdcvoltage2;
			$txopticalpower_2 = $row->txopticalpower2;
			$txrfmodulelevel_2 = $row->txrfmodulelevel2;
		}

		// compare, also check if the threshold is undefined
		for ($i=0; $i < $number; $i++) { 
			
			// laser im 
			if ($laserim_1 != "" $$ $laserim_2 != "") {
				if ($laserim[$i] <  floatval($laserim_1) || $laserim[$i] > floatval($laserim_2)) {
					$log = "EG1550: Laser IM (" .  $laserim[$i] . " mA) is out of range!";
					alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
				}
			}

			// lasertemperature
			if ($lasertemperature_1 != "" $$ $lasertemperature_2 != "") {
				if ($lasertemperature[$i] <  floatval($lasertemperature_1) || $lasertemperature[$i] > floatval($lasertemperature_2)) {
					$log = "EG1550: Laser Temperatrue (" .  $lasertemperature[$i] . " degreeC) is out of range!";
					alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
				}
			}

			// laserbias
			if ($laserbias_1 != "" $$ $laserbias_2 != "") {
				if ($laserbias[$i] <  floatval($laserbias_1) || $laserbias[$i] > floatval($laserbias_2)) {
					$log = "EG1550: Laser Bias Current (" .  $laserbias[$i] . " mA) is out of range!";
					alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
				}
			}

			// rfmodulationlevel 
			if ($rfmodulationlevel_1 != "" $$ $rfmodulationlevel_2 != "") {
				if ($rfmodulationlevel[$i] <  floatval($rfmodulationlevel_1) || $rfmodulationlevel[$i] > floatval($rfmodulationlevel_2)) {
					$log = "EG1550: RF Modulation Level (" .  $rfmodulationlevel[$i] . " dB) is out of range!";
					alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
				}
			}


			// dc24vvoltage
			if ($dc24vvoltage_1 != "" $$ $dc24vvoltage_2 != "") {
				if ($dc24vvoltage[$i] <  floatval($dc24vvoltage_1) || $dc24vvoltage[$i] > floatval($dc24vvoltage_2)) {
					$log = "EG1550: DC 24 Voltage (" .  $dc24vvoltage[$i] . " V) is out of range!";
					alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
				}
			}


			// dc12vvoltage
			if ($dc12vvoltage_1 != "" $$ $dc12vvoltage_2 != "") {
				if ($dc12vvoltage[$i] <  floatval($dc12vvoltage_1) || $dc12vvoltage[$i] > floatval($dc12vvoltage_2)) {
					$log = "EG1550: DC 12 Voltage (" .  $dc12vvoltage[$i] . " V) is out of range!";
					alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
				}
			}

			// dc5vvoltage
			if ($dc5vvoltage_1 != "" $$ $dc5vvoltage_2 != "") {
				if ($dc5vvoltage[$i] <  floatval($dc5vvoltage_1) || $dc5vvoltage[$i] > floatval($dc5vvoltage_2)) {
					$log = "EG1550: DC 5 Voltage (" .  $dc5vvoltage[$i] . " V) is out of range!";
					alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
				}
			}

			// minor5vdcvoltage
			if ($minor5vdcvoltage_1 != "" $$ $minor5vdcvoltage_2 != "") {
				if ($minor5vdcvoltage[$i] <  floatval($minor5vdcvoltage_1) || $minor5vdcvoltage[$i] > floatval($minor5vdcvoltage_2)) {
					$log = "EG1550: DC -5 Voltage (" .  $minor5vdcvoltage[$i] . " V) is out of range!";
					alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
				}
			}


			// txopticalpower
			if ($txopticalpower_1 != "" $$ $txopticalpower_2 != "") {
				if ($txopticalpower[$i] <  floatval($txopticalpower_1) || $txopticalpower[$i] > floatval($txopticalpower_2)) {
					$log = "EG1550: Optical Power (" .  $txopticalpower[$i] . " dBm) is out of range!";
					alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
				}
			}

			// txrfmodulelevel
			if ($txrfmodulelevel_1 != "" $$ $txrfmodulelevel_2 != "") {
				if ($txrfmodulelevel[$i] <  floatval($txrfmodulelevel_1) || $txrfmodulelevel[$i] > floatval($txrfmodulelevel_2)) {
					$log = "EG1550: RF Module Level (" .  $txrfmodulelevel[$i] . " dB) is out of range!";
					alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
				}
			}

			// presentacpower1status
			if ($presentacpower1status_t != "") {
				if ($presentacpower1status[$i] != $presentacpower1status_t) {
					$log = "EG1550: Power Supply 1 (" .  $presentacpower1status[$i] . " is changed!";
					alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
				}
			}

			// presentacpower2status
			if ($presentacpower2status_t != "") {
				if ($presentacpower2status[$i] != $presentacpower2status_t) {
					$log = "EG1550: Power Supply 2 (" .  $presentacpower2status[$i] . " is changed!";
					alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
				}
			}

		}


	}

	pg_free_result($result_value);
	pg_free_result($result_t);
	pg_close($dbconn);

}


?>