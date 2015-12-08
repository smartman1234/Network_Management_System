<?php

// unit test    --- begin
// $time = "20151118150000";
// $time = "'" . $time . "'";
// checkAlarmUpdatedIfYesTakeAction($time);

// unit test --- end 

function checkAlarmUpdatedIfYesTakeAction($time){

	$timestamp=$time;
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

	// get email address of admin from db 
	$query_email = 'SELECT 
		"user".email
		FROM 
		public."user";';

	$result_email = pg_query($query_email) or die('Query failed: ' . pg_last_error());

	while ($row = pg_fetch_object($result_email)) {	
		$email[] = $row->email;
	}

	$toEmailAddress = $email[0];

	if ($number != 0) {

		while ($row = pg_fetch_object($result)) {				
			$ip[] = $row->ip;
			$description[] = $row->description;
			$mac[] = $row->mac;
			$severity[] = $row->severity;
			$logs[] = $row->logs;
			$ack[] = $row->ack;
		}

		$subject = "Alarm Alert from Electroline VanguardHE   ". date('Y-m-d H:i:s'); 
		$body = "This email is automatically sent from Electroline NMS system, and please do not reply to this address.<br>";
		
$body = $body . "----------------------------------<br>";
		for ($i=0; $i < $number; $i++) { 
			# code...
			$body = $body . "IP: " . $ip[$i] . "<br>";
			$body = $body . "MAC: " . $mac[$i] . "<br>"; 
						$body = $body . "Condition: " . $severity[$i] . "<br>";
			$body = $body . "Logs: " . $logs[$i] . "<br>";
			
			$body = $body . "----------------------------------<br>";
		}	

		sendEmail($toEmailAddress, $subject, $body);

	}	

}

?>