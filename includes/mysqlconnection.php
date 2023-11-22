<?php

function mySqlConnection() {
  $server = "mysql";
  $username = "root";
  $password = "password";
  $database = "billing";

  return mysqli_connect($server, $username, $password, $database);
}

?>
