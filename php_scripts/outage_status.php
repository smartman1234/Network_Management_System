<?php


function outage_status($uptime) {
	if($uptime=="") return "<a style=color:#DC143C>Unsolved</a>";
	if($uptime!="") return "<a style=color:#8A2BE2>Solved</a>";
	
}



?>