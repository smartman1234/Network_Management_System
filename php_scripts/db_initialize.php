
<?php

$dbconn = pg_connect("host=localhost port=5432 dbname=opennms user=postgres password=admin")
or die('Could not connect: ' . pg_last_error());

?>


