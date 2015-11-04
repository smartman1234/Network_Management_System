<?php



$query = "SELECT DISTINCT ON (ipinterface.nodeid)
ipinterface.nodeid, 
ipinterface.ipaddr,
alarms.serviceid, 
alarms.alarmid,
alarms.alarmtype, 
alarms.counter, 
node.nodelabel, 
alarms.firsteventtime, 
alarms.lasteventtime, 
alarms.logmsg, 
node.nodeid,
node.nodesysoid, 
node.nodelabel, 
alarms.severity
FROM 
public.alarms, 
public.ipinterface, 
public.node
WHERE 
alarms.nodeid = node.nodeid AND node.nodeid = ipinterface.nodeid;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$total_alarm_number = pg_num_rows($result);

echo "<thead>";
echo "<tr class=headings>";
echo "<th align=left class=table-sortable:numeric_comma><b>Interface</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Label</b></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Device Category</b></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Severity</b></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Service</b></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Automatic Resolution</b></th>";
echo "<th align=left class=table-sortable:numeric><b>Counts</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left class=table-sortable:alphanumeric><b>Start</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left class=table-sortable:alphanumeric><b>Stop</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left class=table-sortable:text><b>Log Message</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=right><b>Acknowledge</b></th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";


while ($row = pg_fetch_object($result)) {	
	echo "\t<tr class=even pointer>\n";	
	echo "\t\t<td align=left><a href=php_scripts/display_status_value.php?nodeid=$row->nodeid target=_blank > $row->ipaddr</a></td>";
	echo "\t\t<td align=left>$row->nodelabel</td>";
	$deviceCategory = deviceCat($row->nodesysoid);
	echo "\t\t<td align=left>$deviceCategory</td>";
	$seve=visulize_severe($row->severity);
	echo "\t\t<td align=left>$seve</td>";
	$service = service_id($row->serviceid);
	echo "\t\t<td align=left>$service</td>";
	$alarmtype = alarm_type($row->alarmtype);
	echo "\t\t<td align=left>$alarmtype</td>";
	echo "\t\t<td align=left>$row->counter</td>";
	echo "\t\t<td align=left>$row->firsteventtime</td>";
	echo "\t\t<td align=left>$row->lasteventtime</td>";
	echo "\t\t<td align=left>$row->logmsg</td>";
//	echo "\t\t<td align=center><a href=php_scripts/alarm_acknowledge_dialog.php?alarmid=$row->alarmid target=_blank ><img src=images/2c_go.png width=25 height=25></a></td>";


	echo "\t\t<td align=center><a href=php_scripts/curl_acknowlegeAlarm.php?alarmid=$row->alarmid target=_blank ><img src=images/2c_go.png width=25 height=25></a></td>";

	echo "\t</tr>\n";
}










?>