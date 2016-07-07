<?php

session_start();

// check if user is logged in, if not redirect to login page
if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'])
	echo "You are logged in!";
else
	header('Location: login.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Page protected by login credentials</title>
  </head>
  
  <body>
    <form method="post" action="protectedstuff.php">
	  <br />
      <a href="logout.php">Logout</a>
	</form>
  </body>
</html>