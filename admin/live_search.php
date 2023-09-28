<?php

include('../includes/authentication.php');


if (isset($_POST['input'])) {

    $input = $_POST['input'];
    $query = "SELECT * FROM `cust_details` WHERE name LIKE '{$input}%' OR phone LIKE '{$input}%' OR date LIKE '{$input}%' LIMIT 8";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {

        ?>

        <div class="search-table">
            <table>

                <thead>
                    <tr>
                    
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Total Amount</th>
                        <th>Vehicle</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["name"] . "</td><td>" . $row["phone"] . "</td><td>"
                            . $row["email"] . "</td><td>" . $row["totalamount"] . "</td><td>" . $row["vehicle"] . "</td><td>"
                            . $row["date"] . "</td>" . "<td>" .
                            "<a class='view' href='view/?id=" . $row["id"] . "&phone=" . $row["phone"] . "&date=" . $row["date"] ."&route=../search'>View Details</a>";
                    }
        
           
                    ?>
                </tbody>
            </table>
        </div>
 <?php

    } else {

        echo "<h4>Not Data Found</h4>";
    }
}




?>