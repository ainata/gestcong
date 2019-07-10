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
	
 
	$date_depart = $_POST["txt_date_de_depart"];
	$date_retour = $_POST["txt_date_d_entree"];
	$motif=$_POST["slct_motif"];
	$jour_depart=$_POST["slct_jour_depart"];
	$jour_rentree=$_POST["slct_jour_entree"];
	$motif_personnel=$_POST["motif_personnel"];
	$departement=$_SESSION['departement'];
	
	
	
	if(isset($date_depart) and isset($date_retour) and isset($motif) and isset($jour_depart) and isset($jour_rentree))
	{
		$req_verification_date="select * from deposition,valider where deposition.ID_DEPOSITION = valider.ID_DEPOSITION  and ID_EMPLOYER=".$_SESSION['id']." and ((DATE_DEPART BETWEEN '".$date_depart."' and '".$date_retour."') or (DATE_RETOUR BETWEEN '".$date_depart."' and '".$date_retour."')) and (VALIDE_DEPARTEMENT='non vu' or VALIDE_RESPONSABLE='non vu' or VALIDE_RESPONSABLE='oui')";
		$req_verification_date=mysql_query($req_verification_date) or die(mysql_error());
		if(mysql_num_rows($req_verification_date))
		{
			?>
                <script>
					alert("Impossible d'envoyer cet demande!car vous étes en absence pendant cet periode");
					$("#txt_date_de_depart").val('');
					$("#txt_date_d_entree").val('');
				</script>
                
                <?php
				exit;
		}
	
		
		if($tab_motif=mysql_query("SELECT * FROM motif where ID_MOTIF='".$motif."'"))
		{
			
			$resultat=mysql_fetch_array($tab_motif);
			
			
			$nb_jour=nbJours($date_depart,$date_retour);
			if($jour_depart=="Matin" && $jour_rentree=="Apres midi")
			{
				$nb_jour=$nb_jour+0.5;
				
			}
			if($jour_depart=="Apres midi" && $jour_rentree=="Matin")
			{
				$nb_jour=$nb_jour-0.5;
				
			}
			$requete_solde_conge="select * from employer where ID_EMPLOYER=".$_SESSION['id'];
				$requete_solde_conge=mysql_query($requete_solde_conge);
				$solde_conge=mysql_fetch_array($requete_solde_conge);
			if($resultat['ID_TYPE_DEP']==1)
			{
				$droit_nb_jour=$solde_conge["SOLDE_PERMISSION"];
			}
			else
			{
				
				$droit_nb_jour=$solde_conge['SOLDE_CONGE'];
				$date_entree=$solde_conge['DATE_D_ENTREE'];
				//$droit_nb_jour=1;
				//$nb_jour=0;
				//echo $droit_nb_jour;
				$date = date("Y-m-d");
				$an=nbJours($date_entree, $date) / 365;
				
				if($an<1)
				{
					?>
                <script>
					alert("vous n'avez pas encore le droit de deposer un demande ");
					$("#txt_date_de_depart").val('');
					$("#txt_date_d_entree").val('');
				</script>
                
                <?php
				exit;
				}
			}
			if($nb_jour >$droit_nb_jour)
			{
				?>
                <script>
					alert("le nombre de jour entre \tDATE DE DEPART:<?php echo $date_depart;?> \t DATE D'ENTREE :<?php echo $date_retour;?>  sont superieur a <?php echo $droit_nb_jour ?> jour\n \nDONC:IMPOSSIBLE D'ENVOYER! VEUILLEZ RESSAYER S'IL VOUS PLAIT");
					$("#txt_date_de_depart").val('');
					$("#txt_date_d_entree").val('');
					
				</script>
                
                <?php
				
				exit;
		}
		else{



				/*$requete2="SELECT * from motif where MOTIF ='".$motif."'";
				$requete2=mysql_query($requete2);
				$resultat=mysql_fetch_array($requete2);*/
				//$idmotif=$resultat['ID_MOTIF'];
				$idmotif=$motif;
				echo $_SESSION['id'];
				$req = "INSERT INTO deposition (ID_MOTIF,ID_EMPLOYER,DATE_DE_DEMANDE,DATE_DEPART,JOURNE_DE_DEPART,DATE_RETOUR,JOURNE_DE_RETOUR,RENOUVELMENT,EXPLICATION) VALUES (".$idmotif."," .$_SESSION['id'].",now(),'".$date_depart."','".$jour_depart."','".$date_retour."','".$jour_rentree."',0,'".$motif_personnel."')";
				if (mysql_query($req))
				{ 
				
					$req_historique="INSERT INTO historique (ID_EMPLOYER,DATE_HISTORIQUE,HEURE,HISTOIRE) values (".$_SESSION['id'].",now(),'".time()."','Envoye de demande.Date de depart ".$date_depart." ".$jour_depart.",retour ".$date_retour." ".$jour_rentree.".Cause : ".$motif_personnel."')";
					
					mysql_query($req_historique);
					
					echo "insertion reussie";
						//$emp=intval($emp); 
						
					$requete1="SELECT * from deposition where ID_MOTIF=".$idmotif." and ID_EMPLOYER =".$_SESSION['id']." and DATE_DEPART='".$date_depart."' and JOURNE_DE_DEPART='".$jour_depart."' and DATE_RETOUR='".$date_retour."' and JOURNE_DE_RETOUR='".$jour_rentree."'";
					$requete1=mysql_query($requete1);
					$resultat1=mysql_fetch_array($requete1);
					
					
					
					$id_deposition=$resultat1['ID_DEPOSITION'];	
					
					$requete_motif="select * from motif,type_deposition where motif.ID_TYPE_DEP=type_deposition.ID_TYPE_DEP and ID_MOTIF=".$idmotif;
					$requete_motif=mysql_query($requete_motif);
					$row_motif=mysql_fetch_array($requete_motif);
					$type_motif=$row_motif['NOM'];
					
					$requete1="SELECT * from employer where ID_EMPLOYER =".$_SESSION['id'];
					$requete1=mysql_query($requete1);
					$resultat1=mysql_fetch_array($requete1);
					
					$dep=$resultat1['ID_DEPARTEMENT'];
					
					echo $dep;
			
					$requete2="SELECT * from departement where ID_DEPARTEMENT =". $dep ;
					$requete2=mysql_query($requete2);
					$resultat=mysql_fetch_array($requete2);
					$chef=$resultat['ID_EMPLOYER'];
					echo $chef;
		
					if($chef==$_SESSION['id']){
						
						
						
						$requete = "INSERT INTO valider (ID_DEPARTEMENT,ID_DEPOSITION,ID_RESPONSABLE_SITE,VALIDE_DEPARTEMENT,DATE_VALIDATION_DEP,VALIDE_RESPONSABLE,DATE_VALIDATION_RESPONSABLE,VU_UTILISATEUR) VALUES (".$departement.",".$id_deposition.",5,'oui',now(),'non vu',0,'vu')";
						$ok=mysql_query($requete);
						if ($ok)
						{
							echo "<br> insertion de deposition dans le table valider <br>";
						}
						else echo "<br> insertion de deposition dans le table valider est impossible <br>";
					}
					else
					{
						$requete = "INSERT INTO valider (ID_DEPARTEMENT,ID_DEPOSITION,ID_RESPONSABLE_SITE,VALIDE_DEPARTEMENT,DATE_VALIDATION_DEP,VALIDE_RESPONSABLE,DATE_VALIDATION_RESPONSABLE,VU_UTILISATEUR) VALUES (".$_SESSION['departement']."," .$id_deposition.",5,'non vu',0,'non vu',0,'vu')";
						if (mysql_query($requete)){
							echo "<br> insertion de deposition dans le table valider <br>";
						}
						else echo "<br> insertion de deposition dans le table valider est impossible <br>";
			
						
						//echo "<br>".$addres_mail;
			
			
					}
		$requete3="SELECT * from employer where ID_EMPLOYER = ".$chef;
		$requete3=mysql_query($requete3);
		$resultat=mysql_fetch_array($requete3);
		$addres_mail=$resultat['ADRESSEMAIL'];
						/*echo "<script>alert('".$addres_mail."')</script>";
						
		/*$requete3="SELECT * from employer where ID_EMPLOYER = 7";
		$requete3=mysql_query($requete3);
		$resultat=mysql_fetch_array($requete3);
		$addres_mail=$resultat['ADRESSEMAIL'];*/
		
		
		
		/*
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
		/* mail($to, $subject, $message,"From: $to\n");
		 
		 if(mail){echo "any zany";}
		 else {echo "aaa";}*/
		 
		 
		/* echo "<script>alert('".$addres_mail." ".$type_motif." ".$motif_personnel."')</script>";*/
		
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
					$mail->addAddress($_SESSION['mail'],'Reply address');
					$mail->Subject='Demande de conge par'  .$_SESSION['nom'].' '.$_SESSION['prenom']; // l'entête = nom du sujet
					$mail->Body='
					<p>Bonjour!</p>
					<div>'.$_SESSION['nom'].' '.$_SESSION['prenom'].' a depose une demande de '.$type_motif.'</div>
					<div>Date de depart : '.$date_depart.' '.$jour_depart.'</div>
					<div>Date de retour :'.$date_retour.' '.$jour_rentree.'</div>
					<div>Cause : '.$motif_personnel.'</div>';
					$mail->AltBody="This is text only alternative body.";
					var_dump($mail->Send());
		 
		 ?>
        <SCRIPT language="javascript">
					document.location = "index.php?id=7";
			</SCRIPT>
         <?php
				
			}
	else echo mysql_error();
		}
		}
		
		
	}
	else echo "mbola ts ao n post a";

?>