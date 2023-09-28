<?php

session_start();
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



if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];




    $conn = mysqli_connect("localhost", "root", "", "billing");

    // Personal Details
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Booking Details
    $totalA = $_POST['totalamount'];
    $paidA = $_POST['paidamount'];
    $dueA = $totalA - $paidA;
    $days = $_POST['days'];
    $timeSlot = $_POST['time-slot'];
    $vehicle = $_POST['vehicle'];
    $boolLicence = $_POST['newlicence'];
    $trainername = $_POST['trainername'];
    $trainerphone = $_POST['trainerphone'];
    $formfiller = $_POST['formfiller'];

    $update = "UPDATE `cust_details` SET `name`='$name',`email`='$email',`phone`='$phone',`address`='$address',`totalamount`='$totalA',`paidamount`='$paidA',`dueamount`='$dueA',`days`='$days',`timeslot`='$timeSlot',`vehicle`='$vehicle',`newlicence`='$boolLicence',`trainername`='$trainername',`trainerphone`='$trainerphone',`formfiller`='$formfiller' WHERE `id`='$id' ";
    $result = mysqli_query($conn, $update);
    if (!$result) {
        die("Error updating row: " . mysqli_error($conn));
    } else {
        header('location:' . $_GET['route']);
    }
}




?>

<!DOCTYPE html>
<html>

