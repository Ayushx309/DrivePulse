<?php
include('../../config.php');
?>

<?php

date_default_timezone_set('Asia/Kolkata');
$current_timestamp_by_mktime = mktime(date("m"), date("d"), date("Y"));
$currentDate = date("Y-m-d", $current_timestamp_by_mktime);

$check = "SELECT * FROM car_two WHERE status = 'active'";
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

            $update = "UPDATE car_two SET name='', phone='', vehicle='', trainer='',  start_date='', end_date='', status='empty' WHERE id = '$id'";
            $updateResult = mysqli_query($conn, $update);

            if (!$updateResult) {
                die("Error updating row: " . mysqli_error($conn));
            } else {
                // echo "Rows updated successfully. liva";
                echo "<script>alert('Rows updated successfully in liva')</script>";
            }
        }
    }


} else {
    // echo "No rows to update. liva";
    echo "<script>alert('No rows to update in liva')</script>";
}

?>



<?php



if (isset($_GET['car'])) {
    if ($_GET['car'] == "liva") {
        ?>

        <div class="title">Toyota Liva Time-Table <i class='bx bx-table'></i></div>

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


                $select = "SELECT * FROM car_two ORDER BY id ASC";
                $result = $conn->query($select);
                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {

                        ?>

                        <tr>
                            <td>
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
                            <td>
                                <?php echo $row['start_date']; ?>
                            </td>
                            <td>
                                <?php echo $row['end_date']; ?>
                            </td>
                            <td>
                                <?php echo $row['status']; ?>
                            </td>
                            <td>
                                <?php if ($row['status'] == 'active') {
                                    echo "<a href='addDay.php?id=" . $row['id'] . "&car=".$_GET['car']."&route=../timetable?car=liva' style='
                                                                                                display: inline-block;
                                                                                                padding: 10px 20px;
                                                                                                background-color: green;
                                                                                                color: #fff;
                                                                                                text-decoration: none;
                                                                                                border-radius: 4px;
                                                                                                font
                                            '>+1 DAY</a>";
                                } ?>
                            
                                <?php if ($row['status'] == 'active') {
                                    echo "<a href='subDay.php?id=" . $row['id'] . "&car=".$_GET['car']."&route=../timetable?car=liva' style='
                                                                                                display: inline-block;
                                                                                                padding: 10px 20px;
                                                                                                background-color: red;
                                                                                                color: #fff;
                                                                                                text-decoration: none;
                                                                                                border-radius: 4px;
                                                                                                font
                                            '>-1 DAY</a>";
                                } ?>

                                <?php if ($row['status'] == 'active') {
                                    echo "<a href='modify.php?id=" . $row['id'] . "&car=".$_GET['car']."&route=../timetable?car=liva' style='
                                                                                                display: inline-block;
                                                                                                padding: 10px 20px;
                                                                                                background-color: #46abcc;
                                                                                                color: #fff;
                                                                                                text-decoration: none;
                                                                                                border-radius: 4px;
                                                                                                font
                                            '>MODIFY</a>";
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