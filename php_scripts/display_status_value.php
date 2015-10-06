<?php
// Array with names


$nodeid = $_GET['nodeid'];

require("db_initialize.php");
require("device_category_from_OID.php");




$query = "SELECT DISTINCT ON (ipinterface.nodeid)
node.nodesysoid, 
ipinterface.ipaddr
FROM 
public.ipinterface,
public.node
WHERE 
ipinterface.nodeid = node.nodeid AND ipinterface.nodeid = $nodeid;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());


while ($row = pg_fetch_object($result)) {	

	$ip =  $row->ipaddr;
	$oid = $row->nodesysoid;

}

switch ($oid) {
	case ".1.3.6.1.4.1.3222.14.2.1.1":
		# code...
	
	require("oidget/snmp_1550.php");
	get_1550($ip);
	break;
	case ".1.3.6.1.4.1.5591.29317.1.11.1.3.1.1":
		# code...
	
	require("oidget/snmp_elink.php");
	get_elink($ip);
	break;

	case ".1.3.6.1.4.1.17409.1.11":
		# code...
	
	require("oidget/snmp_egfa.php");
	get_egfa($ip);
	break;
	default:
		# code...
	echo "There is no available SNMP info on this device.";
	break;
}



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