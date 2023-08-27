<?php

@include 'config.php';

session_start();

if (isset($_POST['submit'])) {

   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $password = $_POST['password'];
   $pass = md5($_POST['password']);


   $select = " SELECT * FROM users_db WHERE username = '$username' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if (mysqli_num_rows($result) > 0) {

      $row = mysqli_fetch_array($result);

      if (!empty($_POST["remember"])) {
         setcookie("member_login", $username, time() + (10 * 365 * 24 * 60 * 60));
         setcookie("member_password", $password, time() + (10 * 365 * 24 * 60 * 60));

      } else {
         if (isset($_COOKIE["member_login"])) {
            setcookie("member_login", "");
         }
         if (isset($_COOKIE["member_password"])) {
            setcookie("member_password", "");
         }
      }



      if ($row['permissions'] == 'admin') {

         $_SESSION['admin_name'] = $row['name'];
         header('location:admin/');

      } elseif ($row['permissions'] == 'user') {

         $_SESSION['user_name'] = $row['name'];
         header('location:user/');

      } elseif ($row['permissions'] == 'noAccess') {

         $_SESSION['member_name'] = $row['name'];
         header('location:newMember/');

      }

   } else {
      $error[] = 'incorrect username or password!';
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
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="shortcut icon" type="image/png" href="assets/logo.png"/>
   <link rel="stylesheet" href="css/style.css">

</head>

<body>
   <?php

   include('includes/headerlvl1.php');

   ?>

   <div class="form-container">

      <form action="" method="post">
         <h3>login now</h3>
         <?php
         if (isset($error)) {
            foreach ($error as $error) {
               echo '<span class="error-msg">' . $error . '</span>';
            }
            ;
         }
         ;
         ?>
         <input type="text" name="username" required placeholder="enter your username" value="<?php if (isset($_COOKIE["member_login"])) {
            echo $_COOKIE["member_login"];
         } ?>">
         <input type="password" name="password" required placeholder="enter your password" value="<?php if (isset($_COOKIE["member_password"])) {
            echo $_COOKIE["member_password"];
         } ?>">
         <div class="remember" style=" 
                           display: flex;
                           flex-direction: row;
                           flex-wrap: wrap;
         ">
            <input style="width: 40px;" type="checkbox" name="remember" <?php if (isset($_COOKIE["member_login"])) { ?>
                  checked <?php } ?> />
            <label for="remember-me">Remember me</label>
         </div>
         <input type="submit" name="submit" value="login now" class="form-btn">
         <p>don't have an account? <a href="register_form.php">register now</a></p>
      </form>

   </div>

</body>

</html>