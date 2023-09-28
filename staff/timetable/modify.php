<?php
include('../../includes/authenticationStaff.php');

include('../../config.php');

function logActivity($logType, $who, $activity)
{
    date_default_timezone_set('Asia/Kolkata');

    $logFolder = '../../logs/' . $logType;

    if (!file_exists($logFolder)) {
        mkdir($logFolder, 0755, true);
    }

    $logFile = $logFolder . '/logs.json';

    // Read existing log entries from the file, or create an empty array if the file doesn't exist
    $existingLogs = file_exists($logFile) ? json_decode(file_get_contents($logFile), true) : [];

    $logEntry = [
        'timestamp' => date('Y-m-d H:i:s'),
        'who' => $who,
        'activity' => $activity,
    ];

    // Append the new log entry to the existing logs array
    // $existingLogs[] = $logEntry;
    array_unshift($existingLogs, $logEntry);

    // Save the updated logs array back to the file
    file_put_contents($logFile, json_encode($existingLogs, JSON_PRETTY_PRINT));
}


if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $tables = array("i10" => "car_one", "liva" => "car_two");
    $table = $tables[$_GET['car']];

    $selectDate = "SELECT * FROM `$table` WHERE id = $id";
    $result = mysqli_query($conn, $selectDate);
    $row = mysqli_fetch_assoc($result);

    $id = $row['id'];
    $name = $row['name'];
    $phone = $row['phone'];
    $vehicle = $row['vehicle'];
    $trainer = $row['trainer'];
    $Sdate = $row['start_date'];
    $Edate = $row['end_date'];
    $timeSlotDB = $row['timeslots'];

    $string = $vehicle;
    $parts = explode("/", $string);
    $VN = trim($parts[0]);
    $VN = explode(" ", $VN);
    $Fvehicle = trim($VN[3]);
    $Fvehicle = lcfirst($Fvehicle);

}


