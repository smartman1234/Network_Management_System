<?php

function checkAlarmUpdatedIfYesTakeAction($time){

	global $timestamp;
	require("daemon_db_init.php");


	$genericEmailLibPath = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/php_scripts/email.php";
	require_once($genericEmailLibPath);  // to initialize email lib 

	// todo: 1) check the alarm table if there is a record matching the timestamp
	// 2) if yes, it is the newst generated one, so take an action 

	$query = "SELECT 
		  daemonalarm.time, 
		  daemonalarm.ip, 
		  daemonalarm.description, 
		  daemonalarm.mac, 
		  daemonalarm.severity, 
		  daemonalarm.logs, 
		  daemonalarm.ack
		FROM 
		  public.daemonalarm
		WHERE 
		  daemonalarm.time = $timestamp;";

	$result = pg_query($query) or die('Query failed: ' . pg_last_error());

	$number = pg_num_rows($result); 

	$numberD = "'" . $number . "'";
	$query_update = "UPDATE PUBLIC.daemontimestamp SET daemontimestamp.alarmcount=$numberD WHERE daemontimestamp.time=$timestamp;";

	$result_update = pg_query($query_update) or die('Query failed: ' . pg_last_error());

	// get email address of admin from db 
	$query_email = "SELECT 
		  user.email
		FROM 
		  public.user;";

	$result_email = pg_query($query_email) or die('Query failed: ' . pg_last_error());

	while ($row = pg_fetch_object($result_email)) {	
		$email[] = $row->email;
	}

	$toEmailAddress = $email[0];

	if ($number != 0) {

		while ($row = pg_fetch_object($result_value_ems)) {	
			$time[] = $row->time;
			$ip[] = $row->ip;
			$description[] = $row->description;
			$mac[] = $row->mac;
			$severity[] = $row->severity;
			$logs[] = $row->logs;
			$ack[] = $row->ack;
		}

		$subject = "Alarm Alert from Electroline VanguardHE   ". date('Y-m-d H:i:s'); 
		$body = "<p>This email is automatically sent from Electroline NMS system, and please do not reply to this address.</p>";

		for ($i=0; $i < $number; $i++) { 
			# code...
			$body = $body . "<p>IP: " . $ip[$i] . "</p>";
			$body = $body . "<p>MAC: " . $mac[$i] . "</p>"; 
			$body = $body . "<p>Description: " . $description[$i] . "</p>";
			$body = $body . "<p>Condition: " . $severity[$i] . "</p>";
			$body = $body . "<p>Logs: " . $logs[$i] . "</p>";
			$body = $body . "<p>Acknowlegement: " . $ack[$i] . "</p>";
			$body = $body . "----------------------------------<br>";
		}		

		sendEmail($toEmailAddress, $subject, $body);

	}	
}

?>