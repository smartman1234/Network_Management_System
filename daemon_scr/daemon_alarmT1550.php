<?php

// todo: 0) check if the db existi=;if not create; 1) receive the post of each value2) calculate the difference value and validate thme, 3) store all value into it 

require("daemon_db_init.php");

$laserim1=$_POST["laserim1"];
$lasertemperature1=$_POST["lasertemperature1"];
$laserbias1=$_POST["laserbias1"];
$rfmodulationlevel1=$_POST["rfmodulationlevel1"];
$dc24vvoltage1=$_POST["dc24vvoltage1"];
$dc12vvoltage1=$_POST["dc12vvoltage1"];
$dc5vvoltage1=$_POST["dc5vvoltage1"];
$minor5vdcvoltage1=$_POST["minor5vdcvoltage1"];
$txopticalpower1=$_POST["txopticalpower1"];
$txrfmodulelevel1=$_POST["txrfmodulelevel1"];
$laserim2=$_POST["laserim2"];
$lasertemperature2=$_POST["lasertemperature2"];
$laserbias2=$_POST["laserbias2"];
$rfmodulationlevel2=$_POST["rfmodulationlevel2"];
$dc24vvoltage2=$_POST["dc24vvoltage2"];
$dc12vvoltage2=$_POST["dc12vvoltage2"];
$dc5vvoltage2=$_POST["dc5vvoltage2"];
$minor5vdcvoltage2=$_POST["minor5vdcvoltage2"];
$txopticalpower2=$_POST["txopticalpower2"];
$txrfmodulelevel2=$_POST["txrfmodulelevel2"];
$laserim3=$_POST["laserim3"];
$lasertemperature3=$_POST["lasertemperature3"];
$laserbias3=$_POST["laserbias3"];
$rfmodulationlevel3=$_POST["rfmodulationlevel3"];
$dc24vvoltage3=$_POST["dc24vvoltage3"];
$dc12vvoltage3=$_POST["dc12vvoltage3"];
$dc5vvoltage3=$_POST["dc5vvoltage3"];
$minor5vdcvoltage3=$_POST["minor5vdcvoltage3"];
$txopticalpower3=$_POST["txopticalpower3"];
$txrfmodulelevel3=$_POST["txrfmodulelevel3"];
$laserim4=$_POST["laserim4"];
$lasertemperature4=$_POST["lasertemperature4"];
$laserbias4=$_POST["laserbias4"];
$rfmodulationlevel4=$_POST["rfmodulationlevel4"];
$dc24vvoltage4=$_POST["dc24vvoltage4"];
$dc12vvoltage4=$_POST["dc12vvoltage4"];
$dc5vvoltage4=$_POST["dc5vvoltage4"];
$minor5vdcvoltage4=$_POST["minor5vdcvoltage4"];
$txopticalpower4=$_POST["txopticalpower4"];
$txrfmodulelevel4=$_POST["txrfmodulelevel4"];
$laserim7=$_POST["laserim7"];
$lasertemperature7=$_POST["lasertemperature7"];
$laserbias7=$_POST["laserbias7"];
$rfmodulationlevel7=$_POST["rfmodulationlevel7"];
$dc24vvoltage7=$_POST["dc24vvoltage7"];
$dc12vvoltage7=$_POST["dc12vvoltage7"];
$dc5vvoltage7=$_POST["dc5vvoltage7"];
$minor5vdcvoltage7=$_POST["minor5vdcvoltage7"];
$txopticalpower7=$_POST["txopticalpower7"];
$txrfmodulelevel7=$_POST["txrfmodulelevel7"];


$laserim=val1550($laserim1,$laserim2,$laserim3,$laserim4,$laserim7);
$lasertemperature=val1550($lasertemperature1,$lasertemperature2,$lasertemperature3,$lasertemperature4,$lasertemperature7);
$laserbias=val1550($laserbias1,$laserbias2,$laserbias3,$laserbias4,$laserbias7);
$rfmodulationlevel=val1550($rfmodulationlevel1,$rfmodulationlevel2,$rfmodulationlevel3,$rfmodulationlevel4,$rfmodulationlevel7);
$dc24vvoltage=val1550($dc24vvoltage1,$dc24vvoltage2,$dc24vvoltage3,$dc24vvoltage4,$dc24vvoltage7);
$dc12vvoltage=val1550($dc12vvoltage1,$dc12vvoltage2,$dc12vvoltage3,$dc12vvoltage4,$dc12vvoltage7);
$dc5vvoltage=val1550($dc5vvoltage1,$dc5vvoltage2,$dc5vvoltage3,$dc5vvoltage4,$dc5vvoltage7);
$minor5vdcvoltage=val1550($minor5vdcvoltage1,$minor5vdcvoltage2,$minor5vdcvoltage3,$minor5vdcvoltage4,$minor5vdcvoltage7);
$txopticalpower=val1550($txopticalpower1,$txopticalpower2,$txopticalpower3,$txopticalpower4,$txopticalpower7);
$txrfmodulelevel=val1550($txrfmodulelevel1,$txrfmodulelevel2,$txrfmodulelevel3,$txrfmodulelevel4,$txrfmodulelevel7);

////////////////////////////
/// check the database existence, if not, create it 
$query_exist = "SELECT relname FROM pg_class 
WHERE relname = 'daemonalarmthres1550';";

$result_exist = pg_query($query_exist) or die('Query failed: ' . pg_last_error());

$exist = '';
while ($row_exist = pg_fetch_object($result_exist)){

	$exist = $row_exist->relname;

}

