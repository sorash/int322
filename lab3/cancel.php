<?php

	// get fields passed
	$phone = $_GET['phone'];
	$pw = $_GET['pw'];

	// database server info
	$dbserver = "db-mysql.zenit";
	$uid = "int322_162b01";
			
	// connect to mysql server
	$link = mysqli_connect($dbserver, $uid, $pw, $uid)
     	    	or die('Could not connect: ' . mysqli_error($link));
				
	// uncheck days attending for data field with given information
	$sql_query = "update lab3 " .
				 "set days_mon=false, days_tue=false " .
				 "where phone='". $phone . "';";
	$result = mysqli_query($link, $sql_query) or die('Query failed: '. mysqli_error($link));
	
	// refresh the table
	header("Location: fsoss-register.php?cancelled=true");
?>