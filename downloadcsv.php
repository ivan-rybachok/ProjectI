<?php

session_start();

if (!isset($_SESSION['username'])) { header("Location: http://localhost/DNMPP/code/PHP2022/PHP/ProjectI/"); }

    //checking if signed in as admin or prep since only adim allowed to download 

    if($_SESSION['username'] != 'admin') { header("Location: http://localhost/DNMPP/code/PHP2022/PHP/ProjectI/my_menu.php"); }


?>

<!DOCTYPE html>
<html>
<head>
    <title>Downloading Contacts</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
<body></br>
    <div class="container">
        <div class="row text-center">
            <div class="col">

                <!-- menus to go to the different pages  -->

                <a href="my_menu.php"><button class="btn btn-dark">Home Page</button></a>
                
                <a href="newContact.php"><button class="btn btn-dark">Add New Contact</button></a>
                
                <a href="importcsv.php"><button class="btn btn-dark">Import CSV</button>
                
                <a href="email.php"><button class="btn btn-dark">Sent Email</button>
        
                <a href="birthdaypromo.php"><button class="btn btn-dark">Birthday Promo</button>
    
                <a href="logout.php"><button type="submit" name="logout" class="btn btn-dark">Logout</button></a>
            </div>
        </div>
    </div></br>
    <div class="text-center">
        <h3>Signed in as <?php echo $_SESSION['username'];?>:</h3>
    </div>
    <div class="text-center">
        <!-- going to the do_download page where the download of the data happens  -->
    <h1>Welcome to the download contact page!</h1></br>
    <a href="do_download.php"><button class="btn btn-dark">Download Data</button></a>
    </div><br>
</body>
</html>