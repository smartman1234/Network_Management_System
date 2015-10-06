<?php


function notice_type($noticetype){
	switch ($noticetype) {
		case "interfaceDown":
		return "Interface Down";
		break;
		case "nodeAdded":
		return "Device Discovered";
		break;
		case "nodeDown":
		return "Device Down";
		break;
		case "nodeLostService":
		return "Device Lost Service";
		break;
		
		default:
		return "Undetermined";
		break;
	}
}



?>