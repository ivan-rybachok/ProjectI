
<?php

session_start();

// if the user trys to get in by url it will catch and refresh the page since the username was not submitted

if (!isset($_SESSION['username'])) { header("Location: http://localhost/DNMPP/code/PHP2022/PHP/ProjectI/"); }


    if($_SESSION['username'] != 'admin') { header("Location: http://localhost/DNMPP/code/PHP2022/PHP/ProjectI/my_menu.php"); }
 
    // if ((!$_POST['submit']) == U_UNDEFINED_VARIABLE) {
    //     header("Location: http://localhost/DNMPP/code/PHP2022/PHP/ProjectI/my_menu.php");
    //     exit;
    // }


//set up database and table names
$db_name = "address_book";
	$table_name = "address_info";

	require 'dbConnect.php';

	$db = mysqli_select_db($connection, $db_name) or die(mysqli_error($connection));

    // getting everyhting from the database ordering by id

    $sql = "SELECT * FROM $table_name ORDER BY id";

    // doing a prep statement
    $stmt = $connection->prepare($sql);

	// var_dump($stmt);

	$stmt->execute();

	$info = $stmt->get_result();

	$data = $info->fetch_all(MYSQLI_ASSOC);

	$stmt->close();
	$connection->close();

    // setting a name as time and date for the filr

    $setfiletime = date("d m Y h-i-s a");

    // creating a file name and adding it to the folder

    $filename = "./csv/" . $setfiletime . ".csv";

    // checking if file already exsits just why not
    if (file_exists($filename)) {
        
        $msg = "<h3>File unfortunately already exists, try a different name.</h3>";

    }else{
        // loop through each of the elements in the $data array and write each element as a line to the CSV file
        $f = fopen($filename, 'w+') or die("Couldn't create file.");
        foreach ($data as $row) {
            //putting stuff in
            fputcsv($f, $row);
        }
        $msg = "<h3>File was downloaded succesfully!</h3>";

        fclose($f);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Downloading Data</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
<body></br>
    <div class="container">
        <div class="row text-center">
            <div class="col">

                <!-- menu for user to go back to any pages that they like  -->
    
                <a href="my_menu.php"><button class="btn btn-dark">Home Page</button></a>

                <a href="newContact.php"><button class="btn btn-dark">Add New Contact</button></a>
            
                <a href="importcsv.php"><button class="btn btn-dark">Import CSV</button>

                <a href="email.php"><button class="btn btn-dark">Sent Email</button>
        
                <a href="birthdaypromo.php"><button class="btn btn-dark">Birthday Promo</button>
    
                <a href="logout.php"><button type="submit" name="logout" class="btn btn-dark">Logout</button></a>
            </div>
        </div>
    </div>
    <div class="text-center">
    </br><h1>Success!</h1>
        <!-- letting the user know that it wasd downlaoded succesfully -->
        </br><?php echo "$msg </br>"; ?>
        <a href="downloadcsv.php"><button class="btn btn-dark">Go back</button></a>
    </div><br>
</body>
</html>