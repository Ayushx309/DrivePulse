<?php
// Replace with your database connection code
include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/mysqlconnection.php');

$conn = mySqlConnection(); 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch email addresses from the database
$sql = "SELECT email FROM cust_details";
$result = $conn->query($sql);

$emailRecipients = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $emailRecipients[] = $row["email"];
    }
} else {
    echo json_encode($emailRecipients); // Return an empty array if no email addresses are found
}

echo json_encode($emailRecipients);

$conn->close();
?>
