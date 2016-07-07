<?php

// check for validation of fields
$_valid = false;
$_postValid = false;
$_subjValid = false;
$_phoneValid = false;

if($_POST)
{
	// set values from input fields
	$_postalCode = $_POST["postalcode"];
	$_subjCode = $_POST["subjectcode"];
	$_phoneNum = $_POST["phone"];
	
	if(isset($_POST["postalcode"]))
	{
		if(preg_match("/^[ ]*[a-zA-Z][0-9][a-zA-Z][ ]*[0-9][a-zA-Z][0-9][ ]*$/", $_postalCode, $_one))
		{
			// set postal code validation succeeded
			$_postValid = true;
		}	
	}
				
	if(isset($_POST["subjectcode"]))
	{
		if(preg_match("/^[ ]*[A-Z]{3}[0-9]{3}[A-Z]{1,3}[ ]*$/", $_subjCode, $_two))
		{
			// set subject code succeeded
			$_subjValid = true;
		}
	}
	
	if(isset($_POST["phone"]))
	{   
		if(preg_match("/^([ ]*[0-9]{3}[-]{0,1}[0-9]{3}[-]{0,1}[0-9]{4}[ ]*|[ ]*[0-9]{3}[ ]*[0-9]{3}[ ]*[0-9]{4}[ ]*$|[ ]*[0-9]{3}[ ]*[0-9]{3}[-]{0,1}[0-9]{4}[ ]*|[ ]*[(]{1}[0-9]{3}[)]{1}[ ]?[0-9]{3}[-]{1}[0-9]{4}[ ]*|[ ]*[(]{1}[0-9]{3}[)]{1}[ ]*[0-9]{3}[ ]*[0-9]{4}[ ]*)$/", $_phoneNum, $_three))
		{
			// set phone validation succeeded
			$_phoneValid = true;
		}
	}
				
	if($_postValid && $_subjValid && $_phoneValid)
	{
		// output fields are valid
		echo $_postalCode . " is valid.<br \>"; 
		echo $_subjCode . " is valid.<br \>"; 
		echo $_phoneNum . " is valid.<br \>"; 
							
		// set all validations succeeded
		$_valid = true;
	}	
}
?>

<!-- hide fields when input is validated -->
<?php if($_valid != true)
{ ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Lab 2</title>
	</head>
	<body>
		<form action="lab2.php" method="post">
		<h1>Lab 2 INT322</h1>
		<br />
			Postal Code: <input type="text" name="postalcode" value="<?php if($_POST){echo $_POST['postalcode'];}?>"> <?php if($_POST){if($_postValid == false){echo "Invalid format";}}?>
			<br />
			Seneca Subject Code:<input type="text" name="subjectcode" value="<?php if($_POST){echo $_POST['subjectcode'];}?>"> <?php if($_POST){if($_subjValid == false){echo "Invalid format";}}?>
			<br />
			Phone Number:<input type="text" name="phone" value="<?php if($_POST){echo $_POST['phone'];}?>"> <?php if($_POST){if($_phoneValid == false){echo "Invalid format";}}?>
			<br />
			<br />
			<input type="submit" value="submit">
		</form>
	</body>
</html>

<?php 
} ?>
