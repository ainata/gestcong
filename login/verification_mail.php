<?php
	include("../connexion/connexion.php");
	$mail=$_POST['txt_mail'];
	$sql="select ADRESSEMAIL from employer where ADRESSEMAIL='$mail'";
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