<?php


function alarm_type($alarm_type){
	switch ($alarm_type) {
		case "1":
		return "Possibly";
		break;
		case "2":
		return "Resolved";
		break;
		case "3":
		return "Impossibly";
		break;
	}
}



?>