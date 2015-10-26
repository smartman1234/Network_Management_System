<?php

$ip[0] = $_POST["ip1"];
$label[0] = $_POST["lb1"];
$mac[0] = $_POST["mac1"];

$ip[1] = $_POST["ip2"];
$label[1] = $_POST["lb2"];
$mac[1] = $_POST["mac2"];

$ip[2] = $_POST["ip3"];
$label[2] = $_POST["lb3"];
$mac[2] = $_POST["mac3"];

for ($i=0; $i < 3; $i++) { 
	# code...
	if ($ip[$i] != "" && $label[$i] != "") {
		# code...
		echo "The IP " . $ip[$i] , " labeled as " . $label[$i]. " (" . $mac[$i] . ") has been supplemented into XML configuration file.";
		echo "<br>";
		addNodeViaCurlRequisition($ip[$i], $label[$i]);
	}
	
}

echo "<br>";

echo "<br>";
echo "System needs to take a while for synchorizaiton.";
echo "<br>";
echo "<br>";


echo "<button onclick=closeWin()>Close</button>";
echo
"<script>
function closeWin() {
	window.close();
}
</script>";





function addNodeViaCurlRequisition($ip, $label){

	$label = '"'.$label.'"';
	$ip = '"'.$ip.'"';


	$xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
	<node node-label=' . $label . ' foreign-id=' . $label . ' building="TEST">
		<interface snmp-primary="P" status="1" ip-addr=' . $ip . ' descr="">
			<monitored-service service-name="SNMP"/>
			<monitored-service service-name="ICMP"/>
			<monitored-service service-name="DNS"/>
		</interface>
	</node>'; 

	$serverIp = gethostbyname(gethostname());

	//$serverIp = "69.70.200.230";


	$url = "http://" . $serverIp . ":8980/opennms/rest/requisitions/TEST/nodes";

	$curl = curl_init ();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_USERPWD, "admin:admin");
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		'Content-type: application/xml', 
		'Content-length: ' . strlen($xml)
		));
	curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
	$result =  curl_exec ($curl);

// TO TRIGGER THE OPENNMS TO SYNC 
	$url1 = "http://" . $serverIp . ":8980/opennms/rest/requisitions/TEST/import?rescanExisting=false";
	$curl1 = curl_init ();
	curl_setopt($curl1, CURLOPT_URL, $url1);
	curl_setopt($curl1, CURLOPT_USERPWD, "admin:admin");
	curl_setopt($curl1, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl1, CURLOPT_PUT, true);
	curl_setopt($curl1, CURLOPT_HTTPHEADER, array(
		'Content-type: application/xml', 
		'Content-length: ' . strlen($xml)
		));

	$result1 =  curl_exec ($curl1);
	
}


?>


