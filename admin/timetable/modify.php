<?php

include('../../config.php');


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
}


if (isset($_POST['modify'])) {

    $tables = array("i10" => "car_one", "liva" => "car_two");
    $table = $tables[$_GET['car']];
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

    $check = "SELECT * FROM `$table` WHERE timeslots = '$timeslot'";
    $result = mysqli_query($conn, $check);
    $row = mysqli_fetch_assoc($result);

    if ($row['status'] == "active") {

        $error[] = "Time Slot is already Taken";

    } else {


        $update = "UPDATE `$table` SET name='$name', phone='$phone', vehicle='$vehicle', trainer='$trainer',  start_date='$startDate', end_date='$endDate', status='active' WHERE timeslots  = '$timeslot'";
        
        $updateResult = mysqli_query($conn, $update);
        if (!$updateResult) {
            die("Error updating row: " . mysqli_error($conn));
        } else {
            $update2 = "UPDATE `$table` SET name='', phone='', vehicle='', trainer='',  start_date='', end_date='', status='empty' WHERE id = '$id'";
            mysqli_query($conn, $update2);
            header('location:' . $_GET['route'] . '');
        }

    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MODIFY DATA</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;

        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
            margin: 0;
        }

        .modifyData {
            width: 400px;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        .profile-image{
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0px ;
        }


    </style>

    <link rel="stylesheet" href="../../css/navbar.css">

</head>

<body>

    <section id="content">
        <nav>
            <a href="<?php echo $_GET['route']; ?>" class="home-link">
                Back
            </a>
            <span class="text">
                <h3>Patel Motor Driving School</h3>

            </span>
            <a href="#" class="profile">
                <img src="../../assets/logoBlack.png">
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
 
        <div class="modifyData">
        <div class="profile-image">
            <img src="https://www.gravatar.com/avatar/38ed5967302ec60ff4417826c24feef6?s=80&d=mm&r=g" alt="Profile Image">
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
                <input type="submit" value="modify" name="modify">
            </form>
        </div>
    </div>



</body>

</html>