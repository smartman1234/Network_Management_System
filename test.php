<?php
// $dbpath = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/daemon_scr/daemon_db_init.php";
// require_once($dbpath);  // to initialize snmp 

// $query = "SELECT 
// dameonsnmp1550value.time, 
// dameonsnmp1550value.lasertemperature
// FROM 
// public.dameonsnmp1550value;;";
// $result = pg_query($query) or die('Query failed: ' . pg_last_error());

// $time=[];
// $temp=[];

// while ($row = pg_fetch_object($result)) {	
// 	$time[]=$row->time;
// 	$temp[]=floatval($row->lasertemperature);
	
// }

// pg_free_result($result);
// pg_close($dbconn);


$label = "laser";
	$ydata = array(6, 3, 8, 5, 15, 16, 19); 

	/*
	We're not going to set the values for the X axis.
	*/ 
	$xdata = array(0, 1, 2, 3, 4, 5, 6); 

	plotGraph($label, $xdata, $ydata);



function plotGraph($lable, $x, $y){
	/*
	Include JpGraph in your script. Note that jpgraph.php should reside in a directory that's present in your PHP INCLUDE_PATH, otherwise specify the full path yourself.
	*/ 
	require_once('php_scripts/jpgraph/src/jpgraph.php'); 
	/*
	Include the module for creating line graph plots.
	*/ 
	require_once('php_scripts/jpgraph/src/jpgraph_line.php'); 

	// Include the module for creating line graph plots. 
	$ydata = array(6, 3, 8, 5, 15, 16, 19); 

	/*
	We're not going to set the values for the X axis.
	*/ 
	$xdata = array(0, 1, 2, 3, 4, 5, 6); 

	/*
	Let's create a Graph instance and set some variables (width, height, cache filename, cache timeout). If the last argument "inline" is true the image is streamed back to the browser, otherwise it's only created in the cache.
	*/ 
	$graph = new Graph(800, 600, 'auto', 10, true); 

	// Setting what axises to use
	$graph->SetScale('textlin'); 

	/*
	Next, we need to create a LinePlot with some example parameters.
	*/ 
	$lineplot = new LinePlot($ydata, $xdata); 

	// Setting the LinePlot color
	$lineplot->SetColor('forestgreen'); 

	// Adding LinePlot to graphic 
	$graph->Add($lineplot); 

	// Giving graphic a name
	$graph->title->Set('Time-series Status Graph'); 

	/*
	If the graph is going to have labels with international characters, make sure to use a TrueType font that includes the required characters, e.g. Arial.
	*/ 
	//$graph->title->SetFont(FF_ARIAL, FS_NORMAL); 
	//$graph->xaxis->title->SetFont(FF_VERDANA, FS_ITALIC); 
	//$graph->yaxis->title->SetFont(FF_TIMES, FS_BOLD); 

	// Naming axises 
	$graph->xaxis->title->Set('Time'); 
	$graph->yaxis->title->Set('Status Value'); 

	// Coloring axises
	$graph->xaxis->SetColor('#СС0000'); 
	$graph->yaxis->SetColor('#СС0000'); 

	// Setting the LinePlot width 
	$lineplot->SetWeight(3); 

	// To define a marker type, we denote dots as asterisks 
	$lineplot->mark->SetType(MARK_FILLEDCIRCLE); 

	// Showing value above each dot 
	$lineplot->value->Show(); 

	// Filling background with a gradient
	$graph->SetBackgroundGradient('ivory', 'blue'); 

	// Adding a shadow
	$graph->SetShadow(4); 

	/* 
	Showing image in browser. If, when creating an graph object, the last parameter is false, the image would be saved in cache and not showed in browser.
	*/  
	  
	$graph->Stroke("sample.jpg"); 

}


?>