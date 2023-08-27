<?php

//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
function sendMail($id, $email, $name, $VN, $timeslot)
{
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    $mailFileName = $name;
    $mailFileName .= "'s booking reciept";

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = 'patelmotordrivingschool.noreply@gmail.com'; //SMTP username
        $mail->Password = ''; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
        $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('patelmotordrivingschool.noreply@gmail.com', 'Patel Motor Driving School');
        $mail->addAddress($email, $name); //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');


        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        $mail->addAttachment('addmission_pdf/test.pdf', $mailFileName); //Optional name

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = 'Booking Receipt - Patel Motor Driving School';
        $mail->Body = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Booking Receipt</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    font-size: 14px;
                    line-height: 1.6;
                    margin: 0;
                    padding: 0;
                    background-color: #eee;
                }
                
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                }
                
                h2 {
                    color: #333;
                }
                
                p {
                    margin-bottom: 20px;
                }
                
                mark {
                    background-color: #f0f0f0;
                    padding: 2px 5px;
                }
        
                .header {
                    /* display: flex;
                    justify-content: space-between;
                    align-items: center; */
                    text-align: center;
                    margin: 20px 0;
                }
        
                .header img.logo {
                    max-width: 70px;
                    height: auto;
                    margin-right: 10px;
                }
        
                .header img.name-logo {
                    max-width: 180px;
                    height: auto;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <!-- <img class="logo" src="https://cdn.discordapp.com/attachments/839435729993072660/1136989550099583096/logo.png" alt="Company Logo"> -->
                    <img class="name-logo" src="https://cdn.discordapp.com/attachments/839435729993072660/1136988864150507551/name2.png" alt="Company name logo">
                    <!-- <p></p> -->
                </div>
                <h2>Booking Receipt</h2>
                <p>Dear <b>'.$name.'</b>,</p>
                
                <p>Thank you for choosing Patel Motor Driving School for your booking. We are pleased to provide you with the details of your reservation. Please find attached the PDF booking receipt for your reference.</p>
                
                <p>To complete the booking process, we kindly request you to visit our office and collect a hardcopy of the booking receipt. You can collect the original hardcopy from Hemal Patel, our authorized representative, who will be available during office hours.</p>
                
                <p>If you have any questions or require further assistance, please do not hesitate to contact our customer service at  <mark><a href="tel:+919876543210">+91 9876543210</a></mark></p>
                
                <p>Best regards,<br>
                <b>Patel Motor Driving School</b></p>
            </div>
        </body>
        </html>
        
        

        ';
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        // echo 'Message has been sent';
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

require_once('lib/dompdf/autoload.inc.php');

require "mailGeneratedPDF.php";

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('chroot', realpath(''));
$pdf = new Dompdf($options);


ob_start();

include('previewPDF.php');

$htmlCode = ob_get_clean();


$pdf->loadHtml($htmlCode);

$pdf->setPaper('A4', 'portrait');

$pdf->render();

// // Save the PDF to the "ADMISSION_PDF" folder
// $savePath = 'addmission_pdf/test.pdf';
// file_put_contents($savePath, $pdf->output());

// Output the PDF for preview
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="test.pdf"');
echo $pdf->output();

mailReceipt($phone, $email, $name);
sendMail($phone, $email, $name, $VN, $timeslot);

?>