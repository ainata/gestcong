<?php
	include_once("db.php");
	
	
	
	$name=$_POST['name'];
	$age=$_POST['age'];
	echo $name;
	/*if(mysql_query("INSERT INTO user VALUES ('$name','$age')"))
	echo "tafiditra okay";
	else
	echo " tsy tafiditra tsy okay";
	
	/*$req = "INSERT INTO user VALUES ('',5)";
			
	if ($resultat=mysql_query($req))
	{
		echo "tafiditra okay";
	}
	else echo "tsy ao zan an : ".mysql_error();*/
	
?>