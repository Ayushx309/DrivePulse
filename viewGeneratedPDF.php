<?php

require_once('lib/dompdf/autoload.inc.php');

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('chroot', realpath(''));
$pdf = new Dompdf($options);


ob_start();

include('viewpdf.php');

$htmlCode = ob_get_clean();


$pdf->loadHtml($htmlCode);

$pdf->setPaper('A4', 'portrait');

$pdf->render();

$pdfDataUri = 'data:application/pdf;base64,' . base64_encode($pdf->output());
error_reporting(0);
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
    <title>PDF Viewer</title>
</head>

<body>


    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <!-- <i class='bx bxs-smile'></i> -->

            <span class="text">
                <h6><span><?php echo ucfirst((isset($_GET['who'])) ? $_GET['who'] : ""); ?></span></h6>
                <h4>Welcome <span>
                        <?php echo (string)($_GET['who'] == "admin")?$_SESSION['admin_name'] :(($_GET['who'] == "staff")?$_SESSION['staff_name']:"error"); ?>
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
            <li style="<?php echo (isset($_GET['who']))?(($_GET['who'] == "staff")? "display:none;": ""):(($_GET['who'] == "staff")? "": "");?>" >
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
            <li style="<?php echo (isset($_GET['who']))?(($_GET['who'] == "staff")? "display:none;": ""):(($_GET['who'] == "staff")? "": "");?>" >
                <a href="<?php echo (isset($_GET['who'])) ? $_GET['who'] : ""; ?>/mailSender">
                    <i class='bx bx-mail-send'></i>
                    <span class="text">Mail System</span>
                </a>
            </li>
            <li style="<?php echo (isset($_GET['who']))?(($_GET['who'] == "staff")? "display:none;": ""):(($_GET['who'] == "staff")? "": "");?>" >
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
                    <h1>PDF Viewer</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" style=" color: #aaaaaa;"
                                href="<?php echo (isset($_GET['who'])) ? $_GET['who'] : ""; ?>">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" style=" color: #aaaaaa;"
                                href="<?php echo (isset($_GET['route'])) ? $_GET['route'] : ((isset($_GET['who'])) ? $_GET['who'] : ""); ?>">View
                                Details</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="">PDF Viewer</a>
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