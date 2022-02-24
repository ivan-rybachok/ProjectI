<?php

	session_start();

	// if the user trys to get in by url it will catch and refresh the page since the username was not submitted

	if (!isset($_SESSION['username'])) { header("Location: http://localhost/DNMPP/code/PHP2022/PHP/ProjectI/"); }
	
	$db_name = "address_book";
	$table_name = "address_info";

	require 'dbConnect.php';

	$db = mysqli_select_db($connection, $db_name) or die(mysqli_error($connection));

	// getting info from the table only where month birthday = current month and shows on the page

	$sql = "SELECT * FROM $table_name WHERE MONTH(birthday) = MONTH(CURRENT_DATE())";

	// doing prepare statements

	$stmt = $connection->prepare($sql);

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
		<title>Birthday's On the Current Month</title>
	</head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<body>
		<!-- <div class="text-inline"> -->
			<div class="text-center">
				</br><h1 class="d-inline text-dark">Birthday Promo Page</h1>
			</div><br>
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

						<a href="email.php"><button class="btn btn-dark">Sent Email</button>

						<a href="logout.php"><button type="submit" name="logout" class="btn btn-dark">Logout</button></a>
						
					</div>
				</div>
			</div></br>
			<div class="text-center">
				<h3>Signed in as <?php echo $_SESSION['username'];?>:</h3>
			</div>
		<div class="container my-3"> 
			<!-- <table class="table table-striped"> -->
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
					</tr>
				</thead>
				<tbody>

				<!-- going through the array and displaying the correct info on the page  -->
				<?php 
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
					echo "</tr>";
				}
				?>
				</tbody>
			</table>
		<div>
	</body>
</html>

