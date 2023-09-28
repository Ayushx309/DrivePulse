<?php
session_start();

$output = '';
if (isset($_GET["export"])) {

    $output .= '
   <table class="table" style="border-collapse: collapse; width: 100%; border: 1px solid black;">
   <tr style="border: 1px solid black; background-color: #ccc;">

   <th style="border: 1px solid black; padding: 8px;">Name</th>
   <th style="border: 1px solid black; padding: 8px;">Phone</th>
   <th style="border: 1px solid black; padding: 8px;">Total Amount</th>
   <th style="border: 1px solid black; padding: 8px;">Paid Amount</th>
   <th style="border: 1px solid black; padding: 8px;">Due Amount</th>
   <th style="border: 1px solid black; padding: 8px;">Vehicle</th>
   <th style="border: 1px solid black; padding: 8px;">Trainer Name</th>
   <th style="border: 1px solid black; padding: 8px;">Date</th>
   <th style="border: 1px solid black; padding: 8px;">Days</th>
   <th style="border: 1px solid black; padding: 8px;">Ends On</th>
   </tr>
  ';

    foreach ((array)$_SESSION['filtered_Data'] as $record) {
        $output .= '
   <tr style="border: 1px solid black;">  
   <td style="border: 1px solid black; padding: 8px;">' . $record["1"] . '</td>  
   <td style="border: 1px solid black; padding: 8px;">' . $record["2"] . '</td>  
   <td style="border: 1px solid black; padding: 8px;">' . $record["3"] . '</td>  
   <td style="border: 1px solid black; padding: 8px;">' . $record["4"] . '</td>
   <td style="border: 1px solid black; padding: 8px;">' . $record["5"] . '</td>
   <td style="border: 1px solid black; padding: 8px;">' . $record["6"] . '</td>
   <td style="border: 1px solid black; padding: 8px;">' . $record["7"] . '</td>
   <td style="border: 1px solid black; padding: 8px;">' . $record["8"] . '</td>
   <td style="border: 1px solid black; padding: 8px;">' . $record["9"] . '</td>
   <td style="border: 1px solid black; padding: 8px;">' . $record["10"] . '</td>
   </tr> 
   ';
    }
    $output .= '</table>';
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename=Customer_Details.xls');
    echo $output;
}
?>
