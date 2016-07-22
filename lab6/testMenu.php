<?php 

$hide = false;

include_once("myClasses.php"); 
if(isset($_POST['submit']))
	$hide = true;

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Test menu page</title>
  </head>

  <body>
  	<?php if(!$hide) { ?>
    <h1>Using classes to show a menu</h1>
	<form action="testMenu.php" method="post">
	  <label>Enter texts to show in the menu</label>
	  <input type="text" name="fields" id="fields" />
	  
	  <input type="submit" name="submit" id="submit" />
	</form>
	<?php } ?>
	
	<ul>
	  <?php if($_POST){ if(isset($_POST['fields'])) $menu = new Menu($_POST['fields']); } ?>
	</ul>
  </body>
</html>