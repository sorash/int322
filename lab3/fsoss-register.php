<?php
	// errors
	$titleError = "&nbsp&nbspYou must choose a title.";
	$fnameError = "&nbsp&nbspFirst name can not be left blank.";
	$lnameError = "&nbsp&nbspLast name can not be left blank.";
	$orgError = "&nbsp&nbspOrganization name can not be left blank.";
	$emailError = "&nbsp&nbspEmail address can not be left blank.";
	$phoneError = "&nbsp&nbspPhone number can not be left blank.";
	$daysError = "&nbsp&nbspYou must choose at least one attending day.";
	$shirtError = "&nbsp&nbspYou must choose a t-shirt size.";
	
	// checkers
	$titleChecked = true;
	$fnameChecked = true;
	$lnameChecked = true;
	$orgChecked = true;
	$emailChecked = true;
	$phoneChecked = true;
	$daysChecked = true;
	$shirtChecked = true;
	$allChecked = false;
	
	if($_POST || $_GET)
	{
		if($_POST)
		{
			// check if a title is selected
			if(!isset($_POST['title']))
				$titleChecked = false;
		
			// check if first name is entered
			if(empty($_POST['firstName']))
				$fnameChecked = false;
		
			// check if last name is entered
			if(empty($_POST['lastName']))
				$lnameChecked = false;
		
			// check if organization is entered
			if(empty($_POST['organization']))
				$orgChecked = false;
		
			// check if email is entered
			if(empty($_POST['email']))
				$emailChecked = false;
			
			// check if phone number is entered
			if(empty($_POST['phone']))
				$phoneChecked = false;
			
			// check if at least one day is selected
			if(!isset($_POST['days']))
				$daysChecked = false;
			
			// check if a t-shirt size is selected
			if($_POST['t-shirt'] == 'default')
				$shirtChecked = false;
		}
		
		// show information if all fields are checked
		if(($titleChecked && $fnameChecked && $lnameChecked 
				&& $orgChecked && $emailChecked && $phoneChecked && $daysChecked && $shirtChecked) 
				|| $_GET["cancelled"] == true)
		{
			// set all checked
			$allChecked = true;
			
			if ($_POST)
			{
				// get info from fields
				$title = ucfirst($_POST['title']);
				$fname = $_POST['firstName'];
				$lname = $_POST['lastName'];
				$org = $_POST['organization'];
				$email = $_POST['email'];
				$phone = $_POST['phone'];
				$days_mon = "false";
				$days_tue = "false";
				if(in_array('monday', $_POST['days']))
					$days_mon = "true";
				if(in_array('tuesday', $_POST['days']))
					$days_tue = "true";
				$shirt_size = ucfirst($_POST['t-shirt']);
			}
			
			// database server info
			$dbserver = "db-mysql.zenit";
			$uid = "int322_162b01";
			$pw = "";	// set password later because i cant even anymore
			
			// connect to mysql server
			$link = mysqli_connect($dbserver, $uid, $pw, $uid)
         	    	or die('Could not connect: ' . mysqli_error($link));
					
			if($_POST)
			{
				// format for inserting data
				// insert into lab3 (title, fname, lname, org, email, phone, days_mon, days_tue, shirt_size) 
				// 			  values('Mr', 'Soroush', 'Ashrafi', 'sorash', 'sashrafi3@myseneca.ca', 1234567890, true, false, 'Medium') 
			
				// insert into table
				$sql_query = "insert into lab3 (title, fname, lname, org, email, phone, days_mon, days_tue, shirt_size) " . 
							 "values('" . $title . "', '" . $fname . "', '" . $lname . "', '" . $org . "', '" . $email . "', " . $phone . ", " . $days_mon . ", " . $days_tue . ", '" . $shirt_size . "')";
				$result = mysqli_query($link, $sql_query) or die('Query failed: '. mysqli_error($link));
			}
			
			// get all records from db
			$sql_query = "SELECT * from lab3";
			$result = mysqli_query($link, $sql_query) or die('Query failed: '. mysqli_error($link));
			if($result)
			{	
				// show records
				if (mysqli_num_rows($result) > 0) 
				{
					// table header
					echo "<table border='2px solid black'>" .
					     "<tr>" . 
						   "<td>Title</td>" . 
						   "<td>First name</td>" . 
						   "<td>Last name</td>" . 
						   "<td>Organization</td>" . 
						   "<td>Email</td>" . 
						   "<td>Phone number</td>" . 
						   "<td>Days attending: monday</td>" . 
						   "<td>Days attending: tuesday</td>" . 
						   "<td>T-Shirt size</td>" . 
						 "</tr>";
							  
					// show each row
					while($row = mysqli_fetch_assoc($result)) 
					{
						$phone = $row["phone"];
						$cancelURL = "cancel.php?phone=$phone&pw=$pw";
						
						echo "<tr>" . 
					     	   "<td>" . $row["title"] . "</td>" . 
							   "<td>" . $row["fname"] . "</td>" . 
							   "<td>" . $row["lname"] . "</td>" . 
							   "<td>" . $row["org"] . "</td>" . 
							   "<td>" . $row["email"] . "</td>" . 
						       "<td>" . $row["phone"] . "</td>" . 
							   "<td>" . ($row["days_mon"] == true ? "yes" : "no") . "</td>" . 
							   "<td>" . ($row["days_tue"] == true ? "yes" : "no") . "</td>" . 
							   "<td>" . $row["shirt_size"] . "</td>" .
							   "<td><a href='$cancelURL'>Cancel</a></td>" .
							 "</tr>";
					}
						
					echo "</table>";
				} 
				else 
					echo "No data in the database.";
			}
		}
	}
