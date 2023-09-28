<?php

include('../includes/authentication.php');
date_default_timezone_set('Asia/Kolkata');


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
   
    <link rel="shortcut icon" type="image/png" href="../assets/logo.png" />
    <style>
        /* @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

* {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  box-sizing: border-box;
  text-decoration: none;
} */

.container {
  min-height: 25vh;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  padding: 20px;
  padding-bottom: 60px;
  gap: 30px;
}
.container .form-container{
  max-width: 800px;
}

.container .form-container input {
  padding: 20px;
  width: 100%;
  max-width: 800px;
  height: 50px;
  border-radius: 5px;
  border: 3px solid #525151;
}

#search_result {
  color: black;
  width: 100%;
  height: 50vh;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
}

#search_result h3 {
  color: red;
}

/* Style for the table container */
.search-table {
  width: 100%;
}

.search-table {
  display: flex;
  justify-content: center;
  align-items: center;
}

/* Style for the table header */
.search-table table thead th {
  background-color: #f2f2f2;
  text-align: left;
  padding: 10px;
}

/* Style for the table body */
.search-table table tbody td {
  padding: 10px;
}

/* Style for the edit and delete buttons */
.search-table table tbody td a.view,
.full-data a {
  font-size: 14px;
  padding: 6px 16px;
  color: var(--light);
  border-radius: 8px;
  font-weight: 200;
  text-decoration: none;
  margin-right: 5px;
  background-color: #46abcc;
  color: #fff;
  font-family: 'Poppins', sans-serif;
  font-weight: 500;
  transition: all 250ms;
}



.full-data a{
  border-radius: 7px;
  transition: all 250ms;
}


.full-data a:hover, .search-table table tbody td a.view:hover{
    background: #206e88;
}

/* Responsive Styles */

@media only screen and (max-width: 768px) {
  .container .form-container input {
    width: 100%;
    max-width: 500px;
  }
}

@media only screen and (max-width: 480px) {
  .container .form-container input {
    width: 100%;
    max-width: 300px;
  }

  .search-table table {
    font-size: 12px;
  }

  .search-table table th,
  .search-table table td {
    padding: 8px;
  }
}


@media only screen and (max-width: 768px) {
  .container .form-container input {
    width: 100%;
    max-width: 600px;
  }
}

@media only screen and (max-width: 480px) {
  .container .form-container input {
    width: 100%;
    max-width: 300px;
    padding: 10px;
    height: 40px;
    font-size: 14px;
  }
}

    </style>
    <link rel="stylesheet" href="../css/adminDashboard.css">
    <title>Due Amount Customers</title>
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
                <a href="./">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="admissionForm.php">
                    <i class='bx bxs-book-bookmark'></i>
                    <span class="text">Book Admission</span>
                </a>
            </li>
            <li>
                <a href="analytics/">
                    <i class='bx bxs-bar-chart-alt-2'></i>
                    <span class="text">Analytics</span>
                </a>
            </li>
            <li class="active search">
                <a href="search.php">
                    <i class='bx bx-search-alt-2'></i>
                    <span class="text">Search</span>
                </a>
            </li>
            <li>
                <a href="sortData/">
                        <!-- <i class='bx bxs-bar-chart-alt-2'></i> -->
                        <i class='bx bxs-data'></i>
                    <span class="text">Customers Data</span>
                </a>
            </li>
            <li class="time-table">
                <a href="timetable/">
                    <i class='bx bx-table'></i>
                    <span class="text">Time Table</span>
                </a>
            </li>
            <li  >
                <a href="dueCustomers/">
                    <i class='bx bxs-user'></i>
                    <span class="text">Due Amount Customers</span>
                </a>
            </li>
            <li>
                <a href="mailSender/">
                    <i class='bx bx-mail-send'></i>
                    <span class="text">Mail System</span>
                </a>
            </li>
            <li>
                <a href="manageUsers/">
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
                <a href="../logout.php" class="logout">
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
            <a href="./'" class="profile">
                <img src="../assets/logoBlack.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Search</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active"  style=" color: #aaaaaa;"  href="./">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="./search.php">Search</a>
                        </li>
                    </ul>
                </div>
                <!-- <a href="Excel/?export=true" class="btn-download">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">Data to Excel</span>
                </a> -->
            </div>

    <?php
    if (isset($_GET['query'])) {

        $Squery = $_GET['query'];

        echo "  <div class='container' >
        <div class='form-container'>
            <input type='text' id='live_search' autocomplete='off' placeholder='Search' value='$Squery' style='
            width: 50vw;'>
        </div>
     ";


    } else {

        echo "  <div class='container' >
        <div class='form-container'>
            <input type='text' id='live_search' autocomplete='off' placeholder='Search' style='
            width: 50vw;'>
        </div>
        
     ";

    }

    ?>
    <div class="full-data">
        <a href="sortData/">View DataBase</a>
    </div>
    </div>
    <!-- <div class="container">
        <div class="form-container">
            <input type="text" id="live_search" autocomplete="off" placeholder="Search">
        </div>
    </div> -->
    <div id="search_result" ></div>


        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            var timeout = null;

            $("#live_search").on("input", function () {
                clearTimeout(timeout);

                var input = $(this).val();

                if (input != "") {
                    timeout = setTimeout(function () {
                        $.ajax({
                            url: "live_search.php",
                            method: "POST",
                            data: { input: input },
                            success: function (data) {
                                $("#search_result").html(data);
                            }
                        });
                    }, 500); // Delay for 500 milliseconds (adjust as needed)
                } else {
                    $("#search_result").html(""); // Clear the search result
                }
            });
        });


        // Get the pagination links
        const paginationLinks = document.querySelectorAll(".pagination-link");

        // Add click event listeners to the pagination links
        paginationLinks.forEach(link => link.addEventListener("click", handlePageNavigation));

        // Event handler function
        function handlePageNavigation(e) {
            e.preventDefault();

            // Remove the "active" class from all pagination links
            paginationLinks.forEach(link => link.classList.remove("active"));

            // Add the "active" class to the clicked link
            this.classList.add("active");

            // Add logic to navigate to the corresponding page
        }


    </script>
    <script src="../js/script.js"></script>

</body>

</html>