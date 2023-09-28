<?php
date_default_timezone_set('Asia/Kolkata');
function uploadImageToHostedServer($imageFilePath, $uploadUrl)
{
    
    // Initialize cURL
    $ch = curl_init($uploadUrl);

    // Create a cURL file object
    $imageFile = new CURLFile($imageFilePath, mime_content_type($imageFilePath), basename($imageFilePath));

    // Define the POST data
    $postData = [
        'image' => $imageFile,
    ];

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    // Set cURL options
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the cURL request
    $response = curl_exec($ch);


    // Check for cURL errors
    if (curl_errno($ch)) {
        $error = "cURL Error [" . date('Y-m-d H:i:s') . "]: " . curl_error($ch);
        // Save the error to a log file or perform any desired logging action
        file_put_contents('./logs/image_curl_error.log', $error . PHP_EOL, FILE_APPEND);
        curl_close($ch);
        return $error;
    } else {
        // Save the response to a log file or perform any desired logging action
        $responseLog = "cURL Response [" . date('Y-m-d H:i:s') . "]: " . $response;
        file_put_contents('./logs/image_curl_response.log', $responseLog . PHP_EOL, FILE_APPEND);
        curl_close($ch);
        return $response;
    }
}

?>
<?php
require '../../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../../vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Replace with your database connection code
$conn = mysqli_connect("localhost", "root", "", "billing");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch email addresses from the database
$sql = "SELECT email FROM cust_details";
$result = $conn->query($sql);

$emailRecipients = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $emailRecipients[] = $row["email"];
    }
} else {
    echo "No email addresses found in the database.";
}

// Check if there are email recipients
if (count($emailRecipients) > 0) {
    // Get the current index from the URL parameter (sent by JavaScript)
    $currentIndex = isset($_POST['currentIndex']) ? intval($_POST['currentIndex']) : 0;

    // Check if there are more recipients to send emails to
    if ($currentIndex < count($emailRecipients)) {
        $recipient = $emailRecipients[$currentIndex];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $attachmentType = $_POST['attachmentType'];

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'yourmail@gmail.com'; //SMTP username
        $mail->Password = 'SMTPpassword'; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('yourmail@gmail.com', 'You Name'); // Set the sender's email and name
        $mail->addAddress($recipient); // Set the recipient's email

        $mail->Subject = $subject;
        $mail->Body = $message;

        if ($attachmentType === 'image') {
            if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
                // Move the uploaded image to a specific directory
                $uploadDirectory = '../../../addmission_pdf/';
                $mailImageName = 'mailImage.png'; // Rename the image if needed

                $destinationPath = $uploadDirectory . $mailImageName;
                move_uploaded_file($_FILES['attachment']['tmp_name'], $destinationPath);

                $imageFilePath = '../../../addmission_pdf/mailImage.png'; // Replace with the actual file path
                $uploadUrl = 'https://chaoschatroom.000webhostapp.com/api/upload.php'; // Replace with the actual URL This Api is for only test 

                $imageFileURL = json_decode(uploadImageToHostedServer($imageFilePath, $uploadUrl));




                // Create the HTML email content
                $htmlContent = "
                    <!DOCTYPE html>
                    <html>
                    <head>
                    <style>
                    @page {
                        size: A4 portrait;
                        margin: 0;
                    }
                    body {
                        font-family: Arial, sans-serif;
                        font-size: 14px;
                        line-height: 1.6;
                        margin: 0;
                        padding: 0;
                        background-color: #eee;
                    }
                    
                    span {
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
                    <body style=\"text-align: center; align-items: center; background-color: rgb(240, 242, 252); \">
                    
                    <div class=\"header\">
                    <img class=\"name-logo\" src=\"https://cdn.discordapp.com/attachments/839435729993072660/1136988864150507551/name2.png\" alt=\"Company name logo\">
                    </div>
                    <h2>" . $message . "</h2><br>
                    <img src=\"" . $imageFileURL->imageUrl . "\" class=\"background-image\" style=\"image-resolution: 1000dpi;\">
                    <br><br>
                    <hr style=\"min-width: 80dvw; min-width: 80vw;\">
                    <h5>
                    Address: <span><a href=\"https://goo.gl/maps/youraddress\">CLICK HERE</a></span><br>Phone: <span><a href=\"tel:+000000000000\">+00 0000000000</a></span><br>Website: https://yourwebsite/<br>E-Mail: yourmail@gmail.com
                    </h5>
                    </body>
                    </html>";



                // Attach the image file to the email
                $mail->isHTML(true);
                $mail->Body = $htmlContent;
                // $mail->addAttachment($destinationPath, $mailImageName);
            }
        } elseif ($attachmentType === 'html') {
            // Attach an HTML file here (replace 'your_html_file.html' with your actual file path)
            if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
                // Read the contents of the uploaded HTML file
                $htmlContent = file_get_contents($_FILES['attachment']['tmp_name']);

                // Set the HTML content as the email body
                $mail->isHTML(true);
                $mail->Subject = $subject; // Set the email subject
                $mail->Body = $htmlContent; // Set the HTML content as the email body
            }
        }
        $response = [
            'timestamp' => date('Y-m-d H:i:s'),
            'recipient' => $recipient,
        ];


        // Attempt to send the email
        if ($mail->send()) {
            echo 'Email sent successfully to: ' . $recipient;
            $response['status'] = 'success';
            $response['message'] = 'Email sent successfully to: ' . $recipient;
        } else {
            echo 'Error sending email to: ' . $recipient;
            $response['status'] = 'error';
            $response['message'] = 'Error sending email to: ' . $recipient;
        }


        $logFile = './logs/email_log.log';

        if (file_exists($logFile)) {
            $logData = json_decode(file_get_contents($logFile), true);
        } else {
            $logData = [];
        }

        $logData[] = $response;
        file_put_contents($logFile, json_encode($logData, JSON_PRETTY_PRINT));

    } else {
        echo 'All emails sent successfully.';
    }
} else {
    echo "No email addresses found in the database.";
}

$conn->close();

?>