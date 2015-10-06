<?php

$id = $_REQUEST["q"];
$data = "alarmId=" . $id . "&action=ack";
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
}else{
	echo "Acknowledged later!";
}




// the following code is also okay by curl command line method 

// $id = $_REQUEST["q"];


// $cmd1 = "curl -u admin:admin -X POST -d alarmId=";
// $cmd2 = " -d action=ack http://172.16.181.62:8980/opennms/rest/acks";
// $cmd = $cmd1 . $id . $cmd2;

// $cmd1 = $cmd1 . $id1 . $cmd2;



// $result = shell_exec($cmd);

// echo $result;
// if (!is_null($result)) {
// 	echo "Successfully acknowledged!"; 
// }else{
// 	echo "Some errors may take place, please check!";
// }


?>