<head>
    <title>Profile Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0px;
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .profile-container {
            max-width: 1500px;
            width: 1300px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            flex-direction: column;

        }

        .profile-image {
            flex: 0 0 120px;
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-image img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
        }

        .profile-details {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        form .row {
            flex-wrap: wrap;
            display: flex;
            align-items: start;
            justify-content: center;
            flex-direction: row;
            gap: 40px;
        }


        .profile-details p {
            margin: 5px 0;
            padding: 10px;
            width: 500px;

        }

        .profile-details label {
            font-weight: bold;
        }

        .profile-details input,
        select {
            padding: 8px;
            max-width: 500px;
            width: 100%;
            font-size: 20px;

        }


        .profile-buttons {
            margin-top: -5px;
            display: flex;
            justify-content: center;
        }

        .profile-buttons a,
        input[type='submit'] {
            padding: 10px 20px;
            margin-left: 10px;
            border: none;
            border-radius: 3px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }

        .profile-buttons .edit-btn,
        .profile-buttons .delete-btn {

            color: #fff;
            font-size: 20px;

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


        /* Style the profile-buttons container */
        .profile-buttons {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 20px;
        }

        /* Style the edit button */
        .edit-btn {
            width: 350px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 3px;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: all .3s;

        }

        /* Add hover effect to the edit button */
        .edit-btn:hover {
            background-color: #45a049;
        }

        .delete-btn {
            width: 350px;
            padding: 10px 20px;
            background-color: #f44336;
            color: #fff;
            border: none;
            border-radius: 3px;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: all .3s;

        }

        /* Add hover effect to the delete button */
        .delete-btn:hover {
            background-color: #db0000;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../../css/navbar.css">
</head>

<body>

    <section id="content">
        <nav>
            <a class="home-link" href="<?php echo $_GET['route'] ?>">
                Back
            </a>
            <span class="text">
                <h3>Patel Motor Driving School</h3>

            </span>
            <a href="../" class="profile">
                <img src="../../assets/logoBlack.png">
            </a>
        </nav>

    </section>


    <?php
    $connect = mysqli_connect("localhost", "root", "", "billing");
    $backRoute = '';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $email = $_GET['email'];
        $name = $_GET['name'];
        $query = "SELECT * FROM `cust_details` WHERE phone = '$id' AND email = '$email' AND name = '$name'";
        $result = mysqli_query($connect, $query);
        $row = mysqli_fetch_assoc($result);
    }
    ?>
    <div class="profile-container">
        <div class="profile-image">
            <img src="../generate_image.php?name=<?php echo $name; ?>">
        </div>
        <div class="profile-details">

            <form method="post" id="edit-form">

                <div class="row">
                    <div>
                        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                        <p><label>Name:</label></br>
                            <input type="text" name="name" value="<?php echo $row["name"]; ?>">
                        </p>
                        <p><label>Email:</label></br>
                            <input type="text" name="email" value="<?php echo $row["email"]; ?>">
                        </p>
                        <p><label>Phone:</label></br>
                            <input type="text" name="phone" value="<?php echo $row["phone"]; ?>">
                        </p>
                        <p><label>Address:</label></br>
                            <input type="text" name="address" value="<?php echo $row["address"]; ?>">
                        </p>
                    </div>
                    <div>
                        <p><label>Total Amount:</label></br>
                            <input type="text" name="totalamount" value="<?php echo $row["totalamount"]; ?>">
                        </p>
                        <p><label>Paid Amount:</label></br>
                            <input type="text" name="paidamount" value="<?php echo $row["paidamount"]; ?>">
                        </p>
                        <p><label>Due Amount:</label></br>
                            <input type="text" name="dueamount" value="<?php echo $row["dueamount"]; ?>" readonly>
                        </p>
                        <p><label>Days:</label></br>
                            <input type="text" name="days" value="<?php echo $row["days"]; ?>">
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <p><label>Time-Slot:</label></br>
                            <select name="time-slot">
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

                                $selectedTimeSlot = $row["timeslot"];
                                foreach ($timeSlots as $timeSlot) {
                                    $selected = ($timeSlot === $selectedTimeSlot) ? "selected" : "";
                                    echo "<option value='$timeSlot' $selected>$timeSlot</option>";
                                }
                                ?>

                            </select>
                        </p>
                        <p><label>Vehicle:</label></br>
                            <input type="text" name="vehicle" value="<?php echo $row["vehicle"]; ?>">
                        </p>
                        <p><label>New Licence:</label></br>

                            <select name="newlicence">
                                <?php
                                $boolLicence = array("Applied" => "Applied", "Not Applied" => "Not Applied");
                                $select = $row["newlicence"];
                                foreach ($boolLicence as $Licence) {
                                    $selected = ($Licence == $select) ? "selected" : "";
                                    echo "<option value='$Licence' $selected>$Licence</option>";
                                }
                                ?>
                            </select>

                        </p>
                        <p><label>Trainer Name:</label></br>
                            <input type="text" name="trainername" value="<?php echo $row["trainername"]; ?>">
                        </p>
                        <p><label>Trainer Phone:</label></br>
                            <input type="text" name="trainerphone" value="<?php echo $row["trainerphone"]; ?>">
                        </p>

                    </div>
                    <div>
                        <p><label>Admission Date:</label></br>
                            <input type="text" name="date" value="<?php echo $row["date"]; ?>" readonly>
                        </p>
                        <p><label>Admission Time:</label></br>
                            <input type="text" name="time" value="<?php echo $row["time"]; ?>" readonly>
                        </p>
                        <p><label>Training Started On:</label></br>
                            <input type="text" name="startedAT" value="<?php echo $row["startedAT"]; ?>" readonly>
                        </p>
                        <p><label>Training Ended On:</label></br>
                            <input type="text" name="endedAT" value="<?php echo $row["endedAT"]; ?>" readonly>
                        </p>
                        <p><label>Form Filler:</label></br>
                            <input type="text" name="formfiller" value="<?php echo $row["formfiller"]; ?>">
                        </p>
                    </div>
                </div>
        </div>
        <div class="profile-buttons">
            <input class="edit-btn" name="edit" value="Edit" readonly>
            <input class="delete-btn" name="delete" value="Delete" readonly>
        </div>
        </form>

        <form method="post" id="delete-form" style="display: none;">
            <input type="hidden" name="DELid" value="<?php echo $row["id"]; ?>">

            <input type="text" name="DELname" value="<?php echo $row["name"]; ?>">

            <input type="text" name="DELemail" value="<?php echo $row["email"]; ?>">

            <input type="text" name="DELphone" value="<?php echo $row["phone"]; ?>">
        </form>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Add an event listener to the edit button
                document.querySelector(".edit-btn").addEventListener("click", function (e) {
                    // Show a SweetAlert confirmation dialog
                    Swal.fire({
                        title: "Confirm Edit",
                        text: "Are you sure you want to edit this profile?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "#4CAF50",
                        cancelButtonColor: "#f44336",
                        confirmButtonText: "Yes, edit it!",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // If the user confirms, submit the form
                            document.getElementById("edit-form").submit();
                        }
                    });
                });



                document.querySelector(".delete-btn").addEventListener("click", function (e) {
                    // Show a SweetAlert confirmation dialog
                    Swal.fire({
                        title: "Confirm Removal",
                        text: `Are you sure you want to remove this customer?`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Yes, remove it",
                        cancelButtonText: "Cancel",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // If the user confirms, submit the form
                            document.getElementById("delete-form").submit();
                        }
                    });
                });

            });
        </script>
      
            <?php
            $tables = array("i10" => "car_one", "Liva" => "car_two");
            $conn = mysqli_connect("localhost", "root", "", "billing");

            if (isset($_POST['DELid'])) {
                $id = $_POST['DELid'];
                $name = $_POST['DELname'];
                $email = $_POST['DELemail'];
                $phone = $_POST['DELphone'];

                $select = "SELECT * FROM `cust_details` WHERE id = $id AND name ='$name' AND phone = '$phone'";
                $selectResult = mysqli_query($conn, $select);
                $row = mysqli_fetch_assoc($selectResult);

                $table = null;
                $inputString = $row['vehicle'];

                // Check if the string starts with "Two Wheeler"
                if (strpos($inputString, "Two Wheeler") === 0) {
                    // Handle Two Wheeler case if needed
                } else {
                    // Define a regular expression pattern to match the model name
                    $pattern = '/\b(i10|Liva)\b/';

                    if (preg_match($pattern, $inputString, $matches)) {
                        $modelName = $matches[0];
                        $tableKey = $modelName;
                        $table = $tables[$tableKey];
                    }
                }


                $sql = "DELETE FROM `cust_details` WHERE id = $id AND phone = '$phone' AND name = '$name'";
                $resultf = mysqli_query($conn, $sql);

                if (!isset($resultf)) {
                    echo '<script>Swal.fire("Error", "Failed to remove customer.", "error");</script>';
                } else {
                   
                    try {
                        if ($table != null) {
                            $check = "SELECT * FROM `$table` WHERE phone = '$phone' and name = '$name'";
                            $CheckStatus = mysqli_query($conn, $check);
                            $statusRow = mysqli_fetch_assoc($CheckStatus);
                            if ($CheckStatus) {
                                $status = $statusRow['status'];
                                $statusP = $statusRow['phone'];
                                $statusID = $statusRow['id'];
                                $statusN = $statusRow['name'];

                                $update2 = "UPDATE `$table` SET name='', phone='', vehicle='', trainer='', start_date='', end_date='', status='empty' WHERE id = $statusID AND phone = '$statusP' AND name = '$statusN'";
                                mysqli_query($conn, $update2);
                            }

                        }
                    } catch (Exception $e) {
                        // Handle the exception here
                        echo '<script> Swal.fire("Error", "An error occurred while processing the request.", "error"); </script>';
                    }

                    echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Removed!',
                        text: 'Customer " . $name . " has been removed',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    setTimeout(function () {
                        window.location.href = '../';
                    }, 2000);
                    </script>";

                    logActivity('admin_logs', $_SESSION['admin_name'], "Customer ".$name." has been removed form database | Details:- Name: ".$name." Phone: ".$phone);
                    exit();

                }
            }
            ?>

        
</body>

</html>