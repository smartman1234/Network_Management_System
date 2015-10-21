<?php

$noticeid=$_GET[ 'noticeid'];


$serverIp = gethostbyname(gethostname());

//$serverIp = "10.100.0.199";

$data = "notifId=" . $noticeid . "&action=ack";

//$url = "http://10.100.0.199:8980/opennms/rest/acks";
$url = "http://" . $serverIp . ":8980/opennms/rest/acks";

$curl = curl_init ();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_USERPWD, "admin:admin");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$result =  curl_exec ($curl);
if(gettype($result) == "string"){
	echo "Acknowledged Successfully!";
	//echo $result;
}else{
	echo "Please Acknowledged Later!";
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




