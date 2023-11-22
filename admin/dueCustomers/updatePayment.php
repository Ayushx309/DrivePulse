<?php

include('../../includes/authentication.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/mysqlconnection.php');
date_default_timezone_set('Asia/Kolkata');
$conn = mySqlConnection(); 

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $phone = $_GET['phone'];

    $select = "SELECT * FROM `cust_details` WHERE id = $id AND phone = '$phone'";
    $result = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($result);

    $id = $row['id'];
    $name = $row['name'];
    $phone = $row['phone'];
    $totalamount = $row['totalamount'];
    $paidamount = $row['paidamount'];
    $dueamount = $row['dueamount'];
    $vehicle = $row['vehicle'];

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
    <style>
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

        /* Container styles */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        /* Form styles */
        .modifyData {
            width: 100%;
            max-width: 800px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            text-align: center;
            box-sizing: border-box;
            margin: 0 auto;
        }

        .modifyData form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .modifyData input[type="text"],
        .modifyData select {
            width: 340px;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        .modifyData input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 3px;
            width: 45%;
        }

        .modifyData input[type="submit"]:hover {
            background-color: #45a049;
        }

        .profile-image {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0px;
        }

        /* Add new styles for row and col layout */
        .row {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
        }

        .col {
            display: flex;
            flex-direction: column;
            flex: 1;
            align-items: center;
            justify-content: center;
            gap: 1rem;

        }


        .col label {
            display: flex;
            flex-direction: column;
            flex: 1;
            align-items: center;
            justify-content: center;


        }

        /* Add styles for submit-container */
        .submit-container {
            width: 100%;
            text-align: center;
        }
    </style>
    <!-- Add SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="shortcut icon" type="image/png" href="../../assets/logo.png" />
    <title>Due Amount Customers</title>
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
                    <h1>Due Amount Customers</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" style=" color: #aaaaaa;" href="../">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" style=" color: #aaaaaa;" href="./">Due Amount Customers</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="./updatePayment.php">Update Payment</a>
                        </li>
                    </ul>
                </div>
                <!-- <a href="Excel/?export=true" class="btn-download">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">Data to Excel</span>
                </a> -->
            </div>
            <!-- <div class="table-data">
                <div class="order"> -->

            <div class="error-container">
                <?php
                if (isset($error)) {

                    foreach ($error as $error) {
                        echo '<span class="error-msg" style="
          margin: 10px 0px;
          display: block;
          background: red;
          color:#fff;
          border-radius: 5px;
          font-size: 20px;
          padding:10px;">' . $error . '</span>';
                    }
                    ;
                }
                ;
                ?>
            </div>

            <div class="container" id="updateBox">
                <div class="modifyData">
                    <div class="profile-image">
                        <img src="https://www.gravatar.com/avatar/38ed5967302ec60ff4417826c24feef6?s=80&d=mm&r=g"
                            alt="Profile Image">
                    </div>
                    <form method="post">
                        <div class="row">
                            <div class="col">
                                <label for="name">Name
                                    <input type="hidden" name="id" value="<?php echo $id; ?>" readonly>
                                    <input type="text" name="name" value="<?php echo $name; ?>" readonly></label>
                                <label for="name">Phone
                                    <input type="text" name="phone" value="<?php echo $phone; ?>" readonly></label>
                                <label for="name">Total Amount
                                    <input type="text" name="Tamount" value="<?php echo $totalamount; ?>"
                                        readonly></label>
                            </div>
                            <div class="col">
                                <label for="name"> Paid Amount
                                    <input type="text" name="Pamount" value="<?php echo $paidamount; ?>"
                                        readonly></label>
                                <label for="name"> Due Amount
                                    <input type="text" name="Damount" value="<?php echo $dueamount; ?>"
                                        readonly></label>
                                <label for="name"> Vehicle
                                    <input type="text" name="vehicle" value="<?php echo $vehicle; ?>" readonly></label>
                            </div>

                        </div>
                        <hr>
                        <div class="row">

                            <div class="col">
                                <label for="name"> Amount Customer Paid
                                    <input type="text" name="updateAmount"
                                        placeholder="Enter Amount Customer Paid"></label>
                            </div>
                        </div>

                        <div class="submit-container">


                            <input type="submit" value="Update" name="updatePay">
                        </div>
                    </form>
                </div>
            </div>




</body>

</html>
</div>
</div>


</main>
<!-- MAIN -->
</section>
<!-- CONTENT -->

<?php


if (isset($_POST['updatePay'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    $tamount = $_POST['Tamount'];
    $pamount = $_POST['Pamount'];
    $damount = $_POST['Damount'];

    $updateAmount = $_POST['updateAmount'];


    if(!preg_match_all("/^[0-9]/",$updateAmount)){
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Invalid Payment Amount",
            text: "Please enter a valid payment, Payment Should be positive & in numbers only. "
        });
    </script>';

    }else{


    if ($updateAmount > $damount) {

        echo '<script>
        Swal.fire({
            icon: "error",
            title: "Invalid Payment Amount",
            text: "Please enter a valid payment, Amount you entered is more then due amount."
        });
    </script>';


     } 
    //elseif ($updateAmount < $damount) {


    //     echo '<script>
    //     Swal.fire({
    //         icon: "error",
    //         title: "Invalid Payment Amount",
    //         text: "Please enter a valid payment, Amount you Entered is less Then Due Amount.",
    //     });
    // </script>';

    // } 
    else {

        $newPA = $pamount + $updateAmount;
        $newDA = $damount - $updateAmount;

        $updateQuery = "UPDATE `cust_details` SET `paidamount` = '$newPA', `dueamount` = '$newDA' WHERE `id` = $id AND `phone` = '$phone'";


        if (mysqli_query($conn, $updateQuery)) {
            // The record was updated successfully
            echo '<script>
            Swal.fire({
                icon: "success",
                title: "Payment Updated Successfully",
                text: "Payment details have been updated.",
                showConfirmButton: false,
                timer: 3000
            }).then(function() {
                window.location.href = "./";
            });
        </script>';
        } else {
            // There was an error updating the record
            echo '<script>
            Swal.fire({
                icon: "error",
                title: "Error Updating Payment",
                text: "An error occurred while updating the payment.",
                showConfirmButton: false,
                timer: 3000
            });
        </script>';
        }
    }
}}
?>

<script src="../../js/sweetalert.js"></script>
<script src="../../js/script.js"></script>

</body>

</html>
