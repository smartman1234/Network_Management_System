<?php
// $attachment
// vanguardhe	headendplatform 

function sendEmail($to_address, $subject, $body){

	require_once ('PHPMailer/class.phpmailer.php');
require_once ("PHPMailer/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail = new PHPMailer ( true ); // the true param means it will throw exceptions on errors, which we need to catch
try {
//Enable SMTP debugging. 
$mail->SMTPDebug = 3;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Provide username and password     
$mail->Username = "vanguardhe@gmail.com";                 
$mail->Password = "headendplatform";                           
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = 'tls';                          
//Set TCP port to connect to 
$mail->Port = 587;                              

$mail->From = "vanguardhe@gmail.com";
$mail->FromName = "Electroline VanguardHE";

$mail->AddAddress ( $to_address, 'Electroline NMS Admin' );


$mail->isHTML(true);

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

