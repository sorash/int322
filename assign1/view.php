<!DOCTYPE html>
<html lang="en">
  <?php 
  
  // include library file for use of functions
  include "library.php";
  
  // generate a header for the page
  generateHeader("View Items", "viewstyle");
  
  ?>
</html>

<?php
	
// get all records from db
if($result = getRecords())
{	
	// show records
	if (mysqli_num_rows($result) > 0) 
	{
		// table header
		echo "<table>" .
	 	       "<tr class='header'>" . 
		         "<th>ID</th>" . 
				 "<th>Item name</th>" . 
				 "<th>Desciption</th>" . 
				 "<th>Supplier</th>" . 
				 "<th>Cost</th>" . 
				 "<th>Price</th>" . 
				 "<th>Number On Hand</th>" . 
				 "<th>Reorder Level</th>" . 
				 "<th>On Back Order?</th>" . 
				 "<th>Delete/Restore</th>" . 
			   "</tr>";
							  
		// show each row
		while($row = mysqli_fetch_assoc($result)) 
		{
			$deleteURL = "delete.php?id=" . $row["id"];
						
			echo "<tr>" . 
		   	       "<td>" . $row["id"] . "</td>" . 
				   "<td>" . $row["itemName"] . "</td>" . 
				   "<td>" . $row["description"] . "</td>" . 
				   "<td>" . $row["supplierCode"] . "</td>" . 
				   "<td>" . $row["cost"] . "</td>" . 
				   "<td>" . $row["price"] . "</td>" . 
				   "<td>" . $row["onHand"] . "</td>" . 
				   "<td>" . $row["reorderPoint"] . "</td>" . 
				   "<td>" . $row["backOrder"] . "</td>" . 
				   "<td><a href='$deleteURL'>" . ($row["deleted"] == "n" ? "Delete" : "Restore") . "</a></td>" .
				 "</tr>";
		}
						
		echo "</table>";
	} 
	else 
		echo "No data in the database.";
}

?>