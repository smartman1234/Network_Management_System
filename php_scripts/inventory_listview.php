<?php

$dbpath = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/daemon_scr/daemon_db_init.php";
require_once($dbpath);  // to initialize snmp 

$alarmStatus = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/daemon_scr/daemon_checkAlarmStatus.php";
require_once($alarmStatus);  // to initialize snmp 

// require "service_id.php";
// require 'severity_vis.php';
// require "alarm_type.php";
require "device_category_from_OID.php";
// require "notice_type.php";
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
echo "<th align=left class=table-sortable:numeric_comma><b>ID</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Device</b></th>";
echo "<th align=left class=table-sortable:numeric_comma><b>Interface</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left class=table-sortable:numeric_comma><b>MAC</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left class=table-sortable:numeric_comma><b>SN</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Assigned Profile</b></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Alarm </b></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>ICMP </b></th>";
echo "<th align=left class=table-sortable:alphanumeric><b>Discovered Time</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left><b>Device Metrics</b></th>";
echo "<th align=left><b>Alarm Setup</b></th>";
echo "<th align=left><b>Delete</b></th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

// <a href=php_scripts/snmpSpecificIp_Inventory.php?ip=$row->ipaddr target=_blank > 
// <a href=php_scripts/snmpinfo_from_snmpinterface.php?nodeid=$row->nodeid target=_blank > 

