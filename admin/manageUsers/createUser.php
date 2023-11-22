<?php

include('../../includes/authentication.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/mysqlconnection.php');
date_default_timezone_set('Asia/Kolkata');

$conn = mySqlConnection(); 


?>


<?php


if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);

    if (isset($_POST['permissions'])) {
        $permissions = mysqli_real_escape_string($conn, $_POST['permissions']);
    } else {
        $errors[] = 'Permissions field is required.';
    }


    $select = "SELECT * FROM `users_db` WHERE username = '$username'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $errors[] = 'User already exists!';
    } else {
        if ($pass != $cpass) {
            $errors[] = 'Password mismatch!';
        } else {
            $insert = "INSERT INTO `users_db` (name, username, password, permissions, time) VALUES ('$name', '$username', '$pass', '$permissions', current_timestamp())";
            if (mysqli_query($conn, $insert)) {
                $errors[] = 'User Created!';
                echo '<script>
                setTimeout(function () {
                    window.location.href = "../manageUsers/"; // Redirect to the desired URL
                }, 2000); // Delay for 2 seconds
            </script>';
            } else {
                $errors[] = 'Error creating user: ' . mysqli_error($conn);
            }
        }
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
        .error-msg {
            margin: 10px 0;
            display: block;
            background: #46abcc;
            color: #fff;
            border-radius: 5px;
            font-size: 20px;
            padding: 10px;
        }

        .createUserBox {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 90vh;
            margin: 0;
        }

        .form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .form-container input,
        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
        }

        .form-btn {
            background-color: #46abcc;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 12px 20px;
            font-size: 18px;
            cursor: pointer;
            transition: all .3s;

        }

        .form-btn:hover {
            background-color: #007da5;
        }
    </style>

    <!-- Add SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="shortcut icon" type="image/png" href="../../assets/logo.png" />
    <title>Create Users</title>
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
            <li class="active">
                <a href="./">
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
                    <h1>Create User</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active"  style=" color: #aaaaaa;" href="../">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active"  style=" color: #aaaaaa;" href="./">Manage Users</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active"  href="./createUser">Create Users</a>
                        </li>
                    </ul>
                </div>
                <!-- <a href="Excel/?export=true" class="btn-download">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">Data to Excel</span>
                </a> -->
            </div>

            <div class="createUserBox">
                <div class="form-container" id="create-form">
                    <h2>Create User</h2>
                    <?php
                    if (isset($errors)) {
                        foreach ($errors as $errors) {
                            echo '<span class="error-msg">' . $errors . '</span>';
                        }
                    }
                    ?>

                    <form method="post">
                        <label for="name" style="float: left;">Name</label>
                        <input type="text" name="name" required placeholder="Enter your name">
                        <label for="name" style="float: left;">Username</label>
                        <input type="text" name="username" required placeholder="Enter your username">
                        <label for="name" style="float: left;">Password</label>
                        <input type="password" name="password" required placeholder="Enter your password">
                        <label for="name" style="float: left;">Confirm Password</label>
                        <input type="password" name="cpassword" required placeholder="Confirm your password">
                        <select name='permissions' required>
                            <option disabled selected value='false'>Select Permissions</option>
                            <option value='admin'>admin</option>
                            <option value='staff'>staff</option>
                            <option value='user'>user</option>
                        </select>
                        <input type="submit" name="submit" value="Create Now" class="form-btn">
                    </form>
                </div>
            </div>

        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Add an event listener to the form submission
            document.querySelector(".form-btn").addEventListener("click", function (e) {
                e.preventDefault(); // Prevent the form from submitting
                const name = document.querySelector("input[name='name']").value;
                const username = document.querySelector("input[name='username']").value;
                const password = document.querySelector("input[name='password']").value;
                const cpassword = document.querySelector("input[name='cpassword']").value;
                const permissions = document.querySelector("select[name='permissions']").value;

                if (name === "" || username === "" || password === "" || cpassword === "" || permissions === "Select Permissions") {
                    Swal.fire({
                        icon: "error",
                        title: "Empty Fields",
                        text: "Please fill in all required fields.",
                    });
                } else {
                    const confirmPassword = document.querySelector("input[name='cpassword']").value;
                    if (password !== confirmPassword) {
                        Swal.fire({
                            icon: "error",
                            title: "Password Mismatch",
                            text: "Please make sure your passwords match.",
                        });
                    } else {
                        // Form submission logic here
                        Swal.fire({
                            icon: "success",
                            title: "Registration Successful",
                            text: "You are now registered!",
                        }).then(() => {
                            // If the user confirms, submit the form
                            document.getElementById("registration-form").submit();
                        });
                    }
                }
            });
        });
    </script> -->

    <script src="../../js/sweetalert.js"></script>
    <script src="../../js/script.js"></script>

</body>

</html>
