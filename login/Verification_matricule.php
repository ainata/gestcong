<?php
	require "db.php";
	$matricule = $_POST["txt_matricule"];
	$sql="select MATRICULE from employer where MATRICULE='$matricule' and NOM=''";
	$req=mysql_query($sql) or die (mysql_error());
	if(mysql_num_rows($req)>0)
	{
		echo "1";
	}
	else
	{
		echo "0";
	}
	
?>