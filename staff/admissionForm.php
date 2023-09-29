<?php


include('../includes/authenticationStaff.php');
function logActivity($logType, $who, $activity)
{
    date_default_timezone_set('Asia/Kolkata');

    $logFolder = '../logs/' . $logType;

    if (!file_exists($logFolder)) {
        mkdir($logFolder, 0755, true);
    }

    $logFile = $logFolder . '/admission_logs.json';

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






if (isset($_POST['book-admission'])) {

    // varaibles


    // Personal Details
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];


    // Booking Details
    $totalA = $_POST['totalA'];
    $paidA = $_POST['paidA'];
    $dueA = $totalA - $paidA;
    $tempS = $_POST['startingForm'];
    $days = $_POST['days'];
    $timeSlot = $_POST['time-slot'];



    $Tname = $_POST['Tname'];
    $Tnum = $_POST['Tnumber'];


    // time and date

    date_default_timezone_set('Asia/Kolkata');
    $current_timestamp_by_mktime = mktime(date("m"), date("d"), date("Y"));
    $currentDate = date("Y-m-d", $current_timestamp_by_mktime);
    $currentMakeTime = strtotime("now");
    $currentTime = date("h:i:sa", $currentMakeTime);
    $startedAT = date('Y-m-d', strtotime((int) $currentDate . ' +' . $_POST['startingForm'] . ' days'));
    $days -= 1;
    $EndsTemp = date('Y-m-d', strtotime($startedAT . ' +' . $days . ' days'));


    if ($_POST['ARSundays'] == 'remove') {
        $start_date = $startedAT;
        $end_date = $EndsTemp;

        $start = new DateTime($start_date);
        $end = new DateTime($end_date);
        $interval = new DateInterval('P1D');
        $period = new DatePeriod($start, $interval, $end);

        $count = 0;
        foreach ($period as $date) {
            if ($date->format('N') == 7) {
                $count++;
            }
        }


        $Ends_On = date('Y-m-d', strtotime($EndsTemp . ' +' . $count . ' days'));


        if (date('N', strtotime($Ends_On)) == 7) {

            $Ends_On = date('Y-m-d', strtotime($Ends_On . ' +1 day'));
        }
        // echo $count . "</br>";

    } else {
        $Ends_On = date('Y-m-d', strtotime($currentDate . ' +' . $days . ' days'));
    }





    // Check if add ons

    if (isset($_POST['add-ons'])) {

        $add_ons = "Applied";

    } else {
        $add_ons = "Not Applied";
    }



    $vehicle = $_POST['vehicle'];

    if ($vehicle == '4wheeler') {
        $carName = $_POST['carName'];
        $distance = $_POST['distance'];

        $CarDetails = "Four Wheeler  ";
        $CarDetails .= $carName;

        $TandD = $distance . "Km ";

        $vehicleDetails = $CarDetails . "/ " . $TandD;


    } elseif ($vehicle == '2wheeler') {

        $bikeName = "Two Wheeler";
        $bikeTime = $_POST['bikeTime'] . " mins ";

        $vehicleDetails = $bikeName . "/ " . $bikeTime;


    }


    $CheckNum = " SELECT * FROM `cust_details` WHERE phone = $phone";
    $result = mysqli_query($conn, $CheckNum);

    if (mysqli_num_rows($result) > 0) {

        $error[] = 'Phone Number already exist!';

    } else {

        if ($carName == "i10") {

            $CheckStatus = "SELECT * FROM `car_one` WHERE timeslots = '$timeSlot'";
            $result = mysqli_query($conn, $CheckStatus);
            $row = mysqli_fetch_assoc($result);
            if ($row['status'] != "empty") {

                $error[] = $timeSlot . '  Time Slot is already Taken in ' . $carName . '!';

            } else {

                $updata = "UPDATE `car_one` SET name='$name', phone='$phone', vehicle='$vehicleDetails', trainer='$Tname', start_date='$startedAT', end_date='$Ends_On', status='active' WHERE timeslots = '$timeSlot'";
                mysqli_query($conn, $updata);
                if (!isset($result)) {
                    $error[] = "Error inserting data in Time Table: " . mysqli_error($conn);
                }


            }
        }
        if ($carName == "Liva") {

            $CheckStatus = "SELECT * FROM `car_two` WHERE timeslots = '$timeSlot'";
            $result = mysqli_query($conn, $CheckStatus);
            $row = mysqli_fetch_assoc($result);
            if ($row['status'] != "empty") {

                $error[] = $timeSlot . '  Time Slot is already Taken in ' . $carName . '!';

            } else {

                $updata = "UPDATE `car_two` SET name='$name', phone='$phone', vehicle='$vehicleDetails', trainer='$Tname', start_date='$startedAT', end_date='$Ends_On', status='active' WHERE timeslots = '$timeSlot'";
                mysqli_query($conn, $updata);
                if (!isset($result)) {
                    $error[] = "Error inserting data in Time Table: " . mysqli_error($conn);
                }


            }
        }

        if (!isset($error)) {


            $days += 1;
            $insert = "INSERT INTO `cust_details`(`name`, `email`, `phone`, `address`, `totalamount`, `paidamount`, `dueamount`, `days`, `timeslot`, `vehicle`, `newlicence`, `trainername`, `trainerphone`, `date`, `time`, `endedAT`,  `startedAT`, `formfiller`) VALUES('$name','$email','$phone','$address', '$totalA','$paidA','$dueA','$days', '$timeSlot', '$vehicleDetails','$add_ons', '$Tname', '$Tnum','$currentDate','$currentTime','$Ends_On','$startedAT','" . $_SESSION['staff_name'] . "')";

            $result = mysqli_query($conn, $insert);


            if (isset($result)) {

                logActivity('staff_logs', $_SESSION['staff_name'], array("What" => "Booked Admission", array("customer_details" => array("name" => $name, "phone" => $phone, "car" => $vehicleDetails, "timeSlot" => $timeSlot, "addmission_date" => $currentDate, "days" => $days, "started_at" => $startedAT, "ended_at" => $Ends_On, "formfiller" => $_SESSION['staff_name']))));

                if ($vehicle == '4wheeler') {



                    header('location:../previewPDF.php?id=' . $phone . '&email=' . $email . '&name=' . $name . '&VN=' . $CarDetails . '&TT=' . $TandD . '&who=staff');

                } elseif ($vehicle == '2wheeler') {


                    header('location:../previewPDF.php?id=' . $phone . '&email=' . $email . '&name=' . $name . '&VN=' . $bikeName . '&TT=' . $bikeTime . '&who=staff');
                }

            } else {
                $error[] = "Error inserting data: " . mysqli_error($conn);
            }




        }

    }

}
?>



