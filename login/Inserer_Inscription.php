<?php
	include("../connexion/connexion.php");
	$date_aujourd_hui=date('Y-m-d');
	$nom=$_POST['txt_nom'];
	$prenom=$_POST['txt_prenom'];
	$mail=$_POST['txt_mail'];
	$pass=$_POST['txt_mot_de_passe'];
	if(isset($nom))
	{
		$req="select * from employer where ADRESSEMAIL='".$mail."'";
		$req=mysql_query($req);
		if(mysql_num_rows($req))
		{
			echo " <script>$(function(){alert('cette addresse mail exit deja');$(\"#txt_mail\").val('');$(\"#txt_mail\").focus();});</script>";
		}
		else{
		if(mysql_query("INSERT INTO employer (MATRICULE,NOM,PRENOM,ADRESSEMAIL,MOT_DE_PASSE,DATE_D_ENTREE,DERNIER_DATE_AJOUT_AUTO) VALUES ('0','$nom','$prenom','$mail','$pass',now(),now())"))
		{
			?>
            <script language="javascript">
						document.location = "login.php?id=4" ;
			</script>
            <?php
		}
		
		else
		echo " <script>alert('Erreur d\'envoye')</script>";
		}
	}
	else 
	echo "mbola ts ao zan an";
	
?>