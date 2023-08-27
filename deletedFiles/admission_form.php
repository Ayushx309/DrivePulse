<?php

include('../includes/authentication.php');


$add_ons = array("LNew" => 0, "LRnew" => 0, "LDup" => 0, "LNT" => 0, );


if (isset($_POST['book-admission'])) {

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $totalA = $_POST['totalA'];
    $paidA = $_POST['paidA'];
    $dueA = $totalA - $paidA;
    $Tname = $_POST['Tname'];
    $Tnum = $_POST['Tnumber'];
    $days = $_POST['days'];


    date_default_timezone_set('Asia/Kolkata');
    $current_timestamp_by_mktime = mktime(date("m"), date("d"), date("Y"));
    $currentDate = date("Y-m-d", $current_timestamp_by_mktime);
    $currentMakeTime = strtotime("now");
    $currentTime = date("h:i:sa", $currentMakeTime);

    $Ends_On =  date('Y-m-d', strtotime((int)$currentDate . ' +'.$days.' days'));
    

    if (isset($_POST['add-ons'])) {

        $Chad_ons = $_POST['add-ons'];

        for ($i = 0; $i < count($Chad_ons); $i++) {
            $add_ons[$Chad_ons[$i]] = 1;
        }

    }


    $LNew = $add_ons['LNew'];
    $LRnew = $add_ons['LRnew'];
    $LDup = $add_ons['LDup'];
    $LNT = $add_ons['LNT'];




    $vehicle = $_POST['vehicle'];

    if ($vehicle == '4wheeler') {
        $carName = $_POST['carName'];
        $time = $_POST['time'];
        $distance = $_POST['distance'];

        $CarDetails = "Four Wheeler  ";
        $CarDetails .= $carName;

        $TandD = $time . 'mins , ' . $distance . "Km ";

        $vehicleDetails = $CarDetails ."/ ". $TandD;


    } elseif ($vehicle == '2wheeler') {

        $bikeName = "Two Wheeler";
        $bikeTime = $_POST['bikeTime'] . " mins";

        $vehicleDetails = $bikeName ."/ ". $bikeTime;


    }


    $insert = "INSERT INTO `cust_details`( `name`, `phone`, `email`, `address`, `totalamount`, `vehicle`, `trainername`, `trainerphone`, `date`, `time`, `days`, `ends_on`) VALUES('$name','$phone','$email','$address', '$totalA','$vehicleDetails','$Tname','$Tnum', '$currentDate', '$currentTime','$days', '$Ends_On')";

    $result = mysqli_query($conn, $insert);
    if (isset($result)) {


        if ($vehicle == '4wheeler') {



            header('location:../Format.php?id=' . $phone . '&email=' . $email . '&name=' . $name . '&TA=' . $totalA . '&PA=' . $paidA . '&DA=' . $dueA . '&VN=' . $CarDetails . '&TT=' . $TandD . '&Tname=' . $Tname . '&Tnum=' . $Tnum . '&LNew=' . $LNew . '&LRnew=' . $LRnew . '&LDup=' . $LDup . '&LNT=' . $LNT);

        } elseif ($vehicle == '2wheeler') {


            header('location:../Format.php?id=' . $phone . '&email=' . $email . '&name=' . $name . '&TA=' . $totalA . '&PA=' . $paidA . '&DA=' . $dueA . '&VN=' . $bikeName . '&TT=' . $bikeTime . '&Tname=' . $Tname . '&Tnum=' . $Tnum . '&LNew=' . $LNew . '&LRnew=' . $LRnew . '&LDup=' . $LDup . '&LNT=' . $LNT);
        }

    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }



}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Form</title>
 
    <link rel="stylesheet" href="../css/admission_form.css">
  

</head>

