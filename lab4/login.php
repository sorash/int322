<?php

$error = "Invalid username or password.";
$checked = false;

$recoverPassUserChecked = false;
$noUserFound = false;

// database info
$dbserver = "db-mysql.zenit";
$uid = "int322_162b01";
$pw = "";
$table = "users";

// recover password
if($_GET && isset($_GET['recoverpass']))
{
	/*
	 * POST DOES NOT WORK HERE SINCE BUTTON IS NOT SUBMIT
	 * TODO: FIX PLS B0SS THX
	 */
	
	// check if they entered a username
	if(isset($_POST['username']))
	{
		$recoverPassUserChecked = true;
		
		// connect to database
		$link = mysqli_connect($dbserver, $uid, $pw, $uid)
					or die('Could not connect: ' . mysqli_error($link));
				
		// get all records
		$sql_query = "SELECT * from " . $table;
		$result = mysqli_query($link, $sql_query) or die('Query failed: '. mysqli_error($link));
		if($result)
		{	
			if (mysqli_num_rows($result) > 0) 
			{
				// loop through records and find the user that matches
				while($row = mysqli_fetch_assoc($result)) 
				{
					if($row['username'] == $user)
					{
						// send email with username and password hint
						$message = $row['username'] . "\r\n" . $row['passwordHint'];
						mail($user, 'Your password recovery', $message);
					}
					else
					{
						echo "no user found";
						$noUserFound = true;
					}
				}
			}
			else 
				echo "No data in the database.";
		}
	}
}

// form submit
if($_POST)
{
	// get info from user input
	$user = $_POST['user'];
	$password = $_POST['password'];
	
	// connect to database
	$link = mysqli_connect($dbserver, $uid, $pw, $uid)
     	    	or die('Could not connect: ' . mysqli_error($link));
	
	// get all records
	$sql_query = "SELECT * from " . $table;
	$result = mysqli_query($link, $sql_query) or die('Query failed: '. mysqli_error($link));
	if($result)
	{	
		if (mysqli_num_rows($result) > 0) 
		{
			// loop through records and find the user and password that match
			while($row = mysqli_fetch_assoc($result)) 
			{
				if($row['username'] == $user && $row['password'] == $password)
				{
					$checked = true;
					
					// create session
					session_start();
					$_SESSION['loggedIn'] = true;
					$_SESSION['username'] = $user;
					
					header('Location: protectedstuff.php?user=' . $user);	// redirect to protectedstuff page
					break;
				}
			}
		}
		else 
			echo "No data in the database.";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login</title>
  </head>

  <body>
    <form method="post" action="login.php">
	  <label style="display: inline-block; width: 100px; padding-bottom: 5px;">Username: </label><input type="text" name="user" id="user" value="<?php if($noUserFound) echo $user; ?>" />
	  <?php 
		if(!$_GET)
		{
			echo "<br />" .
				 "<label style='display: inline-block; width: 100px; padding-bottom: 15px;'>Password: </label><input type='password' name='password' id='password' />" .
				 "<br />";
			if($_POST){ if(!$checked) echo $error . "<br />";}
			echo "<input style='margin-right: 5px;' type='submit' />";
			echo "<input type='button' value='Forgot password' onclick=\"window.location='login.php?forgetpass';\" />";
		}
		else
			echo "<input type='button' value='Recover password' onclick=\"window.location='login.php?recoverpass';\" />";
	  ?>
	</form>
  </body>
</html>