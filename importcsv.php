<?php

session_start();

// if the user trys to get in by url it will catch and refresh the page since the username was not submitted
if (!isset($_SESSION['username'])) { header("Location: http://localhost/DNMPP/code/PHP2022/PHP/ProjectI/"); }


    //checking if signed in as admin or prep since only adim allowed to import

    if($_SESSION['username'] != 'admin') { header("Location: http://localhost/DNMPP/code/PHP2022/PHP/ProjectI/my_menu.php"); }

?>


<!DOCTYPE html>
<html>
<head>
    <title>Importing Data</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
<body></br>
    <div class="text-center">
    <h1>Welcome to the Import CSV page!</h1></br>
    <div class="container">
        <div class="row text-center">
            <div class="col">

                <!-- menu for the user to go to any pages that they like  -->
                
                <a href="my_menu.php"><button class="btn btn-dark">Home Page</button></a>
                
                <a href="newContact.php"><button class="btn btn-dark">Add New Contact</button></a>

                <a href="downloadcsv.php"><button class="btn btn-dark">Download Contact</button>
                
                <!-- <a href="importcsv.php"><button class="btn btn-dark">Import CSV</button> -->
                
                <a href="email.php"><button class="btn btn-dark">Sent Email</button>
        
                <a href="birthdaypromo.php"><button class="btn btn-dark">Birthday Promo</button>
    
                <a href="logout.php"><button type="submit" name="logout" class="btn btn-dark">Logout</button></a>
            </div>
        </div>
    </div></br>
    <div class="text-center">
        <!-- showing user who they are signed in as  -->
        <h3>Signed in as <?php echo $_SESSION['username'];?>:</h3>
    </div></br>
    <form action="do_importcsv.php" method="post" enctype="multipart/form-data">
        <!-- Select File to import: -->
        <!-- letting the user choose files from their pc to upload  -->
        <input type="file" required name="fileToUpload" id="fileToUpload" class="btn btn-dark">
        <!-- sending the data to the do_import page  -->
        <input type="submit" name="submit">
    </form>
    </div><br>
</body>
</html>