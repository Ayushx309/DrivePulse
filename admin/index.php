<?php

include('../includes/authentication.php');
date_default_timezone_set('Asia/Kolkata');
if (isset($_GET['search-query'])) {

    $Squery = $_GET['search-query'];
    header('location:search.php?query=' . $Squery);

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
    <link rel="stylesheet" href="../css/adminDashboard.css">
    <style>
        .order {
            width: 100%;
        }

        .order .head {
            background-color: #f1f1f1;
            padding: 10px;
        }

        .order h3 {
            margin: 0;
        }

        .order .table-container {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #ccc;
            margin-top: 10px;
        }

        .order table {
            width: 100%;
            border-collapse: collapse;
        }

        .order th,
        .order td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        .order tbody tr:last-child td {
            border-bottom: none;
        }

        .view {
            font-size: 14px;
            padding: 6px 16px;
            color: var(--light);
            border-radius: 20px;
            font-weight: 200;
            background: var(--blue);
            text-decoration: none;
            transition: all 250ms;
        }

        .view:hover {
            background: #206e88;
        }

        .order td[colspan="6"] {
            text-align: center;
        }



        .edit {
            font-size: 14px;
            padding: 6px 16px;
            color: #fff;
            border-radius: 20px;
            font-weight: 200;
            background: green;
            text-decoration: none;
        }

        .delete {
            font-size: 14px;
            padding: 6px 16px;
            color: #fff;
            border-radius: 20px;
            font-weight: 200;
            background: red;
            text-decoration: none;
        }

        .edit:hover {
            background: darkgreen;
        }

        .delete:hover {
            background: darkred;
        }

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

    <link rel="shortcut icon" type="image/png" href="../assets/logo.png" />
    <title>Dashboard</title>
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
                <a href="./">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="admissionForm.php">
                    <i class='bx bxs-book-bookmark'></i>
                    <span class="text">Book Admission</span>
                </a>
            </li>
            <li>
                <a href="analytics">
                    <i class='bx bxs-bar-chart-alt-2'></i>
                    <span class="text">Analytics</span>
                </a>
            </li>
            <li class="search">
                <a href="search.php">
                    <i class='bx bx-search-alt-2'></i>
                    <span class="text">Search</span>
                </a>
            </li>
            <li>
                <a href="sortData/">
                    <!-- <i class='bx bxs-bar-chart-alt-2'></i> -->
                    <i class='bx bxs-data'></i>
                    <span class="text">Customers Data</span>
                </a>
            </li>
            <li class="time-table">
                <a href="timetable/">
                    <i class='bx bx-table'></i>
                    <span class="text">Time Table</span>
                </a>
            </li>

            <li>
                <a href="./dueCustomers/">
                    <i class='bx bxs-user'></i>
                    <span class="text">Due Amount Customers</span>
                </a>
            </li>
            <li>
                <a href="mailSender/">
                    <i class='bx bx-mail-send'></i>
                    <span class="text">Mail System</span>
                </a>
            </li>

            <li>
                <a href="manageUsers/">
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
                <a href="../logout.php" class="logout">
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
            <label for="switch-mode" class="switch-mode"></label> -->
            <!-- <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a> -->
            <span class="text">
                <h3>Patel Motor Driving School</h3>
                <h5>Dashboard</h5>
            </span>
            <a href="./" class="profile">
                <img src="../assets/logoBlack.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" style=" color: #aaaaaa;" href="./">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="./">Home</a>
                        </li>
                    </ul>
                </div>
                <div style="    display: flex;
                    width: 300px;
                    flex-direction: row;
                    align-content: center;
                    justify-content: center;
                    gap: 20px;
                    align-items: center;
                    flex-wrap: wrap;">
                    <a href="Excel/?export=true" class="btn-download">
                        <i class='bx bxs-cloud-download'></i>
                        <span class="text">Data to Excel</span>
                    </a>
                    <a href="viewLogs/" class="btn-download" style="background: grey;">
                    <i class="fa-solid fa-file-circle-question"></i>
                        <span class="text">Logs</span>
                    </a>
                </div>
            </div>

            <div class="box-info-head" style="
            padding: 24px;
            background: #f9f9f9;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 24px;
            margin-top: 36px;">

                <i class='bx bxs-calendar' style="
            width: 30px;
            height: 30px;
            border-radius: 10px;
            font-size: 28px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: red;
            
            "></i>
                <span class="text">
                    <h3>
                        <?php
                        $currentMonthYear = date("F Y");

                        echo $currentMonthYear . " ";
                        ?>
                        Statistics
                    </h3>
                    <p></p>
                </span>
            </div>
            <ul class="box-info">
                <li>
                    <i class='bx bxs-car'></i>
                    <span class="text">
                        <h3>
                            <?php

                            $sql = "SELECT SUM(active_count) AS total_active_users
        FROM (
            SELECT COUNT(*) AS active_count
            FROM car_one
            WHERE status = 'active'
            UNION ALL
            SELECT COUNT(*) AS active_count
            FROM car_two
            WHERE status = 'active'
        ) AS combined_tables";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // Output data
                                $row = $result->fetch_assoc();
                                $totalActiveUsers = $row["total_active_users"];
                                echo "" . $totalActiveUsers;
                            } else {
                                echo "No active users found.";
                            }

                            ?>
                        </h3>
                        <p>Active Learners</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-group'></i>
                    <span class="text">
                        <h3>
                            <?php

                            // Get the current year and month
                            $currentYear = date("Y");
                            $currentMonth = date("m");

                            // SQL query to retrieve total paidamount for the current month
                            $sql = "SELECT COUNT(*) AS total_new_customers FROM `cust_details` WHERE YEAR(`date`) = $currentYear AND MONTH(`date`) = $currentMonth";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $totalNewCustomers = $row["total_new_customers"];
                                echo $totalNewCustomers;
                            } else {
                                echo "No new customers recorded for this month.";
                            }


                            ?>
                        </h3>
                        <p>Total Admissions</p>
                    </span>
                </li>
                <li>
                    <i class='bx bx-rupee'></i>
                    <span class="text">
                        <h3>
                            <?php


                            // Get the current year and month
                            $currentYear = date("Y");
                            $currentMonth = date("m");

                            // SQL query to retrieve total paidamount for the current month
                            $sql = "SELECT SUM(paidamount) AS total_paidamount FROM `cust_details` WHERE YEAR(`date`) = $currentYear AND MONTH(`date`) = $currentMonth";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $totalPaidAmount = $row["total_paidamount"];
                                echo "₹" . number_format($totalPaidAmount, 2);
                            } else {
                                echo "No payments recorded for this month.";
                            }

                            ?>
                        </h3>
                        <p>Total Sales</p>
                    </span>
                </li>
            </ul>


            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Today's Admissions</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Total Amount</th>
                                <th>Vehicle</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            date_default_timezone_set('Asia/Kolkata');
                            $current_timestamp_by_mktime = mktime(date("m"), date("d"), date("Y"));
                            $currentDate = date("Y-m-d", $current_timestamp_by_mktime);

                            $query = "SELECT * FROM `cust_details` WHERE date = '$currentDate'";

                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) > 0) {

                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr><td>" . $row["name"] . "</td><td>" . $row["phone"] . "</td><td>" . $row["totalamount"] . "</td><td>" . $row["vehicle"] . "</td><td>"
                                        . $row["date"] . "</td>" . "<td>" .
                                        "<a class='view' href='view?id=" . $row["id"] . "&phone=" . $row["phone"] . "&date=" . $row["date"] . "&route=../'>View Details</a>";
                                }

                            } else {
                                $msg[] = "No Admissions Today ☹️ ";
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



        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->


    <script src="../js/script.js"></script>

</body>

</html>