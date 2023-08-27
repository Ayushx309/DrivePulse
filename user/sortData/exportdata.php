<?php
session_start();




$output = '';
if (isset($_GET["export"])) {

    $output .= '
   <table class="table" style="border-collapse: collapse; border: 1px solid black;">
   <tr style="border: 1px solid black;">

   <th style="border: 1px solid black;">Name</th>
   <th style="border: 1px solid black;">Phone</th>
   <th style="border: 1px solid black;">Total Amount</th>
   <th style="border: 1px solid black;">Paid Amount</th>
   <th style="border: 1px solid black;">Due Amount</th>
   <th style="border: 1px solid black;">Vehicle</th>
   <th style="border: 1px solid black;">Trainer Name</th>
   <th style="border: 1px solid black;">Date</th>
   <th style="border: 1px solid black;">Days</th>
   <th style="border: 1px solid black;">Ends On</th>
   </tr>
  ';


    foreach ((array)$_SESSION['filtered_Data'] as $record) {
        $output .= '
   <tr style="border: 1px solid black;">  
   <td style="border: 1px solid black;">' . $record["1"] . '</td>  
   <td style="border: 1px solid black;">' . $record["2"] . '</td>  
   <td style="border: 1px solid black;">' . $record["3"] . '</td>  
   <td style="border: 1px solid black;">' . $record["4"] . '</td>
   <td style="border: 1px solid black;">' . $record["5"] . '</td>
   <td style="border: 1px solid black;">' . $record["6"] . '</td>
   <td style="border: 1px solid black;">' . $record["7"] . '</td>
   <td style="border: 1px solid black;">' . $record["8"] . '</td>
   <td style="border: 1px solid black;">' . $record["9"] . '</td>
   <td style="border: 1px solid black;">' . $record["10"] . '</td>
   </tr> 
   ';
    }
    $output .= '</table>';
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename=Customer_Details.xls');
    echo $output;
}

?>
<?php



?>