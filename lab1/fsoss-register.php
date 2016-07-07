<?php
  $fnameError = "&nbsp&nbspFirst name can not be left blank.";
  $lnameError = "&nbsp&nbspLast name can not be left blank.";
  $orgError = "&nbsp&nbspOrganization name can not be left blank.";
  $emailError = "&nbsp&nbspEmail address can not be left blank.";
  $phoneError = "&nbsp&nbspPhone number can not be left blank.";

  if($_POST)
  {
    $_SERVER = "[PHP_SELF]";
    if($_POST['title'])echo "Title: " . $_POST ['title'] . "</br></br>";
    if($_POST['firstName'])echo "First Name: " . $_POST ['firstName'] . "</br></br>";
    if($_POST['lastName'])echo "Last name: " . $_POST ['lastName'] . "</br></br>";
    if($_POST['organization'])echo "Organization: " . $_POST ['organization'] . "</br></br>";
    if($_POST['email'])echo "Email Address: " . $_POST ['email'] . "</br></br>";
    if($_POST['phone'])echo "Phone Number: " . $_POST ['phone'] . "</br></br>";
    if(!empty($_POST['days']))
    {
      echo "Days attending: </br>";
      foreach($_POST['days'] as $checkedDay)
        echo $checkedDay . "</br>";
      echo "</br>";
    }
    if($_POST['t-shirt'])echo "T-shirt size: " . $_POST ['t-shirt']; 
  }
?>

<html>
  <head>
    <title>FSOSS Registration</title>
  </head>
  <body>
  <h1>FSOSS Registration</h1>
  <form method="post" action="fsoss-register.php">
	<table>
	<tr>
    	<td valign="top">Title:</td>
	<td>
		<table>
		<tr>
		<td><input type="radio" name="title" value="mr">Mr</td>
		</tr>
		<tr>
		<td><input type="radio" name="title" value="mrs">Mrs</td>
		</tr>
		<tr>
		<td><input type="radio" name="title" value="ms">Ms</td>
		</tr>
		</table>
	</td>
	</tr>
	<tr>
    	<td>First name:</td>
	<td><input name="firstName" type="text" value="<?php if($_POST) echo $_POST['firstName']; ?>"><?php if(empty($_POST['firstName'])) echo $fnameError; ?></td>
	</tr>
	<tr>
    	<td>Last name:</td>
	<td><input name="lastName" type="text" value="<?php if($_POST) echo $_POST['lastName']; ?>"><?php if(empty($_POST['lastName'])) echo $lnameError; ?></td>
	</tr>
	<tr>
    	<td>Organization:</td>
	<td><input name="organization" type="text" value="<?php if($_POST) echo $_POST['organization']; ?>"><?php if(empty($_POST['organization'])) echo $orgError; ?></td>
	</tr>
	<tr>
    	<td>Email address:</td>
	<td><input name="email" type="text" value="<?php if($_POST) echo $_POST['email']; ?>"><?php if(empty($_POST['email'])) echo $emailError; ?></td>
	</tr>
	<tr>
    	<td>Phone number:</td>
	<td><input name="phone" type="text" value="<?php if($_POST) echo $_POST['phone']; ?>"><?php if(empty($_POST['phone'])) echo $phoneError; ?></td>
	</tr>
	<tr>
    	<td>Days attending:</td>
	<td>
		<input name="days[]" id="monday" type="checkbox" value="monday">Monday
		<input name="days[]" id="tuesday" type="checkbox" value="tuesday">Tuesday<td/>
	</tr>
	<tr>
	<td>T-shirt size:</td>
	<td>
	<select name="t-shirt">
	<option>--Please choose--</option>
	<option name="small" value="s">Small</option>
	<option value="m">Medium</option>
	<option value="l">Large</option>
	<option value="xl">X-Large</option>
	</select>
	</td>
	</tr>
	<tr><td><br></td></tr>
	<tr>
	<td></td>
	<td><input name="submit" type="submit"></td>
	</tr>
  </form>
  </body>
</html>

