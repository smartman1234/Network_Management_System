<?php

require "db_initialize.php";
require "service_id.php";
require "severity_vis.php";
require "device_category_from_OID.php";
require "outage_status.php";
require "notice_type.php";
require "acknowledged_notice_by.php";

$query = "SELECT DISTINCT ON (ipinterface.nodeid)
ipinterface.nodeid, 
ipinterface.ipaddr,
notifications.notifconfigname, 
notifications.serviceid,  
notifications.nodeid, 
notifications.answeredby,  
notifications.pagetime,  
notifications.respondtime,  
notifications.subject, 
node.nodelabel, 
node.nodeid,
node.nodesysoid
FROM 
public.notifications, 
public.ipinterface, 
public.node
WHERE 
notifications.nodeid = node.nodeid AND node.nodeid = ipinterface.nodeid AND 
notifications.respondtime IS NOT NULL 
ORDER BY
ipinterface.nodeid ASC;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

echo "<thead>";
echo "<tr class=headings>";
echo "<th align=left class=table-filterable table-sortable:default><b>Interface</b></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Device Category</b></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Service</b></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Notice Type</b></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Answered by</b></th>";
echo "<th align=left class=table-sortable:alphanumeric><b>Answered Time</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left class=table-sortable:text><b>Message</b><img src=images/sorticon.png width=30 height=20></th>";
echo "</tr>";
echo "</thead>";


echo "<tbody>";


while ($row = pg_fetch_object($result)) {	
	echo "\t<tr class=even pointer>\n";		
	echo "\t\t<td align=left><a href=php_scripts/display_status_value.php?nodeid=$row->nodeid target=_blank >$row->ipaddr</a></td>";

	$deviceCategory = deviceCat($row->nodesysoid);
	echo "\t\t<td align=left>$deviceCategory</td>";

	$service = service_id($row->serviceid);
	echo "\t\t<td align=left>$service</td>";

	$notice_type = notice_type($row->notifconfigname);
	echo "\t\t<td align=left>$notice_type</td>";

  $answer_by = acknowledged_notice_by($row->answeredby);
  echo "\t\t<td align=left>$answer_by</td>";

  echo "\t\t<td align=left>$row->respondtime</td>";
  echo "\t\t<td align=left>$row->subject</td>";

  echo "\t</tr>\n";
}



pg_free_result($result);
pg_close($dbconn);

?>




