<!DOCTYPE html>
<html>
<head>
    <title>Profile Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0px;
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .profile-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            flex-direction: row;
        }
        
        .profile-image {
            flex: 0 0 120px;
            text-align: center;
            margin-right: 20px;
        }
        
        .profile-image img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
        }
        
        .profile-details {
            flex: 1;
        }
        
        .profile-details p {
            margin: 5px 0;
        }
        
        .profile-details label {
            font-weight: bold;
        }
        
        .profile-buttons {
            margin-top: -5px;
            display: flex;
            justify-content: center;
        }
        
        .profile-buttons a {
            padding: 10px 20px;
            margin-left: 10px;
            border: none;
            border-radius: 3px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }
        
        .profile-buttons .edit-btn {
         
            background-color: #4CAF50;
            color: #fff;
      
        }
        
        .profile-buttons .pdf-btn {
    
            background-color: #2196F3;
            color: #fff;
            text-align: center;
        }
        
        .profile-buttons .close-btn {
       
            background-color: #f44336;
            color: #fff;
         
        }
    </style>
      <link rel="stylesheet" href="../../css/navbar.css">
</head>
<body>

<section id="content">
        <nav>
        <a  class="home-link" style="
    visibility: hidden;
">
         Back
            </a>
            <span class="text">
                <h3>Patel Motor Driving School</h3>

            </span>
            <a href="#" class="profile">
                <img src="../../assets/logoBlack.png">
            </a>
        </nav>
        
    </section>


<?php
    $connect = mysqli_connect("localhost", "root", "", "billing");
        $backRoute = '';
    if (isset($_GET['id'])) {
        $backRoute = $_GET['route'];
        $id = $_GET['id'];
        $query = "SELECT * FROM `cust_details` WHERE id = '$id'";
        $result = mysqli_query($connect, $query);
        $row = mysqli_fetch_assoc($result);
    ?>
    <div class="profile-container">
        <div class="profile-image">
            <img src="https://www.gravatar.com/avatar/38ed5967302ec60ff4417826c24feef6?s=80&d=mm&r=g" alt="Profile Image">
        </div>
        <div class="profile-details" style="
    padding-right: 50px;
">
    
                <p><label>Name:</label> <?php echo $row["name"]; ?></p>
                <p><label>Email:</label> <?php echo $row["email"]; ?></p>
                <p><label>Phone:</label> <?php echo $row["phone"]; ?></p>
                <p><label>Address:</label> <?php echo $row["address"]; ?></p>
          
                <p><label>Total Amount:</label> <?php echo $row["totalamount"]; ?></p>
                <p><label>Paid Amount:</label> <?php echo $row["paidamount"]; ?></p>
                <p><label>Due Amount:</label> <?php echo $row["dueamount"]; ?></p>
                <p><label>Days:</label> <?php echo $row["days"]; ?></p>
                <p><label>Time-Slot:</label> <?php echo $row["timeslot"]; ?></p>
       
                <p><label>Vehicle:</label> <?php echo $row["vehicle"]; ?></p>
                <p><label>New Licence:</label> <?php echo $row["newlicence"]; ?></p>
                <p><label>Trainer Name:</label> <?php echo $row["trainername"]; ?></p>
                <p><label>Trainer Phone:</label> <?php echo $row["trainerphone"]; ?></p>
                <p><label>Admission Date:</label> <?php echo $row["date"]; ?></p>
       
                <p><label>Admission Time:</label> <?php echo $row["time"]; ?></p>
                <p><label>Training Started On:</label> <?php echo $row["startedAT"]; ?></p>
                <p><label>Training Ended On:</label> <?php echo $row["endedAT"]; ?></p>
                <p><label>Form Filler:</label> <?php echo $row["formfiller"]; ?></p>
        </div>
        <div class="profile-buttons" style="
    display: flex;
    justify-content: flex-start;
    flex-direction: column;
    flex-wrap: wrap;
    gap: 20px;
">
            <a href="<?php

            echo "../../viewpdf.php?id=".$row['phone']."&email=".$row['email']."&name=".$row['name']."";
            
            ?>" class="pdf-btn">Booking Receipt PDF</a>
            <!-- <button class="edit-btn">Edit</button> -->
            <a href="<?php echo $backRoute; ?>"class="close-btn">Close</a>
        </div>
    </div>
    <?php
    }
    ?>
</body>
</html>
