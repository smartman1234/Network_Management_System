<?php


// todo:  1) check if the threshold table exsits, if true, go ahead; 2) extract all value, and data treatment from alarm thres table, 3) extract all value, and data treatment from snmp table,  4) under the condition, compare the resutl, if abnormal, do an action 

function alarmCompare_elink(){

	require_once("alarm_logger.php");

	global $timestamp;
	// $timestamp = "'4 November 2015 08:29:27 AM'";   for debug purpose 

	require("daemon_db_init.php");

	// 1) check if the alarm thres 1550 table exist, if yes, go down the following codes	
	$query_exist = "SELECT relname FROM pg_class 
	WHERE relname = 'daemonalarmthreselink';";

	$result_exist = pg_query($query_exist) or die('Query failed: ' . pg_last_error());

	$exist = '';
	while ($row_exist = pg_fetch_object($result_exist)){

		$exist = $row_exist->relname;

	}

	// only if existed, following function will perform  
	if ($exist == "daemonalarmthreselink") {

		$query_value_ems = "SELECT 
			  dameonsnmpelinkems.ip			 
			FROM 
			  public.dameonsnmpelinkems
			WHERE 
			  dameonsnmpelinkems.time = $timestamp;";

		$result_value_ems = pg_query($query_value_ems) or die('Query failed: ' . pg_last_error());

		$number_ems = pg_num_rows($result_value_ems);    // the number of total device eg1550
		
		while ($row = pg_fetch_object($result_value_ems)) {	
			$ip[] = $row->ip;
		}

		for ($i=0; $i < $number_ems; $i++) { 
				
			// compare: fan 
			// extract the alarm thres raw data 
			$query_value_fan = "SELECT 
				  dameonsnmpelinkfan.fan1, 
				  dameonsnmpelinkfan.fan2, 
				  dameonsnmpelinkfan.fan3, 
				  dameonsnmpelinkfan.fan4, 
				  dameonsnmpelinkfan.fan5, 
				  dameonsnmpelinkfan.fan6, 
				  dameonsnmpelinkfan.fan7, 
				  dameonsnmpelinkfan.fan8 
				FROM 
				  public.dameonsnmpelinkfan
				WHERE 
				  dameonsnmpelinkfan.time = $timestamp;";

			$result_value_fan = pg_query($query_value_fan) or die('Query failed: ' . pg_last_error());

			$number_fan = pg_num_rows($result_value_fan);    // the number of total device fan
			
			while ($row = pg_fetch_object($result_value_fan)) {	
				$fan1[] = int($row->fan1);
				$fan2[] = int($row->fan2);
				$fan3[] = int($row->fan3);    // 1
				$fan4[] = int($row->fan4);    // 2
				$fan5[] = int($row->fan5);    // 3
				$fan6[] = int($row->fan6);    // 4
				$fan7[] = int($row->fan7);    // 5
				$fan8[] = int($row->fan8);    // 6
			}

			for ($j=0; $j < $number_fan; $j++) { 
				checkFanStatus($fan1[$j], $timestamp, $ip[$i]);
				checkFanStatus($fan2[$j], $timestamp, $ip[$i]);
				checkFanStatus($fan3[$j], $timestamp, $ip[$i]);
				checkFanStatus($fan4[$j], $timestamp, $ip[$i]);
				checkFanStatus($fan5[$j], $timestamp, $ip[$i]);
				checkFanStatus($fan6[$j], $timestamp, $ip[$i]);
				checkFanStatus($fan7[$j], $timestamp, $ip[$i]);
				checkFanStatus($fan8[$j], $timestamp, $ip[$i]);
			}

			// check power supply 
			$query_value_ps = "SELECT 
				  dameonsnmpelinkps.outputv, 
				  dameonsnmpelinkps.outputma, 
				  dameonsnmpelinkps.outputw
				FROM 
				  public.dameonsnmpelinkps
				WHERE 
				  dameonsnmpelinkps.time = $timestamp;";

			$result_value_ps = pg_query($query_value_ps) or die('Query failed: ' . pg_last_error());

			$number_ps = pg_num_rows($result_value_ps);    // the number of total device fan
			
			while ($row = pg_fetch_object($result_value_ps)) {	
				$outputv[] = int($row->outputv);
				$outputma[] = int($row->outputma);
				$outputw[] = int($row->outputw); 
			}

			$query_t_ps = "SELECT 
			  daemonalarmthreselinkps.outputv1, 
			  daemonalarmthreselinkps.outputv2, 
			  daemonalarmthreselinkps.outputv3, 
			  daemonalarmthreselinkps.outputv4, 
			  daemonalarmthreselinkps.outputma1, 
			  daemonalarmthreselinkps.outputma2, 
			  daemonalarmthreselinkps.outputma3, 
			  daemonalarmthreselinkps.outputma4, 
			  daemonalarmthreselinkps.outputw1, 
			  daemonalarmthreselinkps.outputw2,
			  daemonalarmthreselinkps.outputw3,
			  daemonalarmthreselinkps.outputw4 
			FROM 
			  public.daemonalarmthreselinkps
			LIMIT 1;";
			$result_t_ps = pg_query($query_t_ps) or die('Query failed: ' . pg_last_error());
			while ($row = pg_fetch_object($result_t_ps)) {
				$outputv_1 = $row->outputv1;
				$outputv_2 = $row->outputv2;
				$outputv_3 = $row->outputv3;
				$outputv_4 = $row->outputv4;
				$outputma_1 = $row->outputma1;
				$outputma_2 = $row->outputma2;
				$outputma_3 = $row->outputma3;
				$outputma_4 = $row->outputma4;
				$outputw_1 = $row->outputw1;
				$outputw_2 = $row->outputw2;
				$outputw_3 = $row->outputw3;
				$outputw_4 = $row->outputw4;
			}

			for ($k=0; $k < $number_ps; $k++) { 
				compare_elink($outputv_1, $outputv_2, $outputv_3, $outputv_4, $outputv[$k], $timestamp, $ip[$i]);
				compare_elink($outputma_1, $outputma_2, $outputma_3, $outputma_4, $outputma[$k], $timestamp, $ip[$i]);
				compare_elink($outputw_1, $outputw_2, $outputw_3, $outputw_4, $outputw[$k], $timestamp, $ip[$i]);
			}


			// check rrx 
			$query_value_rrx = "SELECT 
				  dameonsnmpelinkrrx.input1, 
				  dameonsnmpelinkrrx.input2, 
				  dameonsnmpelinkrrx.input3, 
				  dameonsnmpelinkrrx.input4
				FROM 
				  public.dameonsnmpelinkrrx
				WHERE 
				  dameonsnmpelinkrrx.time = $timestamp;";

			$result_value_rrx = pg_query($query_value_rrx) or die('Query failed: ' . pg_last_error());

			$number_rrx = pg_num_rows($result_value_rrx);    // the number of total device fan
			
			while ($row = pg_fetch_object($result_value_rrx)) {	
				$input1[] = int($row->input1);
				$input2[] = int($row->input2);
				$input3[] = int($row->input3); 
				$input4[] = int($row->input4);
			}

			$query_t_rrx = "SELECT 
			  daemonalarmthreselinkrrx.input11, 
			  daemonalarmthreselinkrrx.input12, 
			  daemonalarmthreselinkrrx.input13, 
			  daemonalarmthreselinkrrx.input14, 
			  daemonalarmthreselinkrrx.input21, 
			  daemonalarmthreselinkrrx.input22, 
			  daemonalarmthreselinkrrx.input23, 
			  daemonalarmthreselinkrrx.input24, 
			  daemonalarmthreselinkrrx.input31, 
			  daemonalarmthreselinkrrx.input32,
			  daemonalarmthreselinkrrx.input33,
			  daemonalarmthreselinkrrx.input34,
			  daemonalarmthreselinkrrx.input41, 
			  daemonalarmthreselinkrrx.input42,
			  daemonalarmthreselinkrrx.input43,
			  daemonalarmthreselinkrrx.input44			  
			FROM 
			  public.daemonalarmthreselinkrrx
			LIMIT 1;";
			$result_t_rrx = pg_query($query_t_rrx) or die('Query failed: ' . pg_last_error());
			while ($row = pg_fetch_object($result_t_rrx)) {
				$input1_1 = $row->input11;
				$input1_2 = $row->input12;
				$input1_3 = $row->input13;
				$input1_4 = $row->input14;
				$input2_1 = $row->input21;
				$input2_2 = $row->input22;
				$input2_3 = $row->input23;
				$input2_4 = $row->input24;
				$input3_1 = $row->input31;
				$input3_2 = $row->input32;
				$input3_3 = $row->input33;
				$input3_4 = $row->input34;
				$input4_1 = $row->input41;
				$input4_2 = $row->input42;
				$input4_3 = $row->input43;
				$input4_4 = $row->input44;
			}

			for ($l=0; $l < $number_rrx; $l++) { 
				compare_elink($input1_1, $input1_2, $input1_3, $input1_4, $input1[$l], $timestamp, $ip[$i]);
				compare_elink($input2_1, $input2_2, $input2_3, $input2_4, $input2[$l], $timestamp, $ip[$i]);
				compare_elink($input3_1, $input3_2, $input3_3, $input3_4, $input3[$l], $timestamp, $ip[$i]);
				compare_elink($input4_1, $input4_2, $input4_3, $input4_4, $input4[$l], $timestamp, $ip[$i]);
			}

			// check ftx 
			$query_value_rrx = "SELECT 
				  dameonsnmpelinkftx.lasertemp, 
				  dameonsnmpelinkftx.laserbiascurrent, 
				  dameonsnmpelinkftx.outputpower, 
				  dameonsnmpelinkftx.thccurrent
				FROM 
				  public.dameonsnmpelinkftx
				WHERE 
				  dameonsnmpelinkftx.time = $timestamp;";

			$result_value_ftx = pg_query($query_value_ftx) or die('Query failed: ' . pg_last_error());

			$number_ftx = pg_num_rows($result_value_ftx);    // the number of total device fan
			
			while ($row = pg_fetch_object($result_value_ftx)) {	
				$lasertemp[] = int($row->lasertemp);
				$laserbiascurrent[] = int($row->laserbiascurrent);
				$outputpower[] = int($row->outputpower); 
				$thccurrent[] = int($row->thccurrent);
			}

			$query_t_ftx = "SELECT 
			  daemonalarmthreselinkftx.lasertemp1, 
			  daemonalarmthreselinkftx.lasertemp2, 
			  daemonalarmthreselinkftx.lasertemp3, 
			  daemonalarmthreselinkftx.lasertemp4, 
			  daemonalarmthreselinkftx.laserbiascurrent1, 
			  daemonalarmthreselinkftx.laserbiascurrent2, 
			  daemonalarmthreselinkftx.laserbiascurrent3, 
			  daemonalarmthreselinkftx.laserbiascurrent4, 
			  daemonalarmthreselinkftx.outputpower1, 
			  daemonalarmthreselinkftx.outputpower2,
			  daemonalarmthreselinkftx.outputpower3,
			  daemonalarmthreselinkftx.outputpower4,
			  daemonalarmthreselinkftx.thccurrent1, 
			  daemonalarmthreselinkftx.thccurrent2,
			  daemonalarmthreselinkftx.thccurrent3,
			  daemonalarmthreselinkftx.thccurrent4			  
			FROM 
			  public.daemonalarmthreselinkftx
			LIMIT 1;";
			$result_t_ftx = pg_query($query_t_ftx) or die('Query failed: ' . pg_last_error());
			while ($row = pg_fetch_object($result_t_ftx)) {
				$lasertemp_1 = $row->lasertemp1;
				$lasertemp_2 = $row->lasertemp2;
				$lasertemp_3 = $row->lasertemp3;
				$lasertemp_4 = $row->lasertemp4;
				$laserbiascurrent_1 = $row->laserbiascurrent1;
				$laserbiascurrent_2 = $row->laserbiascurrent2;
				$laserbiascurrent_3 = $row->laserbiascurrent3;
				$laserbiascurrent_4 = $row->laserbiascurrent4;
				$outputpower_1 = $row->outputpower1;
				$outputpower_2 = $row->outputpower2;
				$outputpower_3 = $row->outputpower3;
				$outputpower_4 = $row->outputpower4;
				$thccurrent_1 = $row->thccurrent1;
				$thccurrent_2 = $row->thccurrent2;
				$thccurrent_3 = $row->thccurrent3;
				$thccurrent_4 = $row->thccurrent4;
			}

			for ($m=0; $m < $number_ftx; $m++) { 
				compare_elink($lasertemp_1, $lasertemp_2, $lasertemp_3, $lasertemp_4, $lasertemp[$m], $timestamp, $ip[$i]);
				compare_elink($laserbiascurrent_1, $laserbiascurrent_2, $laserbiascurrent_3, $laserbiascurrent_4, $laserbiascurrent[$m], $timestamp, $ip[$i]);
				compare_elink($outputpower_1, $outputpower_2, $outputpower_3, $outputpower_4, $outputpower[$m], $timestamp, $ip[$i]);
				compare_elink($thccurrent_1, $thccurrent_2, $thccurrent_3, $thccurrent_4, $thccurrent[$m], $timestamp, $ip[$i]);
			}

		}	

	}

	pg_free_result($result_exist);
	pg_free_result($result_value_ems);
	pg_free_result($result_value_fan);
	pg_free_result($result_value_ps);
	pg_free_result($result_value_rrx);
	pg_free_result($result_value_ftx);
	pg_free_result($result_t_ps);
	pg_free_result($result_t_rrx);
	pg_free_result($result_t_ftx);
	pg_close($dbconn);

}

