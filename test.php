<?php

require("daemon_scr/daemon_db_init.php");
//$target_ip = "'" + $_GET['ip'] + "%'";


$query = "SELECT 
	dameonsnmp1550value.time
	FROM 
	public.dameonsnmp1550value;";

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($row = pg_fetch_object($result)) {
	$time = $row->time; 
	

}

$time = "'" . strval($time) . "'";



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
	WHERE dameonsnmp1550value.time = $time;";

$result = pg_query($query) or die('Query failed: ' . pg_last_error());
while ($row = pg_fetch_object($result)) {
	echo $row->oids;
}
?>