if (isset($_POST['modify'])) {

    $tables = array("i10" => "car_one", "liva" => "car_two");
    $table = $tables[$_GET['car']];
    $tableKey = array_keys($tables, $table);
    $tableKey = $tableKey[0];

    // $update = "UPDATE `$table` SET name='', phone='', vehicle='', trainer='',  start_date='', end_date='', status='empty' WHERE id = '$id'";
    // $updateResult = mysqli_query($conn, $update);
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $vehicle = $_POST['vehicle'];
    $trainer = $_POST['trainer'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $timeslot = $_POST['time-slot'];
    $carName = $_POST['carName'];

    if ($carName !== $tableKey) {

        $table2 = $tables[$tableKey];
        $table = $tables[$carName];

        $check = "SELECT * FROM `$table` WHERE timeslots = '$timeslot'";
        $result = mysqli_query($conn, $check);
        $row = mysqli_fetch_assoc($result);

        if ($row['status'] == "active") {

            $error[] = "Time Slot is already Taken";

        } else {

            $inputString = $vehicle; // or "Four Wheeler i10/ 5-6Km,"

            // Split the string by '/'
            $parts = explode("/", $inputString);

            // Check if the first part contains "Liva" (case-sensitive)
            if (strpos($parts[0], "Liva") !== false) {
                // Replace "Liva" with your desired word
                $parts[0] = str_replace("Liva", "i10", $parts[0]);
            } elseif (strpos($parts[0], "i10") !== false) {
                // Replace "Liva" with your desired word
                $parts[0] = str_replace("i10", "Liva", $parts[0]);
            }

            // Reconstruct the string
            $vehicle = implode("/", $parts);



            $update = "UPDATE `$table` SET name='$name', phone='$phone', vehicle='$vehicle', trainer='$trainer',  start_date='$startDate', end_date='$endDate', status='active' WHERE timeslots  = '$timeslot'";

            $updateCust = "UPDATE `cust_details` SET timeslot='$timeslot',  vehicle = '$vehicle' WHERE phone = '$phone' AND name = '$name'";

            $updateResult = mysqli_query($conn, $update);
            if (!$updateResult) {
                die("Error updating row: " . mysqli_error($conn));
            } else {
                $update2 = "UPDATE `$table2` SET name='', phone='', vehicle='', trainer='',  start_date='', end_date='', status='empty' WHERE id = '$id'";
                mysqli_query($conn, $update2);
                mysqli_query($conn, $updateCust);



                logActivity('staff_logs', $_SESSION['staff_name'], array("What" => "Modified Data in timetable and Customer database", array("customer_details" => array("name" => $name, "phone" => $phone), "changed_things" => array("car" => array("old" => $_GET['car'], "new" => $carName), "timeSlot" => array("0ld" => $timeSlotDB, "new" => $timeslot)))));

                header('location:' . $_GET['route'] . '');
            }

        }


    } elseif ($carName === $tableKey) {



        $check = "SELECT * FROM `$table` WHERE timeslots = '$timeslot'";
        $result = mysqli_query($conn, $check);
        $row = mysqli_fetch_assoc($result);

        if ($row['status'] == "active") {

            $error[] = "Time Slot is already Taken";

        } else {


            $update = "UPDATE `$table` SET name='$name', phone='$phone', vehicle='$vehicle', trainer='$trainer',  start_date='$startDate', end_date='$endDate', status='active' WHERE timeslots  = '$timeslot'";

            $updateCust = "UPDATE `cust_details` SET timeslot='$timeslot' WHERE phone = '$phone' AND name = '$name' AND vehicle = '$vehicle'";

            $updateResult = mysqli_query($conn, $update);
            if (!$updateResult) {
                die("Error updating row: " . mysqli_error($conn));
            } else {
                $update2 = "UPDATE `$table` SET name='', phone='', vehicle='', trainer='',  start_date='', end_date='', status='empty' WHERE id = '$id'";
                mysqli_query($conn, $update2);
                mysqli_query($conn, $updateCust);

                logActivity('staff_logs', $_SESSION['staff_name'], array("What" => "Modified Data in timetable and Customer database", array("customer_details" => array("name" => $name, "phone" => $phone), "changed_things" => array("car" => array("old" => $_GET['car'], "new" => $carName), "timeSlot" => array("0ld" => $timeSlotDB, "new" => $timeslot)))));


                header('location:' . $_GET['route'] . '');
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
    <title>MODIFY DATA</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 70vh;
            margin: 0;
        }

        .modifyData {
            margin-top: 100px;
            width: 650px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
        }

        .modifyData form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .modifyData input[type="text"],
        .modifyData select {
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
    </style>

    <!-- Add SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="shortcut icon" type="image/png" href="../../assets/logo.png" />
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
            <li class="time-table active">
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
                    <h1>Modify Time Table</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" style=" color: #aaaaaa;" href="../">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" style=" color: #aaaaaa;"
                                href="./<?php echo "?car=" . $_GET['car']; ?>">Time
                                Table</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active"
                                href="./modify.php<?php echo "?id=" . $_GET['id'] . "&car=" . $_GET['car'] . "&route=" . urlencode("../timetable?car=" . $_GET['car']); ?>">Modify</a>
                        </li>
                    </ul>
                </div>
                <!-- <a href="Excel/?export=true" class="btn-download">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">Data to Excel</span>
                </a> -->
            </div>


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

            <div class="container" id="modify">

                <div class="modifyData">
                    <div class="profile-image">
                        <!-- <img src="https://www.gravatar.com/avatar/38ed5967302ec60ff4417826c24feef6?s=80&d=mm&r=g"
                            alt="Profile Image"> -->
                        <img src="../generate_image.php?name=<?php echo $name; ?>" style="border-radius: 100%;">
                    </div>
                    <form method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" readonly>
                        <input type="hidden" name="start_date" value="<?php echo $Sdate; ?>" readonly>
                        <input type="hidden" name="end_date" value="<?php echo $Edate; ?>" readonly>
                        <input type="text" name="name" value="<?php echo $name; ?>" readonly>
                        <input type="text" name="phone" value="<?php echo $phone; ?>" readonly>
                        <input type="text" name="vehicle" value="<?php echo $vehicle; ?>" readonly>
                        <input type="text" name="trainer" value="<?php echo $trainer; ?>" readonly>
                        <select required name="time-slot">
                            <option disabled selected>Select Time Slot</option>

                            <?php

                            $timeSlots = array(
                                "7:00am to 7:30am",
                                "7:30am to 8:00am",
                                "8:00am to 8:30am",
                                "8:30am to 9:00am",
                                "9:00am to 9:30am",
                                "9:30am to 10:00am",
                                "10:00am to 10:30am",
                                "10:30am to 11:00am",
                                "11:00am to 11:30am",
                                "11:30am to 12:00pm",
                                "12:00pm to 12:30pm",
                                "12:30pm to 1:00pm",
                                "1:00pm to 1:30pm",
                                "1:30pm to 2:00pm",
                                "2:00pm to 2:30pm",
                                "2:30pm to 3:00pm",
                                "3:00pm to 3:30pm",
                                "3:30pm to 4:00pm",
                                "4:00pm to 4:30pm",
                                "4:30pm to 5:00pm",
                                "5:00pm to 5:30pm",
                                "5:30pm to 6:00pm",
                                "6:00pm to 6:30pm",
                                "6:30pm to 7:00pm",
                                "7:00pm to 7:30pm",
                                "7:30pm to 8:00pm"
                            );

                            $selectedTimeSlot = $timeSlotDB;
                            foreach ($timeSlots as $timeSlot) {
                                $selected = ($timeSlot === $selectedTimeSlot) ? "selected" : "";
                                echo "<option value='$timeSlot' $selected>$timeSlot</option>";
                            }
                            ?>
                        </select>

                        <select name="carName">
                            <option disabled>Select Car</option>
                            <?php

                            if ($Fvehicle === 'i10') {
                                echo "<option value='i10' selected>Hyundai i10</option>
                                    <option value='liva'>Toyota Liva</option>";
                            } elseif ($Fvehicle === 'liva') {
                                echo "<option value='liva' selected>Toyota Liva</option>
                                            <option value='i10'>Hyundai i10</option>";
                            } else {
                                echo "<option disabled selected>Error Select Car</option>";
                            }

                            ?>
                        </select>
                        <input type="submit" value="modify" name="modify">
                    </form>
                </div>
            </div>



        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="../../js/sweetalert.js"></script>
    <script src="../../js/script.js"></script>

</body>

</html>