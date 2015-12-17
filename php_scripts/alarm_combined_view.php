<?php
/**
 * @Author: yuwang
 * @Date:   2015-12-17 14:37:31
 * @Last Modified by:   yuwang
 * @Last Modified time: 2015-12-17 14:45:20
 */


// require "db_initialize.php";
// require "service_id.php";
// require 'severity_vis.php';
// require "alarm_type.php";
// require "device_category_from_OID.php";
// require "notice_type.php";

$dbpath = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/daemon_scr/daemon_db_init.php";
require($dbpath);  // to initialize snmp 

// $alarmStatus = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/daemon_scr/daemon_checkAlarmStatus.php";
// require_once($alarmStatus);  // to initialize snmp 

// require "service_id.php";
// require 'severity_vis.php';
// require "alarm_type.php";
//require "device_category_from_OID.php";
// require "notice_type.php";
// require "assigned_profile_according_to_nodelablesource.php";
// require "status_snmp_inventory.php";
// require "alarm_inventory.php";


$query = "SELECT 
	daemonalarm.alarmid, 
	daemonalarm.time, 
	daemonalarm.deviceid, 
	daemonalarm.ip, 
	daemonalarm.description, 
	daemonalarm.mac, 
	daemonalarm.severity, 
	daemonalarm.logs, 
  	daemonalarm.ack
	FROM 
	public.daemonalarm;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$total_alarm_number = pg_num_rows($result);

echo "<thead>";
echo "<tr class=headings>";
echo "<th align=left class=table-sortable:numeric_comma><b>Alarm ID</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>IP</b></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Device</b></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Severity</b></th>";
echo "<th align=left class=table-sortable:numeric><b>MAC</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Acknowledge</b></th>";
echo "<th align=left class=table-sortable:alphanumeric><b>Alarm Time</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left class=table-sortable:text><b>Log Message</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=right><b>Acknowledge</b></th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";


while ($row = pg_fetch_object($result)) {	
	echo "\t<tr class=even pointer>\n";	
	echo "\t\t<td align=left>$row->alarmid</td>";
	echo "\t\t<td align=left>$row->ip</td>";
	//$deviceCategory = deviceCat($row->nodesysoid);
	//echo "\t\t<td align=left>$deviceCategory</td>";
	//	echo "\t\t<td align=left>$row->deviceid</td>";

	$d=getDeviceCate($row->logs);
	echo "\t\t<td align=left>$d</td>";

	//$seve=visulize_severe($row->severity);
	$v=visulize_severe($row->severity);
	echo "\t\t<td align=left>$v</td>";
	//	$service = service_id($row->serviceid);
	echo "\t\t<td align=left>$row->mac</td>";
	//$alarmtype = alarm_type($row->alarmtype);
	echo "\t\t<td align=left>$row->ack</td>";


	$alarmTime=displayTime($row->time);
	echo "\t\t<td align=left>$alarmTime</td>";
	echo "\t\t<td align=left>$row->logs</td>";

	//	echo "\t\t<td align=center><a href=php_scripts/alarm_acknowledge_dialog.php?alarmid=$row->alarmid target=_blank ><img src=images/2c_go.png width=25 height=25></a></td>";


	echo "\t\t<td align=center><a href=php_scripts/curl_acknowlegeAlarm.php?alarmid=$row->alarmid target=_blank ><img src=images/2c_go.png width=25 height=25></a></td>";

	echo "\t</tr>\n";
}


pg_free_result($result);
pg_close($dbconn);

function displayTime($t){

	if (strlen($t)==13) {
		# code...
		$year = substr($t, 0, 4);
		$month = substr($t, 4, 2);
		$day = substr($t, 6, 2);
		$hour = "0" . substr($t, 8, 1);
		$min = substr($t, 9, 2);
		$sec = substr($t, 11, 2);
	}

	if (strlen($t)==14) {
		# code...
		$year = substr($t, 0, 4);
		$month = substr($t, 4, 2);
		$day = substr($t, 6, 2);
		$hour = substr($t, 8, 1);
		$min = substr($t, 10, 2);
		$sec = substr($t, 12, 2);
	}

	return $year . "-" . $month . "-" . $day . "-" . $hour . "-" . $min . "-" . $sec;
	
}

function visulize_severe($severe) {
	if($severe=="high-high") return "<a style=color:#DC143C>High-High</a>";
	if($severe=="high") return "<a style=color:#DB7093>High</a>";
	if($severe=="Power Failure") return "<a style=color:#CD853F>Power Failure</a>";
	if($severe=="low") return "<a style=color:#8A2BE2>Low</a>";
	if($severe=="low-low") return "<a style=color:#6B8E23>Low-Low</a>";
	return $severe;

}


function getDeviceCate($s){

	if (substr($s, 0, 6)=="EG1550") {
		# code...
		return "EG1550";
	}

	if (substr($s, 0, 13)=="ELink HeadEnd") {
		# code...
		return "ELink HeadEnd";
	}

	if (substr($s, 0, 4)=="EGFA") {
		# code...
		return "EGFA";
	}

	return "Unknown";
}

























?>

