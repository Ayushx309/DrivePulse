<?php

include('includes/authentication.php');
@include 'config.php';

$id = $_GET['id'];
$email = $_GET['email'];
$name = $_GET['name'];
$TA = $_GET['TA'];
$PA = $_GET['PA'];
$DA = $_GET['DA'];
$VN = $_GET['VN'];
$TT = $_GET['TT'];






$select = "SELECT * FROM `cust_details` WHERE phone = '$id' AND email = '$email' AND name = '$name' LIMIT 1";

$result = mysqli_query($conn, $select);

// Check if the query was successful
if ($result) {
    // Fetch the row as an associative array
    $row = mysqli_fetch_assoc($result);

    // Display the data from the row
    if ($row) {

        // Personal Details
        $name = $row['name'];
        $phone = $row['phone'];
        $email = $row['email'];
        $address = $row['address'];


        $date = $row['date'];
        $time = $row['time'];
        $days = $row['days'];
        $Tname = $row['trainername'];
        $Tnum = $row['trainerphone'];
        // Continue displaying other columns as needed
    } else {
        echo "No rows found.";
    }


    mysqli_free_result($result);

} else {
    echo "Error executing the query: " . mysqli_error($conn);
}




// if (isset($_POST['book-admission'])) {



//     $name = $_POST['name'];
//     $phone = $_POST['phone'];
//     $email = $_POST['email'];
//     $address = $_POST['address'];
//     $dateTime = $_POST['date-time'];

//     if (isset($dateTime)) {
//         date_default_timezone_set('Asia/Kolkata');
//         $currentDate = mktime(date("m"), date("d"), date("Y"));
//         $currentTime = strtotime("now");

//         $_SESSION["CurrentDate"] = date("Y-m-d", $currentDate);
//         $_SESSION["CurrentTime"] = date("h:i:sa", $currentTime);
//     }






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generated Admission Form PDF</title>
    <script src="https://kit.fontawesome.com/3db79b918b.js" crossorigin="anonymous"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            border: none;
            text-decoration: none;
        }

        /* 
        .images {

            background-image: url("assets/form.png");
            background-repeat: no-repeat;
            background-position: center;
            overflow: scroll;
            background-size: cover;
            height: 100vh;



        } */

        .container {
            width: 100%;
            height: 100%;
        }

        .form-style {
            font-family: 'Poppins', sans-serif;
            width: 410px;
            padding: 10px;
            z-index: 1;
            color: black;
            text-align: start;
            background-color: transparent;

        }

        .container .form-name {

            position: absolute;
            top: 193px;
            left: 125px;


        }

        .container .form-number {

            position: absolute;
            top: 229px;
            left: 200px;


        }

        .container .form-email {

            position: absolute;
            top: 261px;
            left: 125px;


        }

        .container .form-address {

            position: absolute;
            top: 301px;
            left: 145px;


        }

        .container .form-data-time {

            position: absolute;
            top: 380px;
            left: 135px;

        }

        .container .form-data {

            position: absolute;
            top: 377px;
            left: 110px;

        }

        .container .form-time {

            position: absolute;
            top: 377px;
            left: 305px;

        }

        .container .form-days {

            font-size: 20px;
            position: absolute;
            top: 580px;
            left: 79px;

        }

        .container .form-totalA {
            font-size: 15.5px;
            position: absolute;
            top: 643px;
            left: 90px;

        }

        .container .form-paidA {
            font-size: 15.5px;
            position: absolute;
            top: 643px;
            left: 193.5px;

        }

        .container .form-dueA {
            font-size: 15.5px;
            position: absolute;
            top: 643px;
            left: 292.5px;

        }

        .container .form-signature {

            position: absolute;
            top: 870px;
            left: -20px;

        }

        .container .form-signature img {
            width: 290px;
            height: 140px;
        }

        .container .form-Tname {
            position: absolute;
            top: 573px;
            left: 185px;
        }

        .container .form-Tnumber {
            position: absolute;
            top: 573px;
            left: 350px;
        }


        .container .form-Vname {
            position: absolute;
            top: 472px;
            left: 90px;
        }


        .container .form-Vdetails {
            position: absolute;
            font-size: 15px;
            top: 472px;
            left: 270px;
        }

        .container .POSCheck {
            position: absolute;
            top: 713.5px;
            left: 194px;
        }

        .container #checkbox2 {
            left: 265.5px;

        }

        .container #checkbox3 {
            top: 713px;
            left: 361px;

        }

        .container #checkbox4 {
            top: 712.5px;
            left: 493.5px;

        }
    </style>

