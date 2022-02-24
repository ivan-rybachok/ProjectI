<?php

session_start();

if ((!$_POST['firstname']) || (!$_POST['lastname']) || (!$_POST['phonenumber']) || (!$_POST['email']) || (!$_POST['address']) || (!$_POST['city']) || (!$_POST['province']) || (!$_POST['postalcode']) || (!$_POST['birthday'])) {
    header("Location: http://localhost/DNMPP/code/PHP2022/PHP/ProjectI/my_menu.php");
    exit;
}


//set up database and table names
$db_name = "address_book";
	$table_name = "address_info";

	require 'dbConnect.php';

	$db = mysqli_select_db($connection, $db_name) or die(mysqli_error($connection));

    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $postalcode = $_POST['postalcode'];
    $birthday = $_POST['birthday'];

	// $sql = "UPDATE $table_name SET `firstname`='$firstname', `lastname`='$lastname', `phonenumber`='$phonenumber', `email`='$email', `address`='$address', `city`='$city', `province`='$province', `postalcode`='$postalcode', `birthday`='$birthday' WHERE id=$id";

    //passing in the data updating the database finding what was changed and using prepare statements

    $stmt = $connection->prepare("UPDATE $table_name SET `firstname`=?, `lastname`=?, `phonenumber`=?, `email`=?, `address`=?, `city`=?, `province`=?, `postalcode`=?, `birthday`=? WHERE id=$id");

    $stmt->bind_param("sssssssss", $firstname, $lastname, $phonenumber, $email, $address, $city, $province, $postalcode, $birthday);
    
    // if ($connection->prepare($stmt) === TRUE) {
    //     // echo "Record updated successfully";
    // } 
    // else {
    //     echo "Error updating record: " . $connection->error;
    // }

	$stmt->execute();

	$stmt->close();
	$connection->close();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact is Editted</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
<body></br>
    <div class="container">
        <div class="row text-center">
            <div class="col">

                <!-- letting the user to go back if they like -->

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
    <h3> Submission was send successfully. </h3>
    </div><br>
</body>
</html>

