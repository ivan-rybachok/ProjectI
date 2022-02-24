
<?php
    // Begin the session
    session_start();

    // var_dump($_SESSION);
    // Unset all of the session variables.
    session_unset();

    // Destroy the session.
    session_destroy();

    // Clear Session cookie
    unset($_COOKIE['PHPSESSID']);
    setcookie("PHPSESSID", "", time()-3600, "/");

    header("Location: index.php");


?>

