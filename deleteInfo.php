<?php

session_start();

// if the user trys to get in by url it will catch and refresh the page since the username was not submitted

if (!isset($_SESSION['username'])) { header("Location: http://localhost/DNMPP/code/PHP2022/PHP/ProjectI/"); }

    // checks if id is not undefined so the user cant access the delete page with url
    if ((!$_POST['id']) == U_UNDEFINED_VARIABLE) {
        header("Location: http://localhost/DNMPP/code/PHP2022/PHP/ProjectI/my_menu.php");
        exit;
    }

//set up database and table names
$db_name = "address_book";
	$table_name = "address_info";

    // brining in the connect page

	require 'dbConnect.php';

	$db = mysqli_select_db($connection, $db_name) or die(mysqli_error($connection));

    $id = $_POST['id'];

    // deleting from the table where id = id that was clicked

	$sql = "DELETE FROM $table_name WHERE id=$id";

    if ($connection->query($sql) === TRUE) {

        // echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $connection->error;
    }

	// $stmt = $connection->prepare($sql);

	// // var_dump($stmt);

	// $stmt->execute();

	// $info = $stmt->get_result();

	// $data = $info->fetch_all(MYSQLI_ASSOC);

	// $stmt->close();
	$connection->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer was deleted</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
<body></br>
    <div class="container">
        <div class="row text-center">
            <div class="col">

                <!-- allowing user to go back if they like -->

                <a href="my_menu.php"><button class="btn btn-dark">Home Page</button></a>

                <a href="newContact.php"><button class="btn btn-dark">Add New Contact</button></a>
                        
                <a href="email.php"><button class="btn btn-dark">Sent Email</button>

                 <!-- checking to see if the sign in was with admin or prep to show content or not -->
                
                <?php if($_SESSION['username'] == 'admin') { ?>

                <a href="downloadcsv.php"><button class="btn btn-dark">Download Contact</button>

                <a href="importcsv.php"><button class="btn btn-dark">Import CSV</button>

                    <?php } ?>

                <a href="birthdaypromo.php"><button class="btn btn-dark">Birthday Promo</button>

                <a href="logout.php"><button type="submit" name="logout" class="btn btn-dark">Logout</button></a>
    
            </div>
        </div>
    </div>
    <div class="text-center">
        </br><h1>Success!</h1>
        <h3> Contact was deleted succesuflly!</h3>
    </div><br>
    
</body>
</html>

