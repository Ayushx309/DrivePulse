<?php

include('../../../includes/authentication.php');
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/3db79b918b.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- My CSS -->
    <link rel="stylesheet" href="../../../css/adminDashboard.css">
    <style>
        /* Style for the main container */
        .container {
            margin: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px 5px 0px 0px;
            max-width: 100%;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }

        /* Style for form elements */
        form {
            margin-top: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            font-size: 16px;
        }

        select {
            height: 40px;
        }

        input[type="file"] {
            padding: 5px;
        }

        input[type="submit"] {
            background-color: #46abcc;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: all .3s;
        }

        input[type="submit"]:hover {
            background-color: #206e88;
        }

        /* Style for list items */
        #successfulEmails li {
            margin-bottom: 10px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            list-style: none;
        }

        /* Style for in-process status */
        #inprocessEmails li.in-process {
            background-color: #f0ad4e;

            /* Yellow background for in-process */
            color: #fff;
            /* White text color */
        }

        /* Style for success status */
        #successfulEmails li.success {
            background-color: #5bc0de;
            /* Blue background for success */
            color: #fff;
            /* White text color */
        }

        /* Style for error status */
        #successfulEmails li.error {
            background-color: #d9534f;
            /* Red background for error */
            color: #fff;
            /* White text color */
        }

        #drop-area {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            border: 2px dashed #ccc;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            margin: 20px 0px;
        }

        #drop-area.highlight {
            background-color: #f0f0f0;
        }


        input[type="file"] {
            background-color: #46abcc;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: all .3s;
        }

        input[type="file"]:hover {
            background-color: #206e88;
        }

        #optional {
            font-size: 12px;
            color: #ccc;
            float:right;
        }


        /* Media query for responsiveness */
        @media (max-width: 768px) {
            .container {
                width: 100%;
            }
        }
    </style>

    <!-- Add SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="shortcut icon" type="image/png" href="../../../assets/logo.png" />
    <title>Offer Email Sender</title>
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
                <a href="../../">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="../../admissionForm.php">
                    <i class='bx bxs-book-bookmark'></i>
                    <span class="text">Book Admission</span>
                </a>
            </li>
            <li>
                <a href="../../analytics">
                    <i class='bx bxs-bar-chart-alt-2'></i>
                    <span class="text">Analytics</span>
                </a>
            </li>
            <li class="search">
                <a href="../../search.php">
                    <i class='bx bx-search-alt-2'></i>
                    <span class="text">Search</span>
                </a>
            </li>
            <li>
                <a href="../../sortData/">
                    <!-- <i class='bx bxs-bar-chart-alt-2'></i> -->
                    <i class='bx bxs-data'></i>
                    <span class="text">Customers Data</span>
                </a>
            </li>
            <li class="time-table">
                <a href="../../timetable/">
                    <i class='bx bx-table'></i>
                    <span class="text">Time Table</span>
                </a>
            </li>
            <li>
                <a href="../../dueCustomers/">
                    <i class='bx bxs-user'></i>
                    <span class="text">Due Amount Customers</span>
                </a>
            </li>
            <li>
                <a href="../../manageUsers/">
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
                <a href="../../../logout.php" class="logout">
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
                <img src="../../../assets/logoBlack.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title" style="margin-bottom: 40px;">
                <div class="left">
                    <h1>Offer Email Sender</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" style=" color: #aaaaaa;" href="../">Mail</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="../offerMail">Offer Sender</a>
                        </li>
                    </ul>
                </div>
                <!-- <a href="Excel/?export=true" class="btn-download">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">Data to Excel</span>
                </a> -->
            </div>
            <div class="container">
                <h2>Email Sender</h2>
                <form id="emailForm" enctype="multipart/form-data">
                    <div>
                        <label for="subject">Subject:</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                    <div>
                        <label for="message">Message:</label>
                        <textarea id="message" name="message" rows="4" required></textarea>
                    </div>
                    <label for="attachment">Mail Body:<span id="optional">(optional)</span></label>
                    <div id="drop-area">
                        <input type="file" id="attachment" name="attachment">
                    </div>
                    <div>
                        <label for="attachmentType">Mail Body Type: <span id="optional">(optional)</span> </label>
                        <select id="attachmentType" name="attachmentType">
                        <option value="null" selected disabled >Select File Type</option>
                            <option value="image">Image</option>
                            <option value="html">HTML File</option>
                        </select>
                    </div>
                    <div>
                        <input type="submit" value="Send Email">
                    </div>
                </form>
            </div>
            <div class="container" style=" border-radius: 0px 0px 5px 5px ;">
                <h2>Successful Emails</h2>
                <ul id="inprocessEmails"
                    style="margin-top: 15px; display: flex; flex-direction: column; gap: 5px; flex-wrap: wrap;">
                    <li class="in-process"
                        style="display:none; margin-bottom: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 5px; list-style: none;">
                    </li>
                </ul>
                <ul id="successfulEmails"
                    style="margin-top: 15px; display: flex; flex-direction: column; gap: 5px; flex-wrap: wrap;"></ul>
            </div>



        </main>
        <!-- MAIN -->
    </section>





    <script src="../../../js/sweetalert.js"></script>
    <script src="../../../js/script.js"></script>
    <script>
        $(document).ready(function () {
            // Initialize the currentIndex to 0
            let currentIndex = 0;
            let emailRecipients = [];

            // Fetch email addresses from the database
            $.ajax({
                url: "get_email_recipients.php", // Create a PHP script to fetch email recipients
                type: "GET",
                success: function (data) {
                    emailRecipients = JSON.parse(data);

                    $("#emailForm").submit(function (event) {
                        event.preventDefault();

                        let formData = new FormData(this);

                        // Append the current recipient to the form data
                        formData.append('currentIndex', currentIndex);
                        // console.log("In process: " + emailRecipients[currentIndex]);
                        let $inProcessLi = $("#inprocessEmails li.in-process");
                        $inProcessLi.attr("style", "display: block; margin-bottom: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 5px; list-style: none;");
                        $inProcessLi.text("In process: " + emailRecipients[currentIndex]);

                        $.ajax({
                            url: "send_email.php",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                // Show "In-process" status
                                $("#successfulEmails").append("<li class='in-process'>In process: " + emailRecipients[currentIndex] + "</li>");

                                // Scroll to the bottom of the list to show the latest update
                                $("#successfulEmails").scrollTop($("#successfulEmails")[0].scrollHeight);


                                // Update to "Email sent successfully" status
                                $(".in-process").last().text("Email sent successfully to: " + emailRecipients[currentIndex]);
                                $(".in-process").last().removeClass("in-process").addClass("success");

                                currentIndex++;

                                // If there are more emails, send the next one
                                if (currentIndex < emailRecipients.length) {
                                    sendNextEmail();
                                } else {
                                    // All emails have been sent
                                    $("#successfulEmails").append("<li class='success'>All emails sent successfully.</li>");
                                    $inProcessLi.attr("style", "display: none; margin-bottom: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 5px; list-style: none;");
                                    $inProcessLi.text("");
                                }
                            },
                            error: function (error) {
                                // Show "In-process" status
                                $("#successfulEmails").append("<li class='in-process'>In process: " + emailRecipients[currentIndex] + "</li>");

                                // Scroll to the bottom of the list to show the latest update
                                $("#successfulEmails").scrollTop($("#successfulEmails")[0].scrollHeight);

                                // Update to "Error sending email" status
                                $(".in-process").last().text("Error sending email to: " + emailRecipients[currentIndex]);
                                $(".in-process").last().removeClass("in-process").addClass("error");

                                currentIndex++;

                                // If there are more emails, send the next one
                                if (currentIndex < emailRecipients.length) {
                                    sendNextEmail();
                                } else {
                                    // All emails have been sent
                                    $("#successfulEmails").append("<li class='error'>All emails sent with errors.</li>");
                                    $inProcessLi.attr("style", "display: none; margin-bottom: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 5px; list-style: none;");
                                    $inProcessLi.text("");


                                }
                            }
                        });
                    });

                    // Function to send the next email
                    function sendNextEmail() {
                        // Simulate form submission
                        $("#emailForm").submit();
                    }
                },
                error: function (error) {
                    console.log("Error fetching email recipients: " + error);
                }
            });
        });

    </script>


</body>

</html>
