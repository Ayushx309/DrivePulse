<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Table</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <title>Sort Data by Date Or Name ETC..</title>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
        }

        .box {
            width: 97%;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 25px;
        }
    </style>

<link rel="shortcut icon" type="image/png" href="../../assets/logo.png"/>
<link rel="stylesheet" href="../../css/navbar.css">
</head>

<body>
   

<section id="content" style="width: 100%; position: sticky; margin-bottom: 10px; ">
        <nav>
            <div class="btn-s" >
            <a href="../" class="home-link" style="margin-right: 20px;">
                Back
            </a>
            <a href="exportdata?export=true" class="home-link" style="background: green;">
            Export As Excel <i class='bx bxs-file-blank'></i>
            </a>
            </div>
            <span class="text">
                <h3>Patel Motor Driving School</h3>

            </span>
            <a href="#" class="profile" style="margin-left: 140px;">
                <img src="../../assets/logoBlack.png">
            </a>
        </nav>

    </section>

    <div class="container box">
        <h1 align="center"></h1>
        <br />
        <div class="table-responsive">
            <br />
            <div class="row">
                <div class="input-daterange">
                    <div class="col-md-4">
                        <input type="text" name="start_date" id="start_date" class="form-control" />
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="end_date" id="end_date" class="form-control" />
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="button" name="search" id="search" value="Search" class="btn btn-info" />
                </div>
            </div>
            <br />
            <table id="order_data" class="table table-bordered table-striped">
                <thead>
                    <tr>

                        <th>id</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Total Amount</th>
                        <th>Paid Amount</th>
                        <th>Due Amount</th>
                        <th>Vehicle</th>
                        <th>Trainer Name</th>
                        <th>Admission Date</th>
                        <th>days</th>
                        <th>Ends_on</th>
                        <th>View</th>

                    </tr>
                </thead>
            </table>

        </div>
    </div>
</body>

</html>



<script type="text/javascript" language="javascript">
    $(document).ready(function () {

        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: "yyyy-mm-dd",
            autoclose: true
        });

        fetch_data('no');

        function fetch_data(is_date_search, start_date = '', end_date = '') {
            var dataTable = $('#order_data').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "fetch.php",
                    type: "POST",
                    data: {
                        is_date_search: is_date_search, start_date: start_date, end_date: end_date
                    }
                }
            });
        }

        $('#search').click(function () {
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            if (start_date != '' && end_date != '') {
                $('#order_data').DataTable().destroy();
                fetch_data('yes', start_date, end_date);
            }
            else {
                alert("Both Date is Required");
            }
        });
        

    });
</script>

