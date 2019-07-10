<?php
	
	$login="root";
	$password="";
	$server="localhost";
	
	$connexion=mysql_connect ($server,$login,$password);
	$db=mysql_select_db("test");
		
?>