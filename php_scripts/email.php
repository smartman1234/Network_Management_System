<?php
// $attachment
function sendEmail($to_address, $subject, $body){

require_once ('PHPMailer/class.phpmailer.php');
require_once ("PHPMailer/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail = new PHPMailer ( true ); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP (); // telling the class to use SMTP

try {
	$mail->Host = "mail2k7.electroline.local"; // SMTP server
	$mail->SMTPDebug = 1; // enables SMTP debug information (for testing)

	
	$mail->Port = 25; // set the SMTP port for the GMAIL server
	$mail->Username = "electroline_nms_no_reply@electroline.com"; // SMTP account username
	// $mail->Password = "Eline123"; // SMTP account password
$mail->IsHTML(true);	
	$mail->AddAddress ( $to_address, 'Electroline NMS Admin' );
	$mail->SetFrom ( 'electroline_nms_no_reply@electroline.com', 'Electroline NMS' );
	
	$mail->Subject = $subject;
	$mail->Body = $body;
	//$mail->AddAttachment($attachment);
	$mail->Send ();
	
	// echo '<script language="javascript">';
	// echo 'alert("The alert email with requested information has been sent to the target email address successfully!")';
	// echo '</script>';


} catch ( phpmailerException $e ) {
	echo $e->errorMessage (); // Pretty error messages from PHPMailer
} catch ( Exception $e ) {
	echo $e->getMessage (); // Boring error messages from anything else!
}

// echo "<h3></h3>";
// echo "<h3></h3>";
// echo "<h3></h3>";
// echo "<h3></h3>";
// echo "<h3></h3>";
// echo "<h3></h3>";
// echo "<a href=alarm_list.html><img src=image/back.png alt=Back style=width:250px;height:170px;></a>";


// $server = $_SERVER['SERVER_ADDR'];
// $serverIp = gethostbyname(gethostname());
// $server_port = $_SERVER['SERVER_PORT'];

// $cl = $_SERVER['REMOTE_ADDR'];


// $u = "http://" . $serverIp . ":" . $server_port . "/vanguardhe/alarm_list.html";



//header('Location: '.$u);

}


?>

