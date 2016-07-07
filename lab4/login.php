<?php

$loginError = "Invalid username or password.";
$recoveryUserError = "Please enter your username for password recovery.";
$recoveryUserFoundError = "Your username was not found in the database.";

$loginChecked = false;
$recoveryUserChecked = false;
$recoveryUserFound = false;

$recovery = false;

// database info
$dbserver = "db-mysql.zenit";
$uid = "int322_162b01";
$pw = "";
$table = "users";

function GetConnection()
{
	global $dbserver;
	global $uid;
	global $pw;
	global $table;
	
	// connect to database
	$link = mysqli_connect($dbserver, $uid, $pw, $uid)
					or die('Could not connect: ' . mysqli_error($link));
					
	return $link;
}

function GetRecords($link, $table)
{
	// get all records
	$sql_query = "SELECT * from " . $table;
	$result = mysqli_query($link, $sql_query) or die('Query failed: '. mysqli_error($link));
	
	return $result;
}

// form submit
if($_POST)
{
	// forgot password
	if(isset($_POST['forget']))
	{
		$recovery = true;
	}
	
	// recover password
	if(isset($_POST['recover']))
	{
		$recovery = true;
		$user = $_POST['user'];
		
		// check if they entered a username
		if($user != '')
		{
			$recoveryUserChecked = true;
			
			$result = GetRecords(GetConnection(), "users");
			if($result)
			{	
				if (mysqli_num_rows($result) > 0) 
				{
					// loop through records and find the user that matches
					while($row = mysqli_fetch_assoc($result)) 
					{
						if($row['username'] == $user)
						{
							$recoveryUserFound = true;
							
							// send email with username and password hint
							$message = "Username: " . $row['username'] . "\r\n" . "Passowrd hint: " . $row['passwordHint'];
							mail($user, 'Your password recovery', $message);
						}
					}
				}
				else 
					echo "No data in the database.";
			}
		}
	}
	
	else if(isset($_POST['submit']))
	{
		// get info from user input
	$user = $_POST['user'];
	$password = $_POST['password'];
	
	$result = GetRecords(GetConnection(), $table);
	if($result)
	{	
		if (mysqli_num_rows($result) > 0) 
		{
			// loop through records and find the user and password that match
			while($row = mysqli_fetch_assoc($result)) 
			{
				if($row['username'] == $user && $row['password'] == $password)
				{
					$loginChecked = true;
					
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
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login</title>
  </head>

  <body>
    <form method="post" action="login.php">
	  <label style="display: inline-block; width: 100px; padding-bottom: 5px;">Username: </label><input type="text" name="user" id="user" />
	  <?php
		if(!$recovery)
		{
			echo "<br />" .
				 "<label style='display: inline-block; width: 100px; padding-bottom: 15px;'>Password: </label><input type='password' name='password' id='password' />" .
				 "<br />";
			if($_POST){ if(!$loginChecked) echo $loginError . "<br />";}
			echo "<input style='margin-right: 5px;' type='submit' name='submit' />";
			echo "<input type='submit' value='Forgot password' name='forget' />";
		}
		else
		{
			echo "<input type='submit' value='Recover password' name='recover' />";
		
			if(isset($_POST['recover']))
			{
				if(!$recoveryUserChecked)
					echo "<br />" . $recoveryUserError . "<br />";
				if($recoveryUserChecked && !$recoveryUserFound)
					echo "<br />" . $recoveryUserFoundError . "<br />";
			}
		}
	  ?>
	</form>
  </body>
</html>