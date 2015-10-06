<?php

require "db_initialize.php";
require "admin_status_from_snmpinterface.php";
require "operation_status_from_snmpinterface.php";

$nodeid = $_REQUEST["nodeid"];

$query = "SELECT DISTINCT
snmpinterface.nodeid, 
snmpinterface.snmpphysaddr, 
snmpinterface.snmpifdescr, 
snmpinterface.snmpifname, 
snmpinterface.snmpifadminstatus, 
snmpinterface.snmpifoperstatus
FROM 
public.snmpinterface
WHERE 
snmpinterface.snmpphysaddr IS NOT NULL AND snmpinterface.nodeid = $nodeid
ORDER BY
snmpinterface.nodeid DESC;";

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$number = pg_num_rows($result);

if ($number == 0) {
	echo "There is no available data in the database currently.";

} 

if ($number > 0) {


	echo "<table>\n";
	echo "\t<tr>\n";
	echo "<td align=center><b>MAC Address</b></td>";
	echo "<td align=center><b>Interface</b></td>";
	echo "<td align=center><b>SNMP Description</b></td>";
	echo "<td align=center><b>Admin Status</b></td>";
	echo "<td align=center><b>Operation Status</b></td>";

	while ($row = pg_fetch_object($result)) {	

		echo "\t<tr>\n";	


		echo "\t\t<td align=left>$row->snmpphysaddr</td>";
		echo "\t\t<td align=left>$row->snmpifname</td>";


		echo "\t\t<td align=left>$row->snmpifdescr</td>";

		$adminstatus = admin_status($row->snmpifadminstatus);
		echo "\t\t<td align=left>$adminstatus</td>";

		$operationstatus = operation_status($row->snmpifoperstatus);
		echo "\t\t<td align=left>$operationstatus</td>";

		echo "\t</tr>\n";
	}

	echo "</table>\n";
}



pg_free_result($result);
pg_close($dbconn);



echo "<br>";
echo "<br>";


echo "<button onclick=closeWin()>Close</button>";
echo
"<script>
function closeWin() {
    window.close();
}
</script>";



?>




