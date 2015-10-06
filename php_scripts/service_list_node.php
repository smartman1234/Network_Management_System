<!DOCTYPE html>
<html>

<head>
	<title>Node Service <?php echo $_GET['nodeid'];?></title>
	<link rel="Electroline icon" href="image/icon.ico" />
	<link href="style/style.css" rel="stylesheet">
</head>

<body>

	<div id="main">
		<h1>Service List of Node <?php echo $_GET['nodeid'];?></h1>

		<?php

		$nodeid = $_GET['nodeid'];
		require "db_init.php";
		require "service_id.php";

		$query = "SELECT   
		ifservices.serviceid
		FROM 
		public.ifservices

		WHERE
		ifservices.nodeid=$nodeid
		ORDER BY
		ifservices.serviceid ASC
		;";
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());

		echo "<table width=300>\n";
		echo "\t<tr>\n";
		echo "<td align=center><b>Supported Services</b></td>";


		while ($row = pg_fetch_object($result)) {
			echo "\t<tr>\n";
			$service = service_id($row->serviceid);
			echo "\t\t<td align=center>$service</td>";
			echo "\t</tr>\n";
		}

		?>

		<h3></h3>
		<h3></h3>
		<h3></h3>
		<h3></h3>
		<h3></h3>
		<h3></h3>

	</div>

	<FORM><INPUT Type="button" VALUE="Back to alarm list" onClick="history.go(-1);return true;"></FORM>
	<h3></h3>
		<h3></h3>
		<h3></h3>
		<h3></h3>
		<h3></h3>
		<h3></h3>


</body>
</html>