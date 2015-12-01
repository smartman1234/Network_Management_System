<?php


function deviceCat($oid){
	switch ($oid) {
		// case ".1.3.6.1.4.1.4115.1.4.3":
		// return "Cadant C3 CMTS";
		// break;

		// case ".1.3.6.1.4.1.4998.2.2":
		// return "CMTS V08.02.00.97";
		// break;

		// case ".1.3.6.1.4.1.5802.1.3.1.2":
		// return "Electroline DHT-PS-NA";
		// break;

		// case ".1.3.6.1.4.1.5802.1.3.1.3":
		// return "Electroline DVM-7500A";
		// break;

		// case ".1.3.6.1.4.1.9.1.344":
		// return "Cisco Internetwork OS";
		// break;

		// case ".1.3.6.1.4.1.311.1.1.3.1.1":
		// return "Elink Headend Client PC";
		// break;

		// case ".1.3.6.1.4.1.3222.14.2.1.1":
		// return "EG1550TX Series";
		// break;

		// case ".1.3.6.1.4.1.5591.29317.1.11.1.3.1.1":
		// return "Elink Headend Platform";
		// break;

		// case ".1.3.6.1.4.1.17409.1.11":
		// return "EG-FA Fiber Amplifier";
		// break;

		// default:
		// return "Other Nodes";
		// break;

		case ".1.3.6.1.4.1.3222.14.2.1.1":
		return "EG1550";
		break;

		case ".1.3.6.1.4.1.5591.29317.1.11.1.3.1.1":
		return "Eline Headend";
		break;

		case ".1.3.6.1.4.1.17409.1.11":
		return "EG-FA";
		break;

		case "SNMPv2-SMI::enterprises.3222.14.2.1.1":
		return "EG1550";
		break;

		case "SNMPv2-SMI::enterprises.5591.29317.1.11.1.3.1.1":
		return "Eline Headend";
		break;

		case "SNMPv2-SMI::enterprises.17409.1.11":
		return "EG-FA";
		break;

		case "SNMPv2-SMI::enterprises.5802.1.3.1.2":
		return "Electroline EON";
		break;

		case ".1.3.6.1.4.1.5802.1.3.1.2":
		return "Electroline EON";
		break;
	}
}



?>