while ($row = pg_fetch_object($result)) {	
$criteria = trim($row->mib);


if ($criteria == ".1.3.6.1.4.1.3222.14.2.1.1" || $criteria == ".1.3.6.1.4.1.5591.29317.1.11.1.3.1.1" || $criteria == ".1.3.6.1.4.1.17409.1.11" || $criteria == "SNMPv2-SMI::enterprises.3222.14.2.1.1" || $criteria == "SNMPv2-SMI::enterprises.5591.29317.1.11.1.3.1.1"|| $criteria == "SNMPv2-SMI::enterprises.17409.1.11" || $criteria == "SNMPv2-SMI::enterprises.5802.1.3.1.2" || $criteria == ".1.3.6.1.4.1.5802.1.3.1.2") {
	# code...
	echo "\t<tr class=even pointer>\n";	
	echo "\t\t<td align=left>$row->id</td>";
	$deviceCategory = deviceCat(trim($row->mib));
	echo "\t\t<td align=left>$deviceCategory</td>";
	echo "\t\t<td align=left>$row->ip </td>";
	echo "\t\t<td align=left>$row->mac </td>";
	echo "\t\t<td align=left>$row->sn </td>";
	$profile = assigned_profile($row->provision);
	echo "\t\t<td align=left>$profile</td>";
	$alarmStatus = getAlarmStatus($row->ip);
	echo "\t\t<td align=left>$alarmStatus</td>";
	$onlineStatus = is_online_for_inventory($row->ip);
	echo "\t\t<td align=left>$onlineStatus</td>";

	$time = displayTime($row->time);

	echo "\t\t<td align=left>$time</td>";

	$trimedIp = trim($row->ip);
	switch (trim($row->mib)) {
		case ".1.3.6.1.4.1.3222.14.2.1.1":
			# code...
			echo "\t\t<td align=center><a href=daemon_scr/display_value_1550.php?ip=$trimedIp target=_blank ><img src=images/search-icon-md.png style=width:20px;height:20px;>  </a></td>";
			echo "\t\t<td align=center><a href=daemon_scr/setup_alarmT_1550.php target=_blank ><img src=images/17-512.png style=width:20px;height:20px;></a></td>";
			echo "\t\t<td align=center><a href=daemon_scr/daemon_doDeleteDeive.php?ip=$trimedIp target=_blank ><img src=images/editing-delete-icon.png style=width:20px;height:20px;></a></td>";

			echo "\t</tr>\n";
			break;
		case ".1.3.6.1.4.1.5591.29317.1.11.1.3.1.1":
			# code...
			echo "\t\t<td align=center><a href=daemon_scr/display_value_elink.php?ip=$trimedIp target=_blank ><img src=images/search-icon-md.png style=width:20px;height:20px;>  </a></td>";
			echo "\t\t<td align=center><a href=daemon_scr/setup_alarmT_elink.php target=_blank ><img src=images/17-512.png style=width:20px;height:20px;></a></td>";
			echo "\t\t<td align=center><a href=daemon_scr/daemon_doDeleteDeive.php?ip=$trimedIp target=_blank ><img src=images/editing-delete-icon.png style=width:20px;height:20px;></a></td>";

			echo "\t</tr>\n";
			break;
		case ".1.3.6.1.4.1.17409.1.11":
			# code...
			echo "\t\t<td align=center><a href=daemon_scr/display_value_egfa.php?ip=$trimedIp target=_blank ><img src=images/search-icon-md.png style=width:20px;height:20px;>  </a></td>";
			echo "\t\t<td align=center><a href=daemon_scr/setup_alarmT_egfa.php target=_blank ><img src=images/17-512.png style=width:20px;height:20px;></a></td>";
			echo "\t\t<td align=center><a href=daemon_scr/daemon_doDeleteDeive.php?ip=$trimedIp target=_blank ><img src=images/editing-delete-icon.png style=width:20px;height:20px;></a></td>";

			echo "\t</tr>\n";
			break;
		case "SNMPv2-SMI::enterprises.3222.14.2.1.1":
			# code...
			echo "\t\t<td align=center><a href=daemon_scr/display_value_1550.php?ip=$trimedIp target=_blank ><img src=images/search-icon-md.png style=width:20px;height:20px;>  </a></td>";
			echo "\t\t<td align=center><a href=daemon_scr/setup_alarmT_1550.php target=_blank ><img src=images/17-512.png style=width:20px;height:20px;></a></td>";
			echo "\t\t<td align=center><a href=daemon_scr/daemon_doDeleteDeive.php?ip=$trimedIp target=_blank ><img src=images/editing-delete-icon.png style=width:20px;height:20px;></a></td>";

			echo "\t</tr>\n";
			break;
		case "SNMPv2-SMI::enterprises.5591.29317.1.11.1.3.1.1":
			# code...
			echo "\t\t<td align=center><a href=daemon_scr/display_value_elink.php?ip=$trimedIp target=_blank ><img src=images/search-icon-md.png style=width:20px;height:20px;>  </a></td>";
			echo "\t\t<td align=center><a href=daemon_scr/setup_alarmT_elink.php target=_blank ><img src=images/17-512.png style=width:20px;height:20px;></a></td>";
			echo "\t\t<td align=center><a href=daemon_scr/daemon_doDeleteDeive.php?ip=$trimedIp target=_blank ><img src=images/editing-delete-icon.png style=width:20px;height:20px;></a></td>";

			echo "\t</tr>\n";
			break;
		case "SNMPv2-SMI::enterprises.17409.1.11":
			# code...
			echo "\t\t<td align=center><a href=daemon_scr/display_value_egfa.php?ip=$trimedIp target=_blank ><img src=images/search-icon-md.png style=width:20px;height:20px;>  </a></td>";
			echo "\t\t<td align=center><a href=daemon_scr/setup_alarmT_egfa.php target=_blank ><img src=images/17-512.png style=width:20px;height:20px;></a></td>";
			echo "\t\t<td align=center><a href=daemon_scr/daemon_doDeleteDeive.php?ip=$trimedIp target=_blank ><img src=images/editing-delete-icon.png style=width:20px;height:20px;></a></td>";

			echo "\t</tr>\n";
			break;
		default:
			# code...
			echo "\t\t<td align=center><img src=images/search-icon-md.png style=width:20px;height:20px;> </td>";
			echo "\t\t<td align=center><img src=images/17-512.png style=width:20px;height:20px;></td>";
			echo "\t\t<td align=center><a href=daemon_scr/daemon_doDeleteDeive.php?ip=$trimedIp target=_blank ><img src=images/editing-delete-icon.png style=width:20px;height:20px;></a></td>";

			echo "\t</tr>\n";
			break;

	}

}

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
		$hour = substr($t, 8, 2);
		$min = substr($t, 10, 2);
		$sec = substr($t, 12, 2);
	}

	//return strlen($t) . " " . $t;
	return $year . "-" . $month . "-" . $day . " " . $hour . ":" . $min . ":" . $sec;
	
}




?>




<!-- echo "\t\t<td align=center><a href=php_scripts/display_status_value.php?nodeid=$row->nodeid target=_blank ><img src=images/search-icon-md.png style=width:20px;height:20px;>  </a></td>";
echo "\t\t<td align=center><a href=php_scripts/inventory_setup.php?nodeid=$row->nodeid target=_blank ><img src=images/17-512.png style=width:20px;height:20px;></a></td>";
 -->