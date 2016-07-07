<?php

session_start();

// check if user is logged in, if not redirect to login page
if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'])
	echo "Session " . $_SESSION['loggedIn'] . " exists.";
else
	header('Location: login.php');

?>