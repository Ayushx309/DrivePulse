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
            background-color:#ccc;
        }
    </style>
</head>

<body>
    <main>
        <?php
        // Define the path to the JSON file
        $jsonFilePath = '../../../../logs/user_logs/logs.json';

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
                            <h3>User Logs</h3>
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
                                echo '<td>' . htmlspecialchars($entry['timestamp']) . '</td>';
                                echo '<td>' . htmlspecialchars($entry['who']) . '</td>';

                                echo '<td>' . htmlspecialchars($entry['activity']) . '</td>';


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