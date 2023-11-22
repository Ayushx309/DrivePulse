
<?php


include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/mysqlconnection.php');

$connect = mySqlConnection(); 

if(isset($_GET["id"]))
{

  $id = $_GET['id'];

  


 $query = "SELECT * FROM `cust_details` WHERE id = '$id'";

 
 $result = mysqli_query($connect,$query);
 $output = '<div class="row">';
 foreach($result as $row)
 {

   $images = '<img src="https://www.gravatar.com/avatar/38ed5967302ec60ff4417826c24feef6?s=80&d=mm&r=g" class="img-responsive img-thumbnail" />';
  
  $output .= '
  <div class="col-md-3">
   <br />
   '.$images.'
  </div>
  <div class="col-md-9">
   <br />
   <p><label>Name :&nbsp;</label>'.$row["name"].'</p>
   <p><label>Email :&nbsp;</label>'.$row["email"].'</p>
   <p><label>phone :&nbsp;</label>'.$row["phone"].'</p>
   <p><label>Address :&nbsp;</label>'.$row["address"].'</p>
   <p><label>Total Amount :&nbsp;</label>'.$row["totalamount"].'</p>
   <p><label>Paid Amount :&nbsp;</label>'.$row["paidamount"].'</p>
   <p><label>Due Amount :&nbsp;</label>'.$row["dueamount"].'</p>
   <p><label>Days :&nbsp;</label>'.$row["days"].'</p>
   <p><label>Time-Slot :&nbsp;</label>'.$row["timeslot"].'</p>
   <p><label>Vehicle :&nbsp;</label>'.$row["vehicle"].'</p>
   
   <p><label>New licence:&nbsp;</label>'.$row["newlicence"].'</p>
   <p><label>Trainer name :&nbsp;</label>'.$row["trainername"].'</p>
   <p><label>Trainer phone :&nbsp;</label>'.$row["trainerphone"].'</p>
   <p><label>Date :&nbsp;</label>'.$row["date"].'</p>

   <p><label>Time :&nbsp;</label>'.$row["time"].'</p>
   <p><label>Training ends on :&nbsp;</label>'.$row["endedAT"].'</p>
   <p><label>Form Filler :&nbsp;</label>'.$row["formfiller"].'</p>
  </div>
  </div></br>
  ';


 }
 echo $output;
}

?>
