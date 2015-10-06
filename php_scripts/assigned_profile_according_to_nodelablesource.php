<?php


function assigned_profile($labelsource){
	switch ($labelsource) {
		case "A":
		return "Set by IP";
		break;
		case "H":
		return "Set by hostname";
		break;
		case "S":
		return "Set by SNMP";
		break;
		default:
		return "User Defined";
		break;

	}
}



?>