<?php
/**
 * @Author: yuwang
 * @Date:   2015-12-18 14:56:55
 * @Last Modified by:   yuwang
 * @Last Modified time: 2015-12-18 15:09:12
 */

require_once "php_scripts/email.php";

echo "testing email";

$to_address="yu.wang@electroline.com";
$subject="test to electroline email";
$body="test";



for ($i=0; $i < 50000; $i++) { 
	sendEmail($to_address, $subject, $body);
}


?>