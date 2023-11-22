<?php

include('../../includes/authentication.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/mysqlconnection.php');
date_default_timezone_set('Asia/Kolkata');

$conn = mySqlConnection(); 

function convertDMY($dateString)
{
    if ($dateString === "0000-00-00") {
        echo "00-00-00";
    } else {

        $date = new DateTime($dateString);
        $formattedDate = $date->format("d-m-Y");
        echo $formattedDate;
    }
}


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
    <link rel="stylesheet" href="../../css/adminDashboard.css">
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


        /* Style for the dropdown container */
        .dropdown {
            display: flex;
            flex-direction: row;
            align-items: center;
            float: right;
            gap: 10px;
            margin: 10px 0px;
        }

        /* Style for the labels */
        label {
            font-weight: bold;
        }

        /* Style for the select elements */
        select {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #logTable {
            width: 100%;
            border-collapse: collapse;
        }

        #logTable th,
        #logTable td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #logTable th {
            background-color: #f2f2f2;
        }
    </style>

    <!-- Add SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="shortcut icon" type="image/png" href="../../assets/logo.png" />
    <title>Logs</title>
</head>

<body>


    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <!-- <i class='bx bxs-smile'></i> -->

            <span class="text">
                <h6><span>Admin</span></h6>
                <h4>Welcome <span>
                        <?php echo $_SESSION['admin_name'] ?>
                    </span></h4>
            </span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="../">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="../admissionForm.php">
                    <i class='bx bxs-book-bookmark'></i>
                    <span class="text">Book Admission</span>
                </a>
            </li>
            <li>
                <a href="../analytics">
                    <i class='bx bxs-bar-chart-alt-2'></i>
                    <span class="text">Analytics</span>
                </a>
            </li>
            <li class="search">
                <a href="../search.php">
                    <i class='bx bx-search-alt-2'></i>
                    <span class="text">Search</span>
                </a>
            </li>
            <li>
                <a href="../sortData/">
                    <!-- <i class='bx bxs-bar-chart-alt-2'></i> -->
                    <i class='bx bxs-data'></i>
                    <span class="text">Customers Data</span>
                </a>
            </li>
            <li class="time-table">
                <a href="../timetable/">
                    <i class='bx bx-table'></i>
                    <span class="text">Time Table</span>
                </a>
            </li>
            <li>
                <a href="../dueCustomers/">
                    <i class='bx bxs-user'></i>
                    <span class="text">Due Amount Customers</span>
                </a>
            </li>
            <li>
                <a href="./">
                    <i class='bx bx-mail-send'></i>
                    <span class="text">Mail System</span>
                </a>
            </li>
            <li>
                <a href="../manageUsers/">
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
                <a href="../../logout.php" class="logout">
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
            <a href="index.php" class="profile">
                <img src="../../assets/logoBlack.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Logs</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" style=" color: #aaaaaa;" href="../">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" style=" color: #aaaaaa;" href="../">Home</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="./">Logs</a>
                        </li>
                    </ul>
                </div>
                <!-- <a href="Excel/?export=true" class="btn-download">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">Data to Excel</span>
                </a> -->
            </div>




            <div class="dropdown">
                <label for="logType">Select Log Type:</label>
                <select id="logwhat">
                    <option value="admin">Admin Logs</option>
                    <option value="staff">Staff Logs</option>
                    <option value="user">User Logs</option>
                </select>
                <select id="logType">
                    <option value="logs">Logs</option>
                    <option id="admission" value="admission_logs">Admission Logs</option>
                </select>
            </div>
            <div>
                <iframe src="" id="logsiframe"
                    style="width: 100%;height: 1200px;margin-top: 35px;border: none;border-radius: 10px;" title="Logs"
                    allowfullscreen loading="lazy"></iframe>
            </div>



        </main>
        <!-- MAIN -->
    </section>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const logwhatDropdown = $('#logwhat');
            const logTypeDropdown = $('#logType');
            const logsiframe = $('#logsiframe');

            function updateSelected(dropdown, selectedValue) {
                dropdown.val(selectedValue);
            }

            // Function to fetch and display log data
            function displayLogs(logWhat, logType) {
                const jsonFilePath = `displayLogs/${logWhat}_logs/show_${logType}.php`;

                logsiframe.attr('src', jsonFilePath);
            }

            function updateLogData() {
                const selectedLogWhat = logwhatDropdown.val();
                const selectedLogType = logTypeDropdown.val();

                if(selectedLogWhat == "user"){
                    document.getElementById('admission').setAttribute("style","display:none");
                }else{
                    document.getElementById('admission').setAttribute("style","display:block");
                }

                updateSelected(logwhatDropdown, selectedLogWhat);
                updateSelected(logTypeDropdown, selectedLogType);

                // Fetch and display logs
                displayLogs(selectedLogWhat, selectedLogType);
            }

            // Attach change event listeners
            logwhatDropdown.on('change', updateLogData);
            logTypeDropdown.on('change', updateLogData);

            // Initial request on page load
            updateLogData();
        });
    </script>



    <script src="../../js/sweetalert.js"></script>
    <script src="../../js/script.js"></script>

</body>

</html>
