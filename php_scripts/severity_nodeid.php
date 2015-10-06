<?php


require "db_initialize.php";
require "service_id.php";
require 'severity_vis.php';
require "alarm_type.php";


$query = "SELECT 
alarms.serviceid, 
alarms.alarmid,
alarms.alarmtype, 
alarms.counter, 
alarms.firsteventtime, 
alarms.lasteventtime, 
alarms.logmsg,
alarms.severity
FROM 
public.alarms
WHERE
alarms.nodeid = $nodeid
ORDER BY
alarms.firsteventtime DESC;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());



echo "<table>\n";
echo "\t<tr>\n";
echo "<td align=center><b>Alarm type</b></td>";
echo "<td align=center><b>Severity</b></td>";
echo "<td align=center><b>Service</b></td>";
echo "<td align=center><b>Counter</b></td>";
echo "<td align=center><b>Log message</b></td>";


while ($row = pg_fetch_object($result)) {	

	echo "\t<tr>\n";	

	$alarmtype = alarm_type($row->alarmtype);
	echo "\t\t<td align=center>$alarmtype</td>";

	
	$seve=visulize_severe($row->severity);
	echo "\t\t<td align=center>$seve</td>";

	$service = service_id($row->serviceid);
	echo "\t\t<td align=center>$service</td>";


	echo "\t\t<td align=center>$row->counter</td>";
	echo "\t\t<td align=center>$row->logmsg</td>";

	echo "\t</tr>\n";
}


echo "</table>\n";

pg_free_result($result);
pg_close($dbconn);


?>