<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../css/admissionForm.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="shortcut icon" type="image/png" href="../assets/logo.png" />
    <link rel="stylesheet" href="../css/navbar.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Admission Form</title>
</head>

<body>


    <section id="content" style="width: 100%; position: sticky; margin-bottom: 10px; ">
        <nav>
            <div class="btn-s">
                <a href="./" class="home-link" style="margin-right: 20px;">
                    Back
                </a>
                <a href="timetable" class="home-link">
                    View Time-Slots
                </a>
            </div>
            <span class="text">
                <h3>Patel Motor Driving School</h3>

            </span>
            <a href="./" class="profile" style="margin-left: 140px;">
                <img src="../assets/logoBlack.png">
            </a>
        </nav>

    </section>

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

    <div class="container">
        <header>Admission Form</header>

        <form method="post">
            <div class="form first">
                <div class="details personal">
                    <span class="title">Personal Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Full Name</label>
                            <input type="text" name="name" placeholder="Enter Name" required>
                        </div>

                        <div class="input-field">
                            <label>Email</label>

                            <input type="text" name="email" placeholder="Enter Email" required>

                        </div>

                        <div class="input-field">
                            <label>Mobile Number</label>
                            <input type="number" name="phone" placeholder="Enter Mobile number" required>
                        </div>


                        <div class="input-field">
                            <label>Address</label>
                            <input type="text" name="address" placeholder="Enter Address" required>
                        </div>
                    </div>
                </div>
                <div class="details ID">

                    <span class="title">Booking Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Total Amount</label>
                            <input type="text" name="totalA" placeholder="Enter Total Amount" required>
                        </div>

                        <div class="input-field">
                            <label>Paid Amount</label>
                            <input type="number" name="paidA" placeholder="Enter Paid Amount" required>
                        </div>

                        <div class="input-field">
                            <label>Days</label>
                            <input type="text" name="days" placeholder="Enter Days" required>
                        </div>

                        <div class="input-field" id="timeSlotsContainer">
                            
                        </div>


                        <div class="input-field">
                            <label>Select vehicle</label>
                            <select name="vehicle" onchange="showFields(this)" required>
                                <option disabled selected>Select Vehicle</option>
                                <option value="4wheeler">Four Wheeler</option>
                                <option value="2wheeler">Two Wheeler</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <label>Select Training Starting From</label>
                            <select name="startingForm" required>
                                <option disabled>Select Training Starting From</option>
                                <option value="0" selected>Same Day</option>
                                <option value="1">Tomorrow</option>
                                <option value="2">Overmorrow</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <label>Sundays</label>
                            <select name="ARSundays" required>
                                <option value="remove" selected>Dont Count</option>
                                <option value="add">Count</option>
                            </select>
                        </div>

                        <div class="box" style="">

                            <label style="
                            font-size: 12px;
                            margin-left: 4px;
                            margin-bottom: 10px; color: #080800;">
                                Add Ons</label>

                            <div class="boxborder" style="
                    border: 1px solid rgb(129, 129, 129);
                    padding: 6.5px 5px 6.5px 19px;
                    border-radius: 4px;
                    width: 285px;">
                                <div class="input-field"
                                    style="justify-content: flex-start; gap: 11px; align-items: center; flex-direction: row; width: 146px;  max-height: 26px; align-items: center; margin: 0px;">
                                    <label style="color: rgb(143, 143, 143);">New Licence</label>

                                    <input type="checkbox" name="add-ons" value="LNew" style="width: 20px;">
                                </div>
                            </div>

                        </div>

                        <div id="carFields" style="display: none;">

                            <div class="input-field">
                                <label>Car Name</label>
                                <!-- <input type="text" name="carName" id="carName"> -->
                                <select name="carName" id="carName" required>
                                    <option disabled selected>Select Car</option>
                                    <option value="i10">Hyundai i10</option>
                                    <option value="Liva">Toyota Liva</option>
                                </select>
                            </div>

                            <div class="input-field">
                                <label>Distance [ Kilometers ]</label>
                                <input type="text" name="distance" id="distance" placeholder="Enter Distance">
                            </div>

                        </div>

                        <div id="bikeFields" style="display: none;">
                            <div class="input-field">
                                <label>Time [ mins ]</label>
                                <input type="text" name="bikeTime" id="bikeTime" placeholder="Enter distance">
                            </div>
                        </div>




                    </div>




                </div>

                <div class="trainer-details">
                    <span class="title">Trainer Details</span>
                    <div class="fields" style="justify-content:flex-start; gap: 40px;">

                        <div class="input-field">
                            <label>Trainer Name</label>
                            <input type="name" autocomplete="off" name="Tname" placeholder="Enter Name" required>
                        </div>

                        <div class="input-field">
                            <label>Trainer Number</label>
                            <input type="phone" autocomplete="off" name="Tnumber" placeholder="Enter Number" required>
                        </div>
                    </div>
                    <!-- <button class="nextBtn"> -->
                    <!-- <span class="btnText"> -->
                    <input class="nextBtn" type="submit" name="book-admission" class="enter" value="Book Admission"
                        style="    height: 45px;
                        max-width: 200px;
                        width: 100%;
                        border: none;
                        outline: none;
                        color: #fff;
                        border-radius: 5px;
                        margin: 25px 0;
                        background-color: #4070f4;
                        cursor: pointer;
                        ">
                    <!-- <i class="uil uil-navigator"></i> -->
                    <!-- </button> -->
                </div>

        </form>


        <script>
            function showFields(select) {
                var carFields = document.getElementById("carFields");
                var bikeFields = document.getElementById("bikeFields");

                if (select.value === "4wheeler") {
                    carFields.style.display = "flex";
                    carFields.style.gap = "50px";
                    carFields.style.width = "100%"
                    bikeFields.style.display = "none";
                } else if (select.value === "2wheeler") {
                    carFields.style.display = "none";
                    bikeFields.style.display = "flex";
                    bikeFields.style.gap = "50px";
                    bikeFields.style.width = "100%"
                }
            }
        </script>
        <script>
        function loadCarContent(car) {
            $.ajax({
                url: car + '.php',
                type: 'GET',
                success: function(data) {
                    $('#timeSlotsContainer').html(data);
                },
                error: function() {
                    $('#timeSlotsContainer').html('Error loading car content.');
                }
            });
        }

        const carNameSelect = document.getElementById('carName');
        carNameSelect.addEventListener('change', function() {
            const selectedCar = this.value;
            if (selectedCar) {
                loadCarContent(selectedCar);
            }
        });
    </script>
</body>

</html>