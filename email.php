<?php 

session_start();

if (!isset($_SESSION['username'])) { header("Location: http://localhost/DNMPP/code/PHP2022/PHP/ProjectI/"); }


    // if($_SESSION['username'] != 'admin') { header("Location: http://localhost/DNMPP/code/PHP2022/PHP/ProjectI/my_menu.php"); }
   
?>

<!DOCTYPE html>
<html>
<head>
    <title>Send Email</title>
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
        <h3>Signed in as <?php echo $_SESSION['username'];?>:</h3>
    </div>
    <div class="text-center">
    <h1>Welcome to the send emails page!</h1></br>

    <!-- getting the info from the user and going to do_email page to do code there to send the emails  -->
    <form action="do_email.php" method="post">
        Full Name:<br>
        <input class="text-center w-25 mb-4" required maxlength="20" type="text" name="fullname"><br>
        <!-- E-mail:<br>
        <input class="text-center w-25 mb-4" required maxlength="20" type="text" name="mail"><br> -->
        Comment:<br>
        <textarea class="text-center w-25 mb-4"  type="text" name="message" required maxlength="500" rows="10"></textarea>
    </div><br>
    <div class="text-center">
        <button type="SUBMIT" name="submit" class="btn btn-dark">Send Email To All</button>
        <button class="btn btn-dark">Reset</button>
    </div>

    </form>
</body>
</html>