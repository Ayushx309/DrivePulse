<?php

@include 'config.php';

if (isset($_POST['submit'])) {

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);


   $select = " SELECT * FROM users_db WHERE username = '$username' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if (mysqli_num_rows($result) > 0) {

      $error[] = 'user already exist!';

   } else {

      if ($pass != $cpass) {
         $error[] = 'password not matched!';
      } else {

         $insert = "INSERT INTO users_db (name, username, password, time) VALUES('$name','$username','$pass',current_timestamp())";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

}
;


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="shortcut icon" type="image/png" href="assets/logo.png"/>
   <link rel="stylesheet" href="css/navbar.css">
   <link rel="stylesheet" href="css/style.css">

</head>

<body>
   <?php

   include('includes/headerlvl1.php');

   ?>

   <div class="form-container">

      <form action="" method="post">
         <h3>register now</h3>
         <?php
         if (isset($error)) {
            foreach ($error as $error) {
               echo '<span class="error-msg">' . $error . '</span>';
            }
            ;
         }
         ;
         ?>
         <input type="text" name="name" required placeholder="enter your name">
         <input type="text" name="username" required placeholder="enter your username">
         <input type="password" name="password" required placeholder="enter your password">
         <input type="password" name="cpassword" required placeholder="confirm your password">
         <input type="submit" name="submit" value="register now" class="form-btn">
         <p>already have an account? <a href="login_form.php">login now</a></p>
      </form>

   </div>

</body>

</html>