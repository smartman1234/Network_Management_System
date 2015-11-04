<?php


$time = "123";

echo "time before: " . $time;

function sc(){
	global $time;
	echo "time inside : " . $time;
}


sc();



?>