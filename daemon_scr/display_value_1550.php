<!DOCTYPE html>
<html lang="en">
<head>
	<title>EG1550 Status Values</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

	<br><br>
	<style>
		table, td, th {
			border: 1px solid #000000;
		}

		th {
			background-color: #000000;
			color: white;

		}

		td{
			height: 40px;
			padding: 10px;
		}
	</style>

<?php

require("daemon_db_init.php");
require("daemon_getDeviceIdPerIp.php");
$deviceid = getDeviceIdPerIp($_GET['ip']);
// $target_ip = "'" . "10.100.0.50" . "%'";

// echo "<b>Status Values of EG1550.</b><br>";

// $query = "SELECT 
// 	dameonsnmp1550value.time
// 	FROM 
// 	public.dameonsnmp1550value;";

// $result = pg_query($query) or die('Query failed: ' . pg_last_error());

// while ($row = pg_fetch_object($result)) {
// 	$time = $row->time; 
	
// }

// $time = "'" . strval($time) .  "'"; 

$query = "SELECT 
	dameonsnmp1550value.time, 
	dameonsnmp1550value.recordip, 
	dameonsnmp1550value.description, 
	dameonsnmp1550value.oids, 
	dameonsnmp1550value.uptime, 
	dameonsnmp1550value.contact, 
	dameonsnmp1550value.location, 
	dameonsnmp1550value.service, 
	dameonsnmp1550value.ip, 
	dameonsnmp1550value.name, 
	dameonsnmp1550value.statusindex, 
	dameonsnmp1550value.mac, 
	dameonsnmp1550value.idcode, 
	dameonsnmp1550value.subid, 
	dameonsnmp1550value.firmwareversion, 
	dameonsnmp1550value.laserim, 
	dameonsnmp1550value.lasertemperature, 
	dameonsnmp1550value.laserbias, 
	dameonsnmp1550value.rfmodulationlevel, 
	dameonsnmp1550value.dc24vvoltage, 
	dameonsnmp1550value.dc12vvoltage, 
	dameonsnmp1550value.dc5vvoltage, 
	dameonsnmp1550value.minor5vdcvoltage, 
	dameonsnmp1550value.txopticalpower, 
	dameonsnmp1550value.gaincontrolsetting, 
	dameonsnmp1550value.sbscontrolsetting, 
	dameonsnmp1550value.ctbcontrolsetting, 
	dameonsnmp1550value.txrfmodulelevel, 
	dameonsnmp1550value.presentacpower1status, 
	dameonsnmp1550value.presentacpower2status, 
	dameonsnmp1550value.txacpowersupplystatus
	FROM 
	public.dameonsnmp1550value
	WHERE dameonsnmp1550value.deviceid=$deviceid;";

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($row = pg_fetch_object($result)) {
	$time = $row->time; 
	$recordip = $row->recordip; 
	$description = $row->description; 
	$oids = $row->oids; 
	$uptime = $row->uptime; 
	$contact = $row->contact; 
	$location = $row->location; 
	$service = $row->service; 
	$ip = $row->ip; 
	$name = $row->name; 
	$statusindex = $row->statusindex; 
	$mac = $row->mac; 
	$idcode = $row->idcode; 
	$subid = $row->subid; 
	$firmwareversion = $row->firmwareversion; 
	$laserim = $row->laserim; 
	$lasertemperature = $row->lasertemperature; 
	$laserbias = $row->laserbias; 
	$rfmodulationlevel = $row->rfmodulationlevel; 
	$dc24vvoltage = $row->dc24vvoltage; 
	$dc12vvoltage = $row->dc12vvoltage; 
	$dc5vvoltage = $row->dc5vvoltage; 
	$minor5vdcvoltage = $row->minor5vdcvoltage; 
	$txopticalpower = $row->txopticalpower; 
	$gaincontrolsetting = $row->gaincontrolsetting; 
	$sbscontrolsetting = $row->sbscontrolsetting; 
	$ctbcontrolsetting = $row->ctbcontrolsetting; 
	$txrfmodulelevel = $row->txrfmodulelevel; 
	$presentacpower1status = $row->presentacpower1status; 
	$presentacpower2status = $row->presentacpower2status; 
	$txacpowersupplystatus = $row->txacpowersupplystatus;

}


