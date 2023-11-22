<?php

include('../../includes/authenticationStaff.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/mysqlconnection.php');
date_default_timezone_set('Asia/Kolkata');

$conn = mySqlConnection(); 

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
        /* Style for the order container */
        .order {
            width: 100%;
            padding: 10px;
            background-color: #f1f1f1;
            text-align: center;
            border-radius: 4px;

        }

        /* Style for the table title */

        .order .head {
            background-color: #f1f1f1;
            padding: 10px;
        }

        .order h3 {
            margin: 0;
            font-size: 20px;
        }

        /* Style for the table container */
        .order .table-container {
            max-height: 400px;
            overflow-y: auto;
            margin-top: 10px;
        }

        /* Style for the table */
        .order table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Style for table headers and cells */
        .order th,
        .order td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }

        /* Style for the last row's cells */
        .order tbody tr:last-child td {
            border-bottom: none;
        }

        /* Style for action buttons */
        .view,
        .edit,
        .delete {
            font-size: 14px;
            padding: 6px 16px;
            color: #fff;
            border-radius: 20px;
            font-weight: 200;
            text-decoration: none;
            transition: background-color 250ms ease;
            margin: 4px;
            cursor: pointer;
        }

        /* Style for the "View" button */
        .view {
            background: var(--blue);
            /* Use your custom color variable */
        }

        /* Hover style for action buttons */
        .view:hover,
        .edit:hover,
        .delete:hover {
            background: #206e88;
            /* Darker color on hover */
        }

        /* Style for the message block */
        .msg {
            text-align: center;
            margin: 10px 0;
            display: block;
            background: #46abcc;
            color: #fff;
            border-radius: 5px;
            font-size: 20px;
            padding: 10px;
        }
    </style>
    <link rel="shortcut icon" type="image/png" href="../../assets/logo.png" />
    <title>Due Amount Customers</title>
</head>

<body>


    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <!-- <i class='bx bxs-smile'></i> -->

            <span class="text">
                <h6><span>Staff</span></h6>
                <h4>Welcome <span>
                        <?php echo $_SESSION['staff_name'] ?>
                    </span></h4>
            </span>
        </a>
        <ul class="side-menu top">
            <li>
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
            <li class="active">
                <a href="../dueCustomers/">
                    <i class='bx bxs-user'></i>
                    <span class="text">Due Amount Customers</span>
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
            <a href="../" class="profile">
                <img src="../../assets/logoBlack.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Due Amount Customers</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active"  style=" color: #aaaaaa;"  href="../">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="./">Due Amount Customers</a>
                        </li>

                    </ul>
                </div>
                <!-- <a href="Excel/?export=true" class="btn-download">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">Data to Excel</span>
                </a> -->
            </div>
            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Customers</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Total Amount</th>
                                <th>Paid Amount</th>
                                <th>Due Amount</th>
                                <th>Vehicle</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            date_default_timezone_set('Asia/Kolkata');
                            $current_timestamp_by_mktime = mktime(date("m"), date("d"), date("Y"));
                            $currentDate = date("Y-m-d", $current_timestamp_by_mktime);

                            $query = "SELECT * FROM `cust_details` WHERE `dueamount` > 0 ORDER BY `date` ASC";



                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) > 0) {

                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr><td>" . $row["name"] . "</td>
                                    <td>" . $row["phone"] . "</td>
                                    <td>" . $row["totalamount"] . "</td>
                                    <td>" . $row["paidamount"] . "</td>
                                    <td>" . $row["dueamount"] . "</td>
                                    <td>" . $row["vehicle"] . "</td>
                                    <td>" . "<a class='view' href='../view?id=" . $row["id"] . "&phone=" . $row["phone"] . "&route=" . urlencode("../dueCustomers") . "'>View Details</a></td>";


                                }

                            } else {
                                $msg = array("No Due Amount Customers ");
                            }
                            ?>
                        </tbody>
                    </table>

                    <?php
                    if (isset($msg)) {
                        foreach ($msg as $msg) {
                            echo '<span class="msg">' . $msg . '</span>';
                        }
                        ;
                    }
                    ;
                    ?>

                </div>
            </div>


        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->


    <script src="../../js/script.js"></script>

</body>

</html>
