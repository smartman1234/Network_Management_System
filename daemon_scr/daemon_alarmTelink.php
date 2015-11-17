<?php

// ps, rrx, ftx


require("daemon_db_init.php");

$outputv1=$_POST["outputv1"];
$outputma1=$_POST["outputma1"];
$outputw1=$_POST["outputw1"];
$input11=$_POST["input11"];
$input21=$_POST["input21"];
$input31=$_POST["input31"];
$input41=$_POST["input41"];
$lasertemp1=$_POST["lasertemp1"];
$laserbiascurrent1=$_POST["laserbiascurrent1"];
$outputpower1=$_POST["outputpower1"];
$thccurrent1=$_POST["thccurrent1"];
$outputv2=$_POST["outputv2"];
$outputma2=$_POST["outputma2"];
$outputw2=$_POST["outputw2"];
$input12=$_POST["input12"];
$input22=$_POST["input22"];
$input32=$_POST["input32"];
$input42=$_POST["input42"];
$lasertemp2=$_POST["lasertemp2"];
$laserbiascurrent2=$_POST["laserbiascurrent2"];
$outputpower2=$_POST["outputpower2"];
$thccurrent2=$_POST["thccurrent2"];
$outputv3=$_POST["outputv3"];
$outputma3=$_POST["outputma3"];
$outputw3=$_POST["outputw3"];
$input13=$_POST["input13"];
$input23=$_POST["input23"];
$input33=$_POST["input33"];
$input43=$_POST["input43"];
$lasertemp3=$_POST["lasertemp3"];
$laserbiascurrent3=$_POST["laserbiascurrent3"];
$outputpower3=$_POST["outputpower3"];
$thccurrent3=$_POST["thccurrent3"];
$outputv4=$_POST["outputv4"];
$outputma4=$_POST["outputma4"];
$outputw4=$_POST["outputw4"];
$input14=$_POST["input14"];
$input24=$_POST["input24"];
$input34=$_POST["input34"];
$input44=$_POST["input44"];
$lasertemp4=$_POST["lasertemp4"];
$laserbiascurrent4=$_POST["laserbiascurrent4"];
$outputpower4=$_POST["outputpower4"];
$thccurrent4=$_POST["thccurrent4"];
$outputv7=$_POST["outputv7"];
$outputma7=$_POST["outputma7"];
$outputw7=$_POST["outputw7"];
$input17=$_POST["input17"];
$input27=$_POST["input27"];
$input37=$_POST["input37"];
$input47=$_POST["input47"];
$lasertemp7=$_POST["lasertemp7"];
$laserbiascurrent7=$_POST["laserbiascurrent7"];
$outputpower7=$_POST["outputpower7"];
$thccurrent7=$_POST["thccurrent7"];


$outputv=valelink($outputv1,$outputv2,$outputv3,$outputv4,$outputv7);
$outputma=valelink($outputma1,$outputma2,$outputma3,$outputma4,$outputma7);
$outputw=valelink($outputw1,$outputw2,$outputw3,$outputw4,$outputw7);
$input1=valelink($input11,$input12,$input13,$input14,$input17);
$input2=valelink($input21,$input22,$input23,$input24,$input27);
$input3=valelink($input31,$input32,$input33,$input34,$input37);
$input4=valelink($input41,$input42,$input43,$input44,$input47);
$lasertemp=valelink($lasertemp1,$lasertemp2,$lasertemp3,$lasertemp4,$lasertemp7);
$laserbiascurrent=valelink($laserbiascurrent1,$laserbiascurrent2,$laserbiascurrent3,$laserbiascurrent4,$laserbiascurrent7);
$outputpower=valelink($outputpower1,$outputpower2,$outputpower3,$outputpower4,$outputpower7);
$thccurrent=valelink($thccurrent1,$thccurrent2,$thccurrent3,$thccurrent4,$thccurrent7);



////////////////////////////
/// check the database existence, if not, create it 
$query_exist = "SELECT relname FROM pg_class 
WHERE relname = 'daemonalarmthreselinkps';";

$result_exist = pg_query($query_exist) or die('Query failed: ' . pg_last_error());

$exist = '';
while ($row_exist = pg_fetch_object($result_exist)){

	$exist = $row_exist->relname;

}

// // 3, if not existed, create it 
if ($exist != "daemonalarmthreselinkps") {
# code...
	$query_construct = "CREATE TABLE PUBLIC.daemonalarmthreselinkps(
		outputv1, 	TEXT, 
		outputv2, 	TEXT, 
		outputv3, 	TEXT, 
		outputv4, 	TEXT, 
		outputma1, 	TEXT, 
		outputma2, 	TEXT, 
		outputma3, 	TEXT, 
		outputma4, 	TEXT, 
		outputw1, 	TEXT, 
		outputw2, 	TEXT,
		outputw3, 	TEXT,
		outputw4, 	TEXT  );";

	$result_construct = pg_query($query_construct) or die('Query failed: ' . pg_last_error());
	pg_free_result($result_construct);
}

