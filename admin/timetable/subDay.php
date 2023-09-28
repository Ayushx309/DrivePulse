<?php

include('../../config.php');
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

    
    $newEndDate = date('Y-m-d', strtotime($end_date . '-1 day'));
    
    $update = "UPDATE `cust_details` SET endedAT = '$newEndDate' WHERE name = '$name' AND phone='$phone'";
    mysqli_query($conn,$update);

    $update = "UPDATE `$table` SET end_date = '$newEndDate' WHERE id = $id";  
    $result = mysqli_query($conn,$update);
    if (!$result) {
        die("Error updating row: " . mysqli_error($conn));
    } else {
        logActivity('admin_logs', $_SESSION['admin_name'], array("What" => "Subtracted one day to Customer in timetable", array("customer_details" => array("name" => $name, "phone" => $phone), "changed_things" => array("car" => $_GET['car'], "date" => array("0ld" => $end_date, "new" => $newEndDate)))));

        header('location:'.$_GET['route'].'');
    }
}



?>