<?php
// will use the public variable 

// unit test --- begin
//alarmCompare_egfa();

// unit test --- end 

// todo:  1) check if the threshold table exsits, if true, go ahead; 2) extract all value, and data treatment from alarm thres table,
//3) extract all value, and data treatment from snmp table,  4) under the condition, compare the resutl, if abnormal, do an action 

function alarmCompare_egfa(){

	require_once("alarm_logger.php");

	global $timestamp;
	// $timestamp = "'4 November 2015 08:29:27 AM'";   for debug purpose 

	require("daemon_db_init.php");

	// 1) check if the alarm thres 1550 table exist, if yes, go down the following codes	
	$query_exist = "SELECT relname FROM pg_class 
	WHERE relname = 'daemonalarmthresegfa';";

	$result_exist = pg_query($query_exist) or die('Query failed: ' . pg_last_error());

	$exist = '';
	while ($row_exist = pg_fetch_object($result_exist)){

		$exist = $row_exist->relname;

	}

	// only if existed, following function will perform  
	if ($exist == "daemonalarmthresegfa") {

		// extract the real-time value :   raw data 
		$query_value = "SELECT 
			  dameonsnmpegfavalue.ip, 
			  dameonsnmpegfavalue.mac, 
			  dameonsnmpegfavalue.outputopticalpower, 
			  dameonsnmpegfavalue.inputopticalpower, 
			  dameonsnmpegfavalue.pumptemp1, 
			  dameonsnmpegfavalue.pumptemp2, 
			  dameonsnmpegfavalue.pumptemp3, 
			  dameonsnmpegfavalue.dc5v, 
			  dameonsnmpegfavalue.dcminor5v, 
			  dameonsnmpegfavalue.dc33v, 
			  dameonsnmpegfavalue.dc12v, 
			  dameonsnmpegfavalue.left5v, 
			  dameonsnmpegfavalue.right5v, 
			  dameonsnmpegfavalue.leftminor5v,
			  dameonsnmpegfavalue.rightminor5v 
			FROM 
			  public.daemonsnmpegfavalue
			WHERE 
			  dameonsnmpegfavalue.time = $timestamp;";

		$result_value = pg_query($query_value) or die('Query failed: ' . pg_last_error());

		$number = pg_num_rows($result_value);
		

		while ($row = pg_fetch_object($result_value)) {	
			$ip[] = $row->ip;
			$mac[] = $row->mac;
			$outputopticalpower[] = floatval($row->outputopticalpower);
			$inputopticalpower[] = floatval($row->inputopticalpower);
			$pumptemp1[] = floatval($row->pumptemp1);
			$pumptemp2[] = floatval($row->pumptemp2);
			$pumptemp3[] = floatval($row->pumptemp3);
			$dc5v[] = floatval($row->dc5v);
			$dcminor5v[] = floatval($row->dcminor5v);
			$dc33v[] = floatval($row->dc33v);
			$dc12v[] = floatval($row->dc12v);
			$left5v[] = floatval($row->left5v);
			$right5v[] = $row->right5v;
			$leftminor5v[] = $row->leftminor5v;
			$rightminor5v[] = $row->rightminor5v;
		}

		// debug purpose    // need to change!!!!!
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
			  daemonalarmthresegfa.outputopticalpower1, 
			  daemonalarmthresegfa.inputopticalpower1, 
			  daemonalarmthresegfa.pumptemp11, 
			  daemonalarmthresegfa.pumptemp21, 
			  daemonalarmthresegfa.pumptemp31, 
			  daemonalarmthresegfa.dc5v1, 
			  daemonalarmthresegfa.dcminor5v1, 
			  daemonalarmthresegfa.dc33v1, 
			  daemonalarmthresegfa.dc12v1, 
			  daemonalarmthresegfa.left5v1, 
			  daemonalarmthresegfa.right5v1, 
			  daemonalarmthresegfa.leftminor5v1, 
			  daemonalarmthresegfa.rightminor5v1, 
			  daemonalarmthresegfa.outputopticalpower2,
			  daemonalarmthresegfa.inputopticalpower2, 
			  daemonalarmthresegfa.pumptemp12, 
			  daemonalarmthresegfa.pumptemp22, 
			  daemonalarmthresegfa.pumptemp32, 
			  daemonalarmthresegfa.dc5v2, 
			  daemonalarmthresegfa.dcminor5v2, 
			  daemonalarmthresegfa.right5v2, 
			  daemonalarmthresegfa.dc12v2, 
			  daemonalarmthresegfa.left5v2,
			  daemonalarmthresegfa.dc33v2, 
			  daemonalarmthresegfa.leftminor5v2, 
			  daemonalarmthresegfa.rightminor5v2,
			  daemonalarmthresegfa.outputopticalpower3,
			  daemonalarmthresegfa.inputopticalpower3, 
			  daemonalarmthresegfa.pumptemp13, 
			  daemonalarmthresegfa.pumptemp23, 
			  daemonalarmthresegfa.pumptemp33, 
			  daemonalarmthresegfa.dc5v3, 
			  daemonalarmthresegfa.dcminor5v3, 
			  daemonalarmthresegfa.right5v3, 
			  daemonalarmthresegfa.dc12v3, 
			  daemonalarmthresegfa.left5v3,
			  daemonalarmthresegfa.dc33v3, 
			  daemonalarmthresegfa.leftminor5v3, 
			  daemonalarmthresegfa.rightminor5v3,
			  daemonalarmthresegfa.outputopticalpower4,
			  daemonalarmthresegfa.inputopticalpower4, 
			  daemonalarmthresegfa.pumptemp14, 
			  daemonalarmthresegfa.pumptemp24, 
			  daemonalarmthresegfa.pumptemp34, 
			  daemonalarmthresegfa.dc5v4, 
			  daemonalarmthresegfa.dcminor5v4, 
			  daemonalarmthresegfa.right5v4, 
			  daemonalarmthresegfa.dc12v4, 
			  daemonalarmthresegfa.left5v4,
			  daemonalarmthresegfa.dc33v4, 
			  daemonalarmthresegfa.leftminor5v4, 
			  daemonalarmthresegfa.rightminor5v4
			FROM 
			  public.daemonalarmthresegfa
			LIMIT 1;";

		$result_t = pg_query($query_t) or die('Query failed: ' . pg_last_error());

		while ($row = pg_fetch_object($result_t)) {
			$outputopticalpower_1 = $row->outputopticalpower1;
			$inputopticalpower_1 = $row->inputopticalpower1;
			$pumptemp1_1 = $row->pumptemp11;
			$pumptemp2_1 = $row->pumptemp21;
			$pumptemp3_1 = $row->pumptemp31;
			$dc5v_1 = $row->dc5v1;
			$dcminor5v_1 = $row->dcminor5v1;
			$dc33v_1 = $row->dc33v1;
			$dc12v_1 = $row->dc12v1;
			$left5v_1 = $row->left5v1;
			$right5v_1 = $row->right5v1;
			$leftminor5v_1 = $row->leftminor5v1;
			$rightminor5v_1 = $row->rightminor5v1;
			$outputopticalpower_2 = $row->outputopticalpower2;
			$inputopticalpower_2 = $row->inputopticalpower2;
			$pumptemp1_2 = $row->pumptemp12;
			$pumptemp2_2 = $row->pumptemp22;
			$pumptemp3_2 = $row->pumptemp32;
			$dc5v_2 = $row->dc5v2;
			$dcminor5v_2 = $row->dcminor5v2;
			$dc33v_2 = $row->dc33v2;
			$dc12v_2 = $row->dc12v2;
			$left5v_2 = $row->left5v2;
			$right5v_2 = $row->right5v2;
			$leftminor5v_2 = $row->leftminor5v2;
			$rightminor5v_2 = $row->rightminor5v2;
			$outputopticalpower_3 = $row->outputopticalpower3;
			$inputopticalpower_3 = $row->inputopticalpower3;
			$pumptemp1_3 = $row->pumptemp13;
			$pumptemp2_3 = $row->pumptemp23;
			$pumptemp3_3 = $row->pumptemp33;
			$dc5v_3 = $row->dc5v3;
			$dcminor5v_3 = $row->dcminor5v3;
			$dc33v_3 = $row->dc33v3;
			$dc12v_3 = $row->dc12v3;
			$left5v_3 = $row->left5v3;
			$right5v_3 = $row->right5v3;
			$leftminor5v_3 = $row->leftminor5v3;
			$rightminor5v_3 = $row->rightminor5v3;
			$outputopticalpower_4 = $row->outputopticalpower4;
			$inputopticalpower_4 = $row->inputopticalpower4;
			$pumptemp1_4 = $row->pumptemp14;
			$pumptemp2_4 = $row->pumptemp24;
			$pumptemp3_4 = $row->pumptemp34;
			$dc5v_4 = $row->dc5v4;
			$dcminor5v_4 = $row->dcminor5v4;
			$dc33v_4 = $row->dc33v4;
			$dc12v_4 = $row->dc12v4;
			$left5v_4 = $row->left5v4;
			$right5v_4 = $row->right5v4;
			$leftminor5v_4 = $row->leftminor5v4;
			$rightminor5v_4 = $row->rightminor5v4;
		}

		// compare, also check if the threshold is undefined
		for ($i=0; $i < $number; $i++) { 
			
			// outputopticalpower
			// if ($outputopticalpower_1 != "" $$ $outputopticalpower_2 != "") {
			// 	if ($outputopticalpower[$i] <  floatval($outputopticalpower_1) || $outputopticalpower[$i] > floatval($outputopticalpower_2)) {
			// 		$log = "EGFA: Output Optical Power (" .  $outputopticalpower[$i] . " mA) is out of range!";
			// 		alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
			// 	}
			// }
			compare_egfa($outputopticalpower_1, $outputopticalpower_2, $outputopticalpower_3, $outputopticalpower_4, $outputopticalpower[$i], $timestamp, $ip[$i], $mac[$i]);


			// inputopticalpower
			// if ($inputopticalpower_1 != "" $$ $inputopticalpower_2 != "") {
			// 	if ($inputopticalpower[$i] <  floatval($inputopticalpower_1) || $inputopticalpower[$i] > floatval($inputopticalpower_2)) {
			// 		$log = "EGFA: Input Optical Power (" .  $inputopticalpower[$i] . " degreeC) is out of range!";
			// 		alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
			// 	}
			// }
			compare_egfa($inputopticalpower_1, $inputopticalpower_2, $inputopticalpower_3, $inputopticalpower_4, $inputopticalpower[$i], $timestamp, $ip[$i], $mac[$i]);
	

			// pumptemp1
			// if ($pumptemp1_1 != "" $$ $pumptemp1_2 != "") {
			// 	if ($pumptemp1[$i] <  floatval($pumptemp1_1) || $pumptemp1[$i] > floatval($pumptemp1_2)) {
			// 		$log = "EGFA: Pump Temperature 1 (" .  $pumptemp1[$i] . " mA) is out of range!";
			// 		alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
			// 	}
			// }
			compare_egfa($pumptemp1_1, $pumptemp1_2, $pumptemp1_3, $pumptemp1_4, $pumptemp1[$i], $timestamp, $ip[$i], $mac[$i]);


			// pumptemp2 
			// if ($pumptemp2_1 != "" $$ $pumptemp2_2 != "") {
			// 	if ($pumptemp2[$i] <  floatval($pumptemp2_1) || $pumptemp2[$i] > floatval($pumptemp2_2)) {
			// 		$log = "EGFA: Pump Temperature 2 (" .  $pumptemp2[$i] . " dB) is out of range!";
			// 		alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
			// 	}
			// }
			compare_egfa($pumptemp2_1, $pumptemp2_2, $pumptemp2_3, $pumptemp2_4, $pumptemp2[$i], $timestamp, $ip[$i], $mac[$i]);



			// pumptemp3
			// if ($pumptemp3_1 != "" $$ $pumptemp3_2 != "") {
			// 	if ($pumptemp3[$i] <  floatval($pumptemp3_1) || $pumptemp3[$i] > floatval($pumptemp3_2)) {
			// 		$log = "EGFA: Pump Temperature 3 (" .  $pumptemp3[$i] . " V) is out of range!";
			// 		alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
			// 	}
			// }
			compare_egfa($pumptemp3_1, $pumptemp3_2, $pumptemp3_3, $pumptemp3_4, $pumptemp3[$i], $timestamp, $ip[$i], $mac[$i]);



			// dc5v
			// if ($dc5v_1 != "" $$ $dc5v_2 != "") {
			// 	if ($dc5v[$i] <  floatval($dc5v_1) || $dc5v[$i] > floatval($dc5v_2)) {
			// 		$log = "EGFA: DC +5V (" .  $dc5v[$i] . " V) is out of range!";
			// 		alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
			// 	}
			// }
			compare_egfa($dc5v_1, $dc5v_2, $dc5v_3, $dc5v_4, $dc5v[$i], $timestamp, $ip[$i], $mac[$i]);


			// dcminor5v
			// if ($dcminor5v_1 != "" $$ $dcminor5v_2 != "") {
			// 	if ($dcminor5v[$i] <  floatval($dcminor5v_1) || $dcminor5v[$i] > floatval($dcminor5v_2)) {
			// 		$log = "EGFA: DC -5V (" .  $dcminor5v[$i] . " V) is out of range!";
			// 		alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
			// 	}
			// }
			compare_egfa($dcminor5v_1, $dcminor5v_2, $dcminor5v_3, $dcminor5v_4, $dcminor5v[$i], $timestamp, $ip[$i], $mac[$i]);


			// dc33v
			// if ($dc33v_1 != "" $$ $dc33v_2 != "") {
			// 	if ($dc33v[$i] <  floatval($dc33v_1) || $dc33v[$i] > floatval($dc33v_2)) {
			// 		$log = "EGFA: DC +3.3V (" .  $dc33v[$i] . " V) is out of range!";
			// 		alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
			// 	}
			// }
			compare_egfa($dc33v_1, $dc33v_2, $dc33v_3, $dc33v_4, $dc33v[$i], $timestamp, $ip[$i], $mac[$i]);


			// dc12v
			// if ($dc12v_1 != "" $$ $dc12v_2 != "") {
			// 	if ($dc12v[$i] <  floatval($dc12v_1) || $dc12v[$i] > floatval($dc12v_2)) {
			// 		$log = "EGFA: DC +12V (" .  $dc12v[$i] . " dBm) is out of range!";
			// 		alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
			// 	}
			// }		
			compare_egfa($dc12v_1, $dc12v_2, $dc12v_3, $dc12v_4, $dc12v[$i], $timestamp, $ip[$i], $mac[$i]);


			// left5v
			// if ($left5v_1 != "" $$ $left5v_2 != "") {
			// 	if ($left5v[$i] <  floatval($left5v_1) || $left5v[$i] > floatval($left5v_2)) {
			// 		$log = "EGFA: Left +5V (" .  $left5v[$i] . " dB) is out of range!";
			// 		alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
			// 	}
			// }
			compare_egfa($left5v_1, $left5v_2, $left5v_3, $left5v_4, $left5v[$i], $timestamp, $ip[$i], $mac[$i]);


			// right5v
			// if ($right5v_1 != "" $$ $right5v_2 != "") {
			// 	if ($right5v[$i] <  floatval($right5v_1) || $right5v[$i] > floatval($right5v_2)) {
			// 		$log = "EGFA: Right +5V (" .  $right5v[$i] . " dB) is out of range!";
			// 		alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
			// 	}
			// }
			compare_egfa($right5v_1, $right5v_2, $right5v_3, $right5v_4, $right5v[$i], $timestamp, $ip[$i], $mac[$i]);


			// leftminor5v
			// if ($leftminor5v_1 != "" $$ $leftminor5v_2 != "") {
			// 	if ($leftminor5v[$i] <  floatval($leftminor5v_1) || $leftminor5v[$i] > floatval($leftminor5v_2)) {
			// 		$log = "EGFA: Left -5V (" .  $leftminor5v[$i] . " dB) is out of range!";
			// 		alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
			// 	}
			// }
			compare_egfa($leftminor5v_1, $leftminor5v_2, $leftminor5v_3, $leftminor5v_4, $leftminor5v[$i], $timestamp, $ip[$i], $mac[$i]);


			// rightminor5v
			// if ($rightminor5v_1 != "" $$ $rightminor5v_2 != "") {
			// 	if ($rightminor5v[$i] <  floatval($rightminor5v_1) || $rightminor5v[$i] > floatval($rightminor5v_2)) {
			// 		$log = "EGFA: Right -5V (" .  $rightminor5v[$i] . " dB) is out of range!";
			// 		alarmLogger($timestamp, $ip[$i], $mac[$i], $log);
			// 	}
			// }
			compare_egfa($rightminor5v_1, $rightminor5v_2, $rightminor5v_3, $rightminor5v_4, $rightminor5v[$i], $timestamp, $ip[$i], $mac[$i]);


		}


	}

	pg_free_result($result_value);
	pg_free_result($result_t);
	pg_close($dbconn);

}

function compare_egfa($t1, $t2, $t3, $t4, $r, $time, $ip, $mac){
			
	if ($t1 != "" && $t2 != "" && $t3 != "" && $t4 != "") {
		if ($t1 <= $t2 && $t2 <= $t3 && $t3 <= $t4) {
			if ($r > floatval($t4)) {
				$log = "EGFA has a high-high alarm! (" . $r .")";
				alarmLogger($time, $ip, $mac, $log, "high-high");
			}

			if ($r < floatval($t4) && $r > floatval($t3)) {
				$log = "EGFA has a high alarm! (" . $r .")";
				alarmLogger($time, $ip, $mac, $log, "high");
			}

			if ($r < floatval($t2) && $r > floatval($t1)) {
				$log = "EGFA has a low alarm! (" . $r .")";
				alarmLogger($time, $ip, $mac, $log, "low");
			}

			if ($r < floatval($t1)) {
				$log = "EGFA has a low-low alarm! (" . $r .")";
				alarmLogger($time, $ip, $mac, $log, "low-low");
			}
		}

	}
}

?>