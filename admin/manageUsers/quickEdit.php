<?php
include('../../includes/authentication.php');
include('../../config.php');

$id = $_GET['i'];
$name = $_GET['n'];
$username = $_GET['u'];
$permissions = $_GET['p'];

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $permissions = $_POST['permissions'];

    $update = "UPDATE users_db SET name = '$name', username = '$username', permissions = '$permissions' WHERE id = $id";
    $result = mysqli_query($conn, $update);

    if (!$result) {
        $error[] = "Failed To Update";
    } else {
        $error[] = "Successfully Updated User Info";
        $_SESSION['TimeOut'] = true;
        echo '<script>
        setTimeout(function () {
            window.location.href = "../manageUsers/"; // Redirect to the desired URL
        }, 2000); // Delay for 2 seconds
    </script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/3db79b918b.js" crossorigin="anonymous"></script>

    <!-- My CSS -->
    <link rel="stylesheet" href="../../css/adminDashboard.css">
    <style>
      
.form-container{
   min-height: 100vh;
   display: flex;
   align-items: center;
   justify-content: center;
   padding:20px;
   padding-bottom: 60px;
   background: #eee;
}

.form-container form{
   padding:20px;
   border-radius: 5px;
   background: #fff;
   text-align: center;
   width: 500px;
}

.form-container form h3{
   font-size: 30px;
   text-transform: uppercase;
   margin-bottom: 10px;
   color:#333;
}

.form-container form input,
.form-container form select{
   width: 100%;
   padding:10px 15px;
   font-size: 17px;
   margin:8px 0;
   background: #eee;
   border-radius: 5px;
   border: none;
}

.form-container form select option{
   background: #fff;
}

.form-container form .form-btn{
   background: #c6eaf6;
   color:#46abcc;
   text-transform: capitalize;
   font-size: 20px;
   cursor: pointer;
}

.form-container form .form-btn:hover{
   background: #46abcc;
   color:#fff;
}
.form-container button .form-btn{
   background: #c6eaf6;
   color:#46abcc;
   text-transform: capitalize;
   font-size: 20px;
   cursor: pointer;
}

.form-container button .form-btn:hover{
   background: #46abcc;
   color:#fff;
}

.form-container form p{
   margin-top: 10px;
   font-size: 20px;
   color:#333;
}

.form-container form p a{
   color:#46abcc;
}

.form-container form .error-msg{
   margin:10px 0;
   display: block;
   background: #46abcc;
   color:#fff;
   border-radius: 5px;
   font-size: 20px;
   padding:10px;
}

    </style>

    <!-- Add SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <link rel="stylesheet" href="../../css/style.css"> -->

    <link rel="shortcut icon" type="image/png" href="../../assets/logo.png" />
    <title>Quick Edit</title>
</head>

<body>


    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <!-- <i class='bx bxs-smile'></i> -->

            <span class="text">
                <h6><span>Admin</span></h6>
                <h4>Welcome <span>
                        <?php echo $_SESSION['admin_name'] ?>
                    </span></h4>
            </span>
        </a>
        <ul class="side-menu top">
            <li>
                <a href="../">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="../admissionForm.php">
                    <i class='bx bxs-book-bookmark'></i>
                    <span class="text">Book Admission</span>
                </a>
            </li>
            <li>
                <a href="../analytics">
                    <i class='bx bxs-bar-chart-alt-2'></i>
                    <span class="text">Analytics</span>
                </a>
            </li>
            <li class="search">
                <a href="../search.php">
                    <i class='bx bx-search-alt-2'></i>
                    <span class="text">Search</span>
                </a>
            </li>
            <li>
                <a href="../sortData/">
                    <!-- <i class='bx bxs-bar-chart-alt-2'></i> -->
                    <i class='bx bxs-data'></i>
                    <span class="text">Customers Data</span>
                </a>
            </li>
            <li class="time-table ">
                <a href="../timetable/">
                    <i class='bx bx-table'></i>
                    <span class="text">Time Table</span>
                </a>
            </li>
            <li>
                <a href="../dueCustomers/">
                    <i class='bx bxs-user'></i>
                    <span class="text">Due Amount Customers</span>
                </a>
            </li>
            <li>
                <a href="../mailSender/">
                    <i class='bx bx-mail-send'></i>
                    <span class="text">Mail System</span>
                </a>
            </li>
            <li class="active">
                <a href="../manageUsers/">
                    <i class='bx bxs-group'></i>
                    <span class="text">Manage Users</span>
                </a>
            </li>

        </ul>
        <ul class="side-menu">
            <!-- <li>
                <a href="#">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Settings</span>
                </a>
            </li> -->
            <li>
                <a href="../../logout.php" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->



    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <!-- <a href="#" class="nav-link">Categories</a> -->
            <!-- <form action="" method="get">
                <div class="form-input">
                    <input type="search" name="search-query" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form> -->
            <!-- <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a> -->
            <span class="text">
                <h3>Patel Motor Driving School</h3>
                <h5>Dashboard</h5>
            </span>
            <a href="../" class="profile">
                <img src="../../assets/logoBlack.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Quick Edit</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a class="prev active"  style=" color: #aaaaaa;" href="../">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" style=" color: #aaaaaa;" href="./">Manage Users</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href='<?php echo urldecode("./quickEdit.php?i=" . $_GET["i"] . "&n=" . $_GET["n"] . "&u=" . $_GET["u"] . "&p=" . $_GET["p"])?>' >Quick Edit</a>
                        </li>
                    </ul>
                </div>
                <!-- <a href="Excel/?export=true" class="btn-download">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">Data to Excel</span>
                </a> -->
            </div>



            <div class="form-container" style="min-height: 70vh;">
                <form action="" method="post" style="background: #f9f9f9;">
                    <h3>Edit user</h3>
                    <?php
                    if (isset($error)) {
                        foreach ($error as $error) {
                            echo '<span class="error-msg">' . $error . '</span>';
                        }
                    }
                    ?>

                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="text" name="name" value="<?php echo $name; ?>" placeholder="enter name">
                    <input type="text" name="username" value="<?php echo $username; ?>" placeholder="enter username">

                    <?php
                    if ($permissions == "admin") {
                        echo "<select name='permissions'>
                            <option selected value='admin'>admin</option>
                            <option value='staff'>staff</option>
                            <option value='user'>user</option>
                        </select>";
                    } elseif ($permissions == "staff") {
                        echo "<select name='permissions'>
                            <option value='admin'>admin</option>
                            <option selected value='staff'>staff</option>
                            <option value='user'>user</option>
                        </select>";
                    } elseif ($permissions == "user") {
                        echo "<select name='permissions'>
                            <option value='admin'>admin</option>
                            <option value='staff'>staff</option>
                            <option selected value='user'>user</option>
                        </select>";
                    }
                    ?>

                    <input type="submit" name="submit" id="st" value="submit" class="form-btn">
                </form>
            </div>
        </main>
    </section>
   
    
    
 
    <script src="../../js/sweetalert.js"></script>
    <script src="../../js/script.js"></script>

</body>

</html>