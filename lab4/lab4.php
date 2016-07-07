<?php

if($_POST)
{
	// get values
	$cookieName = $_POST['cookieName'];
	$cookieValue = $_POST['cookieValue'];
	
	// create a cookie
	setcookie($cookieName, $cookieValue);
}

// create a counter cookie if not already created
if(!isset($_COOKIE['visits']))
{
	// set first visit count
	setcookie('visits', 1);
	
	// display first visit message
	echo "Welcome - you have visted this page for the first time! <br />";
}
else
{
	// increment visit count
	setcookie('visits', ++$_COOKIE['visits']);
	
	// display visit message
	echo "Welcome back - you visited this page <b>" . $_COOKIE['visits'] . "</b> times! <br />";
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Lab 4</title>
  </head>
  
  <body>
    <h1>Cookie Information</h1>
	
    <form method="post" action="lab4.php">
      <label style="display: inline-block; width: 100px; padding-bottom: 5px;">Cookie Name: </label><input type="text" name="cookieName" id="cookieName" />
	  <br />
      <label style="display: inline-block; width: 100px; padding-bottom: 15px;"">Cookie Value: </label><input type="text" name="cookieValue" id="cookieValue" />
	  <br />
	  <input type="submit" />
    </form>
  </body>
</html>

<?php

// show all cookies created
echo "<h2>Cookies</h2>" .
	 "<ul>";
foreach($_COOKIE as $name=>$value)
	echo "<li><b>Name: </b>" . $name . 
		   "<ul>" .
		     "<li>" . "<b>Value: </b>" . $value . "</li>" . 
		   "</ul>" .
		 "</li>" . 
		 "</br />";
echo "</ul>";
	
?>