<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/mysqlconnection.php');
$conn = mySqlConnection(); 
$base_url = __DIR__;
$last_folder = basename($base_url);
$base_url = '/'.$last_folder.'/';
?>
