<?php

function is_online_for_inventory($id){






	require "nodeidInElementToArray.php";



	if (in_array($id, $nodeid_online)) {
		return "Online";
	}else{

		return "Offline";

	}





	
}






?>




