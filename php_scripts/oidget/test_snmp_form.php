<?php


$ip = $_POST["ip"];

// session_start();
// $_SESSION['ip'] = $_POST["ip"];


$id = 0;

switch ($ip) {
	case '10.100.0.50':
		# code...
		$id = 50;
		break;

	case '10.100.0.80':
		# code...
		$id = 80;
		break;

	case '10.100.0.102':
		# code...
	$id = 102;
		break;

}

switch ($id) {
	case 50:
		# code...
		require("test1550.php");
		break;
	


	case 80:
		# code...
		require("testelink.php");
		break;

	case 102:
		# code...
		require("testegfa.php");
		break;

	default:
		# code...
		echo "No this Device";
		break;
}


?>