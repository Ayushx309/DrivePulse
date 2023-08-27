<?php

@include '../config.php';

session_start();

if(!isset($_SESSION['user_name'])) {
    header('location:../login_form.php');
}

?>