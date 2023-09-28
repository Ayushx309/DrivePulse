<?php
include('../../config.php');

function convertDMY($dateString)
{
    if ($dateString === "0000-00-00") {
        echo "00-00-00";
    } else {

        $date = new DateTime($dateString);
        $formattedDate = $date->format("d-m-y");
        echo $formattedDate;
    }
}

?>

<?php

date_default_timezone_set('Asia/Kolkata');
$current_timestamp_by_mktime = mktime(date("m"), date("d"), date("Y"));
$currentDate = date("Y-m-d", $current_timestamp_by_mktime);

$check = "SELECT * FROM car_one WHERE status = 'active'";
$result = mysqli_query($conn, $check);
// echo $currentDate."<br>";
if (!$result) {
    die("Error executing query: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    // Loop through each row
    while ($row = mysqli_fetch_assoc($result)) {
        $endDate = (string) $row['end_date'];
        // echo $endDate."<br>";

        if ($endDate < $currentDate) {
            $id = $row['id'];

            $update = "UPDATE car_one SET name='', phone='', vehicle='', trainer='',  start_date='', end_date='', status='empty' WHERE id = '$id'";
            $updateResult = mysqli_query($conn, $update);

            if (!$updateResult) {
                die("Error updating row: " . mysqli_error($conn));
            } else {
                $msg[] = "Rows updated successfully. i10";
                // echo "<script>alert('Rows updated successfully in i10')</script>";
            }
        }
    }


} else {
    $msg[] = "No rows to update. i10";
    // echo "<script>alert('No rows to update in i10')</script>";

}

?>


<?php



if (isset($_GET['car'])) {
    if ($_GET['car'] == "i10") {
        ?>

        <div class="title">Hyundai i10 Time-Table <i class='bx bx-table'></i></div>

        <table>
            <thead>
                <tr>
                    <th>Timeslots</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Vehicle</th>
                    <th>Trainer</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php


                $select = "SELECT * FROM car_one ORDER BY id ASC";
                $result = $conn->query($select);
                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {

                        ?>

                        <tr>
                            <td id="TS">
                                <?php echo $row['timeslots']; ?>
                            </td>
                            <td>
                                <?php echo $row['name']; ?>
                            </td>
                            <td>
                                <?php echo $row['phone']; ?>
                            </td>
                            <td>
                                <?php echo $row['vehicle']; ?>
                            </td>
                            <td>
                                <?php echo $row['trainer']; ?>
                            </td>
                            <td id="SD">
                                <?php convertDMY((String) $row['start_date']); ?>
                            </td>
                            <td id="ED">
                                <?php convertDMY((String) $row['end_date']); ?>
                            </td>
                            <td>
                                <?php echo $row['status']; ?>
                            </td>
                            <td class="btns">
                                <?php if ($row['status'] == 'active') {
                                    echo "<a id='btn' href='addDay.php?id=" . $row['id'] . "&car=" . $_GET['car'] . "&route=../timetable?car=i10' style='background:green; '>+1 DAY</a>";
                                } ?>

                                <?php if ($row['status'] == 'active') {
                                    echo "<a id='btn' href='subDay.php?id=" . $row['id'] . "&car=" . $_GET['car'] . "&route=../timetable?car=i10'  style='background:red; '>-1 DAY</a>";
                                } ?>

                                <?php if ($row['status'] == 'active') {
                                    echo "<a id='btn' href='modify.php?id=" . $row['id'] . "&car=" . $_GET['car'] . "&route=".urlencode("../timetable?car=i10")."#modify'>MODIFY</a>";
                                } ?>
                            </td>
                        </tr>

                        <?php

                    }
                }

                ?>

            </tbody>
        </table>

        <?php
    }
} else {
    exit();
}

?>