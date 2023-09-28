<?php
// Path to the image file you want to upload from your localhost
$imageFilePath = '../../../addmission_pdf/mailImage.png'; // Replace with the actual file path

// URL of the hosted server's PHP script for image upload
$uploadUrl = 'https://chaoschatroom.000webhostapp.com/api/upload.php'; // Replace with the actual URL

// Initialize cURL
$ch = curl_init($uploadUrl);

// Create a cURL file object
$imageFile = new CURLFile($imageFilePath, mime_content_type($imageFilePath), basename($imageFilePath));

// Define the POST data
$postData = [
    'image' => $imageFile,
];

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Set cURL options
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the cURL request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
} else {
    // Print the response from the hosted server's upload script
    echo $response;
}

// Close cURL session
curl_close($ch);
?>

