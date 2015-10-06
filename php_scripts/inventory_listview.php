<?php

require "db_initialize.php";
require "service_id.php";
require 'severity_vis.php';
require "alarm_type.php";
require "device_category_from_OID.php";
require "notice_type.php";
require "assigned_profile_according_to_nodelablesource.php";
require "status_snmp_inventory.php";
require "alarm_inventory.php";

$query = "SELECT DISTINCT ON (ipinterface.nodeid)
ipinterface.nodeid, 
ipinterface.ipaddr,
assets.nodeid, 
assets.serialnumber, 
assets.description,
node.nodecreatetime, 
node.nodesysoid, 
node.nodelabel, 
node.nodelabelsource, 
node.lastcapsdpoll
FROM 
public.assets, 
public.ipinterface, 
public.node
WHERE 
assets.nodeid = node.nodeid AND assets.nodeid = ipinterface.nodeid
ORDER BY
ipinterface.nodeid ASC;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());


echo "<thead>";
echo "<tr class=headings>";
echo "<th align=left class=table-sortable:numeric_comma><b>Device ID</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Device Category</b></th>";
echo "<th align=left class=table-sortable:numeric_comma><b>Interface</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Label</b></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Assigned Profile</b></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Status</b></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Alarm </b></th>";
echo "<th align=left class=table-sortable:alphanumeric><b>Discovered Time</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left class=table-sortable:alphanumeric><b>Latest Polling</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left><b>SNMP</b></th>";
echo "<th align=left><b>Setup</b></th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";


while ($row = pg_fetch_object($result)) {	
	echo "\t<tr class=even pointer>\n";	
	echo "\t\t<td align=left>$row->nodeid</td>";
	$deviceCategory = deviceCat($row->nodesysoid);
	echo "\t\t<td align=left>$deviceCategory</td>";
	echo "\t\t<td align=left><a href=php_scripts/snmpSpecificIp_Inventory.php?ip=$row->ipaddr target=_blank > $row->ipaddr </a></td>";
	echo "\t\t<td align=left>$row->nodelabel</td>";
	$profile = assigned_profile($row->nodelabelsource);
	echo "\t\t<td align=left>$profile</td>";
	$onlineStatus = is_online_for_inventory($row->nodeid);
	echo "\t\t<td align=left>$onlineStatus</td>";
	$alarmStatus = alarm_severity_for_inventory("$row->nodeid");
	$vis = visulize_severe($alarmStatus);
	echo "\t\t<td align=left>$vis</td>";
	echo "\t\t<td align=left>$row->nodecreatetime</td>";
	echo "\t\t<td align=left>$row->lastcapsdpoll</td>";
	echo "\t\t<td align=center><a href=php_scripts/snmpinfo_from_snmpinterface.php?nodeid=$row->nodeid target=_blank > <img src=images/search-icon-md.png style=width:20px;height:20px;>  </a></td>";
	echo "\t\t<td align=center><a href=php_scripts/inventory_setup.php?nodeid=$row->nodeid target=_blank ><img src=images/17-512.png style=width:20px;height:20px;></a></td>";
	echo "\t</tr>\n";
}


pg_free_result($result);
pg_close($dbconn);

?>




