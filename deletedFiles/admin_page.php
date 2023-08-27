<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin dashboard</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/adminPage.css">

</head>

<body>
   <div class="header">
      <div class="container">

         <div class="content">
            <nav>
               <ul>
                  <li>
                     <h4>hi, <span>admin</span></h4>
                     <h3>Welcome <span>
                           <?php echo $_SESSION['admin_name'] ?>
                        </span></h3>
                  </li>
                  <li class="header-text">
                     <h3>Patel Motor Driving School</h3>
                     <h5>Admin Dashboard</h5>
                  </li>
                  <li>
                     <a href="login_form.php" class="btn">login</a>
                     <a href="register_form.php" class="btn">register</a>
                     <a href="logout.php" class="btn">logout</a>
                  </li>
               </ul>
            </nav>
         </div>

      </div>
   </div>

   <div class="control-panel">
         <div class="header">
            <h3>Tools</h3>
         </div>
   </div>


</body>

</html>