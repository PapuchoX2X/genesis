<?php
//
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'email/vendor/autoload.php';

//

if(empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(500);
  exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

$to = "info@siawebsoft.com"; 
$subject = "$m_subject:  $name";
$body = "Has recibido un nuevo mensaje del formulario de contacto de tu www.siawebsoft.com\n\n"."Aquí están los detalles:\n\nNombre: $name\n\n\nEmail: $email\n\nAsunto: $m_subject\n\nMensage: $message";

$mail = new PHPMailer(true);
try {
	//Server settings
	$mail->isSMTP();                                            
	$mail->Host       = 'mail.siawebsoft.com';                     
	$mail->SMTPAuth   = true;                                   
	$mail->Username   = 'info@siawebsoft.com';                 
	$mail->Password   = 'siainfo2025';                         
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
	$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
	
	$mail->setFrom('info@siawebsoft.com', 'GENESIS');
    $mail->addAddress($email, 'formulario contacto');
    $mail->isHTML(true); // Indica que el correo es HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;
	
	$mail->send();
	
	echo json_encode(array('success'=>true));
} catch (Exception $e) {
	echo json_encode(array('msg'=>" Mailer Error: {$mail->ErrorInfo}"));
}
?>
