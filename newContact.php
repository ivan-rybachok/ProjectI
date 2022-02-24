<?php

	session_start();

    // if the user trys to get in by url it will catch and refresh the page since the username was not submitted

	if (!isset($_SESSION['username'])) { header("Location: http://localhost/DNMPP/code/PHP2022/PHP/ProjectI/"); }
    

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Add a New Client</title>
	</head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
	<body>
        <div class="text-center">
        </br><h1>Adding a New Client</h1></br>
			<div class="container">
				<div class="row text-center">
					<div class="col">

                        <a href="my_menu.php"><button class="btn btn-dark">Home Page</button></a>

                        <a href="email.php"><button class="btn btn-dark">Sent Email</button>

                        <?php if($_SESSION['username'] == 'admin') { ?>

                        <a href="downloadcsv.php"><button class="btn btn-dark">Download Contact</button>

                        <a href="importcsv.php"><button class="btn btn-dark">Import CSV</button>

                        <?php } ?>
                                    
                        <a href="birthdaypromo.php"><button class="btn btn-dark">Birthday Promo</button>
            
                        <a href="logout.php"><button type="submit" name="logout" class="btn btn-dark">Logout</button></a>
                        
					</div>
				</div></br>
                <div class="text-center">
                    
                    <!-- show who you are signed in as -->

					<h3>Signed in as <?php echo $_SESSION['username'];?>:</h3>
				</div>
			</div></br>
            <form method="POST" action="do_newContact.php">
                <!-- <table cellspacing=3 cellpadding=3> -->
                    <tr>
                        <!-- getting info with names and sending it to do_contact page  -->
                        <td valign=top>
                            <p><strong>First Name:</strong><br>
                            <input type="text" required name="firstname" size=35 maxlength=100></p>
                        </td>
                        <td valign=top>
                            <p><strong>Last Name:</strong><br>
                            <input type="text" required name="lastname" size=35 maxlength=100></p>
                        </td>
                        <td valign=top>
                            <p><strong>PhoneNumber:</strong><br>
                            <input type="text" required name="phonenumber" size=35 maxlength=100></p>
                        </td>
                        <td valign=top>
                            <p><strong>Email:</strong><br>
                            <input type="text" required name="email" size=35 maxlength=100></p>
                        </td>
                        <td valign=top>
                            <p><strong>Address:</strong><br>
                            <input type="text" required name="address" size=35 maxlength=100></p>
                        </td>
                        <td valign=top>
                            <p><strong>City:</strong><br>
                            <input type="text" required name="city" size=35 maxlength=100></p>
                        </td>
                        <td valign=top>
                            <p><strong>Province:</strong><br>
                            <input type="text" required name="province" size=35 maxlength=100></p>
                        </td>
                        <td valign=top>
                            <p><strong>PostalCode:</strong><br>
                            <input type="text" required name="postalcode" size=35 maxlength=100></p>
                        </td>
                        <td valign=top>
                            <p><strong>Birthday</strong><br>
                            <input type="date" required name="birthday" size=35 maxlength=100></p>
                        </td>
                    </tr>
                    <tr>
                        <td valign=top colspan=2 align=center>
                            <!-- <p><strong>My Notes:</strong><br>
                            <textarea name="my_notes" cols=35 rows=5 wrap=virtual></textarea></p> -->
                            <p><input class="btn btn-dark" type="SUBMIT" name="submit" value="Submit"></p>
                        </td>
                    </tr>
            </form>
        </div>
	</body>
</html>

