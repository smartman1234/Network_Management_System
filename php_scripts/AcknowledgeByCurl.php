
<?php

function getAckDataAsJson($postAdress="acks?limit=0"){
	$url = "http://172.16.181.62:8980/opennms/rest/";
	$url = $url.$postAdress;
	$curl = curl_init ();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($curl, CURLOPT_USERPWD, "admin:admin");
	curl_setopt($curl, CURLOPT_HTTPHEADER, array ("Accept: application/json"));
	$jsondata = curl_exec ($curl);
	return $jsondata;
}


function postData($postAdress="acks"){
	$data = "";
	$url = "http://172.16.181.62:8980/opennms/rest/";
	$url = $url.$postAdress;
	$curl = curl_init ();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($curl, CURLOPT_USERPWD, "admin:admin");


	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);


	



	$jsondata = curl_exec ($curl);
	return $jsondata;
}



// echo getAckDataAsJson();

// echo postData();


// echo shell_exec("curl -u 'admin:admin' -X POST -d alarmID=20640 -d action=ack http://172.16.181.62:8980/opennms/rest/acks");



// $result = shell_exec("curl -u 'admin:admin' -X POST -d alarmId=20651 -d action=ack http://172.16.181.62:8980/opennms/rest/acks");
// if (!is_null($result)) {
// 	echo "okay curl". $result;
// 	# code...
// }else{
// 	echo "error";
// }




// $result = shell_exec("curl -u 'admin:admin' -X POST -d alarmId:20647, action:ack http://172.16.181.62:8980/opennms/rest/acks");

$result = shell_exec("curl -u 'admin:admin' -X PUT -d http://172.16.181.62:8980/opennms/rest/alarms/20070?clear=true");
if (!is_null($result)) {
	echo "okay curl". $result;
	# code...
}else{
	echo "error";
}






?>