<body>
    <?php
    
    include('../includes/headerlvl2.php');
    
    ?>


    <div class="container">
        <div class="card">
            <p class="Cname">Admission Form</p>
            <form method="post" class="form-container">
                <p>Customer Details</p>
                <div class="inputBox1">
                    <input type="text" name="name" autocomplete="off" required>
                    <span class="user">Name</span>
                </div>


                <div class="inputBox1">
                    <input type="phone" autocomplete="off" name="phone" required>
                    <span>Mobile Number</span>
                </div>

                <div class="inputBox1">
                    <input type="email" autocomplete="off" name="email" required>
                    <span>email</span>
                </div>

                <div class="inputBox1">
                    <input type="text" autocomplete="off" name="address" required>
                    <span>address</span>
                </div>


                <div class="inputBox1">
                    <input type="number" autocomplete="off" name="totalA" required>
                    <span>Total Amount</span>
                </div>

                <div class="inputBox1">
                    <input type="number" autocomplete="off" name="paidA" required>
                    <span>Paid Amount</span>
                </div>

                <div class="inputBox1">
                    <input type="number" autocomplete="off" name="days" required>
                    <span>Days</span>
                </div>

                <div class="vehicle-list">
                    <p>Four Wheeler <input type="radio" name="vehicle" value="4wheeler" onchange="showFields(this)"
                            required></p>
                    <p>Two Wheeler <input type="radio" name="vehicle" value="2wheeler" onchange="showFields(this)"
                            required></p>
                </div>

                <div id="carFields" style="display: none;">
                    <div class="inputBox1">
                        <label for="carName"></label>
                        <input type="text" name="carName" id="carName">
                        <span>Car name</span>
                    </div>
                    </br>
                    <div class="inputBox1">
                        <label for="time"></label>
                        <input type="text" name="time" id="time">
                        <span>Time [ mins ]</span>
                    </div>
                    </br>
                    <div class="inputBox1">
                        <label for="distance"></label>
                        <input type="text" name="distance" id="distance">
                        <span>Distance [ KM ]</span>
                    </div>
                    </br>

                </div>

                <div id="bikeFields" style="display: none;">
                    <div class="inputBox1">
                        <label for="bikeTime"></label>
                        <input type="text" name="bikeTime" id="bikeTime">
                        <span>Time [ mins ]</span>
                    </div>
                    </br>
                </div>


                <p>Licence Add-Ons</p>
                <div class="checkBoxs">
                    <label class="checkDateTime">
                        <p>New Licence</p><input type="checkbox" name="add-ons[]" value="LNew">
                        <div class="checkmark"></div>
                    </label>
                    <label class="checkDateTime">
                        <p>ReNew Licence</p><input type="checkbox" name="add-ons[]" value="LRnew">
                        <div class="checkmark"></div>
                    </label>
                    <label class="checkDateTime">
                        <p>Duplicate</p><input type="checkbox" name="add-ons[]" value="LDup">
                        <div class="checkmark"></div>
                    </label>
                    <label class="checkDateTime">
                        <p>Name Transfer</p><input type="checkbox" name="add-ons[]" value="LNT">
                        <div class="checkmark"></div>
                    </label>

                </div>


                <p>Trainer Details</p>
                <div class="inputBox1">
                    <input type="text" autocomplete="off" name="Tname" required>
                    <span>Trainer Name</span>
                </div>

                <div class="inputBox1">
                    <input type="text" autocomplete="off" name="Tnumber" required>
                    <span>Trainer Number</span>
                </div>

                <!-- <div class="checkBoxs">
                    <label class="checkDateTime">
                        <p>Current Date & Time: </p><input type="checkbox" name="date-time" checked>
                        <div class="checkmark"></div>
                    </label>
                    <label class="checkDateTime">
                        <p>Digital Signature: </p><input type="checkbox" name="digital-signature">
                        <div class="checkmark"></div>
                    </label>
                </div> -->





                <input type="submit" name="book-admission" class="enter" value="Book Admission">
            </form>
        </div>
    </div>

    <script>
        function showFields(radio) {
            var carFields = document.getElementById("carFields");
            var bikeFields = document.getElementById("bikeFields");

            if (radio.value === "4wheeler") {
                carFields.style.display = "block";
                bikeFields.style.display = "none";
            } else if (radio.value === "2wheeler") {
                carFields.style.display = "none";
                bikeFields.style.display = "block";
            }
        }
    </script>


</body>

</html>