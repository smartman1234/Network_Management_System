<?php
ini_set('display_errors', 1);

$path = 'C:\Program Files\OpenNMS\etc\discovery-configuration.xml';




$xml=simplexml_load_file($path) or die("Error: Cannot create object");


// echo $xml->include-range[0]->begin;
foreach ($xml->children() as $item) {
	# code...
	echo $item->begin;
	echo $item->end;
}


echo $xml[0];



?>