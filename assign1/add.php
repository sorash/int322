<?php 

// include library file for use of functions
include "library.php";

// errors
$itemNameErr = "";
$descErr = "";
$suppCodeErr = "";
$costErr = "";
$sellPriceErr = "";
$onHandErr = "";
$reorderPtErr = "";

// checkers
$itemNameChecked = false;
$descChecked = false;
$suppCodeChecked = false;
$costChecked = false;
$sellPriceChecked = false;
$onHandChecked = false;
$reorderPtChecked = false;
$allChecked = false;

// fields
$itemName = "";
$desc = "";
$suppCode = "";
$cost = "";
$sellPrice = "";
$onHand = "";
$reorderPt = "";
$backOrder = "";

// when submit button is pressed
if($_POST)
{
	// get fields
	$itemName = trim($_POST['itemName']);
	$desc = trim(htmlspecialchars($_POST['desc']));
	$suppCode = trim($_POST['suppCode']);
	$cost = trim($_POST['cost']);
	$sellPrice = trim($_POST['sellPrice']);
	$onHand = trim($_POST['onHand']);
	$reorderPt = trim($_POST['reorderPt']);
	isset($_POST['backOrder']) ? $backOrder = "y" : $backOrder = "n";
	
	// validate item name
	if($itemName != '')
	{
		if(preg_match("/^[a-zA-Z0-9;:,' -]*$/", $itemName))
			$itemNameChecked = true;
		else
			$itemNameErr = "<span class='error'>Item name can only contain:</span> characters, " . 
						   "numbers, colons, semi-colons, commas, apostrophes, spaces, and dashes.";
	}
	else
		$itemNameErr = "Item name can <span class='error'>not</span> be left blank.";
	
	// validate description
	if($desc != '')
	{
		if(preg_match("/^[a-zA-Z0-9.,'\r\n -]*$/", $desc))
			$descChecked = true;
		else
			$descErr = "<span class='error'>Description can only contain:</span> characters, " . 
						   "numbers, periods, commas, apostrophes, spaces, and dashes.";
	}
	else
		$descErr = "Description can <span class='error'>not</span> be left blank.";
	
	// validate supplier code
	if($suppCode != '')
	{
		if(preg_match("/^[a-zA-Z0-9 -]*$/", $suppCode))
			$suppCodeChecked = true;
		else
			$suppCodeErr = "<span class='error'>Supplier code can only contain:</span> characters, " . 
						   "numbers, spaces, and dashes.";
	}
	else
		$suppCodeErr = "Supplier code can <span class='error'>not</span> be left blank.";
	
	// validate cost
	if($cost != '')
	{
		if(preg_match("/^\d+\.\d{2}$/", $cost))
			$costChecked = true;
		else
			$costErr = "<span class='error'>Cost can only be:</span> monetary amounts, " . 
						   "one or more digits, followed by two decimal points.";
	}
	else
		$costErr = "Cost can <span class='error'>not</span> be left blank.";
	
	// validate sell price
	if($sellPrice != '')
	{
		if(preg_match("/^\d+\.\d{2}$/", $sellPrice))
			$sellPriceChecked = true;
		else
			$sellPriceErr = "<span class='error'>Sell price can only be:</span> monetary amounts, " . 
						   "one or more digits, followed by two decimal points.";
	}
	else
		$sellPriceErr = "Sell price can <span class='error'>not</span> be left blank.";
	
	// validate on hand amount
	if($onHand != '')
	{
		if(preg_match("/^\d+$/", $onHand))
			$onHandChecked = true;
		else
			$onHandErr = "<span class='error'>On hand amount can only be:</span> digits.";
	}
	else
		$onHandErr = "On hand amount can <span class='error'>not</span> be left blank.";
	
	// validate reorder point
	if($reorderPt != '')
	{
		if(preg_match("/^\d+$/", $reorderPt))
			$reorderPtChecked = true;
		else
			$reorderPtErr = "<span class='error'>Reorder point can only be:</span> digits.";
	}
	else
		$reorderPtErr = "Reorder point can <span class='error'>not</span> be left blank.";
	
	// check if all have been validated
	if($itemNameChecked && $descChecked && $suppCodeChecked && $costChecked && $sellPriceChecked && $onHandChecked && $reorderPtChecked)
	{
		$allChecked = true;
		
		// insert fields into table
		$sql_query = "insert into " . $tablename . " (itemName, description, supplierCode, cost, price, onHand, reorderPoint, backOrder, deleted) " . 
					 "values('" . $itemName . "', '" . $desc . "', '" . $suppCode . "', " . $cost . ", " . $sellPrice . ", " . $onHand . ", " . $reorderPt . ", '" . $backOrder . "', 'n')";
		$result = mysqli_query($link, $sql_query) or die('Query failed: '. mysqli_error($link));
		
		// load view page if insertion succeeded
		if($result)
			header('Location: view.php');
	}	
}

