<!-- deprcated file 
 -->
<?php
require "db_init.php";
require "email.php";
$sev_thres = intval($_POST["sev_thres"]);
$to_email_name = $_POST["email_address"];
$to_email = $to_email_name . "@electroline.com";
$query = "
COPY(
	SELECT 
	alarms.nodeid, 
	alarms.alarmid, 
	alarms.alarmtype, 
	alarms.counter, 
	alarms.severity, 
	alarms.lasteventtime, 
	alarms.serviceid
	FROM 
	public.alarms 
	WHERE 
	alarms.severity >= $sev_thres
	ORDER BY
	alarms.lasteventtime,
	alarms.severity) 
TO 'C:\Bitnami\wappstack-5.5.30-0\apache2\htdocs/eline/for_downloading/email_alert_data.csv' With CSV HEADER;
";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$subject = "Alarm Alert from Electroline NMS   ". date('Y-m-d H:i:s');
$body = "This email is automatically sent from Electroline NMS system, and please do not reply to this address. Alarm details are attached in this email.";
$attachment = "for_downloading/email_alert_data.csv";

sendEmail($to_email, $subject, $body, $attachment);




?>