// // 3, if not existed, create it 
if ($exist != "daemonalarmthres1550") {
# code...
	$query_construct = "CREATE TABLE PUBLIC.daemonalarmthres1550(
		laserim1, 	TEXT, 
		lasertemperature1, 	TEXT, 
		laserbias1, 	TEXT, 
		rfmodulationlevel1, 	TEXT, 
		dc24vvoltage1, 	TEXT, 
		dc12vvoltage1, 	TEXT, 
		dc5vvoltage1, 	TEXT, 
		minor5vdcvoltage1, 	TEXT, 
		txopticalpower1, 	TEXT, 
		txrfmodulelevel1, 	TEXT, 
		presentacpower1status, 	TEXT, 
		presentacpower2status, 	TEXT,
		laserim2, 	TEXT,
		lasertemperature2, 	TEXT, 
		laserbias2, 	TEXT, 
		rfmodulationlevel2, 	TEXT, 
		dc24vvoltage2, 	TEXT, 
		dc12vvoltage2, 	TEXT, 
		dc5vvoltage2, 	TEXT, 
		minor5vdcvoltage2, 	TEXT, 
		txopticalpower2, 	TEXT, 
		txrfmodulelevel2，
		laserim3, 	TEXT, 
		lasertemperature3, 	TEXT, 
		laserbias3, 	TEXT, 
		rfmodulationlevel3, 	TEXT, 
		dc24vvoltage3, 	TEXT, 
		dc12vvoltage3, 	TEXT, 
		dc5vvoltage3, 	TEXT, 
		minor5vdcvoltage3, 	TEXT, 
		txopticalpower3, 	TEXT, 
		txrfmodulelevel3, 	TEXT, 
		laserim4, 	TEXT, 
		lasertemperature4, 	TEXT, 
		laserbias4, 	TEXT, 
		rfmodulationlevel4, 	TEXT, 
		dc24vvoltage4, 	TEXT, 
		dc12vvoltage4, 	TEXT, 
		dc5vvoltage4, 	TEXT, 
		minor5vdcvoltage4, 	TEXT, 
		txopticalpower4, 	TEXT, 
		txrfmodulelevel4, 	TEXT,
		laserim5, 	TEXT, 
		lasertemperature5, 	TEXT, 
		laserbias5, 	TEXT, 
		rfmodulationlevel5, 	TEXT, 
		dc24vvoltage5, 	TEXT, 
		dc12vvoltage5, 	TEXT, 
		dc5vvoltage5, 	TEXT, 
		minor5vdcvoltage5, 	TEXT, 
		txopticalpower5, 	TEXT, 
		txrfmodulelevel5	TEXT,		);";

	$result_construct = pg_query($query_construct) or die('Query failed: ' . pg_last_error());
	pg_free_result($result_construct);



}

// create done 
/////////////

$query_insert = "INSERT INTO PUBLIC.dameonsnmp1550value VALUES (
	$laserim[0], 
	$lasertemperature[0],
	$laserbias[0],
	$rfmodulationlevel[0],
	$dc24vvoltage[0],
	$dc12vvoltage[0],
	$dc5vvoltage[0],
	$minor5vdcvoltage[0],
	$txopticalpower[0],
	$txrfmodulelevel[0],
	'0',
	'0',
	$laserim[1], 
	$lasertemperature[1],
	$laserbias[1],
	$rfmodulationlevel[1],
	$dc24vvoltage[1],
	$dc12vvoltage[1],
	$dc5vvoltage[1],
	$minor5vdcvoltage[1],
	$txopticalpower[1],
	$txrfmodulelevel[1],
	$laserim[2], 
	$lasertemperature[2],
	$laserbias[2],
	$rfmodulationlevel[2],
	$dc24vvoltage[2],
	$dc12vvoltage[2],
	$dc5vvoltage[2],
	$minor5vdcvoltage[2],
	$txopticalpower[2],
	$txrfmodulelevel[2],
	$laserim[3], 
	$lasertemperature[3],
	$laserbias[3],
	$rfmodulationlevel[3],
	$dc24vvoltage[3],
	$dc12vvoltage[3],
	$dc5vvoltage[3],
	$minor5vdcvoltage[3],
	$txopticalpower[3],
	$txrfmodulelevel[3],
	$laserim[4], 
	$lasertemperature[4],
	$laserbias[4],
	$rfmodulationlevel[4],
	$dc24vvoltage[4],
	$dc12vvoltage[4],
	$dc5vvoltage[4],
	$minor5vdcvoltage[4],
	$txopticalpower[4],
	$txrfmodulelevel[4] );";


$result_insert = pg_query($query_insert) or die('Query failed: ' . pg_last_error());
pg_free_result($result_insert);

function val1550($a, $b, $c, $d, $e){
	$a=floatval($a);
	$b=floatval($b);
	$c=floatval($c);
	$d=floatval($d);
	$e=floatval($e);

	$re[0]="''";
	$re[1]="''";
	$re[2]="''";
	$re[3]="''";
	$re[4]="''";


	if (($a-$e)<($b-$e) && ($b-$e)<($c+$e) && ($c+$e)<($d+$e)) {
		# code...
		$re[0]="'"+strval(($a-$e))+"'";
		$re[1]="'"+strval(($b-$e))+"'";
		$re[2]="'"+strval(($c+$e))+"'";
		$re[3]="'"+strval(($d+$e))+"'";
		$re[4]="'"+strval($e)+"'";
	}
	return $re;

}

?>
