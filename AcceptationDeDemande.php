<?php
	session_start();
	include("connexion/connexion.php");
	require_once "phpmailler/PHPMailer/PHPMailerAutoload.php"; 
	include("phpmailler/PHPMailer/class.phpmailer.php");
	include("phpmailler/PHPMailer/class.smtp.php");
	function nbJours($debut, $fin) {
					//60 secondes X 60 minutes X 24 heures dans une journée
					$nbSecondes= 60*60*24;
			 
					$debut_ts = strtotime($debut);
					$fin_ts = strtotime($fin);
					$diff = $fin_ts - $debut_ts;
					return round($diff / $nbSecondes);
	}
	
	if(isset($_GET['code'])&& isset($_GET['type_dep']))
	{
		$req_verifier_resp_site="select * from valider where ID_RESPONSABLE_SITE=".$_SESSION['departement'];
		$q=mysql_query($req_verifier_resp_site);
		
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
		$addres_mail=$row_employe['ADRESSEMAIL'];
		$nom=$row_employe['NOM'];
		$prenom=$row_employe['PRENOM'];
		$id_departement=$row_employe['ID_DEPARTEMENT'];
		
		$req_departement="select * from departement where ID_DEPARTEMENT=".$id_departement;
		$req_departement=mysql_query($req_departement);
		$row_departement_emp=mysql_fetch_array($req_departement);
		$nom_departement=$row_departement_emp['NOM_DEPARTEMENT'];
		
		if(mysql_num_rows($q))
		{
			
			
			if($_GET['type_dep']!=1)
			{
				
				
				$nb_jour=nbJours($ligne['DATE_DEPART'],$ligne['DATE_RETOUR']);
			
					if($jour_depart=="Matin" && $jour_rentree=="Apres midi")
					{
						$nb_jour=$nb_jour+0.5;
						
					}
					if($jour_depart=="Apres midi" && $jour_rentree=="Matin")
					{
						$nb_jour=$nb_jour-0.5;
					}
				$req_verifier_emp="select * from employer where ID_EMPLOYER=".$ligne['ID_EMPLOYER'];
				$req_verifier_emp=mysql_query($req_verifier_emp);
				$row=mysql_fetch_array($req_verifier_emp);
				$nouv_solde=$row['SOLDE_CONGE']-$nb_jour;
				
				$req_modifie_solde="update employer set SOLDE_CONGE=".$nouv_solde." where ID_EMPLOYER=".$ligne['ID_EMPLOYER'];
				mysql_query($req_modifie_solde);
		
			}
			else
			{
				
				$nb_jour=nbJours($ligne['DATE_DEPART'],$ligne['DATE_RETOUR']);
			
					if($jour_depart=="Matin" && $jour_rentree=="Apres midi")
					{
						$nb_jour=$nb_jour+0.5;
						
					}
					if($jour_depart=="Apres midi" && $jour_rentree=="Matin")
					{
						$nb_jour=$nb_jour-0.5;
					}
				$req_verifier_emp="select * from employer where ID_EMPLOYER=".$ligne['ID_EMPLOYER'];
				$req_verifier_emp=mysql_query($req_verifier_emp);
				$row=mysql_fetch_array($req_verifier_emp);
				$nouv_solde=$row['SOLDE_PERMISSION']-$nb_jour;
				
				$req_modifie_solde="update employer set SOLDE_PERMISSION=".$nouv_solde." where ID_EMPLOYER=".$ligne['ID_EMPLOYER'];
				mysql_query($req_modifie_solde);
			}
		$req="update valider set VALIDE_RESPONSABLE ='oui',	DATE_VALIDATION_RESPONSABLE=now(),VU_UTILISATEUR='non vu' where ID_DEPOSITION=".$_GET['code']." and ID_RESPONSABLE_SITE=".$_SESSION['departement'];
		mysql_query($req);
		//				
						
						
					//echo $addres_mail;
		
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
					$mail->FromName='L\'Administrateur de gestion de conge IGE+XAO Madagascar';
					$mail->isHTML(true);
					$mail->addReplyTo('stagiaireigexao2014@gmail.com','Reply address');
					//$mail->addAddress('stagiaireigexao2014@gmail.com','Reply address');
					$mail->addAddress($addres_mail,'Reply address');
					$mail->Subject='Demande de conge accepte'; // l'entête = nom du sujet
					$mail->Body='
					<p>Bonjour!</p>
					<div>Votre demande qui a ete depose le :'.$date_demande.' est accepte par la responsable du site</div>';
					$mail->AltBody="This is text only alternative body.";
					var_dump($mail->Send());
					
					$requete_emp="SELECT * from employer where ID_DEPARTEMENT = 4";
					$requete_emp=mysql_query($requete_emp) or die(mysql_error());
					$resultat=mysql_fetch_array($requete_emp);
					$addres_mail_admin=$resultat['ADRESSEMAIL'];
					
					//echo "<br>".$addres_mail_admin;
					
					$requete_emp="SELECT * from employer where ID_DEPARTEMENT = 4";
					$requete_emp=mysql_query($requete_emp) or die(mysql_error());
					$resultat=mysql_fetch_array($requete_emp);
					$addres_mail_admin=$resultat['ADRESSEMAIL'];
					
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
					$mail->FromName='L\'Administrateur de gestion de conge IGE+XAO Madagascar';
					$mail->isHTML(true);
					$mail->addReplyTo('stagiaireigexao2014@gmail.com','Reply address');
					//$mail->addAddress('stagiaireigexao2014@gmail.com','Reply address');
					$mail->addAddress($addres_mail_admin,'Reply address');
					$mail->Subject='Demande de conge accepte'; // l'entête = nom du sujet
					$mail->Body='
					<p>Bonjour!</p>
					<div>La demande de'.$nom.' '.$prenom.' qui est dans la Departement : '.$nom_departement.' ; depose le :'.$date_demande.' est accepte par la responsable du site</div>';
					$mail->AltBody="This is text only alternative body.";
					var_dump($mail->Send());
		
		
		
		}
		else{
					$requete1="update valider set VALIDE_DEPARTEMENT ='oui',DATE_VALIDATION_DEP=now() where ID_DEPOSITION=".$_GET['code']." and ID_DEPARTEMENT=".$_SESSION['departement'];
					mysql_query($requete1);
		
					echo "departement<br>";
		
					$requete3="SELECT * from employer where ID_DEPARTEMENT = 5";
					$requete3=mysql_query($requete3);
					$resultat=mysql_fetch_array($requete3);
					$addres_mail_resp=$resultat['ADRESSEMAIL'];
					echo 'responsable : '.$addres_mail_resp;
					
					
					$requete_chef_dep="SELECT * from departement where ID_DEPARTEMENT = ".$_SESSION['departement'];
					$requete_chef_dep=mysql_query($requete_chef_dep) or die(mysql_error());
					$row_chef_dep=mysql_fetch_array($requete_chef_dep);
					$rara=$row_chef_dep['ID_EMPLOYER'];
					$req_add_chef_dep="select * from employer where ID_EMPLOYER=".$rara;
					$req_add_chef_dep=mysql_query($req_add_chef_dep) or die(mysql_error());
					$row_add_chef_dep=mysql_fetch_array($req_add_chef_dep);
					$addres_mail_chef_dep=$row_add_chef_dep['ADRESSEMAIL'];
					
					//echo 'chef dep:'.$addres_mail_chef_dep;
					
					
					
				
					
					
					echo "<br>".$nom.' '.$prenom.' '.$row_departement_emp['NOM_DEPARTEMENT'];
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
					$mail->FromName='L\'Administrateur de gestion de conge IGE+XAO Madagascar';
					$mail->isHTML(true);
					$mail->addReplyTo('stagiaireigexao2014@gmail.com','Reply address');
					//$mail->addAddress('stagiaireigexao2014@gmail.com','Reply address');
					$mail->addAddress($addres_mail_resp,'Reply address');
					$mail->addAddress($_SESSION['mail'],'Reply address');
					$mail->Subject='Demande de conge accepte'; // l'entête = nom du sujet
					$mail->Body='Il y a une demande depose par'.$nom.' '.$prenom.' qui a ete depose le :'.$date_demande.'<br>Departement: '.$nom_departement.'';
					$mail->AltBody="This is text only alternative body.";
					var_dump($mail->Send());
		
		
		
		}
		
		
		
		$req_departement="select * from departement where ID_DEPARTEMENT=".$row_employe['ID_DEPARTEMENT'];
		$req_departement=mysql_query($req_departement);
		$row_departement=mysql_fetch_array($req_departement);
					
		$req_historique="INSERT INTO historique (ID_EMPLOYER,DATE_HISTORIQUE,HEURE,HISTOIRE) values (".$_SESSION['id'].",now(),'".time()."','acceptée la demande ".$row_employe['NOM']." ".$row_employe['PRENOM'].".Dépatement : ".$row_departement['NOM_DEPARTEMENT']." qui est déposée le ".$date_demande."')";
					
		mysql_query($req_historique);
		?>
      <script>
		document.location="index.php?id=11";
		</script>
        <?php 
	}
	else echo "erreur de fonction $_GET"
?>