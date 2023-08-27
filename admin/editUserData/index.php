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
            max-width: 1500px;
            width: 1300px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            flex-direction: column;

        }

        .profile-image {
            flex: 0 0 120px;
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-image img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
        }

        .profile-details {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        form .row {
            flex-wrap: wrap;
            display: flex;
            align-items: start;
            justify-content: center;
            flex-direction: row;
            gap: 40px;
        }


        .profile-details p {
            margin: 5px 0;
            padding: 10px;
            width: 500px;

        }

        .profile-details label {
            font-weight: bold;
        }

        .profile-details input,select {
            padding: 8px;
            max-width: 500px;
            width: 100%;
            font-size: 20px;

        }
      

        .profile-buttons {
            margin-top: -5px;
            display: flex;
            justify-content: center;
        }

        .profile-buttons a,
        input[type='submit'] {
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
            font-size: 20px;

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
            <a class="home-link" href="<?php echo "../"?>">
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
        $id = $_GET['id'];
        $email = $_GET['email'];
        $name = $_GET['name'];
        $query = "SELECT * FROM `cust_details` WHERE phone = '$id' AND email = '$email' AND name = '$name'";
        $result = mysqli_query($connect, $query);
        $row = mysqli_fetch_assoc($result);
    }
    ?>
    <div class="profile-container">
        <div class="profile-image">
            <img src="https://www.gravatar.com/avatar/38ed5967302ec60ff4417826c24feef6?s=80&d=mm&r=g"
                alt="Profile Image">
        </div>
        <div class="profile-details">

            <form method="post">

                <div class="row">
                    <div>
                        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                        <p><label>Name:</label></br>
                            <input type="text" name="name" value="<?php echo $row["name"]; ?>">
                        </p>
                        <p><label>Email:</label></br>
                            <input type="text" name="email" value="<?php echo $row["email"]; ?>">
                        </p>
                        <p><label>Phone:</label></br>
                            <input type="text" name="phone" value="<?php echo $row["phone"]; ?>">
                        </p>
                        <p><label>Address:</label></br>
                            <input type="text" name="address" value="<?php echo $row["address"]; ?>">
                        </p>
                    </div>
                    <div>
                        <p><label>Total Amount:</label></br>
                            <input type="text" name="totalamount" value="<?php echo $row["totalamount"]; ?>">
                        </p>
                        <p><label>Paid Amount:</label></br>
                            <input type="text" name="paidamount" value="<?php echo $row["paidamount"]; ?>">
                        </p>
                        <p><label>Due Amount:</label></br>
                            <input type="text" name="dueamount" value="<?php echo $row["dueamount"]; ?>" readonly>
                        </p>
                        <p><label>Days:</label></br>
                            <input type="text" name="days" value="<?php echo $row["days"]; ?>">
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <p><label>Time-Slot:</label></br>
                            <select  name="time-slot">
                                <option disabled selected>Select Time Slot</option>

                                <?php
                               
                                $timeSlots = array(
                                    "7:00am to 7:30am",
                                    "7:30am to 8:00am",
                                    "8:00am to 8:30am",
                                    "8:30am to 9:00am",
                                    "9:00am to 9:30am",
                                    "9:30am to 10:00am",
                                    "10:00am to 10:30am",
                                    "10:30am to 11:00am",
                                    "11:00am to 11:30am",
                                    "11:30am to 12:00pm",
                                    "12:00pm to 12:30pm",
                                    "12:30pm to 1:00pm",
                                    "1:00pm to 1:30pm",
                                    "1:30pm to 2:00pm",
                                    "2:00pm to 2:30pm",
                                    "2:30pm to 3:00pm",
                                    "3:00pm to 3:30pm",
                                    "3:30pm to 4:00pm",
                                    "4:00pm to 4:30pm",
                                    "4:30pm to 5:00pm",
                                    "5:00pm to 5:30pm",
                                    "5:30pm to 6:00pm",
                                    "6:00pm to 6:30pm",
                                    "6:30pm to 7:00pm",
                                    "7:00pm to 7:30pm",
                                    "7:30pm to 8:00pm"
                                );

                                $selectedTimeSlot = $row["timeslot"];
                                foreach ($timeSlots as $timeSlot) {
                                    $selected = ($timeSlot === $selectedTimeSlot) ? "selected" : "";
                                    echo "<option value='$timeSlot' $selected>$timeSlot</option>";
                                }
                                ?>

                            </select>
                        </p>
                        <p><label>Vehicle:</label></br>
                            <input type="text" name="vehicle" value="<?php echo $row["vehicle"]; ?>">
                        </p>
                        <p><label>New Licence:</label></br>
                           
                            <select name="newlicence">
                            <?php 
                            $boolLicence = array("Applied"=>"Applied","Not Applied"=>"Not Applied");
                            $select = $row["newlicence"]; 
                                foreach ($boolLicence as $Licence) {
                                    $selected = ($Licence == $select) ? "selected" : "";
                                    echo "<option value='$Licence' $selected>$Licence</option>";
                                }
                            ?>
                            </select>

                        </p>
                        <p><label>Trainer Name:</label></br>
                            <input type="text" name="trainername" value="<?php echo $row["trainername"]; ?>">
                        </p>
                        <p><label>Trainer Phone:</label></br>
                            <input type="text" name="trainerphone" value="<?php echo $row["trainerphone"]; ?>">
                        </p>

                    </div>
                    <div>
                        <p><label>Admission Date:</label></br>
                            <input type="text" name="date" value="<?php echo $row["date"]; ?>" readonly>
                        </p>
                        <p><label>Admission Time:</label></br>
                            <input type="text" name="time" value="<?php echo $row["time"]; ?>" readonly>
                        </p>
                        <p><label>Training Started On:</label></br>
                            <input type="text" name="startedAT" value="<?php echo $row["startedAT"]; ?>" readonly>
                        </p>
                        <p><label>Training Ended On:</label></br>
                            <input type="text" name="endedAT" value="<?php echo $row["endedAT"]; ?>" readonly>
                        </p>
                        <p><label>Form Filler:</label></br>
                            <input type="text" name="formfiller" value="<?php echo $row["formfiller"]; ?>">
                        </p>
                    </div>
                </div>
        </div>
        <div class="profile-buttons" style="
            display: flex;
            justify-content: center;
            flex-direction: column;
            flex-wrap: wrap;
            gap: 20px;">

            <input class="edit-btn" type="submit" name="edit" value="Edit" >
        </div>
        </form>

 
</body>

</html>
