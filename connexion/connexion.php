<?php
$login="root";
$password="";
$server="localhost";
$db="gestion_conger";
$connexion=mysql_pconnect($server,$login,$password)  or die ('erreur serveur '.mysql_error());
if (!$connexion)
		{
			print("<B> Impossible d'etablir la connexion </B> ");
			exit;
		}
		else
		// selection de la base
		if (!mysql_select_db($db,$connexion))
		{
			print("<B> Impossible de se connecter à la base </B> ");
			exit;
		}
		
?>