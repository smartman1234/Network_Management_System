<?php

$ip[0] = $_POST["ip1"];
$label[0] = $_POST["lb1"];

$ip[1] = $_POST["ip2"];
$label[1] = $_POST["lb2"];

$ip[2] = $_POST["ip3"];
$label[2] = $_POST["lb3"];

for ($i=0; $i < 3; $i++) { 
	# code...
	if ($ip[$i] != "") {
		# code...
		echo "The IP " . $ip[$i] , " labeled as " . $label[$i]. " has been supplemented into XML configuration file.";
		echo "<br>";
	}

	
}




echo "<br>";

echo "<br>";
echo "System needs to take a while for synchorizaiton.";
echo "<br>";
echo "<br>";


echo "<button onclick=closeWin()>Close</button>";
echo
"<script>
function closeWin() {
	window.close();
}
</script>";





?>


