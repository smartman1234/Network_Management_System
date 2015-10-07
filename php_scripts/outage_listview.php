<!-- http://www.javascripttoolbox.com/lib/table/documentation.php -->


<?php

require "db_initialize.php";
require "service_id.php";
require "device_category_from_OID.php";
require "outage_status.php";

$query = "SELECT 
  outages.nodeid, 
  outages.ipaddr, 
  outages.serviceid, 
  outages.iflostservice, 
  outages.ifregainedservice, 
  node.nodelabel,
  node.nodeid,
  node.nodesysoid
FROM 
  public.outages, 
  public.node
WHERE 
  outages.nodeid = node.nodeid
ORDER BY
  outages.nodeid ASC;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

echo "<thead>";
echo "<tr class=headings>";
echo "<th align=left class=table-filterable table-sortable:default><b>Status</b></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Label</b></th>";
echo "<th align=left class=table-sortable:numeric_comma><b>Interface</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Device Category</b></th>";
echo "<th align=left class=table-filterable table-sortable:default><b>Service</b></th>";
echo "<th align=left class=table-sortable:alphanumeric><b>Down</b><img src=images/sorticon.png width=30 height=20></th>";
echo "<th align=left class=table-sortable:alphanumeric><b>Up</b><img src=images/sorticon.png width=30 height=20></th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

while ($row = pg_fetch_object($result)) {	
	echo "\t<tr class=even pointer>\n";	


	$status = outage_status($row->ifregainedservice);
	echo "\t\t<td align=left>$status</td>";
	echo "\t\t<td align=left>$row->nodelabel</td>";

	echo "\t\t<td align=left><a href=php_scripts/display_status_value.php?nodeid=$row->nodeid target=_blank >$row->ipaddr</a></td>";

	$deviceCategory = deviceCat($row->nodesysoid);
	echo "\t\t<td align=left>$deviceCategory</td>";

	$service = service_id($row->serviceid);
	echo "\t\t<td align=left>$service</td>";

	echo "\t\t<td align=left>$row->iflostservice</td>";
	echo "\t\t<td align=center>$row->ifregainedservice</td>";

	echo "\t</tr>\n";
}



pg_free_result($result);
pg_close($dbconn);

?>




