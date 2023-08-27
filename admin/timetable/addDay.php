<?php

include('../../config.php');



if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $tables = array("i10"=>"car_one","liva"=>"car_two");
    $table = $tables[$_GET['car']];

    $selectDate = "SELECT * FROM `$table` WHERE id = $id";
    $result = mysqli_query($conn,$selectDate);
    $row = mysqli_fetch_assoc($result);

    $end_date = $row['end_date'];
    $name = $row['name'];
    $phone = $row['phone'];

    
    $newEndDate = date('Y-m-d', strtotime($end_date . '+1 day'));
    
    $update = "UPDATE `cust_details` SET endedAT = '$newEndDate' WHERE name = '$name' AND phone='$phone'";
    mysqli_query($conn,$update);

    $update = "UPDATE `$table` SET end_date = '$newEndDate' WHERE id = $id";  
    $result = mysqli_query($conn,$update);
    if (!$result) {
        die("Error updating row: " . mysqli_error($conn));
    } else {
        header('location:'.$_GET['route'].'');
    }
}



?>