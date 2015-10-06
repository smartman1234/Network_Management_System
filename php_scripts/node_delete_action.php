<?php

session_start();
$nodeid=$_SESSION['NODEID']; 
echo "The CURL command via REST of deleting the device " . $nodeid . " has been sent. Please wait a while for system synchronization";

echo "<br>";

$data = "alarmId=" . $nodeid . "&action=ack";
$url = "http://10.100.0.199:8980/opennms/rest/acks";
$curl = curl_init ();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_USERPWD, "admin:admin");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$result =  curl_exec ($curl);


if(gettype($result) == "string"){
	echo "Acknowledged successfully!";
	echo "
<br>
";

	echo "
<button onclick=closeWin()>Close</button>
";
	echo
	"
<script>
	function closeWin() {
		window.close();
	}
</script>
";
}else{
	echo "Acknowledged later!";
	echo "
<br>
";

	echo "
<button onclick=closeWin()>Close</button>
";
	echo
	"
<script>
	function closeWin() {
		window.close();
	}
</script>
";
}











?>