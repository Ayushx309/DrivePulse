<?php  
//export.php  
include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/mysqlconnection.php');

$connect = mySqlConnection(); 
$output = '';
if(isset($_GET["export"]))
{
 $query = "SELECT * FROM cust_details";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" style="border-collapse: collapse; border: 1px solid black;">
   <tr style="border: 1px solid black;">
   <th style="border: 1px solid black;">ID</th>
   <th style="border: 1px solid black;">Name</th>
   <th style="border: 1px solid black;">Phone</th>
   <th style="border: 1px solid black;">Email</th>
   <th style="border: 1px solid black;">Address</th>
   <th style="border: 1px solid black;">Total Amount</th>
   <th style="border: 1px solid black;">Paid Amount</th>
   <th style="border: 1px solid black;">Due Amount</th>
   <th style="border: 1px solid black;">Days</th>
   <th style="border: 1px solid black;">Time Slot</th>
   <th style="border: 1px solid black;">Vehicle</th>
   <th style="border: 1px solid black;">New Licence</th>
   <th style="border: 1px solid black;">Trainer</th>
   <th style="border: 1px solid black;">Trainer Ph.</th>
   <th style="border: 1px solid black;">Date</th>
   <th style="border: 1px solid black;">Time</th>
   <th style="border: 1px solid black;">Ends On</th>
   <th style="border: 1px solid black;">Form Filler</th>
   </tr>
  ';
  
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
   <tr style="border: 1px solid black;">  
   <td style="border: 1px solid black;">'.$row["id"].'</td>  
   <td style="border: 1px solid black;">'.$row["name"].'</td>  
   <td style="border: 1px solid black;">'.$row["phone"].'</td>  
   <td style="border: 1px solid black;">'.$row["email"].'</td>  
   <td style="border: 1px solid black;">'.$row["address"].'</td>
   <td style="border: 1px solid black;">'.$row["totalamount"].'</td>
   <td style="border: 1px solid black;">'.$row["paidamount"].'</td>
   <td style="border: 1px solid black;">'.$row["dueamount"].'</td>
   <td style="border: 1px solid black;">'.$row["days"].'</td>
   <td style="border: 1px solid black;">'.$row["timeslot"].'</td>
   <td style="border: 1px solid black;">'.$row["vehicle"].'</td>
   <td style="border: 1px solid black;">'.$row["newlicence"].'</td>
   <td style="border: 1px solid black;">'.$row["trainername"].'</td>
   <td style="border: 1px solid black;">'.$row["trainerphone"].'</td>
   <td style="border: 1px solid black;">'.$row["date"].'</td>
   <td style="border: 1px solid black;">'.$row["time"].'</td>
   <td style="border: 1px solid black;">'.$row["days"].'</td>
   <td style="border: 1px solid black;">'.$row["endedAT"].'</td>
   <td style="border: 1px solid black;">'.$row["formfiller"].'</td>
   </tr> 
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment; filename=Customer_Details.xls');
  echo $output;
 }
}
?>
