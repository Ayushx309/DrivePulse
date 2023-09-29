<?php
include('../config.php');

// Create the <select> element outside the loop
echo "<label>Time Slot</label>";
echo "<select required name='time-slot'>";
echo "<option disabled selected>Select Time Slot</option>";
for ($i = 2; $i < 27; $i++) {
    
    $carquery = "SELECT * FROM car_one WHERE id=$i";
    $carquery1 = mysqli_query($conn, $carquery);

    while ($row = mysqli_fetch_assoc($carquery1)) {
        $status = $row['status'];
        // echo $status;
        // Use double equals for comparison
        if ($i==2 and $status == "empty") {
            echo "<option value='7:00am to 7:30am'>7:00am to 7:30am</option>";
        }
        if ($i==3 and $status == "empty") {
            echo "<option value='7:30am to 8:00am'>7:30am to 8:00am</option>";
        }
        if ($i==4 and $status == "empty") {
            echo "<option value='8:00am to 8:30am'>8:00am to 8:30am</option>";
        }
        if ($i==5 and $status == "empty") {
            echo "<option value='8:30am to 9:00am'>8:30am to 9:00am</option>";
        }
        if ($i==6 and $status == "empty") {
            echo "<option value='9:00am to 9:30am'>9:00am to 9:30am</option>";
        }
        if ($i==7 and $status == "empty") {
            echo "<option value='9:30am to 10:00am'>9:30am to 10:00am</option>";
        }
        if ($i==8 and $status == "empty") {
            echo "<option value='10:00am to 10:30am'>10:00am to 10:30am</option>";
        }
        if ($i==9 and $status == "empty") {
            echo "<option value='10:30am to 11:00am'>10:30am to 11:00am</option>";
        }
        if ($i==10 and $status == "empty") {
            echo "<option value='11:00am to 11:30am'>11:00am to 11:30am</option>";
        }
        if ($i==11 and $status == "empty") {
            echo "<option value='11:30am to 12:00pm'>11:30am to 12:00pm</option>";
        }
        if ($i==12 and $status == "empty") {
            echo "<option value='12:00pm to 12:30pm'>12:00pm to 12:30pm</option>";
        }
        if ($i==13 and $status == "empty") {
            echo "<option value='12:30pm to 1:00pm'>12:30pm to 1:00pm</option>";
        }
        if ($i==14 and $status == "empty") {
            echo "<option value='1:00pm to 1:30pm'>1:00pm to 1:30pm</option>";
        }
        if ($i==15 and $status == "empty") {
            echo "<option value='1:30pm to 2:00pm'>1:30pm to 2:00pm</option>";
        }
        if ($i==16 and $status == "empty") {
            echo "<option value='2:00pm to 2:30pm'>2:00pm to 2:30pm</option>";
        }
        if ($i==17 and $status == "empty") {
            echo "<option value='2:30pm to 3:00pm'>2:30pm to 3:00pm</option>";
        }
        if ($i==18 and $status == "empty") {
            echo "<option value='3:00pm to 3:30pm'>3:00pm to 3:30pm</option>";
        }
        if ($i==19 and $status == "empty") {
            echo "<option value='3:30pm to 4:00pm'>3:30pm to 4:00pm</option>";
        }
        if ($i==20 and $status == "empty") {
            echo "<option value='4:00pm to 4:30pm'>4:00pm to 4:30pm</option>";
        }
        if ($i==21 and $status == "empty") {
            echo "<option value='4:30pm to 5:00pm'>4:30pm to 5:00pm</option>";
        }
        if ($i==22 and $status == "empty") {
            echo "<option value='5:00pm to 5:30pm'>5:00pm to 5:30pm</option>";
        }
        if ($i==23 and $status == "empty") {
            echo "<option value='5:30pm to 6:00pm'>5:30pm to 6:00pm</option>";
        }
        if ($i==24 and $status == "empty") {
            echo "<option value='6:00pm to 6:30pm'>6:00pm to 6:30pm</option>";
        }
        if ($i==25 and $status == "empty") {
            echo "<option value='6:30pm to 7:00pm'>6:30pm to 7:00pm</option>";
        }
        if ($i==26 and $status == "empty") {
            echo "<option value='7:00pm to 7:30pm'>7:00pm to 7:30pm</option>";
        }
        if ($i==27 and $status == "empty") {
            echo "<option value='7:30pm to 8:00pm'>7:30pm to 8:00pm</option>";
        }

    }
}

// Close the <select> element after the loop
echo "</select>";
?>