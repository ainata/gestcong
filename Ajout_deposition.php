<?php

	$id = $_POST["txt_id_deposition"];
	$motif = $_POST["slct_motif"];
	$emp = $_POST["slct_employer"];
	$date_dem = $_POST["txt_date_de_demande"];
	$date_depart = $_POST["txt_date_de_depart"];
	$date_retour = $_POST["txt_date_de_retour"];
	
	echo "<br> <br> INSERT INTO deposition VALUES (".$id.",".$motif."," .$emp.",'".$date_dem."','".$date_depart."','".$date_retour."',".$renouvelment.")" ;
	$req = "INSERT INTO deposition VALUES (".$id.",".$motif."," .$emp.",'".$date_dem."','".$date_depart."','".$date_retour."',".$renouvelment.")";
	
	if ($resultat=mysql_query($req)) echo "insertion reussie";
	else echo mysql_error();
	//$emp=intval($emp); 
	$requete1="SELECT * from employer where ID_EMPLOYER =".$emp;
	$requete1=mysql_query($requete1);
	$resultat1=mysql_fetch_array($requete1);
	
	$dep=$resultat1['ID_DEPARTEMENT'];
	//echo $dep;
	
	
	
	$requete2="SELECT * from departement where ID_DEPARTEMENT =". $dep ;
	$requete2=mysql_query($requete2);
	$resultat=mysql_fetch_array($requete2);
	$chef=$resultat['ID_EMPLOYER'];
	//echo $chef;
	
	$requete3="SELECT * from employer where ID_EMPLOYER = ".$chef;
	$requete3=mysql_query($requete3);
	$resultat=mysql_fetch_array($requete3);
	$addres_mail=$resultat['ADRESSEMAIL'];
	echo $addres_mail;
	
	 $to      = $addres_mail;
     $subject = 'le sujet';
     $message = 'Bonjour !';
	 /*
     $headers = 'From: webmaster@example.com' . "\r\n" .
     'Reply-To: webmaster@example.com' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();

     mail($to, $subject, $message, $headers);
	 */
	// $from = $txt_email;
	 mail($to, $subject, $message,"From: $to\n");
	 
	 if(mail){echo "any zany";}
	 else {echo "aaa";}
	
	//echo "<br>envoi reussie";
?>
<!--<SCRIPT language="javascript">
	document.location = "index.php?id=3";
</SCRIPT>
