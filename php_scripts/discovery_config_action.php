<?php

$path = 'C:\Program Files\OpenNMS\etc\discovery-configuration.xml';


$ipbegin[0] = $_POST["ipbegin1"];
$ipend[0] = $_POST["ipend1"];
$retries[0] = $_POST["retries1"];
$timeout[0] = $_POST["timeout1"];

$ipbegin[1] = $_POST["ipbegin2"];
$ipend[1] = $_POST["ipend2"];
$retries[1] = $_POST["retries2"];
$timeout[1] = $_POST["timeout2"];

$ipbegin[2] = $_POST["ipbegin3"];
$ipend[2] = $_POST["ipend3"];
$retries[2] = $_POST["retries3"];
$timeout[2] = $_POST["timeout3"];


for ($i=0; $i < 3; $i++) { 
	# code...
	if ($ipbegin[$i] != "" && $ipend[$i] != "") {
		# code...
		echo "The IP range from " . $ipbegin[$i] , " to " . $ipend[$i]. " has been supplemented into XML configuration file.";
		echo "<br>";
		addEntry($path, $ipbegin[$i], $ipend[$i]);
	}

	
}




displayEntry($path);



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





function addEntry($file, $begin, $end){

	$xml=simplexml_load_file($file) or die("Error: Cannot create object");
	if (!isset($xml->children()->$begin) && !isset($xml->children()->$end)) {
		$ir = $xml->addChild('include-range ');
		$ir->addChild("begin", $begin);
		$ir->addChild("end", $end);
		file_put_contents($file, $xml->asXML());
	}
	

}


function displayEntry($file){
	echo "<br> Current valid auto-discovery ranges are: <br>";
	echo "------------<br>";
	$xml=simplexml_load_file($file) or die("Error: Cannot create object");
	foreach ($xml->children() as $item) {
	# code...
		echo "IP Begin: " . $item->begin . "<br>";
		echo "IP End: " . $item->end. "<br>";
		echo "------------<br>";
	}




}








?>


