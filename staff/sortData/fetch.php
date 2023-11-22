<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/mysqlconnection.php');

$connect = mySqlConnection(); 
$columns = array(
    'id',
    'name',
    'email',
    'phone',
    'address',
    'totalamount',
    'paidamount',
    'dueamount',
    'days',
    'timeslot',
    'vehicle',
    'newlicence',
    'trainername',
    'trainerphone',
    'date',
    'time',
    'startedAT',
    'endedAT',
    'formfiller'
);





$query = "SELECT * FROM `cust_details`  WHERE ";

if ($_POST["is_date_search"] == "yes") {
    $query .= 'date BETWEEN "' . $_POST["start_date"] . '" AND "' . $_POST["end_date"] . '" AND ';
}

if (isset($_POST["search"]["value"])) {
    $query .= '
  (id LIKE "%' . $_POST["search"]["value"] . '%" 
  OR name LIKE "%' . $_POST["search"]["value"] . '%" 
  OR vehicle LIKE "%' . $_POST["search"]["value"] . '%" 
  OR totalamount LIKE "%' . $_POST["search"]["value"] . '%")
 ';
}

if (isset($_POST["order"])) {
    $query .= 'ORDER BY ' . $columns[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' 
 ';
} else {
    $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if ($_POST["length"] != -1) {
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while ($row = mysqli_fetch_array($result)) {
    $sub_array = array();
    $sub_array[] = $row["id"];
    $sub_array[] = $row["name"];
    $sub_array[] = $row["phone"];
    $sub_array[] = $row["totalamount"];
    $sub_array[] = $row["paidamount"];
    $sub_array[] = $row["dueamount"];
    $sub_array[] = $row["vehicle"];
    $sub_array[] = $row["trainername"];
    $sub_array[] = $row["date"];
    $sub_array[] = $row["days"];
    $sub_array[] = $row["endedAT"];
    $sub_array[] = "<a class='btn btn-primary btn-xs view' href='../view/?id=" . $row["id"] . "&phone=" . $row["phone"] . "&date=" . $row["date"] . "&route=../sortData" . "'>View More Details</a>";

    $data[] = $sub_array;
}

function get_all_data($connect)
{
    $query = "SELECT * FROM `cust_details`";
    $result = mysqli_query($connect, $query);
    return mysqli_num_rows($result);
}

$output = array(
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => get_all_data($connect),
    "recordsFiltered" => $number_filter_row,
    "data" => $data
);

$_SESSION['filtered_Data'] = $data;

echo json_encode($output);

?>
