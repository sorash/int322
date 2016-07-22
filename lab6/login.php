<?php

$loginError = "Invalid username or password.";
$loginChecked = false;
$hide = false;

// database info
$dbserver = "db-mysql.zenit";
$uid = "int322_162b01";
$pw = "";
$table = "users";

$salt = "1234";

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
	if(isset($_POST['submit']))
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
					if($row['username'] == $user && $row['password'] == crypt($password, $salt))
					{
						$loginChecked = true;
					
						echo "Logged in!";
						$hide = true;
						break;
					}
				}
			}
		}
	}
}

?>

<?php if(!$hide) { ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login</title>
  </head>

  <body>
    <form method="post" action="login.php">
	  <label style="display: inline-block; width: 100px; padding-bottom: 5px;">Username: </label><input type="text" name="user" id="user" />
	  <br />
	  <label style='display: inline-block; width: 100px; padding-bottom: 15px;'>Password: </label><input type='password' name='password' id='password' />
	  <br />
	  <?php if($_POST){ if(!$loginChecked) echo $loginError . "<br />";} ?>
	  <input style='margin-right: 5px;' type='submit' name='submit' />
	</form>
  </body>
</html>

<?php } ?>