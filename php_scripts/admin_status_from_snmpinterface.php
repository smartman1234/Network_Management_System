<?php




function admin_status($id){



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

		default:
		return "Undetermined";
		break;
	}
}



?>