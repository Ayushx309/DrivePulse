<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin dashboard</title>
   <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/newMember.css">

</head>

<body>
   <div class="header">
      <div class="container">

         <div class="content">
            <nav>
               <ul>
                  <li id="imgAndText">
                     
                  <img src="../assets/logoBlack.png" />
                     <h3>Welcome <span>
                           <?php echo $_SESSION['user_name'] ?>
                        </span></h3>
                  </li>
                  <li class="header-text">
                     <h3>Patel Motor Driving School</h3>
                  </li>
                  <li>
                     <a href="../logout.php" class="btn" style="margin-left: 110px;">logout</a>
                  </li>
               </ul>
            </nav>
         </div>

      </div>
   </div>

   <div class="control-panel">
      <div class="header">
         <h3>You Don't Have Access</h3> <i class='bx bxs-lock'></i>
      </div>
   </div>


</body>

</html>