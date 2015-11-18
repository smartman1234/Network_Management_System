<?php

// todo: 0) check if the db existi=;if not create; 1) receive the post of each value2) calculate the difference value and validate thme, 3) store all value into it 

require("daemon_db_init.php");

$loutputopticalpower1=$_POST["loutputopticalpower1"];
$inputopticalpower1=$_POST["inputopticalpower1"];
$pumptemp11=$_POST["pumptemp11"];
$pumptemp21=$_POST["pumptemp21"];
$pumptemp31=$_POST["pumptemp31"];
$dc5v1=$_POST["dc5v1"];
$dcminor5v1=$_POST["dcminor5v1"];
$dc33v1=$_POST["dc33v1"];
$dc12v1=$_POST["dc12v1"];
$left5v1=$_POST["left5v1"];
$right5v1=$_POST["right5v1"];
$leftminor5v1=$_POST["leftminor5v1"];
$rightminor5v1=$_POST["rightminor5v1"];
$loutputopticalpower2=$_POST["loutputopticalpower2"];
$inputopticalpower2=$_POST["inputopticalpower2"];
$pumptemp12=$_POST["pumptemp12"];
$pumptemp22=$_POST["pumptemp22"];
$pumptemp32=$_POST["pumptemp32"];
$dc5v2=$_POST["dc5v2"];
$dcminor5v2=$_POST["dcminor5v2"];
$dc33v2=$_POST["dc33v2"];
$dc12v2=$_POST["dc12v2"];
$left5v2=$_POST["left5v2"];
$right5v2=$_POST["right5v2"];
$leftminor5v2=$_POST["leftminor5v2"];
$rightminor5v2=$_POST["rightminor5v2"];
$loutputopticalpower3=$_POST["loutputopticalpower3"];
$inputopticalpower3=$_POST["inputopticalpower3"];
$pumptemp13=$_POST["pumptemp13"];
$pumptemp23=$_POST["pumptemp23"];
$pumptemp33=$_POST["pumptemp33"];
$dc5v3=$_POST["dc5v3"];
$dcminor5v3=$_POST["dcminor5v3"];
$dc33v3=$_POST["dc33v3"];
$dc12v3=$_POST["dc12v3"];
$left5v3=$_POST["left5v3"];
$right5v3=$_POST["right5v3"];
$leftminor5v3=$_POST["leftminor5v3"];
$rightminor5v3=$_POST["rightminor5v3"];
$loutputopticalpower4=$_POST["loutputopticalpower4"];
$inputopticalpower4=$_POST["inputopticalpower4"];
$pumptemp14=$_POST["pumptemp14"];
$pumptemp24=$_POST["pumptemp24"];
$pumptemp34=$_POST["pumptemp34"];
$dc5v4=$_POST["dc5v4"];
$dcminor5v4=$_POST["dcminor5v4"];
$dc33v4=$_POST["dc33v4"];
$dc12v4=$_POST["dc12v4"];
$left5v4=$_POST["left5v4"];
$right5v4=$_POST["right5v4"];
$leftminor5v4=$_POST["leftminor5v4"];
$rightminor5v4=$_POST["rightminor5v4"];
$loutputopticalpower7=$_POST["loutputopticalpower7"];
$inputopticalpower7=$_POST["inputopticalpower7"];
$pumptemp17=$_POST["pumptemp17"];
$pumptemp27=$_POST["pumptemp27"];
$pumptemp37=$_POST["pumptemp37"];
$dc5v7=$_POST["dc5v7"];
$dcminor5v7=$_POST["dcminor5v7"];
$dc33v7=$_POST["dc33v7"];
$dc12v7=$_POST["dc12v7"];
$left5v7=$_POST["left5v7"];
$right5v7=$_POST["right5v7"];
$leftminor5v7=$_POST["leftminor5v7"];
$rightminor5v7=$_POST["rightminor5v7"];


$loutputopticalpower=valegfa($loutputopticalpower1,$loutputopticalpower2,$loutputopticalpower3,$loutputopticalpower4,$loutputopticalpower7);
$inputopticalpower=valegfa($inputopticalpower1,$inputopticalpower2,$inputopticalpower3,$inputopticalpower4,$inputopticalpower7);
$pumptemp1=valegfa($pumptemp11,$pumptemp12,$pumptemp13,$pumptemp14,$pumptemp17);
$pumptemp2=valegfa($pumptemp21,$pumptemp22,$pumptemp23,$pumptemp24,$pumptemp27);
$pumptemp3=valegfa($pumptemp31,$pumptemp32,$pumptemp33,$pumptemp34,$pumptemp37);
$dc5v=valegfa($dc5v1,$dc5v2,$dc5v3,$dc5v4,$dc5v7);
$dcminor5v=valegfa($dcminor5v1,$dcminor5v2,$dcminor5v3,$dcminor5v4,$dcminor5v7);
$dc33v=valegfa($dc33v1,$dc33v2,$dc33v3,$dc33v4,$dc33v7);
$dc12v=valegfa($dc12v1,$dc12v2,$dc12v3,$dc12v4,$dc12v7);
$left5v=valegfa($left5v1,$left5v2,$left5v3,$left5v4,$left5v7);
$right5v=valegfa($right5v1,$right5v2,$right5v3,$right5v4,$right5v7);
$leftminor5v=valegfa($leftminor5v1,$leftminor5v2,$leftminor5v3,$leftminor5v4,$leftminor5v7);
$rightminor5v=valegfa($rightminor5v1,$rightminor5v2,$rightminor5v3,$rightminor5v4,$rightminor5v7);

