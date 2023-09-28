<?php

include('../../includes/authentication.php');
date_default_timezone_set('Asia/Kolkata');
$conn = mysqli_connect("localhost", "root", "", "billing");

function convertDMY($dateString)
{
    if ($dateString === "0000-00-00") {
        echo "00-00-00";
    } else {

        $date = new DateTime($dateString);
        $formattedDate = $date->format("d-m-Y");
        echo $formattedDate;
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
        /* Style the container */
        .container {
            margin-top: 70px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            height: auto;
            width: 100%;
        }

        /* Style the chart container */
        .chart-container {
            width: 100%;
            max-width: auto;
            margin-bottom: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;

        }

        .barchart{
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: start;
            align-items: start;
            gap: 30px;
            flex-wrap: wrap;
        }

        .piechart{
            padding: 20px;
            display: flex;
            flex-direction: row;
            justify-content: start;
            align-items: start;
            flex-wrap: wrap;
        }

        /* Style the button container */
        .barchart .button-container {
            display: flex;
            gap: 20px;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            width: 100%;

        }

        /* Style the button */
        button {
            padding: 10px 20px;
            background-color: #46abcc;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #1397c2;
        }

        /* Style the select element */
        select[name="select-year"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            /* Adjust the width as needed */
        }

        /* Style the selected option */
        select[name="select-year"] option[selected] {
            background-color: #3498db;
            color: #fff;
        }

        /* Style the options when the select is open */
        select[name="select-year"]:focus {
            outline: none;
            /* Remove the default focus outline */
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.7);
        }

        /* Style the options in the dropdown */
        select[name="select-year"] option {
            padding: 5px;
            font-size: 14px;
        }

        /* Style the hover effect on options */
        select[name="select-year"] option:hover {
            background-color: #f2f2f2;
            cursor: pointer;
        }

        /* Style the apply button */
        input[type="submit"][name="apply-button"] {
            padding: 10px 20px;
            /* Adjust padding as needed */
            background-color: #46abcc;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        /* Style the button on hover */
        input[type="submit"][name="apply-button"]:hover {
            background-color: #1397c2;
        }


    </style>

    <!-- Add SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="shortcut icon" type="image/png" href="../../assets/logo.png" />
    <title>Analytics</title>
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
            <li class="active">
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
            <li class="time-table">
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
            <li>
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
                    <h1>Analytics</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" style=" color: #aaaaaa;" href="../">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="./">Analytics</a>
                        </li>
                    </ul>
                </div>
                <!-- <a href="Excel/?export=true" class="btn-download">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">Data to Excel</span>
                </a> -->
            </div>


            <div class="container">
                <div class="chart-container">
                    <div class="barchart">
                        <div class="button-container">
                            <button id="change-chart">Change to Material</button>
                            <form method="get">
                                <label for="select-year">Select Year:</label>
                                <select name="select-year">
                                    <!-- Populate this select element with available years -->
                                    <?php
                                    $years_query = "SELECT DISTINCT YEAR(date) AS year FROM cust_details ORDER BY year DESC";
                                    $years_result = mysqli_query($conn, $years_query);
                                    $currentYear = isset($_GET['select-year']) ? $_GET['select-year'] : null;

                                    while ($row = mysqli_fetch_assoc($years_result)) {
                                        $year = $row['year'];
                                        $selected = ($currentYear == $year) ? 'selected' : '';
                                        echo "<option value='$year' $selected>$year</option>";
                                    }
                                    ?>
                                </select>
                                <input type="submit" name="apply-button" value="Apply" />
                            </form>

                        </div>
                        <div id="chart_div" style="width: 100%; height: 500px; "></div>
                    </div>
                </div>

                <div class="container" style="margin-top:20px;">
                    <div class="chart-container">
                        <div class="piechart">
                            <div id="piechart_3d" style="width: auto;  min-width: 450px; height: 300px;"></div>
                    
                            <div id="piechart" style="width: auto;  min-width: 450px; height: 300px;"></div>
                        </div>
                    </div>

                </div>

    



 



        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <!-- drawStuff                                 drawStuff                                 drawStuff -->


    <script type="text/javascript">
        google.charts.load('current', { 'packages': ['corechart', 'bar'] });
        google.charts.setOnLoadCallback(drawStuff);

        function drawStuff() {

            var button = document.getElementById('change-chart');
            var chartDiv = document.getElementById('chart_div');

            var data = google.visualization.arrayToDataTable([
                ['Month', 'Sales', 'Customers'],
                <?php



                if (isset($_GET['apply-button'])) {
                    $year = $_GET['select-year'];

                    $currentYear = DateTime::createFromFormat("Y", $year);
                    $currentYear = $currentYear->format("Y");

                } else {
                    $currentYear = date("Y");
                }




                // Query to calculate total sales and number of customers for each month and order by month
                $query = "SELECT DATE_FORMAT(date, '%Y-%m') AS month, SUM(paidamount) AS total_sales, COUNT(*) AS total_customers
                    FROM cust_details
                    WHERE YEAR(date) = $currentYear
                    GROUP BY month
                    ORDER BY month";

                $res = mysqli_query($conn, $query);
                while ($data = mysqli_fetch_assoc($res)) {
                    $month = $data['month'];
                    $total_sales = $data['total_sales'];
                    $total_customers = $data['total_customers'];
                    ?>
                    ['<?php echo convertDMY($month); ?>', <?php echo $total_sales; ?>, <?php echo $total_customers; ?>],
                    <?php
                }

                ?>
            ]);

            console.table(data);

            var materialOptions = {
                width: 950,
                chart: {
                    title: 'Monthly Sales and Customers',
                    subtitle: 'Sales on the left, Customers on the right'
                },
                series: {
                    0: { axis: 'sales' }, // Bind series 0 to an axis named 'sales'.
                    1: { axis: 'customers' } // Bind series 1 to an axis named 'customers'.
                },
                axes: {
                    y: {
                        sales: { label: 'Sales' }, // Left y-axis.
                        customers: { side: 'right', label: 'Customers' } // Right y-axis.
                    }
                }
            };

            var classicOptions = {
                width: 950,
                series: {
                    0: { targetAxisIndex: 0 },
                    1: { targetAxisIndex: 1 }
                },
                title: 'Monthly Sales and Customers',
                vAxes: {
                    // Adds titles to each axis.
                    0: { title: 'Sales' },
                    1: { title: 'Customers' }
                }
            };

            function drawMaterialChart() {
                var materialChart = new google.charts.Bar(chartDiv);
                materialChart.draw(data, google.charts.Bar.convertOptions(materialOptions));
                button.innerText = 'Change to Classic';
                button.onclick = drawClassicChart;
            }

            function drawClassicChart() {
                var classicChart = new google.visualization.ColumnChart(chartDiv);
                classicChart.draw(data, classicOptions);
                button.innerText = 'Change to Material';
                button.onclick = drawMaterialChart;
            }

            drawMaterialChart();
        }
    </script>



<!-- drawChartPie3d                 drawChartPie3d                   drawChartPie3d                     drawChartPie3d -->



    <script type="text/javascript">
        google.charts.load("current", { packages: ["corechart"] });
        google.charts.setOnLoadCallback(drawChartPie3d);
        function drawChartPie3d() {
            var data = google.visualization.arrayToDataTable([
                ['Years', 'Customers'],
                <?php

$years_query = "SELECT DISTINCT YEAR(date) AS year FROM cust_details ORDER BY year DESC";
$years_result = mysqli_query($conn, $years_query);


while ($row = mysqli_fetch_assoc($years_result)) {
    

    $pieYear = DateTime::createFromFormat("Y",$row['year']);
    $pieYear = $pieYear->format("Y");
    
    $query = "SELECT DATE_FORMAT(date, '%Y') AS year, COUNT(*) AS total_customers
    FROM cust_details
    WHERE YEAR(date) = $pieYear
    GROUP BY year
    ORDER BY year";

    $res = mysqli_query($conn, $query);
    while ($data = mysqli_fetch_assoc($res)) {
 
       ?> 
       ['<?php echo $data['year'];?>',<?php echo $data['total_customers']?>],
<?php
    }
}
?>
           
            ]);

            var options = {
                title: 'Yearly Statistics Of Total Customers',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>


<!-- drawChartPie                                        drawChartPie                                     drawChartPie -->



<script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChartPie);

      function drawChartPie() {

   
        var data = google.visualization.arrayToDataTable([
            ['Years', 'Sales'],
            <?php

                $years_query = "SELECT DISTINCT YEAR(date) AS year FROM cust_details ORDER BY year DESC";
                $years_result = mysqli_query($conn, $years_query);


                while ($row = mysqli_fetch_assoc($years_result)) {
                    

                    $pieYear2 = DateTime::createFromFormat("Y",$row['year']);
                    $pieYear2 = $pieYear2->format("Y");
                    
                    $query2 = "SELECT DATE_FORMAT(date, '%Y') AS year, SUM(paidamount) AS total_sales
                    FROM cust_details
                    WHERE YEAR(date) = $pieYear2
                    GROUP BY year
                    ORDER BY year";

                    $res2 = mysqli_query($conn, $query2);
                    while ($data2 = mysqli_fetch_assoc($res2)) {
                        ?> 
                        ['<?php echo $data2['year'];?>',<?php echo $data2['total_sales']?>],
                 <?php
                     }
                 }
       ?> 
        
        ]);



        var options = {
          title: 'Yearly Statistics Of Total Sales'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>









    <script src="../../js/sweetalert.js"></script>
    <script src="../../js/script.js"></script>

</body>

</html>