?>

<!-- hide form when all fields validated -->
<?php if(!$allChecked)
{ ?>

<!DOCTYPE html>
<html lang="en">
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
	          <td>
			    <input type="radio" name="title" value="mr" <?php if($_POST){if(isset($_POST['title'])){if($_POST['title'] == "mr") echo "checked";}} ?>>Mr
		      </td>
	        </tr>
		
	        <tr>
	          <td>
			    <input type="radio" name="title" value="mrs" <?php if($_POST){if(isset($_POST['title'])){if($_POST['title'] == "mrs") echo "checked";}} ?>>Mrs
			  </td>
	        </tr>
	    
		    <tr>
	          <td>
			    <input type="radio" name="title" value="ms" <?php if($_POST){if(isset($_POST['title'])){if($_POST['title'] == "ms") echo "checked";}} ?>>Ms
		      </td>
	        </tr>
	      </table>
	    </td>
		
		<td>
		  <p><?php if(!$titleChecked) echo $titleError ?></p>
		</td>
	  </tr>
	
	  <tr>
        <td>First name:</td>
	    <td>
		  <input name="firstName" type="text" value="<?php if($_POST){if($_POST['firstName']) echo $_POST['firstName'];} ?>">
		</td>
		<td>
		  <p><?php if(!$fnameChecked) echo $fnameError ?></p>
		</td>
	  </tr>
	
	  <tr>
        <td>Last name:</td>
	    <td>
		  <input name="lastName" type="text" value="<?php if($_POST){if($_POST['lastName']) echo $_POST['lastName'];} ?>">
		</td>
		<td>
		  <p><?php if(!$lnameChecked) echo $lnameError ?></p>
		</td>
	  </tr>
	
	  <tr>
        <td>Organization:</td>
	    <td>
		  <input name="organization" type="text" value="<?php if($_POST){if($_POST['organization']) echo $_POST['organization'];} ?>">
		</td>
		<td>
		  <p><?php if(!$orgChecked) echo $orgError ?></p>
		</td>
	  </tr>
	
	  <tr>
        <td>Email address:</td>
	    <td>
		  <input name="email" type="text" value="<?php if($_POST){if($_POST['email']) echo $_POST['email'];} ?>">
		</td>
		<td>
		  <p><?php if(!$emailChecked) echo $emailError ?></p>
		</td>
	  </tr>
	
	  <tr>
        <td>Phone number:</td>
	    <td>
		  <input name="phone" type="text" value="<?php if($_POST){if($_POST['phone']) echo $_POST['phone'];} ?>">
		</td>
		<td>
		  <p><?php if(!$phoneChecked) echo $phoneError ?></p>
		</td>
	  </tr>
	
	  <tr>
        <td>Days attending:</td>
        <td>
	      <input name="days[]" id="monday" type="checkbox" value="monday" <?php if($_POST){if(isset($_POST['days'])){if(in_array("monday", $_POST['days'])) echo "checked";}} ?>>Monday
	      <input name="days[]" id="tuesday" type="checkbox" value="tuesday" <?php if($_POST){if(isset($_POST['days'])){if(in_array("tuesday", $_POST['days'])) echo "checked";}} ?>>Tuesday
		</td>
		<td>
		  <p><?php if(!$daysChecked) echo $daysError ?></p>
		</td>
      </tr>
	
	  <tr>
	    <td>T-shirt size:</td>
	    <td>
	      <select name="t-shirt">
	        <option name="default" value="default">--Please choose--</option>
	        <option name="small" value="small" <?php if($_POST){if(isset($_POST['t-shirt'])){if($_POST['t-shirt'] == 'small') echo "selected";}} ?>>Small</option>
	        <option name="medium" value="medium" <?php if($_POST){if(isset($_POST['t-shirt'])){if($_POST['t-shirt'] == 'medium') echo "selected";}} ?>>Medium</option>
	        <option name="large" value="large" <?php if($_POST){if(isset($_POST['t-shirt'])){if($_POST['t-shirt'] == 'large') echo "selected";}} ?>>Large</option>
	        <option name="x-large" value="x-large" <?php if($_POST){if(isset($_POST['t-shirt'])){if($_POST['t-shirt'] == 'x-large') echo "selected";}} ?>>X-Large</option>
	      </select>
	    </td>
		<td>
		  <p><?php if(!$shirtChecked) echo $shirtError ?></p>
		</td>
	  </tr>
	  
	  <tr>
	    <td>
		  <input type="hidden" name="pass" id="pass">
		  <br />
		</td>
	  </tr>
	
	  <tr>
	    <td>
		</td>
	    <td>
		  <input name="submit" type="submit">
		</td>
	  </tr>
	</table>
  </form>
  </body>
</html>
<?php
} ?>