</head>

<body>

    <!-- <div class="images">

</div> -->



    <div class="container">
        <img src="assets/form.png" height="100%" width="100%" style="image-resolution: 300dpi;">
        <strong class="form-style form-name">
            <?php echo $name; ?>
        </strong>
        <strong class="form-style form-number">
            <?php echo $phone; ?>
        </strong>
        <strong class="form-style form-email">
            <?php echo $email; ?>
        </strong>
        <strong class="form-style form-address">
            <?php echo $address; ?>
        </strong>
        <strong class="form-style form-data-time form-data">
            <?php
            // date_default_timezone_set('Asia/Kolkata');
            // $current_timestamp_by_mktime = mktime(date("m"), date("d"), date("Y"));
            // echo date("Y-m-d", $current_timestamp_by_mktime);
            echo $date;
            ?>
        </strong>
        <strong class="form-style form-data-time form-time">
            <?php
            // date_default_timezone_set('Asia/Kolkata');
            // $current_timestamp = strtotime("now");
            // echo date("h:i:sa", $current_timestamp); 
            echo $time;
            ?>
        </strong>
        <strong class="form-style form-days">
            <?php echo $days; ?>
        </strong>
        <strong class="form-style form-totalA">
            <?php echo $TA; ?>
        </strong>
        <strong class="form-style form-paidA">
            <?php echo $PA; ?>
        </strong>
        <strong class="form-style form-dueA">
            <?php echo $DA; ?>
        </strong>
        <!-- <strong class="form-style form-signature"><img src="assets/signature.png"></strong> -->
        <strong class="form-style form-Tname">
            <?php echo $Tname; ?>
        </strong>
        <strong class="form-style form-Tnumber">
            <?php echo $Tnum; ?>
        </strong>
        <strong class="form-style form-Vname">
            <?php echo $VN; ?>
        </strong>
        <strong class="form-style form-Vdetails">
            <?php echo $TT; ?>
        </strong>

        <!-- <input type="checkbox" class="POSCheck" id="checkbox1">
        <img  class="POSCheck" id="checkbox1" src="assets/checkmark.png" alt="checkmark">
        

        <input type="checkbox" class="POSCheck" id="checkbox2">

        <input type="checkbox" class="POSCheck" id="checkbox3">

        <input type="checkbox" class="POSCheck" id="checkbox4"> -->


    </div>


    <script>

        let features = 'menubar=yes,location=yes,resizable=no,scrollbars=no,status=no';

        function redirectAndClose() {
            let url = 'GeneratingPDF';
            let newWindow = window.open(url, '_blank', features);
        }

        var delay = 100;
        setTimeout(redirectAndClose, delay);


        function redirect() {
            window.location = "http://localhost/Billing_Software/pdf_gen.php?id=<?php echo $id; ?>&email=<?php echo $email ?>&name=<?php echo $name ?>&TA=<?php echo $TA; ?>&PA=<?php echo $PA; ?>&DA=<?php echo $DA; ?>&VN=<?php echo $VN; ?>&TT=<?php echo $TT; ?>&LNew=<?php echo $LNew; ?>&LRnew=<?php echo $LRnew; ?>&LDup=<?php echo $LDup; ?>&LNT=<?php echo $LNT; ?>";
            //   window.open(url);
            // &Tname=<?php echo $Tname; ?>&Tnum=<?php echo $Tnum; ?>

        }
        var delay = 500;
        setTimeout(redirect, delay);

    </script>
<!--     
    <script>
        // Retrieve checkbox elements
        const checkboxes = [
            document.getElementById("checkbox1"),
            document.getElementById("checkbox2"),
            document.getElementById("checkbox3"),
            document.getElementById("checkbox4"),
        ];

        // Values corresponding to each checkbox (0 or 1)
        const checkboxValues = [<?php //echo $LNew; ?>, <?php //echo $LRnew; ?>, <?php //echo $LDup; ?>, <?php //echo $LNT; ?>];

        console.log(checkboxValues);

        // Display and tick checkboxes based on their values
        for (let i = 0; i < checkboxes.length; i++) {
            const checkbox = checkboxes[i];
            const value = checkboxValues[i];

            if (value === 1) {
                checkbox.style.display = "block"; // Display the checkbox
                // Tick the checkbox
            } else {
                checkbox.style.display = "none"; // Hide the checkbox
            }
        }
    </script> -->


</body>

</html>