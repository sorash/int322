<?php

class Menu
{
	function __construct($strings)
	{
		$fields = explode(", ", $strings);
		
		foreach($fields as $field)
			echo "<li>" . $field . "</li>";
	}
}

class Connection
{
	public $link;
	function __construct()
	{
		// database info
		$dbserver = "db-mysql.zenit";
		$uid = "int322_162b01";
		$pw = "";
		
		// connect to database
		$this->link = mysqli_connect($dbserver, $uid, $pw, $uid)
			or die('Could not connect: ' . mysqli_error());
			
		//return $link;
	}
	
	function Query($query)
	{
		$result = mysqli_query($this->link, $query) or die('Query failed: '. mysqli_error());
		return $result;
	}
}

?>