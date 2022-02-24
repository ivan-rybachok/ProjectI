<?php


session_start();


if (!isset($_SESSION['username'])) { header("Location: http://localhost/DNMPP/code/PHP2022/PHP/ProjectI/"); }

    //checking if signed in as admin or prep since only adim allowed to download 

    if($_SESSION['username'] != 'admin') { header("Location: http://localhost/DNMPP/code/PHP2022/PHP/ProjectI/my_menu.php"); }

    // if submit is null it wont let the user go by pass to the page using url

    if ((!$_POST['submit']) == U_UNDEFINED_VARIABLE) {
        header("Location: http://localhost/DNMPP/code/PHP2022/PHP/ProjectI/my_menu.php");
        exit;
    }

    // setting up vars 

    $db_name = "address_book";
        $table_name = "address_info";

        require 'dbConnect.php';

        // $db = mysqli_select_db($connection, $db_name) or die(mysqli_error($connection));

        // $db = new mysqli('localhost', 'username', 'password', 'databasename');

        // if an error dispaly what error it is

        if($connection->connect_errno > 0){
            die('Unable to connect to database [' . $connection->connect_error . ']');
        } 

        // File Upload

        if (isset($_POST['submit'])) {
            
            // checking if .csv type was uploaded
            
            if($_FILES['fileToUpload']['type'] == "application/vnd.ms-excel") {
                
                
                // Import the uploaded file to the database
        
                // opening the file the file to upload and reading it
                $handle = fopen($_FILES['fileToUpload']['tmp_name'], "r");
                

                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

                    // inserting info of the csv into the database

                    $sql = "INSERT INTO `$table_name` (`firstname`, `lastname`, `phonenumber`, `email`, `address`, `city`, `province`, `postalcode`, `birthday`) VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]', '$data[7]', '$data[8]');";

                    if(!$result = $connection->query($sql)){
                        die('There was an error running the query [' . $connection->error . ']');
                    }
                }

                fclose($handle);

            } else {
                // echo "BAD!";
            }
                

            // echo "Import Completed Successfully"; 
            mysqli_close($connection);
        }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Import Added</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
<body></br>
    <div class="container">
        <div class="row text-center">
            <div class="col">

                <!-- menu for the user to go back if they are done with importing  -->

                <a href="my_menu.php"><button class="btn btn-dark">Home Page</button></a>
                    
                <a href="downloadcsv.php"><button class="btn btn-dark">Download Contact</button>

                <a href="email.php"><button class="btn btn-dark">Sent Email</button>
    
                <a href="downloadcsv.php"><button class="btn btn-dark">Download Contact</button>
        
                <a href="birthdaypromo.php"><button class="btn btn-dark">Birthday Promo</button>
    
                <a href="logout.php"><button type="submit" name="logout" class="btn btn-dark">Logout</button></a>
            </div>
        </div>
    </div>
    <div class="text-center">
    <?php if($_FILES['fileToUpload']['type'] == "application/vnd.ms-excel") { ?>    
        </br><h1>Success!</h1>
        <h3> Import was send successfully. </h3>
        </div><br>
        </body>
    <?php }else{?>
    </br><h1 class="text-danger">Unfortunately You Used a wrong file type</h1>
    <h3 class="text-danger">Please use .csv file:) </h3>
    <a href="importcsv.php"><button class="btb btn-dark">Try again?</button></a>
    </div><br>
    </body>
    <?php }?>
</html>

