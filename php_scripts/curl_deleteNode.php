<?php

//$noticeid=$_GET[ 'noticeid'];


session_start();
$nodeid=$_SESSION['NODEID']; 



$serverIp = gethostbyname(gethostname());

//$serverIp = "69.70.200.230";

//$data = "nodeId=" . $nodeid . "&action=ack";
//$data = "nodeId=" . $nodeid;

//$url = "http://10.100.0.199:8980/opennms/rest/acks";
$url = "http://" . $serverIp . ":8980/opennms/rest/nodes/" . $nodeid;

$curl = curl_init ();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_USERPWD, "admin:admin");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
//curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$result =  curl_exec ($curl);
if(gettype($result) == "string"){
	echo "Delete Successfully!";
	//echo $result;
}else{
	echo "Delete Later!";
	//echo $result;
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




