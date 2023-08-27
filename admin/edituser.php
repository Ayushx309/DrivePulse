<?php

include('../includes/authentication.php');

?>

<?php


$id = $_GET['i'];
$name = $_GET['n'];
$username = $_GET['u'];
$permissions = $_GET['p'];

if (isset($_POST['submit'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $permissions = $_POST['permissions'];

    $update = "UPDATE users_db SET name = '$name', username = '$username', permissions = '$permissions' WHERE id = $id";

    $result = mysqli_query($conn, $update);
    if (!$result) {
        $error[] = "Failed To Update";
    } else {
        $error[] = "Successfully Updated User Info";
        $_SESSION['TimeOut'] = true;

    }

}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit form</title>

    <!-- custom css file link  -->
<link rel="shortcut icon" type="image/png" href="../assets/logo.png"/>
    
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>
<?php
    
    include('../includes/headerlvl2.php');
    
    ?>

    <div class="form-container">

        <form action="" method="post">
            <h3>Edit user</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                    
                }
                header('refresh:2;url=index.php');
           
            }

    
            
            ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="enter name">
            <input type="text" name="username" value="<?php echo $username; ?>" placeholder="enter username">


            <?php

            if ($permissions == "admin") {

                echo "<select name='permissions' >
                <option selected value='admin'>admin</option>
                <option  value='user'>user</option>
                <option  value='noAccess'>noAccess</option>
            </select>";


            } elseif ($permissions == "user") {

                echo "<select name='permissions' >
                <option  value='admin'>admin</option>
                <option selected value='user'>user</option>
                <option  value='noAccess'>noAccess</option>
            </select>";

            } elseif ($permissions == "noAccess") {

            echo "<select name='permissions' >
            <option  value='admin'>admin</option>
            <option  value='user'>user</option>
            <option selected value='noAccess'>noAccess</option>
        </select>";

        }


            ?>


            <input type="submit" name="submit" id="st" value="submit" class="form-btn">

        </form>

    </div>



   

</body>

</html>