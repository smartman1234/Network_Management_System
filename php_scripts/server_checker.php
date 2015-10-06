<?php

$server = $_SERVER['SERVER_ADDR'];
$serverIp = gethostbyname(gethostname());
$server_port = $_SERVER['SERVER_PORT'];

$cl = $_SERVER['REMOTE_ADDR'];


$db = "http://" . $serverIp . ":" . $server_port . "/phppgadmin";
$opennms = "http://" . $serverIp. ":" . "8980" . "/opennms";



?>




