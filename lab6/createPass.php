<?php 
$hash = "";
$showHash = false;

if($_POST)
{
	if(isset($_POST['pass']) && isset($_POST['salt']))
	{
		$hash = crypt($_POST['pass'], $_POST['salt']);
		$showHash = true;
	}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Test menu page</title>
  </head>

  <body>
    <h1>Create hashed password</h1>
	<form action="createPass.php" method="post">
	  <label>Enter a password to encrypt</label>
	  <input type="text" name="pass" id="pass" />
	  <br />
	  <label>Enter the salt for encryption</label>
	  <input type="text" name="salt" id="salt" />
	  <br />
	  <input type="submit" name="submit" id="submit" />
	</form>
	
	<?php if($showHash) echo "Hashed password: " . $hash; ?>
	
  </body>
</html>