////////////////////////////
/// check the database existence, if not, create it 
$query_exist = "SELECT relname FROM pg_class 
WHERE relname = 'daemonalarmthresegfa';";

$result_exist = pg_query($query_exist) or die('Query failed: ' . pg_last_error());

$exist = '';
while ($row_exist = pg_fetch_object($result_exist)){

	$exist = $row_exist->relname;

}

// // 3, if not existed, create it 
if ($exist != "daemonalarmthresegfa") {
# code...
	$query_construct = "CREATE TABLE PUBLIC.daemonalarmthresegfa(
		loutputopticalpower1 TEXT,
		inputopticalpower1 TEXT,
		pumptemp11 TEXT,
		pumptemp21 TEXT,
		pumptemp31 TEXT,
		dc5v1 TEXT,
		dcminor5v1 TEXT,
		dc33v1 TEXT,
		dc12v1 TEXT,
		left5v1 TEXT,
		right5v1 TEXT,
		leftminor5v1 TEXT,
		rightminor5v1 TEXT,
		loutputopticalpower2 TEXT,
		inputopticalpower2 TEXT,
		pumptemp12 TEXT,
		pumptemp22 TEXT,
		pumptemp32 TEXT,
		dc5v2 TEXT,
		dcminor5v2 TEXT,
		dc33v2 TEXT,
		dc12v2 TEXT,
		left5v2 TEXT,
		right5v2 TEXT,
		leftminor5v2 TEXT,
		rightminor5v2 TEXT,
		loutputopticalpower3 TEXT,
		inputopticalpower3 TEXT,
		pumptemp13 TEXT,
		pumptemp23 TEXT,
		pumptemp33 TEXT,
		dc5v3 TEXT,
		dcminor5v3 TEXT,
		dc33v3 TEXT,
		dc12v3 TEXT,
		left5v3 TEXT,
		right5v3 TEXT,
		leftminor5v3 TEXT,
		rightminor5v3 TEXT,
		loutputopticalpower4 TEXT,
		inputopticalpower4 TEXT,
		pumptemp14 TEXT,
		pumptemp24 TEXT,
		pumptemp34 TEXT,
		dc5v4 TEXT,
		dcminor5v4 TEXT,
		dc33v4 TEXT,
		dc12v4 TEXT,
		left5v4 TEXT,
		right5v4 TEXT,
		leftminor5v4 TEXT,
		rightminor5v4 TEXT,
		loutputopticalpower5 TEXT,
		inputopticalpower5 TEXT,
		pumptemp15 TEXT,
		pumptemp25 TEXT,
		pumptemp35 TEXT,
		dc5v5 TEXT,
		dcminor5v5 TEXT,
		dc33v5 TEXT,
		dc12v5 TEXT,
		left5v5 TEXT,
		right5v5 TEXT,
		leftminor5v5 TEXT,
		rightminor5v5 TEXT   );";

	$result_construct = pg_query($query_construct) or die('Query failed: ' . pg_last_error());
	pg_free_result($result_construct);



}

// create done 
/////////////


$query_insert = "INSERT INTO PUBLIC.daemonalarmthresegfa VALUES (
	$loutputopticalpower[0],
	$inputopticalpower[0],
	$pumptemp1[0],
	$pumptemp2[0],
	$pumptemp3[0],
	$dc5v[0],
	$dcminor5v[0],
	$dc33v[0],
	$dc12v[0],
	$left5v[0],
	$right5v[0],
	$leftminor5v[0],
	$rightminor5v[0],
	$loutputopticalpower[1],
	$inputopticalpower[1],
	$pumptemp1[1],
	$pumptemp2[1],
	$pumptemp3[1],
	$dc5v[1],
	$dcminor5v[1],
	$dc33v[1],
	$dc12v[1],
	$left5v[1],
	$right5v[1],
	$leftminor5v[1],
	$rightminor5v[1],
	$loutputopticalpower[2],
	$inputopticalpower[2],
	$pumptemp1[2],
	$pumptemp2[2],
	$pumptemp3[2],
	$dc5v[2],
	$dcminor5v[2],
	$dc33v[2],
	$dc12v[2],
	$left5v[2],
	$right5v[2],
	$leftminor5v[2],
	$rightminor5v[2],
	$loutputopticalpower[3],
	$inputopticalpower[3],
	$pumptemp1[3],
	$pumptemp2[3],
	$pumptemp3[3],
	$dc5v[3],
	$dcminor5v[3],
	$dc33v[3],
	$dc12v[3],
	$left5v[3],
	$right5v[3],
	$leftminor5v[3],
	$rightminor5v[3],
	$loutputopticalpower[4],
	$inputopticalpower[4],
	$pumptemp1[4],
	$pumptemp2[4],
	$pumptemp3[4],
	$dc5v[4],
	$dcminor5v[4],
	$dc33v[4],
	$dc12v[4],
	$left5v[4],
	$right5v[4],
	$leftminor5v[4],
	$rightminor5v[4]   );";


$result_insert = pg_query($query_insert) or die('Query failed: ' . pg_last_error());
pg_free_result($result_insert);


function valegfa($a, $b, $c, $d, $e){
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

echo "<br>";

echo "<br>";
	echo "<h2>The alarm configuration has been setup.</h2>";
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