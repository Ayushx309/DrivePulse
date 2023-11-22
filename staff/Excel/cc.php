<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/mysqlconnection.php');

$connect = mySqlConnection(); 
$sql = "SELECT * FROM cust_details";  
$result = mysqli_query($connect, $sql);
?>
<html>

<head>
    <title>Export Data To Excel Sheet</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <style>
        .home-link {
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            background-color: #0084ff;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .home-link:hover {
            background-color: #0066cc;
        }

        .home-link:focus,
        .home-link:active {
            outline: none;
            background-color: #004499;
        }

        .home-link,
        .home-link:hover,
        .home-link:focus,
        .home-link:active {
            text-decoration: none;
        }

        .container {
            width: 100%;
            height: 100%;
            background-color: lightgray;
        }

        body{
            background-color: lightgray;
        }

       
    </style>
    <link rel="stylesheet" href="../../css/table.css">
</head>

<body>
    <?php
      include('../../includes/headerlvl3.php');

    ?>
    <div class="container">
        <br />
        <br />
        <br />
        <div class="table-responsive">
            <h2 align="center">Export Customer Details to Excel File</h2><br />
            <form method="post" action="excel.php">
                <input type="submit" name="export" class="btn btn-success" value="Export" />
            </form>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Total Amount</th>
                    <th>Vehicle</th>
                    <th>Trainer</th>
                    <th>Trainer Ph.</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Days</th>
                    <th>Ends On</th>
                </tr>
                <?php
     while($row = mysqli_fetch_array($result))  
     {  
        echo '  
       <tr>  
         <td>'.$row["id"].'</td>  
         <td>'.$row["name"].'</td>  
         <td>'.$row["phone"].'</td>  
         <td>'.$row["email"].'</td>  
         <td>'.$row["address"].'</td>
         <td>'.$row["totalamount"].'</td>
         <td>'.$row["vehicle"].'</td>
         <td>'.$row["trainername"].'</td>
         <td>'.$row["trainerphone"].'</td>
         <td>'.$row["date"].'</td>
         <td>'.$row["time"].'</td>
         <td>'.$row["days"].'</td>
         <td>'.$row["endedAT"].'</td>
       </tr>  
        ';  
     }
     ?>
            </table>
            <br />
        </div>
    </div>
</body>

</html>
