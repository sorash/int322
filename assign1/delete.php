<?php

// include library file for use of functions
include "library.php";

// get info passed from view page
$id = $_GET['id'];

// get the status of deletion of item with the given id in the database
if($result = getRecords("deleted", "id=" . $id))
{
	if (mysqli_num_rows($result) > 0) 
	{
		$deleted = mysqli_fetch_assoc($result)["deleted"];
		
		// flip deleted status for passed item id in database
		$sql_query = "update " . $tablename . " " . 
					 "set deleted=" . ($deleted == "n" ? "'y'" : "'n'") . " " .
					 "where id=" . $id;
		$result = mysqli_query($link, $sql_query) or die('Query failed: '. mysqli_error($link));
	
		// refresh the view page
		header('Location: view.php?' . ($deleted == "n" ? "deleted" : "restored"));
	}
	else
		echo "No item found with given ID.";
}

?>