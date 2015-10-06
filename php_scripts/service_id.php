<?php


function service_id($service_id){
	switch ($service_id) {
		case "1":
		return "ICMP";
		break;
		case "2":
		return "SNMP";
		break;
		case "3":
		return "HTTP";
		break;
		case "4":
		return "FTP";
		break;
		case "5":
		return "DNS";
		break;
		case "6":
		return "SSH";
		break;
		default:
		return "N.A.";
		break;
	}
}



?>