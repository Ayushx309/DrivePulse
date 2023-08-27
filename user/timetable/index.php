<?php
if (isset($_POST['submitCar'])) {

    header("location:?car=" . $_POST['car'] . "");

}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Table</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .title {

            padding: 20px;
            background: rgb(0, 178, 238);
            color: rgb(255, 255, 255);
            font-size: 30px;
            font-weight: 700;
            border-radius: 10px;
            box-shadow: 7px 7px 2px 1px rgba(0, 0, 0, 0.2);
        }

        table {
            width: 100%;
            max-width: 1500px;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        table tr:hover {
            background-color: #f5f5f5;
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 100%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {

            table th,
            table td {
                font-size: 14px;
            }

            h1 {
                font-size: 24px;
            }

            form {
                max-width: 100%;
                padding: 10px;
            }

            select {
                padding: 6px;
            }

            button[type="submit"] {
                padding: 8px 16px;
                font-size: 14px;
            }



            .plusDay:hover {
                background-color: #45a049;
            }

        }
    </style>


    <title>Profile Details</title>
    <link rel="stylesheet" type="text/css">

</head>

<body>
    <?php

    include('../../includes/headerlvl3.php');

    ?>

    <form method="post">
        <div class="form-group">
            <label for="car">Select Car:</label>
            <select id="car" name="car">
                <option disabled selected>Select Car To View Time-Table</option>
                <option value="i10">Hyundai i10</option>
                <option value="liva">Toyota Liva</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" name="submitCar">View Time-Table</button>
        </div>
    </form>

    <div class="time_table_box">
        <?php
        include('car_one.php');
        ?>
        <?php
        include('car_two.php');
        ?>
    </div>

</body>

</html>