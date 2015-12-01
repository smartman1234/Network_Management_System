<?php

$dbpath = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/daemon_scr/daemon_db_init.php";
require_once($dbpath);  // to initialize snmp 

require "service_id.php";
require 'severity_vis.php';
require "alarm_type.php";
require "device_category_from_OID.php";
require "notice_type.php";
require "assigned_profile_according_to_nodelablesource.php";
require "status_snmp_inventory.php";
require "alarm_inventory.php";

$query = "SELECT 
  daemondevice.ip, 
  daemondevice.id, 
  daemondevice.time, 
  daemondevice.status, 
  daemondevice.description, 
  daemondevice.mib, 
  daemondevice.uptime, 
  daemondevice.contact, 
  daemondevice.name, 
  daemondevice.location, 
  daemondevice.provision, 
  daemondevice.service, 
  daemondevice.mac, 
  daemondevice.sn
FROM 
  public.daemondevice;";

$result = pg_query($query) or die('Query failed: ' . pg_last_error());


echo "<thead>";
echo "<tr class=headings>";
echo "<th align=left class=table-sortable:numeric_comma><b>Device ID</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Device Category</b></th>";
echo "<th align=left class=table-sortable:numeric_comma><b>IP</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left class=table-sortable:numeric_comma><b>MAC</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left class=table-sortable:numeric_comma><b>SN</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Assigned Profile</b></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Status </b></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>ICMP </b></th>";
echo "<th align=left class=table-sortable:alphanumeric><b>Discovered Time</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left class=table-sortable:alphanumeric><b>Latest Polling</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left><b>Status Values</b></th>";
echo "<th align=left><b>Alarm Setup</b></th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

// <a href=php_scripts/snmpSpecificIp_Inventory.php?ip=$row->ipaddr target=_blank > 
// <a href=php_scripts/snmpinfo_from_snmpinterface.php?nodeid=$row->nodeid target=_blank > 
while ($row = pg_fetch_object($result)) {	

if ($row->mib == ".1.3.6.1.4.1.3222.14.2.1.1" || $row->mib == ".1.3.6.1.4.1.5591.29317.1.11.1.3.1.1"|| $row->mib == ".1.3.6.1.4.1.17409.1.11" || $row->mib == "SNMPv2-SMI::enterprises.3222.14.2.1.1" || $row->mib == "SNMPv2-SMI::enterprises.5591.29317.1.11.1.3.1.1"|| $row->mib == "SNMPv2-SMI::enterprises.17409.1.11") {
	# code...
	echo "\t<tr class=even pointer>\n";	
	echo "\t\t<td align=left>$row->id</td>";
	$deviceCategory = deviceCat($row->nodesysoid);
	echo "\t\t<td align=left>$deviceCategory</td>";
	echo "\t\t<td align=left>$row->ipaddr </td>";
	echo "\t\t<td align=left>$row->nodelabel</td>";
	$profile = assigned_profile($row->nodelabelsource);
	echo "\t\t<td align=left>$profile</td>";
	$onlineStatus = is_online_for_inventory($row->ipaddr);
	echo "\t\t<td align=left>$onlineStatus</td>";
	$alarmStatus = alarm_severity_for_inventory("$row->nodeid");
	$vis = visulize_severe($alarmStatus);
	echo "\t\t<td align=left>$vis</td>";
	echo "\t\t<td align=left>$row->nodecreatetime</td>";
	echo "\t\t<td align=left>$row->lastcapsdpoll</td>";

	switch ($row->nodesysoid) {
		case ".1.3.6.1.4.1.3222.14.2.1.1":
			# code...
			echo "\t\t<td align=center><a href=daemon_scr/display_value_1550.php?ip=$row->ipaddr target=_blank ><img src=images/search-icon-md.png style=width:20px;height:20px;>  </a></td>";
			echo "\t\t<td align=center><a href=daemon_scr/setup_alarmT_1550.php target=_blank ><img src=images/17-512.png style=width:20px;height:20px;></a></td>";
			echo "\t</tr>\n";
			break;
		case ".1.3.6.1.4.1.5591.29317.1.11.1.3.1.1":
			# code...
			echo "\t\t<td align=center><a href=daemon_scr/display_value_elink.php?ip=$row->ipaddr target=_blank ><img src=images/search-icon-md.png style=width:20px;height:20px;>  </a></td>";
			echo "\t\t<td align=center><a href=daemon_scr/setup_alarmT_elink.php target=_blank ><img src=images/17-512.png style=width:20px;height:20px;></a></td>";
			echo "\t</tr>\n";
			break;
		case ".1.3.6.1.4.1.17409.1.11":
			# code...
			echo "\t\t<td align=center><a href=daemon_scr/display_value_egfa.php?ip=$row->ipaddr target=_blank ><img src=images/search-icon-md.png style=width:20px;height:20px;>  </a></td>";
			echo "\t\t<td align=center><a href=daemon_scr/setup_alarmT_egfa.php target=_blank ><img src=images/17-512.png style=width:20px;height:20px;></a></td>";
			echo "\t</tr>\n";
			break;
	}


}

}


pg_free_result($result);
pg_close($dbconn);

?>




<!-- echo "\t\t<td align=center><a href=php_scripts/display_status_value.php?nodeid=$row->nodeid target=_blank ><img src=images/search-icon-md.png style=width:20px;height:20px;>  </a></td>";
echo "\t\t<td align=center><a href=php_scripts/inventory_setup.php?nodeid=$row->nodeid target=_blank ><img src=images/17-512.png style=width:20px;height:20px;></a></td>";
 -->