<?php

	session_start();

    
if (!isset($_SESSION['username'])) { header("Location: http://localhost/DNMPP/code/PHP2022/PHP/ProjectI/"); }

    $db_name = "address_book";
        $table_name = "address_info";

        require 'dbConnect.php';

        $db = mysqli_select_db($connection, $db_name) or die(mysqli_error($connection));

        $id = $_POST['id'];

        // getting everything from the database to use as a place holder so the user can edit based on the id that the contact was clicked on
        
        $sql = "SELECT firstname, lastname, phonenumber, email, address, city, province, postalcode, birthday FROM $table_name WHERE id=$id";
        
        $stmt = $connection->prepare($sql);

        // var_dump($stmt);

        $stmt->execute();

        $info = $stmt->get_result();

        $data = $info->fetch_all(MYSQLI_ASSOC);

        foreach ($data as $result){
						
            $firstname = $result['firstname'];
            $lastname =  $result['lastname'];
            $phonenumber = $result['phonenumber'];
            $email = $result['email'];
            $address = $result['address'];
            $city = $result['city'];
            $province =  $result['province'];
            $postalcode = $result['postalcode'];
            $birthday = $result['birthday'];
        }

        $stmt->close();
        $connection->close();


?>

<!DOCTYPE html>
<html>
	<head>
		<title>Editing a Client</title>
	</head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
	<body>
        <div class="text-center">
        </br><h1>Edit a Client</h1></br>	
        <div class="container">
            <div class="row text-center">
                <div class="col">

                    <a href="my_menu.php"><button class="btn btn-dark">Home Page</button></a>

                    <a href="newContact.php"><button class="btn btn-dark">Add New Contact</button></a>
                    
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
                <h3>Signed in as <?php echo $_SESSION['username'];?>:</h3>
            </div>
        </div></br>
            <form method="POST"  action="do_editContact.php">
                <!-- <table cellspacing=3 cellpadding=3> -->
                    <tr>
                        <td valign=top>
                        
                        <!-- goes to do_edit to sends the data there and checks it out and send it to the database -->
                            
                            <p><strong>FirstName:</strong><br>
                            <input type="hidden" name="id" value="<?php echo $id?>">
                            <input type="text" name="firstname" required value="<?php echo $firstname ?>" size=35 maxlength=100></p>
                        </td>
                        <td valign=top>
                            <p><strong>LastName:</strong><br>
                            <input type="text" name="lastname" required value="<?php echo $lastname ?>" size=35 maxlength=100></p>
                        </td>
                        <td valign=top>
                            <p><strong>PhoneNumber:</strong><br>
                            <input type="text" name="phonenumber" required value="<?php echo $phonenumber ?>" size=35 maxlength=100></p>
                        </td>
                        <td valign=top>
                            <p><strong>Email:</strong><br>
                            <input type="text" name="email" required value="<?php echo $email ?>" size=35 maxlength=100></p>
                        </td>
                        <td valign=top>
                            <p><strong>Address:</strong><br>
                            <input type="text" name="address" required value="<?php echo $address ?>" size=35 maxlength=100></p>
                        </td>
                        <td valign=top>
                            <p><strong>City:</strong><br>
                            <input type="text" name="city" required value="<?php echo $city ?>" size=35 maxlength=100></p>
                        </td>
                        <td valign=top>
                            <p><strong>Province:</strong><br>
                            <input type="text" name="province" required value="<?php echo $province ?>" size=35 maxlength=100></p>
                        </td>
                        <td valign=top>
                            <p><strong>PostalCode:</strong><br>
                            <input type="text" name="postalcode" required value="<?php echo $postalcode ?>" size=35 maxlength=100></p>
                        </td>
                        <td valign=top>
                            <p><strong>Birthday</strong><br>
                            <input type="date" name="birthday" required value="<?php echo $birthday ?>"size=35 maxlength=100></p>
                        </td>
                    </tr>
                    <tr>
                        <td valign=top colspan=2 align=center>
                            <!-- <p><strong>My Notes:</strong><br>
                            <textarea name="my_notes" cols=35 rows=5 wrap=virtual></textarea></p> -->
                            <p><input class="btn btn-dark" type="SUBMIT" name="submit" value="Submit"></p>
                        </td>
                    </tr>
                <!-- </table> -->
                <!-- <form method="POST">
                    <button class="btn btn-dark" name="logout">Logout</button>
                </form> -->
            </form>
        </div>
	</body>
</html>

