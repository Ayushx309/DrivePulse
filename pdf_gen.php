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
        $mail->Username = 'yourmail@gmail.com'; //SMTP username
        $mail->Password = 'SMTPpassword'; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
        $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('yourmail@gmail.com', 'Name');
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
        $mail->Subject = 'Booking Receipt - Your Name';
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
        <body>
            <div class="container">
                <div class="header">
                    <!-- <img class="logo" src="https://cdn.discordapp.com/attachments/839435729993072660/1136989550099583096/logo.png" alt="Company Logo"> -->
                    <img class="name-logo" src="https://cdn.discordapp.com/attachments/839435729993072660/1136988864150507551/name2.png" alt="Company name logo">
                    <!-- <p></p> -->
                </div>
                <h2>TEST Booking Receipt</h2>
                <p>Hi <b>' . $name . '</b>,</p>
                
                <p>Thank you for choosing Your Name for your booking. We are pleased to provide you with the details of your reservation. Please find attached the PDF booking receipt for your reference.</p>
                
                <p>If you have any questions or require further assistance, please do not hesitate to contact our customer service at  <span><a href="tel:+000000000000">+00 0000000000</a></span></p>
                
                <p>Best regards,<br>
                <b>Your Name</b></p>
            </div>
        </body>
        </html>
        
        

        ';
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->SMTPDebug = 0;
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
// header('Content-Type: application/pdf');
// header('Content-Disposition: inline; filename="test.pdf"');
// echo $pdf->output();

$pdfDataUri = 'data:application/pdf;base64,' . base64_encode($pdf->output());

mailReceipt($phone, $email, $name);
sendMail($phone, $email, $name, $VN, $timeslot);
error_reporting(0);

