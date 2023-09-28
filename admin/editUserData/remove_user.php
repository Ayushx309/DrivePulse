<?php
$conn = mysqli_connect("localhost", "root", "", "billing");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the user ID from the POST data
    $userId = $_POST["id"];

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare the SQL query with a placeholder
    $sql = "DELETE FROM `cust_details` WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Query preparation failed: " . mysqli_error($conn));
    }

    // Bind the parameter to the placeholder
    mysqli_stmt_bind_param($stmt, "i", $userId);

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // User has been successfully removed
        $response = ["success" => true];
    } else {
        // Failed to remove the user
        $response = ["success" => false, "error" => mysqli_error($conn)];
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Send a JSON response to indicate success or failure
    header("Content-Type: application/json");
    echo json_encode($response);
    exit;
}
?>
