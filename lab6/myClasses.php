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

?>