?>

<!DOCTYPE html>
<html lang="en">
  
  <?php 
  // generate a header for the page
  generateHeader("Add Item", "addstyle"); 
  ?>
	
  <p class="req">All fields mandatory except "On Back Order"</p>
  
  <form method="post" action="add.php">
    <table>
	  <tr>
	    <td class="leftTD">Item name:</td>
		<td><input type="text" name="itemName" id="itemName" value="<?php if($itemName != '') echo $itemName; ?>" /></td>
		<td class="error"><?php if(!$itemNameChecked) echo $itemNameErr; ?></td>
	  </tr>
	  
	  <tr>
	    <td class="leftTD">Description:</td>
		<td><textarea name="desc" id="desc" ><?php if($desc != '') echo $desc; ?></textarea></td>
		<td class="error"><?php if(!$descChecked) echo $descErr; ?></td>
	  </tr>
	  
	  <tr>
	    <td class="leftTD">Supplier Code:</td>
		<td><input type="text" name="suppCode" id="suppCode" value="<?php if($suppCode != '') echo $suppCode; ?>" /></td>
		<td class="error"><?php if(!$suppCodeChecked) echo $suppCodeErr; ?></td>
	  </tr>
	  
	  <tr>
	    <td class="leftTD">Cost:</td>
		<td><input type="text" name="cost" id="cost" value="<?php if($cost != '') echo $cost; ?>" /></td>
		<td class="error"><?php if(!$costChecked) echo $costErr; ?></td>
	  </tr>
	  
	  <tr>
	    <td class="leftTD">Selling price:</td>
		<td><input type="text" name="sellPrice" id="sellPrice" value="<?php if($sellPrice != '') echo $sellPrice; ?>" /></td>
		<td class="error"><?php if(!$sellPriceChecked) echo $sellPriceErr; ?></td>
	  </tr>
	  
	  <tr>
	    <td class="leftTD">Number on hand:</td>
		<td><input type="text" name="onHand" id="onHand" value="<?php if($onHand != '') echo $onHand; ?>" /></td>
		<td class="error"><?php if(!$onHandChecked) echo $onHandErr; ?></td>
	  </tr>
	  
	  <tr>
	    <td class="leftTD">Reorder Point:</td>
		<td><input type="text" name="reorderPt" id="reorderPt" value="<?php if($reorderPt != '') echo $reorderPt; ?>" /></td>
		<td class="error"><?php if(!$reorderPtChecked) echo $reorderPtErr; ?></td>
	  </tr>
	  
	  <tr>
	    <td class="leftTD">On Back Order:</td>
		<td><input type="checkbox" name="backOrder" id="backOrder" <?php if($_POST){ if(isset($_POST['backOrder'])) echo "checked";} ?> /></td>
	  </tr>
	  
	  <tr>
	    <td class="leftTD"><input type="submit" /></td>
		<td></td>
	  </tr>
	</table>
  </form>
</html>