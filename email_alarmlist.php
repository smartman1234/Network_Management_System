<?php

require "php_scripts/email.php";
require("php_scripts/device_category_from_OID.php");


$dbconn1 = pg_connect("host=localhost dbname=account4rapidnms user=postgres password=admin")
or die('Could not connect: ' . pg_last_error());

$query1 = "SELECT 
  account_user_information.email, 
  account_user_information.name
FROM 
  public.account_user_information;";
$result1 = pg_query($query1) or die('Query failed: ' . pg_last_error());

while ($row1 = pg_fetch_object($result1)){

$name = $row1->name;
$to_email = $row1->email;



}


require "php_scripts/db_initialize.php";

// $query = "
// COPY(
// 	SELECT 
// 	alarms.nodeid, 
// 	alarms.alarmid, 
// 	alarms.alarmtype, 
// 	alarms.counter, 
// 	alarms.severity, 
// 	alarms.lasteventtime, 
// 	alarms.serviceid
// 	FROM 
// 	public.alarms 
// 	WHERE 
// 	alarms.severity >= 3
// 	ORDER BY
// 	alarms.lasteventtime,
// 	alarms.severity) 
// TO 'C:/rapidnms/data.csv' With CSV HEADER;
// ";

$query = "SELECT 
  node.nodesysoid, 
  ipinterface.ipaddr, 
  alarms.severity, 
  alarms.lasteventtime, 
  alarms.description
FROM 
  public.alarms, 
  public.ipinterface,  
  public.node
WHERE 
  ipinterface.nodeid = node.nodeid AND
  alarms.nodeid = ipinterface.nodeid
ORDER BY
  alarms.lasteventtime DESC;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($row = pg_fetch_object($result)){

$time[] = $row->lasteventtime;
$ip[] = $row->ipaddr;
$device[] = deviceCat($row->nodesysoid);
$sev[] = severe($row->severity);
$des[] = $row->description;


}



$subject = $name . ", you have new alarms from Electroline Vanguard-HE   ". date('Y-m-d H:i:s');
$body = $device[0] . " (" . $ip[0] . "): " . $des[0] . " (" . $time[0] . "). ";
//$attachment = "for_downloading/email_alert_data.csv";

sendEmail($to_email, $subject, $body);



function severe($severe) {
	if($severe=="6") return "High-High";
	if($severe=="5") return "High";
	if($severe=="4") return "Intermediate";
	if($severe=="3") return "Low";
	if($severe=="2") return "Low-Low";
	if($severe=="No alarm") return "No alarm";


}

// echo $time[0] . "<br>";
// echo $ip[0]. "<br>";
// echo $device[0]. "<br>";
// echo $sev[0]. "<br>";
// echo $des[0]. "<br>";


?>