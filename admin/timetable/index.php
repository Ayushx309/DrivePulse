<?php

include('../../includes/authentication.php');
date_default_timezone_set('Asia/Kolkata');
$conn = mysqli_connect("localhost", "root", "", "billing");

$msg = [];

if (isset($_POST['submitCar'])) {

    header("location:?car=" . $_POST['car'] . "");

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
        .title {
            text-align: center;
            padding: 13px;
            background: #46abcc;
            color: rgb(255, 255, 255);
            font-size: 20px;
            font-weight: 700;
            border-radius: 10px;
            /* box-shadow: 7px 7px 2px 1px rgba(0, 0, 0, 0.2); */
        }

        table {
            width: 100%;
            max-width: 1500px;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            font-size: 15px;
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        table tr:hover {
            background-color: #f5f5f5;
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 100%;
            margin: 30px 0px 5px 0px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        select{
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {

            table th,
            table td {
                font-size: 14px;
            }

            h1 {
                font-size: 24px;
            }

            form {
                max-width: 100%;
                padding: 10px;
            }

            select {
                padding: 6px;
            }

            button[type="submit"] {
                padding: 8px 16px;
                font-size: 14px;
            }



            .plusDay:hover {
                background-color: #45a049;
            }

        }

        #car {
            padding: 20px;
            font-size: 17px;
            font-weight: bold;
            text-align: center;
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

        .btns{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            gap: 10px;
            
        }

        #btn {
            text-align: center;
            display: inline-block;
            padding: 5px 10px;
            background-color: #46abcc;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            flex-grow: 3;
        }

        #SD,#ED,#TS{
            font-size: 13px;
        }

    </style>

    <!-- Add SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="shortcut icon" type="image/png" href="../../assets/logo.png" />
    <title>Time Table</title>
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
            <li class="active time-table">
                <a href="./">
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
                <a href="../mailSender/">
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
            <a href="../" class="profile">
                <img src="../../assets/logoBlack.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Time Table</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active"  style=" color: #aaaaaa;" href="../">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="./">Time Table</a>
                        </li>
                    </ul>
                </div>
                <!-- <a href="Excel/?export=true" class="btn-download">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">Data to Excel</span>
                </a> -->
            </div>

            <?php
                if (isset($msg)) {
                    foreach ($msg as $msg) {
                        echo '<span class="msg">' . $msg . '</span>';
                    }
                    ;
                }
                ;
                ?>

            <form method="post">
                <div class="form-group">
                    <label for="car">Select Car:</label>
                    <select id="car" name="car">
                        <option disabled selected>Select Car To View Time-Table</option>
                        <option value="i10">Hyundai i10</option>
                        <option value="liva">Toyota Liva</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" name="submitCar">View</button>
                </div>
            </form>

            <div class="time_table_box">


                <?php
                include('car_one.php');
                ?>

                <?php
                include('car_two.php');
                ?>


               
            </div>


        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="../../js/sweetalert.js"></script>
    <script src="../../js/script.js"></script>

</body>

</html>