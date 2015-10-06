<?php

function acknowledged_notice_by($text){
	switch ($text) {
		case "auto-acknowledged":
		return "Auto-acknowledged";
		break;
		case "admin":
		return "Admin";
		break;
		case "admin/auto-acknowledged":
		return "Admin/Auto-acknowledged";
		break;
		default:
		return "Undetermined";
		break;
	}
}



?>