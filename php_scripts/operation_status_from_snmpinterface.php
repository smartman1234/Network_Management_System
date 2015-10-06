<?php



function operation_status($id){
	
	switch ($id) {
		case "1":
		return "Up";
		break;
		case "2":
		return "Down";
		break;
		case "3":
		return "Testing";
		break;

		case "4":
		return "Unknown";
		break;
		case "5":
		return "Dormant";
		break;
		case "6":
		return "Not Present";
		break;

		case "7":
		return "Lower Layer Down";
		break;




	}
}



?>