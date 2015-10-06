

<div class="x_content">
	<table id="example" class="table table-striped responsive-utilities jambo_table table-autosort table-autofilter table-autopage:10 table-autostripe table-page-number:t1page table-page-count:t1pages table-filtered-rowcount:t1filtercount table-rowcount:t1allcount" >

		<style type="text/css">
			th {
				color: #000000;
				background-color: #2A3F54 }
			</style>



			<?php
			$ipaddress = $_REQUEST["q"];

			$newipaddress = "'" . $ipaddress . "'";

			require "db_initialize.php";
			require "service_id.php";
			require 'severity_vis.php';
			require "alarm_type.php";
			require "device_category_from_OID.php";

			$query = "SELECT 
			events.nodeid, 
			events.eventtime, 
			events.ipaddr, 
			events.serviceid, 
			events.eventseverity, 
			events.eventlogmsg, 
			node.nodesysoid
			FROM 
			public.events, 
			public.node
			WHERE 
			events.nodeid = node.nodeid AND
			events.ipaddr = $newipaddress
			ORDER BY
			events.eventtime DESC;";
			$result = pg_query($query) or die('Query failed: ' . pg_last_error());

			$total_alarm_number = pg_num_rows($result);


			echo "<thead>";
			echo "<tr class=headings>";
			echo "<th align=left class=table-filterable table-sortable:default><b>Device Category</b></th>";
			echo "<th align=left class=table-filterable table-sortable:default><b>Alarm Severity</b></th>";
			echo "<th align=left class=table-filterable table-sortable:default><b>Service</b></th>";
			echo "<th align=left class=table-sortable:alphanumeric><b>Time</b></th>";
			echo "<th align=left class=table-sortable:text><b>Log Message</b></th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";

			while ($row = pg_fetch_object($result)) {	
				echo "\t<tr class=even pointer>\n";	
				$deviceCategory = deviceCat($row->nodesysoid);
				echo "\t\t<td align=left>$deviceCategory</td>";

				$seve=visulize_severe($row->eventseverity);
				echo "\t\t<td align=left>$seve</td>";

				$service = service_id($row->serviceid);
				echo "\t\t<td align=left>$service</td>";

				echo "\t\t<td align=left>$row->eventtime</td>";
				echo "\t\t<td align=left>$row->eventlogmsg</td>";

				echo "\t</tr>\n";
			}


			pg_free_result($result);
			pg_close($dbconn);



			?>
		</tr></table>

