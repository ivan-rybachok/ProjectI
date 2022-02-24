<?php

	session_start();

	// if the user trys to get in by url it will catch and refresh the page since the username was not submitted

	if (!isset($_SESSION['username'])) { header("Location: http://localhost/DNMPP/code/PHP2022/PHP/ProjectI/"); }
	
	// creating variables for database use
	require 'dbConnect.php';

	// $sql = "CREATE DATABASE IF NOT EXISTS address_book";
	// 	if($connection->query($sql) === TRUE) {

	// 	}else {
	// 		echo 'ERROR';
	// 	}
	
	// require 'config.php';	

	// $sqlfile = "address_book.sql";
	// $op_data = '';
	// $lines = file($sqlfile);
	// foreach ($lines as $line)
	// {
	// 	if (substr($line, 0, 2) == '--' || $line == '')//This IF Remove Comment Inside SQL FILE
	// 	{
	// 		continue;
	// 	}
	// 	$op_data .= $line;
	// 	if (substr(trim($line), -1, 1) == ';')//Breack Line Upto ';' NEW QUERY
	// 	{
	// 		$connection->query($op_data);
	// 		$op_data = '';
	// 	}
	// }

	$db_name = "address_book";
	$table_name = "address_info";

	// // bringing in the connection code

	$db = mysqli_select_db($connection, $db_name) or die(mysqli_error($connection));
	
	// // getting eveything from the database doing a prepare statement ordering by firstname alphabetically 

	$sqltable = "SELECT * FROM $table_name ORDER BY firstname";

	$stmt = $connection->prepare($sqltable);

	// var_dump($stmt);

	$stmt->execute();

	$info = $stmt->get_result();

	$data = $info->fetch_all(MYSQLI_ASSOC);

	$stmt->close();
	$connection->close();


?>

<!DOCTYPE html>
<html>
	<head>
		<title>Table Info</title>
	</head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<body>
		<!-- <div class="text-inline"> -->
			<div class="text-center">
				</br><h1 class="d-inline text-dark">Welcome To Contacts Information</h1>
			</div><br>
			<div class="container">
				<div class="row text-center">
					<div class="col">
				
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
				</div></br>
				<div class="text-center">
					<h3>Signed in as <?php echo $_SESSION['username'];?>:</h3>
				</div>
			</div>
		<div class="container my-3"> 
			<table class="table table-sm">
				<thead>
					<tr>
						<th scope="col">FirstName:</th>
						<th scope="col">LastName:</th>
						<th scope="col">PhoneNumber:</th>
						<th scope="col">Email:</th>
						<th scope="col">Address:</th>
						<th scope="col">City:</th>
						<th scope="col">Province:</th>
						<th scope="col">PostalCode:</th>
						<th scope="col">Birthday:</th>
						<th scope="col">Delete:</th>
						<th scope="col">Edit:</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					// running array of info from the database and getting it out on the page 
					// if(!U_UNDEFINED_VARIABLE) {

						foreach ($data as $result){
						echo "<tr>";
						echo "<td>" . $result['firstname'] . "</td>";
						echo "<td>" . $result['lastname'] . "</td>";
						echo "<td>" . $result['phonenumber'] . "</td>";
						echo "<td>" . $result['email'] . "</td>";
						echo "<td>" . $result['address'] . "</td>";
						echo "<td>" . $result['city'] . "</td>";
						echo "<td>" . $result['province'] . "</td>";
						echo "<td>" . $result['postalcode'] . "</td>";
						echo "<td>" . $result['birthday'] . "</td>";
						// adding id's to buttons to be able to use them and know which one to delete or edit
						echo '<td><form method="post" action="deleteInfo.php"><input type="hidden" name="id" value="' . $result['id'] .'"><button class="btn btn-danger" type="submit"><i class="bi bi-trash"></i></button></form></td>';
						echo '<td><form method="post" action="editInfo.php"><input type="hidden" name="id" value="' . $result['id'] .'"><button class="btn btn-warning" type="submit"><i class="bi bi-pencil-fill"></i></button></form></td>';
						echo "</tr>";
					}
				// }
				?>
				</tbody>
			</table>
		<div>
	</body>
</html>