pg_free_result($result);
pg_close($dbconn);

?>



<table>

<tr>
<td>Time </td>
<td> <?php  echo $time;         ?></td>	
</tr>

<tr>
<td>recordip </td>
<td> <?php  echo $recordip;         ?></td>	
</tr>


<tr>
<td>description </td>
<td> <?php  echo $description;         ?></td>	
</tr>

<tr>
<td>oids </td>
<td> <?php  echo $oids;         ?></td>	
</tr>

<tr>
<td>uptime </td>
<td> <?php  echo $uptime;         ?></td>	
</tr>

<tr>
<td>contact </td>
<td> <?php  echo $contact;         ?></td>	
</tr>

<tr>
<td>name </td>
<td> <?php  echo $name;         ?></td>	
</tr>

<tr>
<td>location </td>
<td> <?php  echo $location;         ?></td>	
</tr>

<tr>
<td>service </td>
<td> <?php  echo $service;         ?></td>	
</tr>

<tr>
<td>ip </td>
<td> <?php  echo $ip;         ?></td>	
</tr>

<tr>
<td>name </td>
<td> <?php  echo $name;         ?></td>	
</tr>

<tr>
<td>statusindex </td>
<td> <?php  echo $statusindex;         ?></td>	
</tr>

<tr>
<td>mac </td>
<td> <?php  echo $mac;         ?></td>	
</tr>

<tr>
<td>idcode </td>
<td> <?php  echo $idcode;         ?></td>	
</tr>

<tr>
<td>subid </td>
<td> <?php  echo $subid;         ?></td>	
</tr>

<tr>
<td>firmwareversion </td>
<td> <?php  echo $firmwareversion;         ?></td>	
</tr>

<tr>
<td>laserim </td>
<td> <?php  echo $laserim;         ?></td>	
</tr>

<tr>
<td>lasertemperature </td>
<td> <?php  echo $lasertemperature;         ?></td>	
</tr>

<tr>
<td>laserbias </td>
<td> <?php  echo $laserbias;         ?></td>	
</tr>

<tr>
<td>rfmodulationlevel </td>
<td> <?php  echo $rfmodulationlevel;         ?></td>	
</tr>

<tr>
<td>dc24vvoltage </td>
<td> <?php  echo $dc24vvoltage;         ?></td>	
</tr>

<tr>
<td>dc12vvoltage </td>
<td> <?php  echo $dc12vvoltage;         ?></td>	
</tr>

<tr>
<td>dc5vvoltage </td>
<td> <?php  echo $dc5vvoltage;         ?></td>	
</tr>

<tr>
<td>minor5vdcvoltage </td>
<td> <?php  echo $minor5vdcvoltage;         ?></td>	
</tr>


<tr>
<td>txopticalpower </td>
<td> <?php  echo $txopticalpower;         ?></td>	
</tr>



<tr>
<td>gaincontrolsetting </td>
<td> <?php  echo $gaincontrolsetting;         ?></td>	
</tr>

<tr>
<td>sbscontrolsetting </td>
<td> <?php  echo $sbscontrolsetting;         ?></td>	
</tr>

<tr>
<td>ctbcontrolsetting </td>
<td> <?php  echo $ctbcontrolsetting;         ?></td>	
</tr>

<tr>
<td>txrfmodulelevel </td>
<td> <?php  echo $txrfmodulelevel;         ?></td>	
</tr>


<tr>
<td>presentacpower1status </td>
<td> <?php  echo $presentacpower1status;         ?></td>	
</tr>

<tr>
<td>presentacpower2status </td>
<td> <?php  echo $presentacpower2status;         ?></td>	
</tr>

<tr>
<td>txacpowersupplystatus </td>
<td> <?php  echo $txacpowersupplystatus;         ?></td>	
</tr>





</table>


</body>
</html>

