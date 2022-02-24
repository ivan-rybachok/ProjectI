<?php 
    session_start();
    // sanitatizing the email
    $db_name = "address_book";
        $table_name = "address_info";
        
        require 'dbConnect.php';
        
        $db = mysqli_select_db($connection, $db_name) or die(mysqli_error($connection));
        
        // $message =  $_POST['message'];
        // $name = $_POST['fullname'];
        
        // getting all emails from the database ordering by id
        $sql = "SELECT email FROM $table_name ORDER BY id";
        
        $stmt = $connection->prepare($sql);
        
        // var_dump($stmt);
        
        $stmt->execute();
        
        $info = $stmt->get_result();
        
        $data = $info->fetch_all(MYSQLI_ASSOC);
        
        function sanitize_my_email($field) {
            $field = filter_var($field, FILTER_SANITIZE_EMAIL);
            if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
                return true;
            } else {
                return false;
            }
        }
        // adding who to send it too in this case it should be and array with all of the emails from the database
        
        foreach ($data as $result){
            
        $to_email =  $result['email'];
        
        // getting the message from the user
        $message =  $_POST['message'];
        $name = $_POST['fullname'];
        // getting the name from the user
        $headers = "From: " . $_POST['fullname'] . "noreply @ company. com";

        //check if the email address is invalid $secure_check
        $secure_check = sanitize_my_email($to_email);
        if ($secure_check == false) {
            echo "Invalid input";
        } else { //send email 
            mail($to_email, $message, $headers);
            echo "This email is sent using PHP Mail";
        }
    }
        
        $stmt->close();
        $connection->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sending Emails to Contacts</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
<body></br>
    <div class="container">
        <div class="row text-center">
            <div class="col">
            
            <a href="my_menu.php"><button class="btn btn-dark">Home Page</button></a>

            <a href="newContact.php"><button class="btn btn-dark">Add New Contact</button></a>

            <!-- checking to see if the sign in was with admin or prep to show content or not -->

            <?php if($_SESSION['username'] == 'admin') { ?>

            <a href="downloadcsv.php"><button class="btn btn-dark">Download Contact</button>

            <a href="importcsv.php"><button class="btn btn-dark">Import CSV</button>

            <?php } ?>

            <a href="birthdaypromo.php"><button class="btn btn-dark">Birthday Promo</button>

            <a href="logout.php"><button type="submit" name="logout" class="btn btn-dark">Logout</button></a>

            </div>
        </div>
    </div></br>
    <div class="text-center">
        <!--  showing who is signed in  -->
        <h3>Signed in as <?php echo $_SESSION['username'];?>:</h3>
    </div>
    <div class="text-center">
    </br><h1>Success!</h1>
    <h3> Submission was send successfully. </h3>
    </div><br>
</body>
</html>