<?php

// this function thus far can solely return the int value of totalCount 
function getTotalCountfromJasonData($postAdress="alarms"){
	$url = "http://172.16.181.62:8980/opennms/rest/";
	$url = $url.$postAdress;
	$curl = curl_init ();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($curl, CURLOPT_USERPWD, "admin:admin");
	curl_setopt($curl, CURLOPT_HTTPHEADER, array ("Accept: application/json"));
	$jsondata = curl_exec ($curl);
	$dejson = json_decode($jsondata, true);
	$totalCount = (int) $dejson["totalCount"];
	return $totalCount;
}

function getDataAsJson($postAdress="alarms"){
	$url = "http://172.16.181.62:8980/opennms/rest/";
	$url = $url.$postAdress;
	$curl = curl_init ();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($curl, CURLOPT_USERPWD, "admin:admin");
	curl_setopt($curl, CURLOPT_HTTPHEADER, array ("Accept: application/json"));
	return curl_exec ($curl);
}

function getDataAsString($postAdress="alarms"){
	$url = "http://172.16.181.62:8980/opennms/rest/";
	$url = $url.$postAdress;
	$curl = curl_init ();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($curl, CURLOPT_USERPWD, "admin:admin");
	$result = curl_exec ($curl);
	return $result;
}

// // for testing
echo getTotalCountfromJasonData("nodes");
echo "\n";
echo getTotalCountfromJasonData("alarms");
echo getTotalCountfromJasonData("outages");
echo getTotalCountfromJasonData("notifications");


$alarms = getDataAsJson("alarms");
$alarms = json_decode($alarms, true);  // return an associate array 
echo $alarms[count];
echo $alarms[totalCount];

echo $alarms[alarm][0][id];

echo "\n";
print_r($alarms);