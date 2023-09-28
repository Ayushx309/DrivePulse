<?php

@include '../config.php';

session_start();

if (!(isset($_SESSION['admin_name']) || isset($_SESSION['staff_name']))) {

    $base_url = '/Billing_Software/';

    // Define the file name to search for
    $file_to_find = 'login_form.php';

    $found = false;

    // Loop to search for the file in parent directories
    $current_dir = __DIR__;
    while (!$found && $current_dir !== '/') {
        $file_path = $current_dir . $base_url . $file_to_find;
        if (file_exists($file_path)) {
            header('Location: ' . $base_url . $file_to_find);
            exit;
        }

        // Move up one directory
        $current_dir = dirname($current_dir);
    }

    // header('location:../login_form.php');
}

?>