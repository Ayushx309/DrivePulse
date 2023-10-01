<?php
include('../../../includes/authenticationAdminOrStaff.php');
@include '../../../config.php';


$thisCAR = 'i10';
if ($thisCAR === $_SESSION['carSelected']) {
    $timeSlotDB = $_SESSION['carTimeSlotSelected'];
}

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

echo "<select required name='time-slot'>";
echo "<option disabled selected>Select Time Slot (Hyundai i10)</option>";
foreach ($timeSlots as $index => $slot) {
    $i = $index + 2;
    $carquery = "SELECT * FROM car_one WHERE id=$i";
    $carquery1 = mysqli_query($conn, $carquery);

    while ($row = mysqli_fetch_assoc($carquery1)) {
        $status = $row['status'];
        $selectedTimeSlot = $timeSlotDB;
        if ($status == "empty") {
            echo "<option value='$slot'>$slot</option>";
        }
        if ($status == "active") {
            $selected = ($slot === $selectedTimeSlot) ? "selected style='background-color: green; color: white; font-weight: 700;'" : "disabled style='background-color: red; color: white; font-weight: 700;'";
            $status = ($slot === $selectedTimeSlot) ? "(Current)" : "(Occupied)";
            echo "<option value='$slot' $selected >$slot $status</option>";
        }
    }
}

echo "</select>";
?>