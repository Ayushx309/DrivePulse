<?php
@include 'config.php';
session_start();
function logActivity($logType, $who, $activity)
{
    date_default_timezone_set('Asia/Kolkata');

    $logFolder = 'logs/' . $logType;

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


if (isset($_SESSION['admin_name'])) {
    logActivity('admin_logs', $_SESSION['admin_name'], 'Logged out');
} elseif (isset($_SESSION['staff_name'])) {
    logActivity('staff_logs', $_SESSION['staff_name'], 'Logged out');
}




session_unset();
session_destroy();

header('location:login_form.php');

?>