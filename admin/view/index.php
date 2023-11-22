<?php

include('../../includes/authentication.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/mysqlconnection.php');
date_default_timezone_set('Asia/Kolkata');

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
        .profile-container {
            max-width: 900px;
            margin: 50px auto;
            background-color: #f9f9f9;
            border-radius: 7px;
            padding: 20px;
            display: flex;
            flex-direction: row;
        }

        .profile-image {
            flex: 0 0 120px;
            text-align: center;
            margin-right: 20px;
        }

        .profile-image img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
        }

        .profile-details {
            flex: 1;
        }

        .profile-details p {
            margin: 5px 0;
        }

        .profile-details label {
            font-weight: bold;
        }

        .profile-buttons {
            margin-top: -5px;
            display: flex;
            justify-content: center;
        }

        .profile-buttons a {
            padding: 10px 20px;
            margin-left: 10px;
            border: none;
            border-radius: 3px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }

        .profile-buttons .edit-btn {

            background-color: #4CAF50;
            color: #fff;

        }

        .profile-buttons .pdf-btn {

            background-color: #2196F3;
            color: #fff;
            text-align: center;
        }

        .profile-buttons .close-btn {

            background-color: #f44336;
            color: #fff;

        }
    </style>

    <!-- Add SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="shortcut icon" type="image/png" href="../../assets/logo.png" />
    <title>View Details</title>
</head>

<body id="root">


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
                    <h1>View Details</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" style=" color: #aaaaaa;" href="../">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="./">View Details</a>
                        </li>
                    </ul>
                </div>
                <!-- <a href="Excel/?export=true" class="btn-download">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">Data to Excel</span>
                </a> -->
            </div>



            <?php
            $connect = mySqlConnection(); 
            $backRoute = '';
            if (isset($_GET['id'])) {

                try {
                    $backRoute = $_GET['route'];
                } catch (Exception $e) {
                    $backRoute = "../";
                }
                $id = $_GET['id'];
                $query = "SELECT * FROM `cust_details` WHERE id = '$id'";
                $result = mysqli_query($connect, $query);
                $row = mysqli_fetch_assoc($result);
                ?>
                <div class="profile-container">
                    <div class="profile-image">
                        <img  src="../generate_image.php?name=<?php echo $row["name"];?>"
                            alt="Profile Image">
                    </div>
                    <div class="profile-details" style="
    padding-right: 50px;
">

                        <p><label>Name:</label>
                            <?php echo $row["name"]; ?>
                        </p>
                        <p><label>Email:</label>
                            <?php echo $row["email"]; ?>
                        </p>
                        <p><label>Phone:</label>
                            <?php echo $row["phone"]; ?>
                        </p>
                        <p><label>Address:</label>
                            <?php echo $row["address"]; ?>
                        </p>

                        <p><label>Total Amount:</label>
                            <?php echo $row["totalamount"]; ?>
                        </p>
                        <p><label>Paid Amount:</label>
                            <?php echo $row["paidamount"]; ?>
                        </p>
                        <p><label>Due Amount:</label>
                            <?php echo $row["dueamount"]; ?>
                        </p>
                        <p><label>Days:</label>
                            <?php echo $row["days"]; ?>
                        </p>
                        <p><label>Time-Slot:</label>
                            <?php echo $row["timeslot"]; ?>
                        </p>

                        <p><label>Vehicle:</label>
                            <?php echo $row["vehicle"]; ?>
                        </p>
                        <p><label>New Licence:</label>
                            <?php echo $row["newlicence"]; ?>
                        </p>
                        <p><label>Trainer Name:</label>
                            <?php echo $row["trainername"]; ?>
                        </p>
                        <p><label>Trainer Phone:</label>
                            <?php echo $row["trainerphone"]; ?>
                        </p>
                        <p><label>Admission Date:</label>
                            <?php echo $row["date"]; ?>
                        </p>

                        <p><label>Admission Time:</label>
                            <?php echo $row["time"]; ?>
                        </p>
                        <p><label>Training Started On:</label>
                            <?php echo $row["startedAT"]; ?>
                        </p>
                        <p><label>Training Ended On:</label>
                            <?php echo $row["endedAT"]; ?>
                        </p>
                        <p><label>Form Filler:</label>
                            <?php echo $row["formfiller"]; ?>
                        </p>
                    </div>
                    <div class="profile-buttons" style="
    display: flex;
    justify-content: flex-start;
    flex-direction: column;
    flex-wrap: wrap;
    gap: 20px;
">
                        <a href="<?php

                        echo "../../viewGeneratedPDF.php?id=" . $row['phone'] . "&email=" . $row['email'] . "&name=" . $row['name'] .  "&route=" . urlencode("admin/view?id=" . $row['id'] . "&phone=" . $row['phone'] ."&route=$backRoute")."&who=admin";

                        ?>" class="pdf-btn" id="pdfBtn">Booking Receipt PDF</a>
                        <a href="<?php

                        echo "../editUserData?id=" . $row['phone'] . "&email=" . $row['email'] . "&name=" . $row['name'] . "&route=" . urlencode("../view/?id=" . $row['id'] . "&phone=" . $row['phone'] . "&route=" . $backRoute);

                        ?>" class="edit-btn">Edit</a>
                        <a href="<?php echo $backRoute; ?>" class="close-btn">Close</a>
                    </div>
                </div>
                <?php
            }
            ?>

        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    <script>

        document.getElementById('pdfBtn').onclick = function(){
            let root = document.getElementById('root');
            root.setAttribute("style","cursor: wait");
        }

    </script>
    <script src="../../js/sweetalert.js"></script>
    <script src="../../js/script.js"></script>

</body>

</html>
