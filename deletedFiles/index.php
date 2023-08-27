<?php

include('../../includes/authentication.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Details</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://www.jqueryscript.net/demo/Dialog-Modal-Dialogify/dist/dialogify.min.js"></script>
    <link rel="stylesheet" href="../../css/navbar.css">
</head>


<body>

<section id="content">
        <nav>
        <a href="../sortData" class="home-link">
         Back
            </a>
            <span class="text">
                <h3>Patel Motor Driving School</h3>

            </span>
            <a href="#" class="profile">
                <img src="../../assets/logoBlack.png">
            </a>
        </nav>
        
    </section>

    <div class="text-container" style="
    width: 100%;
    height: 100vh;
    display: flex;
    align-content: center;
    justify-content: center;
    flex-wrap: wrap;
">
        <strong style="
    font-size: 50px;
">Go Back to Home?</strong>
    </div>

    <script>
   $(document).ready(function() {
    var urlParams = new URLSearchParams(window.location.search);
  var id = urlParams.get('id');

  
  if (id) {
    var options = {
      ajaxPrefix: '',
      ajaxData: {id: id},
      ajaxComplete: function() {
        this.buttons([{
          type: Dialogify.BUTTON_PRIMARY
        }]);
      },
    
    };
    
    new Dialogify('fetch_single.php', options)
      .title('Customer Details')
      .showModal();
      
  }
  
});


    </script>



</body>

</html>