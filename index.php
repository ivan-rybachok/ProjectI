<?php 

    session_start();

    // echo(password_hash("test", PASSWORD_DEFAULT));

    require 'config.php';
    // require 'dbConnect.php';

    $host=$config['DB_HOST'];
    $connection = mysqli_connect($host, $config['DB_USERNAME'], $config['DB_PASSWORD']) or die(mysqli_error($connection));

    // creating database on login page clickeds
    
	$sql = "CREATE DATABASE IF NOT EXISTS address_book";
		if($connection->query($sql) === TRUE) {

		}else {
			// echo 'ERROR';
		}
	
	// require 'config.php';

	$sqlfile = "address_book.sql";
    $db_name = "address_book";
    
    $connection = mysqli_connect($host, $config['DB_USERNAME'], $config['DB_PASSWORD'], $db_name) or die(mysqli_error($connection));

	$op_data = '';
	$lines = file($sqlfile);

    // going through the sql file and getting rid off ; and adding them in the right spot
	foreach ($lines as $line)
	{
		if (substr($line, 0, 2) == '--' || $line == '')//This IF Remove Comment Inside SQL FILE
		{
			continue;
		}
		$op_data .= $line;
		if (substr(trim($line), -1, 1) == ';')//Breack Line Upto ';' NEW QUERY
		{
			$connection->query($op_data);
			$op_data = '';
		}
	}


    // $config = parse_ini_file('./config.ini'); 

    // $connection = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname']) or die(mysqli_error($connection));
    
    // checjing if the connection is true else show the error
    if(!$connection) {
        echo "<h3 class='container my-3 text-center bg-dark text-white rounded-lg p-3'>Unable to establish connection to Database</h3>";

    }

    if(isset($_REQUEST['login'])){
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
    }

    // getting the username and password from the database and checking if the right info was put in
    function login($connection, $username, $password) {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $query = mysqli_query($connection, $sql);
        return $query;
    }

    if(isset($_REQUEST['login'])){
        $results = login($connection, $username, $password);

        foreach($results as $item) {
            $password_verification = password_verify($password, $item['password']);

            // if passowrd is correct it lets the user to sign in goes to the menu page

            if($password_verification) {
                $_SESSION['username'] = $item['username'];
                header("Location: http://localhost/DNMPP/code/PHP2022/PHP/ProjectI/my_menu.php");
            }

        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    
    <title>Address Book</title>
</head>
<body>

    <!-- showing login page when not logged in -->

    <?php if(empty($_SESSION['username'])) {
        ?>
    <div class="container my-5">
        
        <form method="POST" class="bg-dark text-white p-5 rounded-lg">
            <h2 class="my-3 text-center text-white">Login</h2>
            <input type="text" name="username" placeholder="Username" class="form-control">
            <input type="password" name="password" placeholder="Password" class="form-control mt-3">
            <button type="submit" name="login" class="btn btn-outline-light mt-3">Login</button>
        </form>
        
    </div>
    
    <!-- showing a page that lets the user see that they are still signed it and need to sign out to kill the session -->

    <?php }?>

    <?php if(!empty($_SESSION['username'])){?>
        <div class="container text-center">
            <!-- <form method="POST"> -->
                <h3 class="my-5">Hello, <?php echo $_SESSION['username'];?> you might have forgot to logout?</h3>
                <a href="my_menu.php"><button class="btn btn-dark">Main Menu?</button></a>
                <a href="logout.php"><button class="btn btn-primary">Logout</button></a>
            <!-- </form> -->
        </div>
    <?php }?>
</body>
</html>