<?php
include('../includes/authenticationAdminOrStaff.php');
$timeSlots = array(
    "7:00am to 7:45am",
    "7:45am to 8:30am",
    "8:30am to 9:15am",
    "9:15am to 10:00am",
    "10:00am to 10:45am",
    "10:45am to 11:30am",
    "11:30am to 12:15pm",
    "12:15pm to 1:00pm",
    "1:00pm to 1:45pm",
    "1:45pm to 2:30pm",
    "2:30pm to 3:15pm",
    "3:15pm to 4:00pm",
    "4:00pm to 4:45pm",
    "4:45pm to 5:30pm",
    "5:30pm to 6:15pm",
    "6:15pm to 7:00pm",
    "7:00pm to 7:45pm",
    "7:45pm to 8:30pm"
);

echo "<label>Time Slot</label>";
echo "<select required name='time-slot'>";
echo "<option disabled selected>Select Time Slot (Two Wheeler)</option>";

foreach ($timeSlots as $slot) {
            echo "<option value='$slot'>$slot</option>";
}


echo "</select>";
?>
