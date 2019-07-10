<?php


session_start();
include("../connexion/connexion.php");
			$matricule = $_POST["txt_matricule"];
			$mot = $_POST["txt_mot_secret"];
			
			$sql="select * from employer where MATRICULE='".$matricule."' and MOT_SECRETE ='".$mot."'";//."' and NOM=NULL and PRENOM=NULL";
			$result = mysql_query($sql) or die (mysql_error());
            if ($result==0)
            {
                   echo "<script>alert('requete impossible');</script>";
                   exit;
            }
			else
			{
				if (!mysql_num_rows($result))
				{ 
						 echo "<script>alert('Impossible ! veuiller verifier les données dans votre mail');</script>";
				 }
				else
				 {
					 $array_user=mysql_fetch_array($result);
					 
					 
					$_SESSION['identifiant']=$array_user['ADRESSEMAIL'];
					$_SESSION['nom']=$array_user['NOM'];
					$_SESSION['prenom']=$array_user['PRENOM'];
					$_SESSION['departement']=$array_user['ID_DEPARTEMENT'];
					$_SESSION['id']=$array_user['ID_EMPLOYER'];
					$_SESSION['mot_pass']=$array_user['MOT_DE_PASSE'];
					$_SESSION['mail']=$array_user['ADRESSEMAIL'];
					
					$_SESSION['photo']=$array_user['PHOTO'];
					$req_changement_mot_sec="UPDATE employer SET MOT_SECRETE = 'deja' WHERE ID_EMPLOYER =".$array_user['ID_EMPLOYER'];
					mysql_query($req_changement_mot_sec);
					?>
                   <script language="javascript">
						document.location = "../index.php" ;
					</script>
					<?php
				
				}
			
			 }
			 
?>