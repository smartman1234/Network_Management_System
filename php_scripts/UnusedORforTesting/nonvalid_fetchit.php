<!-- non valid right now, replaced by curl_manipulation.php -->

<?php

// it is the data fetch code, sampled from opennms official developer guide 
function fetchit($thing, $user = "admin", $pass = "admin") {
    $url = "http://172.16.181.62:8980/opennms";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url . $thing);
    curl_setopt($ch, CURLOPT_HEADER, 0)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    curl_setopt($ch, CURLOPT_USERPWD, $user.':'.$pass);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}


?>