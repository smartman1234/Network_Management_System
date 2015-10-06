<?php


function visulize_severe($severe) {
	if($severe=="6") return "<a style=color:#DC143C>High-High</a>";
	if($severe=="5") return "<a style=color:#DB7093>High</a>";
	if($severe=="4") return "<a style=color:#CD853F>Intermediate</a>";
	if($severe=="3") return "<a style=color:#8A2BE2>Low</a>";
	if($severe=="2") return "<a style=color:#6B8E23>Low-Low</a>";
	if($severe=="No alarm") return "No alarm";


}



?>