<?php


include('../includes/authentication.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Data</title>
    <link rel="shortcut icon" type="image/png" href="../assets/logo.png"/>
    <link rel="stylesheet" href="../css/search.css">


</head>

<body>
    <?php
    
    include('../includes/headerlvl2.php');
    
    ?>

    <?php
    if (isset($_GET['query'])) {

        $Squery = $_GET['query'];

        echo "  <div class='container' >
        <div class='form-container'>
            <input type='text' id='live_search' autocomplete='off' placeholder='Search' value='$Squery' style='
            width: 50vw;'>
        </div>
     ";


    } else {

        echo "  <div class='container' >
        <div class='form-container'>
            <input type='text' id='live_search' autocomplete='off' placeholder='Search' style='
            width: 50vw;'>
        </div>
        
     ";

    }

    ?>
    <div class="full-data">
        <a href="sortData/">View DataBase</a>
    </div>
    </div>
    <!-- <div class="container">
        <div class="form-container">
            <input type="text" id="live_search" autocomplete="off" placeholder="Search">
        </div>
    </div> -->
    <div id="search_result" ></div>






    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#live_search").keyup(function () {

                var input = $(this).val();

                if (input != "") {
                    $.ajax({
                        url: "live_search.php",
                        method: "POST",
                        data: { input: input },

                        success: function (data) {
                            $("#search_result").html(data);
                        }

                    });
                } 
                else {
                    $("#search_result").css("display","none");
                }
          

            });
        });

    </script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            var timeout = null;

            $("#live_search").on("input", function () {
                clearTimeout(timeout);

                var input = $(this).val();

                if (input != "") {
                    timeout = setTimeout(function () {
                        $.ajax({
                            url: "live_search.php",
                            method: "POST",
                            data: { input: input },
                            success: function (data) {
                                $("#search_result").html(data);
                            }
                        });
                    }, 500); // Delay for 500 milliseconds (adjust as needed)
                } else {
                    $("#search_result").html(""); // Clear the search result
                }
            });
        });


        // Get the pagination links
        const paginationLinks = document.querySelectorAll(".pagination-link");

        // Add click event listeners to the pagination links
        paginationLinks.forEach(link => link.addEventListener("click", handlePageNavigation));

        // Event handler function
        function handlePageNavigation(e) {
            e.preventDefault();

            // Remove the "active" class from all pagination links
            paginationLinks.forEach(link => link.classList.remove("active"));

            // Add the "active" class to the clicked link
            this.classList.add("active");

            // Add logic to navigate to the corresponding page
        }


    </script>


</body>

</html>