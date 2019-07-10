<?php
	session_start();
	include("connexion/connexion.php");
	include("connexion/connexion.php");
	require_once "phpmailler/PHPMailer/PHPMailerAutoload.php"; 
	include("phpmailler/PHPMailer/class.phpmailer.php");
	include("phpmailler/PHPMailer/class.smtp.php");
	if(isset($_GET['code']))
	{
		$req_verifier_dep="select * from deposition where ID_DEPOSITION=".$_GET['code'];
		$req_verifier_dep=mysql_query($req_verifier_dep);
		$ligne=mysql_fetch_array($req_verifier_dep);
		$jour_depart=$ligne['JOURNE_DE_DEPART'];
		$jour_rentree=$ligne['JOURNE_DE_RETOUR'];
		$id_emp=$ligne['ID_EMPLOYER'];
		$date_demande=$ligne['DATE_DE_DEMANDE'];
		
		$req_employe="select * from employer where ID_EMPLOYER=".$id_emp;
		$req_employe=mysql_query($req_employe);
		$row_employe=mysql_fetch_array($req_employe);
		$nom=$row_employe['NOM'];
		$address_mail=$row_employe['ADRESSEMAIL'];
		
		$req="update valider set VALIDE_RESPONSABLE ='non',DATE_VALIDATION_RESPONSABLE=now(),VU_UTILISATEUR='non vu' where ID_DEPOSITION=".$_GET['code']." and ID_RESPONSABLE_SITE=".$_SESSION['departement'];
		if(mysql_query($req))
		{
					$mail = new PHPmailer();
					$mail->IsSMTP();
					$mail->SMTPAuth = true;
					//$mail->SMTPDebug=2;   
					
					$mail->Host='smtp.gmail.com';
					$mail->Username = 'stagiaireigexao2014@gmail.com';
					$mail->Password = 'igexao2014';
					$mail->SMTPSecure='ssl';
					$mail->Port = 465;
					$mail->From='stagiaireigexao2014@gmail.com';
					$mail->FromName='L\'Administrateur de gestion de congé IGE+XAO Madagascar';
					$mail->isHTML(true);
					$mail->addReplyTo('mbolasitrakaa@gmail.com','Reply address');
					//$mail->addAddress('stagiaireigexao2014@gmail.com','Reply address');
					$mail->addAddress($address_mail,'Reply address');
					
					$mail->Subject='Demande non accepte'; // l'entête = nom du sujet
					$mail->Body='La responsable du site a reffuse votre demande qui a ete deposer le '.$date_demande;
					$mail->AltBody="This is text only alternative body.";
					var_dump($mail->Send());
			
		}
		
		$requete1="update valider set VALIDE_DEPARTEMENT ='non',DATE_VALIDATION_DEP=now(),VU_UTILISATEUR='non vu' where ID_DEPOSITION=".$_GET['code']." and ID_DEPARTEMENT=".$_SESSION['departement'];
		if(mysql_query($requete1))
		{
					$mail = new PHPmailer();
					$mail->IsSMTP();
					$mail->SMTPAuth = true;
					//$mail->SMTPDebug=2;   
					
					$mail->Host='smtp.gmail.com';
					$mail->Username = 'stagiaireigexao2014@gmail.com';
					$mail->Password = 'igexao2014';
					$mail->SMTPSecure='ssl';
					$mail->Port = 465;
					$mail->From='stagiaireigexao2014@gmail.com';
					$mail->FromName='L\'Administrateur de gestion de congé IGE+XAO Madagascar';
					$mail->isHTML(true);
					$mail->addReplyTo('mbolasitrakaa@gmail.com','Reply address');
					//$mail->addAddress('stagiaireigexao2014@gmail.com','Reply address');
					$mail->addAddress($address_mail,'Reply address');
					$mail->addAddress($_SESSION['mail'],'Reply address');
					$mail->Subject='Demande non accepte'; // l'entête = nom du sujet
					$mail->Body='Votre chef de departement a reffuse votre demande qui a ete deposer le '.$date_demande;
					$mail->AltBody="This is text only alternative body.";
					var_dump($mail->Send());
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		$req_departement="select * from departement where ID_DEPARTEMENT=".$row_employe['ID_DEPARTEMENT'];
		$req_departement=mysql_query($req_departement);
		$row_departement=mysql_fetch_array($req_departement);
					
		$req_historique="INSERT INTO historique (ID_EMPLOYER,DATE_HISTORIQUE,HEURE,HISTOIRE) values (".$_SESSION['id'].",now(),'".time()."','reffuse la demande ".$row_employe['NOM']." ".$row_employe['PRENOM'].".Depatement : ".$row_departement['NOM_DEPARTEMENT']." qui est deposee le ".$date_demande."')";
					
		mysql_query($req_historique);
		
		
		
		?>
        <script>
			document.location="index.php?id=11";
		</script>
        <?php
	}
?>