<?php

// get database info
$dbInfo = file("/home/int322_162b01/secret/topsecret");
$dburl = trim($dbInfo[0]);
$uid = trim($dbInfo[1]);
$pw = trim($dbInfo[2]);
$dbname = trim($dbInfo[3]);
$tablename = trim($dbInfo[4]);
$link = false;

// connect to database
$link = mysqli_connect($dburl, $uid, $pw, $dbname) or die('Could not connect to ' . $dburl . ': ' . mysqli_error($link));

// generates a header for page
function generateHeader($title, $cssFile)
{
	echo "<head>" .
		   "<title>" . $title . "</title>" .
		   "<link href='css/normalize.css' rel='stylesheet' type='text/css' />" .
		   "<link href='css/" . $cssFile . ".css' rel='stylesheet' type='text/css' />" .
		 "</head>" . 
		 "" .
		 "<body>" .
		   "<nav>" .
		     "<img src='resources/sorash.png' alt='sorash.png'>" .
		     "<h1>sorash organization</h1>" .
			 "<hr />" .
		     "<ul>" . 
			   "<li><a href='add.php'>Add</a></li>" .
			   "<li><a href='view.php'>View</a></li>" .
			 "</ul>" .
			 "<hr />" .
		   "</nav>" .
		 "</body>";
}

// gets all records from database
function getRecords($field = '*', $where = '')
{
	// ????????????
	global $tablename;
	global $link;
	
	$sql_query = "SELECT " . $field . "	from " . $tablename . 
				 ($where != '' ? " where " . $where . ";" : ";");
	$result = mysqli_query($link, $sql_query) or die('Query failed: '. mysqli_error($link));
	
	return $result;
}

?>