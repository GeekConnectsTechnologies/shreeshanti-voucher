<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function sendEmail($toemail,$image)
{
	$imagepath='uploads/'.$image.'.jpg';
	$mail = new PHPMailer(true);
	try {
	    //Server settings
	    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
	    $mail->isSMTP();                                            //Send using SMTP
	    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	    $mail->Username   = 'shyamkhatri1999@gmail.com';                     //SMTP username
	    $mail->Password   = 'payal1998';                               //SMTP password
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

	    //Recipients
	    $mail->setFrom('shyamkhatri1999@gmail.com');
	    $mail->addAddress($toemail);     //Add a recipient


	    //Attachments
	    $mail->addAttachment($imagepath);         //Add attachments

	    //Content
	    $mail->isHTML(true);                                  //Set email format to HTML
	    $mail->Subject = 'Voucher Generated';
	    $mail->Body    = '<h2>Voucher Generated</h2>';

	    $mail->send();
		echo 'Message has been sent';

	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

	}

}
//Create an instance; passing `true` enables exceptions


// require('fpdf.php');
// 	$pdf=new FPDF();
// 	$pdf->AddPage();
// 	$pdf->Image("uploads/11.jpg",0,0,210,220);
// 	$pdf->Output("uploads/11.pdf","F");

	// $mail->isSMTP();
	// $mail->Host='smtp.gmail.com';
	// $mail->Port=465;
	// $mail->SMTPSecure="tls";
	// $mail->SMTPAuth=true;
	// $mail->Username="shyamkhatri1999@gmail.com";
	// $mail->Password="payal1998";
	// $mail->setFrom("shyamkhatri1999@gmail.com");
	// $mail->addAddress("heetkalaria@yahoo.com");
	// $mail->isHTML(true);
	// $mail->Subjet="Voucher Generated";
	// $mail->Body="Voucher Generated";
	// $mail->addAttachment("uploads/12.jpg");
	// $mail->SMTPOptions=array("ssl"=>array(
	// 	"verify_peer"=>false,
	// 	"verify_peer_name"=>false,
	// 	"allow_self_signed"=>false,
	// ));
	// if($mail->send()){
	// 	echo "Send";
	// }else{
	// 	echo $mail->ErrorInfo;
	// }
    
// //Import PHPMailer classes into the global namespace
// //These must be at the top of your script, not inside a function


	

?>