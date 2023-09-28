<?php
function customTimeFormat($timeString) {
    date_default_timezone_set('Asia/Kolkata');
    // Convert the time string to a timestamp
    $timestamp = strtotime($timeString);

    if ($timestamp === false) {
        return "Invalid Date";
    }

    // Format the timestamp as desired
    $formattedTime = date('d-m-Y g:ia', $timestamp);

    return $formattedTime;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #f1f1f1;
            border-radius: 10px;
            overflow: hidden;
            margin: 20px auto;
        }

        th,
        td {
            text-align: left;
            padding: 10px;
        }

        th {
            background-color: grey;
            color: #fff;
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:nth-child(odd) {
            background-color: #f1f1f1;
        }

        th:nth-child(1),
        td:nth-child(1),
        th:nth-child(2),
        td:nth-child(2) {
            width: 15%;
        }


        #CD,
        #CT {
            width: 25%;
        }

        th:nth-child(3),
        td:nth-child(3) {
            width: 70%;
        }

        tbody tr:hover {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <main>
        <?php
        // Define the path to the JSON file
        $jsonFilePath = '../../../../logs/admin_logs/logs.json';

        // Check if the JSON file exists
        if (file_exists($jsonFilePath)) {
            // Read JSON data from the file
            $jsonData = file_get_contents($jsonFilePath);

            // Decode the JSON data into an array of log entries
            $logEntries = json_decode($jsonData, true);

            // Check if decoding was successful
            if ($logEntries !== null) {
                ?>
                <div class="table-data">
                    <div class="order">
                        <div class="head">
                            <h3>Admin Logs</h3>
                        </div>

                        <?php
                        echo '<table>';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>Timestamp</th>';
                        echo '<th>Who</th>';
                        echo '<th>Activity</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        try {
                            foreach ($logEntries as $entry) {
                                echo '<tr>';
                                echo '<td>' . customTimeFormat((string)htmlspecialchars($entry['timestamp'])) . '</td>';
                                echo '<td>' . htmlspecialchars($entry['who']) . '</td>';

                                // Check if "activity" is a string or an object
                                if (is_array($entry['activity'])) {
                                    echo '<td><b>' . htmlspecialchars($entry['activity']['What']).'</b>';
                                    if (is_array($entry['activity']['0'])) {
                                        echo '<table>';
                                        echo '<thead>';
                                        echo '<tr>';
                                        echo '<th id="CD">Customer Details</th>';
                                        echo '<th id="CT">Changed Things </th>';
                                        echo '<th>Date / TimeSlot</th>';
                                        echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';
                                        echo '<tr>';
                                        echo '<td>' . 'Name: ' . htmlspecialchars($entry['activity']['0']['customer_details']['name']) . '<br>Phone: ' . htmlspecialchars($entry['activity']['0']['customer_details']['phone']) . '</td>';

                                        echo '<td>' . '<b>Car</b><br>' . (is_array($entry['activity']['0']['changed_things']['car']) ? "Old: " . $entry['activity']['0']['changed_things']['car']['old'] . "<br>New: " . $entry['activity']['0']['changed_things']['car']['new'] : $entry['activity']['0']['changed_things']['car']) . '</td>';

                                        echo '<td>' .((isset($entry['activity']['0']['changed_things']['date'])) ? " Old End Date: " . $entry['activity']['0']['changed_things']['date']['0ld'] . "<br>New End Date: " . $entry['activity']['0']['changed_things']['date']['new'] : ((isset($entry['activity']['0']['changed_things']['timeSlot']) ? " Old TimeSlot: " . $entry['activity']['0']['changed_things']['timeSlot']['0ld'] . "<br>New TimeSlot: " . $entry['activity']['0']['changed_things']['timeSlot']['new'] : "Error"))) . '</td>';


                                        echo '</tr>';
                                        echo '</tbody>';
                                        echo '</table>';
                                    }
                                    echo '</td>';
                                } else {
                                    echo '<td>' . htmlspecialchars($entry['activity']) . '</td>';
                                }

                                echo '</tr>';
                            }
                        } catch (\Throwable $th) {
                            // Handle any exceptions if necessary
                        }

                        echo '</tbody>';
                        echo '</table>';
                        ?>

                    </div>
                </div>

                <?php
            } else {
                echo '<p>Failed to decode JSON data.</p>';
            }
        } else {
            echo '<p>JSON file not found.</p>';
        }
        ?>

    </main>

    </section>


</body>

</html>