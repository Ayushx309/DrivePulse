<?php
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
        }
        else{
            header('location:'.$_GET['route']);
        }
    }
?>