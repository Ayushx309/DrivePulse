<?php

$server = "localhost";
$username = "root";
$password = "secret";
$database = "mydatabase";

$conn = mysqli_connect($server, $username, $password, $database);
$base_url = __DIR__;
$last_folder = basename($base_url);
$base_url = '/'.$last_folder.'/';
?>