// Suppress PHP warnings and notices
ini_set('display_errors', 0);
include('includes/authenticationAdminOrStaff.php');
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/3db79b918b.js" crossorigin="anonymous"></script>

    <!-- My CSS -->

    <link rel="stylesheet" href="css/adminDashboard.css">
    <style>
        /* Style the container */
        .container {
            margin-top: 70px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            height: auto;
            width: 100%;
        }

        /* Style the chart container */
        .chart-container {
            width: 100%;
            max-width: auto;
            margin-bottom: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;

        }

        .barchart {
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: start;
            align-items: start;
            gap: 30px;
            flex-wrap: wrap;
        }

        .piechart {
            padding: 20px;
            display: flex;
            flex-direction: row;
            justify-content: start;
            align-items: start;
            flex-wrap: wrap;
        }

        /* Style the button container */
        .barchart .button-container {
            display: flex;
            gap: 20px;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            width: 100%;

        }

        /* Style the button */
        button {
            padding: 10px 20px;
            background-color: #46abcc;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #1397c2;
        }

        /* Style the select element */
        select[name="select-year"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            /* Adjust the width as needed */
        }

        /* Style the selected option */
        select[name="select-year"] option[selected] {
            background-color: #3498db;
            color: #fff;
        }

        /* Style the options when the select is open */
        select[name="select-year"]:focus {
            outline: none;
            /* Remove the default focus outline */
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.7);
        }

        /* Style the options in the dropdown */
        select[name="select-year"] option {
            padding: 5px;
            font-size: 14px;
        }

        /* Style the hover effect on options */
        select[name="select-year"] option:hover {
            background-color: #f2f2f2;
            cursor: pointer;
        }

        /* Style the apply button */
        input[type="submit"][name="apply-button"] {
            padding: 10px 20px;
            /* Adjust padding as needed */
            background-color: #46abcc;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        /* Style the button on hover */
        input[type="submit"][name="apply-button"]:hover {
            background-color: #1397c2;
        }
    </style>

    <!-- Add SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="shortcut icon" type="image/png" href="assets/logo.png" />
    <title>Generated PDF</title>
</head>

<body>


    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <!-- <i class='bx bxs-smile'></i> -->

            <span class="text">
                <h6><span>
                        <?php echo ucfirst((isset($_GET['who'])) ? $_GET['who'] : ""); ?>
                    </span></h6>
                <h4>Welcome <span>
                        <?php echo (string) ($_GET['who'] == "admin") ? $_SESSION['admin_name'] : (($_GET['who'] == "staff") ? $_SESSION['staff_name'] : "error"); ?>
                    </span></h4>
            </span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="<?php echo (isset($_GET['who'])) ? $_GET['who'] : ""; ?>/">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?php echo (isset($_GET['who'])) ? $_GET['who'] : ""; ?>/admissionForm.php">
                    <i class='bx bxs-book-bookmark'></i>
                    <span class="text">Book Admission</span>
                </a>
            </li>
            <li
                style="<?php echo (isset($_GET['who'])) ? (($_GET['who'] == "staff") ? "display:none;" : "") : (($_GET['who'] == "staff") ? "" : ""); ?>">
                <a href="<?php echo (isset($_GET['who'])) ? $_GET['who'] : ""; ?>/analytics">
                    <i class='bx bxs-bar-chart-alt-2'></i>
                    <span class="text">Analytics</span>
                </a>
            </li>
            <li class="search">
                <a href="<?php echo (isset($_GET['who'])) ? $_GET['who'] : ""; ?>/search.php">
                    <i class='bx bx-search-alt-2'></i>
                    <span class="text">Search</span>
                </a>
            </li>
            <li>
                <a href="<?php echo (isset($_GET['who'])) ? $_GET['who'] : ""; ?>/sortData/">
                    <!-- <i class='bx bxs-bar-chart-alt-2'></i> -->
                    <i class='bx bxs-data'></i>
                    <span class="text">Customers Data</span>
                </a>
            </li>
            <li class="time-table">
                <a href="<?php echo (isset($_GET['who'])) ? $_GET['who'] : ""; ?>/timetable/">
                    <i class='bx bx-table'></i>
                    <span class="text">Time Table</span>
                </a>
            </li>
            <li>
                <a href="<?php echo (isset($_GET['who'])) ? $_GET['who'] : ""; ?>/dueCustomers/">
                    <i class='bx bxs-user'></i>
                    <span class="text">Due Amount Customers</span>
                </a>
            </li>
            <li
                style="<?php echo (isset($_GET['who'])) ? (($_GET['who'] == "staff") ? "display:none;" : "") : (($_GET['who'] == "staff") ? "" : ""); ?>">
                <a href="<?php echo (isset($_GET['who'])) ? $_GET['who'] : ""; ?>/mailSender">
                    <i class='bx bx-mail-send'></i>
                    <span class="text">Mail System</span>
                </a>
            </li>
            <li
                style="<?php echo (isset($_GET['who'])) ? (($_GET['who'] == "staff") ? "display:none;" : "") : (($_GET['who'] == "staff") ? "" : ""); ?>">
                <a href="<?php echo (isset($_GET['who'])) ? $_GET['who'] : ""; ?>/manageUsers/">
                    <i class='bx bxs-group'></i>
                    <span class="text">Manage Users</span>
                </a>
            </li>

        </ul>
        <ul class="side-menu">
            <!-- <li>
                <a href="#">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Settings</span>
                </a>
            </li> -->
            <li>
                <a href="logout.php" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->



    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <!-- <a href="#" class="nav-link">Categories</a> -->
            <!-- <form action="" method="get">
                <div class="form-input">
                    <input type="search" name="search-query" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form> -->
            <!-- <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a> -->
            <span class="text">
                <h3>Patel Motor Driving School</h3>
                <h5>Dashboard</h5>
            </span>
            <a href="" class="profile">
                <img src="assets/logoBlack.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Generated PDF Viewer</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" style=" color: #aaaaaa;"
                                href="<?php echo (isset($_GET['who'])) ? $_GET['who'] : ""; ?>">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="">Generated PDF</a>
                        </li>
                    </ul>
                </div>
                <!-- <a href="Excel/?export=true" class="btn-download">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">Data to Excel</span>
                </a> -->
            </div>

            <iframe src="<?php echo $pdfDataUri; ?>"
                style="width: 100%;height: 1200px;margin-top: 35px;border: none;border-radius: 10px;"
                title="Generated PDF" allowfullscreen loading="lazy"></iframe>

        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="js/sweetalert.js"></script>
    <script src="js/script.js"></script>

</body>

</html>