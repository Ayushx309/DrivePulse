<?php

include('../includes/authentication.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA BASE</title>
    <link rel="stylesheet" href="../css/viewdatabase.css">
    <link rel="stylesheet" href="../css/navbar.css">
</head>

<body>
    <section id="content">
        <nav>
            <span class="text">
                <h3>Patel Motor Driving School</h3>

            </span>
            <a href="#" class="profile">
                <img src="../assets/logoBlack.png">
            </a>
        </nav>
    </section>

    <div class="container">
        <div class="todo">
            <table>

                <thead>
                    <tr>

                        <th>id</th>
                        <th>name</th>
                        <th>phone</th>
                        <th>email</th>
                        <th>address</th>
                        <th>vehicle</th>
                        <th>trainername</th>
                        <th>trainerphone</th>
                        <th>totalamount</th>
                        <th>days</th>
                        <th>date</th>
                        <th>time</th>
                        <th>ends_on</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `cust_details`";
                    $result = $conn->query($sql);
              
                    while($row = mysqli_fetch_array($result))  
                    {  
                       echo '  
                      <tr>  
                        <td>'.$row["id"].'</td>  
                        <td>'.$row["name"].'</td>  
                        <td>'.$row["phone"].'</td>  
                        <td>'.$row["email"].'</td>  
                        <td>'.$row["address"].'</td>
                        <td>'.$row["vehicle"].'</td>
                        <td>'.$row["trainername"].'</td>
                        <td>'.$row["trainerphone"].'</td>
                        <td>'.$row["totalamount"].'</td>
                        <td>'.$row["days"].'</td>
                        <td>'.$row["date"].'</td>
                        <td>'.$row["time"].'</td>
                        <td>'.$row["ends_on"].'</td>
                      </tr>  
                       ';  
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>