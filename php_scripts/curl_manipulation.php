<?php


function getJasonData($postAdress){
	$url = "http://172.16.181.62:8980/opennms/rest/";
	$url = $url.$postAdress;
	$curl = curl_init ();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_USERPWD, "admin:admin");
	curl_setopt($curl, CURLOPT_HTTPHEADER, array ("Accept: application/json"));
	return curl_exec ($curl);
}


function getStringData($postAdress){
	$url = "http://172.16.181.62:8980/opennms/rest/";
	$url = $url.$postAdress;
	$curl = curl_init ();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_USERPWD, "admin:admin");
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	return curl_exec ($curl);
}


?>