// create done 
/////////////


////////////////////////////
/// check the database existence, if not, create it 
$query_exist = "SELECT relname FROM pg_class 
WHERE relname = 'daemonalarmthreselinkrrx';";

$result_exist = pg_query($query_exist) or die('Query failed: ' . pg_last_error());

$exist = '';
while ($row_exist = pg_fetch_object($result_exist)){

	$exist = $row_exist->relname;

}

// // 3, if not existed, create it 
if ($exist != "daemonalarmthreselinkrrx") {
# code...
	$query_construct = "CREATE TABLE PUBLIC.daemonalarmthreselinkrrx(
		input11, 	TEXT, 
		input12, 	TEXT, 
		input13, 	TEXT, 
		input14, 	TEXT, 
		input21, 	TEXT, 
		input22, 	TEXT, 
		input23, 	TEXT, 
		input24, 	TEXT, 
		input31, 	TEXT, 
		input32, 	TEXT,
		input33, 	TEXT,
		input34, 	TEXT,
		input41, 	TEXT, 
		input42, 	TEXT,
		input43, 	TEXT,
		input44, 	TEXT   );";

	$result_construct = pg_query($query_construct) or die('Query failed: ' . pg_last_error());
	pg_free_result($result_construct);
}

// create done 
/////////////


////////////////////////////
/// check the database existence, if not, create it 
$query_exist = "SELECT relname FROM pg_class 
WHERE relname = 'daemonalarmthreselinkftx';";

$result_exist = pg_query($query_exist) or die('Query failed: ' . pg_last_error());

$exist = '';
while ($row_exist = pg_fetch_object($result_exist)){

	$exist = $row_exist->relname;

}

// // 3, if not existed, create it 
if ($exist != "daemonalarmthreselinkftx") {
# code...
	$query_construct = "CREATE TABLE PUBLIC.daemonalarmthreselinkftx(
		lasertemp1, 	TEXT, 
		lasertemp2, 	TEXT, 
		lasertemp3, 	TEXT, 
		lasertemp4, 	TEXT, 
		laserbiascurrent1, 	TEXT, 
		laserbiascurrent2, 	TEXT, 
		laserbiascurrent3, 	TEXT, 
		laserbiascurrent4, 	TEXT, 
		outputpower1, 	TEXT, 
		outputpower2, 	TEXT,
		outputpower3, 	TEXT,
		outputpower4, 	TEXT,
		thccurrent1, 	TEXT, 
		thccurrent2, 	TEXT,
		thccurrent3, 	TEXT,
		thccurrent4, 	TEXT	);";

	$result_construct = pg_query($query_construct) or die('Query failed: ' . pg_last_error());
	pg_free_result($result_construct);
}

// create done 
/////////////



////////////
$query_insert = "INSERT INTO PUBLIC.daemonalarmthreselinkps VALUES (
	$outputv[0],
	$outputma[0],
	$outputw[0],
	$outputv[1],
	$outputma[1],
	$outputw[1],
	$outputv[2],
	$outputma[2],
	$outputw[2],
	$outputv[3],
	$outputma[3],
	$outputw[3],
	$outputv[4],
	$outputma[4],
	$outputw[4]    );";


$result_insert = pg_query($query_insert) or die('Query failed: ' . pg_last_error());
pg_free_result($result_insert);
/////////////

////////////
$query_insert = "INSERT INTO PUBLIC.daemonalarmthreselinkrrx VALUES (
	$input1[0],
	$input2[0],
	$input3[0],
	$input4[0],
	$input1[1],
	$input2[1],
	$input3[1],
	$input4[1],
	$input1[2],
	$input2[2],
	$input3[2],
	$input4[2],
	$input1[3],
	$input2[3],
	$input3[3],
	$input4[3],
	$input1[4],
	$input2[4],
	$input3[4],
	$input4[4]   );";


$result_insert = pg_query($query_insert) or die('Query failed: ' . pg_last_error());
pg_free_result($result_insert);
/////////////

////////////
$query_insert = "INSERT INTO PUBLIC.daemonalarmthreselinkftx VALUES (
	$lasertemp[0],
	$laserbiascurrent[0],
	$outputpower[0],
	$thccurrent[0],
	$lasertemp[1],
	$laserbiascurrent[1],
	$outputpower[1],
	$thccurrent[1],
	$lasertemp[2],
	$laserbiascurrent[2],
	$outputpower[2],
	$thccurrent[2],
	$lasertemp[3],
	$laserbiascurrent[3],
	$outputpower[3],
	$thccurrent[3],
	$lasertemp[4],
	$laserbiascurrent[4],
	$outputpower[4],
	$thccurrent[4]  );";


$result_insert = pg_query($query_insert) or die('Query failed: ' . pg_last_error());
pg_free_result($result_insert);
/////////////



function valelink($a, $b, $c, $d, $e){
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