function compare_elink($t1, $t2, $t3, $t4, $r, $time, $ip){
    $mac = "";   // cuz mac is not available from here 		
	if ($t1 != "" && $t2 != "" && $t3 != "" && $t4 != "") {
		if ($t1 <= $t2 && $t2 <= $t3 && $t3 <= $t4) {
			if ($r > floatval($t4)) {
				$log = "ELink HeadEnd has a high-high alarm! (" . $r .")";
				alarmLogger($time, $ip, $mac, $log, "high-high");
			}

			if ($r < floatval($t4) && $r > floatval($t3)) {
				$log = "ELink HeadEnd has a high alarm! (" . $r .")";
				alarmLogger($time, $ip, $mac, $log, "high");
			}

			if ($r < floatval($t2) && $r > floatval($t1)) {
				$log = "ELink HeadEnd has a low alarm! (" . $r .")";
				alarmLogger($time, $ip, $mac, $log, "low");
			}

			if ($r < floatval($t1)) {
				$log = "ELink HeadEnd has a low-low alarm! (" . $r .")";
				alarmLogger($time, $ip, $mac, $log, "low-low");
			}
		}

	}
}

function checkFanStatus($fan, $time, $ip){
	$mac = "";   // cuz mac is not available from here 		
	if ($fan != 1) {
		$log = "ELink HeadEnd has malfunctional fan.";
		alarmLogger($time, $ip, $mac, $log, "fan out");
	}
}



?>