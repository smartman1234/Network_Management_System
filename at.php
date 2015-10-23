<?php


$xml ='<node building="" foreign-id="" node-label="ttt">
<interface descr="" ip-addr="8.8.8.8" managed="true" status="1" snmp-primary="P">
<monitored-service service-name="ICMP"/>
<monitored-service service-name="SNMP"/>
</interface>
</node>'; 


$serverIp = gethostbyname(gethostname());

$serverIp = "69.70.200.230";

//$data = "nodeId=" . $nodeid . "&action=ack";
//$data = "nodeId=" . $nodeid;

//$url = "http://10.100.0.199:8980/opennms/rest/acks";
$url = "http://" . $serverIp . ":8980/opennms/rest/requisitions/requisitions/TEST/nodes";

$curl = curl_init ();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_USERPWD, "admin:admin");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POST, 1);
//curl_setopt($curl, CURLOPT_PUT, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                                       'Content-type: application/xml', 
                                       'Content-length: ' . strlen($xml)
                                     ));
//curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
$result =  curl_exec ($curl);
if(gettype($result) == "string"){
	//echo "Delete Successfully!";
	echo $result;
}else{
	//echo "Delete Later!";
	echo $result;
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



