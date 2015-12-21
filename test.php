<?php
/**
 * @Author: yuwang
 * @Date:   2015-12-18 14:56:55
 * @Last Modified by:   yuwang
 * @Last Modified time: 2015-12-21 14:28:16
 */

require_once "php_scripts/email_generic.php";

echo "testing email";

$to_address="yu.wang@electroline.com";
$subject="test to electroline email";
$body="test";



sendEmail($to_address, $subject, $body);



?>