<?php include("connexion/connexion.php");?>

<?php
	
function modifier_emp()
{	
			$id = $_POST["txt_id_employer"];
			$matricule = $_POST["txt_matricule"];
			$nom = $_POST["txt_nom"];
			$prenom = $_POST["txt_prenom"];
			$mail = $_POST["txt_mail"];
			$date_d_entre = $_POST["txt_date_d_entree"];
			$solde_conger = $_POST["txt_solde_de_conge"];
			//$login = $_POST["txt_login"];
			$mot_pass = $_POST["txt_mot_de_passe"];
			$departement = $_POST["slct_departement"];
			$poste = $_POST["slct_poste"];
			$status = $_POST["slct_contrat"];
			
			$req_matricule="select * from employer where MATRICULE='".$matricule."'";
			$req_matricule=mysql_query($req_matricule);
			//!mysql_num_rows($req_matricule)
			if(1)
			{
				
				$req_verifier_chef="select * from poste where NOM_POSTE='chef'";
					$req_verifier_chef=mysql_query($req_verifier_chef);
					$row_verifier_chef=mysql_fetch_array($req_verifier_chef);
					
					if($row_verifier_chef['ID_POSTE']==$poste)
					{
	
					$req_chef="select * from employer where ID_POSTE=".$row_verifier_chef['ID_POSTE']." and ID_DEPARTEMENT=".$departement;
					$req_chef=mysql_query($req_chef);
					
					if(!mysql_num_rows($req_chef))
					{
							/*echo "<script>alert('sqdsqdqs')</script>";*/
							
							$req_insert_chef="UPDATE departement SET ID_EMPLOYER=".$id." WHERE ID_DEPARTEMENT=".$departement;
							mysql_query($req_insert_chef);
					}
					$req_dep="select * from departement where ID_DEPARTEMENT=".$departement." and ID_EMPLOYER=0";
					$req_dep=mysql_query($req_dep) or die(mysql_error());
					if(!mysql_num_rows($req_dep))
					{
						$req_insert_chef="UPDATE departement SET ID_EMPLOYER=".$id." WHERE ID_DEPARTEMENT=".$departement;
						mysql_query($req_insert_chef);
					}
			}
				
				
  					//SOLDE_CONGE=".$solde_conger.
				$req = "UPDATE  employer SET MATRICULE='".$matricule."',NOM='".$nom."',PRENOM='".$prenom."',ADRESSEMAIL='".$mail."',DATE_D_ENTREE='".$date_d_entre."',MOT_DE_PASSE='".$mot_pass."',ID_CONTRAT=".$status.",ID_POSTE=".$poste.",ID_DEPARTEMENT=".$departement.",SOLDE_CONGE=".$solde_conger." WHERE ID_EMPLOYER=".$id;
				
				
					
				
				
				
				if ($resultat=mysql_query($req)) echo "<script> alert(\"modification reussie\")</script>";
				else echo mysql_error();
				
				if(isset($_POST['txt_date_contrat']))
							{
								$fin=$_POST['txt_date_contrat'];
								
								$req_select_fin="select * from fin_contrat where DATE_FIN_CONTRAT='".$fin."'";
								$req_select_fin=mysql_query($req_select_fin);
								if(!mysql_num_rows($req_select_fin))
									{
									$req="insert into fin_contrat(DATE_FIN_CONTRAT) values('".$fin."')";
									$req=mysql_query($req);
									$req="select * from fin_contrat where DATE_FIN_CONTRAT='".$fin."'";
									$req=mysql_query($req);
									$row=mysql_fetch_array($req);
									$id_fin_contrat=$row['ID_FIN_CONTRAT'];
									//$fin=$_POST['txt_date_contrat'];
									}
									else
									{
										$select_fin=mysql_fetch_array($req_select_fin);
										$id_fin_contrat=$select_fin['ID_FIN_CONTRAT'];
									}
								
								if($fin!="")
								{
									$req_fin_contrat="UPDATE finir set ID_EMPLOYER=".$id.",ID_CONTRAT=".$status.",ID_FIN_CONTRAT=".$id_fin_contrat;
									
								}
							}
							?>
               <SCRIPT language="javascript">
			   		
					document.location = "index.php?id=2";
				</SCRIPT>
                
				<?php
			}
			else
			{
				?>
               <SCRIPT language="javascript">
			   		alert("IMPOSSIBLE DE MODIFIER!Numero matricule <?php echo $matricule;?> mail existe deja");
					document.location = "index.php?id=2";
				</SCRIPT>
                
				<?php
			}

?>

<!--<SCRIPT language="javascript">
	document.location = "index.php?id=2";
</SCRIPT>-->
<?php }
$mode=$_GET['mode'];
switch($mode)
{
	case 1:modifier_emp();break;
}

?>

<?php

function modifier_motif()
{
	//recuperation des données du formulaire:
	$id = $_POST["txt_id_motif"];
	$Idtypedeposition= $_POST["slct_id_type_deposition"];
	$Motif = $_POST["txt_Motif"];
    $NombredejourMax = $_POST["txt_Nb_jours_Max"];

	$req = "UPDATE  motif SET ID_TYPE_DEP=".$Idtypedeposition.",MOTIF='".$Motif."',NOMBRE_JOUR_MAX='".$NombredejourMax."' WHERE ID_MOTIF=".$id;
	
	if ($resultat = mysql_query($req)) echo "<script> alert(\"modification reussie\")</script>";
	else echo mysql_error();

?>

<SCRIPT language="javascript">
	document.location = "index.php?id=5";
</SCRIPT>

<?php }
$mode=$_GET['mode'];
switch($mode)
{
	case 2:modifier_motif();break;
}

?>

<?php

function modifier_contrat()
{
	//recuperation des données du formulaire:
	$id = $_POST["txt_id_contrat"];
	$typecontrat = $_POST["slct_type_contrat"];


	$req = "UPDATE  status SET TYPE_CONTRAT ='".$typecontrat."' WHERE ID_CONTRAT=".$id;
	
	if ($resultat = mysql_query($req)) echo "<script> alert(\"modification reussie\")</script>";
	else echo "<script> alert(\"TYPE DE CONTRAT EXIST DEJA,CHANGEZ SVP\")</script>";

?>

<SCRIPT language="javascript">
	document.location = "index.php?id=4";
</SCRIPT>

<?php }
$mode=$_GET['mode'];
switch($mode)
{
	case 3:modifier_contrat();break;
}

?>

<?php 
	
	function modifier_deposition()
{
	//recuperation des données du formulaire:
	$id = $_POST["txt_id_deposition"];
	$IdMotif = $_POST["slct_motif"];
	$IdEmployer = $_POST["slct_employer"];
	$DateDemande = $_POST["txt_date_de_demande"];
	$DateDepart = $_POST["txt_date_de_depart"];
	$DateRetour = $_POST["txt_date_de_retour"];
	$Renouvellement = 1;
	

	$req = "UPDATE  deposition SET ID_MOTIF='".$IdMotif."',ID_EMPLOYER='".$IdEmployer."',DATE_DE_DEMANDE='".$DateDemande."',DATE_DEPART='".$DateDepart."',DATE_RETOUR='".$DateRetour."',RENOUVELMENT='".$Renouvellement."' WHERE ID_DEPOSITION=".$id;
	
	if ($resultat = mysql_query($req)) echo "<script> alert(\"modification reussie\")</script>";
	else echo mysql_error();
	
	?>

	<SCRIPT language="javascript">
		document.location = "index.php?id=3";
	</SCRIPT>
	
	<?php }
	$mode=$_GET['mode'];
	switch($mode)
	{
		case 4:modifier_deposition();break;
	}
	
?>

<?php 
	
	function modifier_poste()
{
	//recuperation des données du formulaire:
	$id = $_POST["txt_id_poste"];
	$nomposte = $_POST["txt_nom_poste"];
	

	$req = "UPDATE  poste SET NOM_POSTE='".$nomposte."' WHERE ID_POSTE=".$id;
	
	if ($resultat = mysql_query($req)) echo "<script> alert(\"modification reussie\")</script>";
	else echo "<script> alert(\"POSTE EXIST DEJA,CHANGEZ SVP\")</script>";
	
	?>

	<SCRIPT language="javascript">
		document.location = "index.php?id=13";
	</SCRIPT>
	
	<?php }
	$mode=$_GET['mode'];
	switch($mode)
	{
		case 5:modifier_poste();break;
	}
	
?>

<?php 
	
	function modifier_type_deposition()
{
	//recuperation des données du formulaire:
	$id = $_POST["txt_id_type_deposition"];
	$nomtypedeposition = $_POST["txt_nom_type_deposition"];

	$req = "UPDATE  type_deposition SET NOM='".$nomtypedeposition."' WHERE ID_TYPE_DEP=".$id;
	
	if ($resultat = mysql_query($req)) echo "<script> alert(\"modification reussie\")</script>";
	else echo "<script> alert(\"TYPE DEPOSITION EXIST DEJA,CHANGEZ SVP\")</script>";
	
	?>

	<SCRIPT language="javascript">
		document.location = "index.php?id=14";
	</SCRIPT>
	
	<?php }
	$mode=$_GET['mode'];
	switch($mode)
	{
		case 6:modifier_type_deposition();break;
	}
	
?>

<?php 
	
	function modifier_demande_annulation()
{
	//recuperation des données du formulaire:
	$id = $_POST["txt_ID_demande"];
	$txtdate_de_depart_modifie = $_POST["txt_date_de_depart_modifie"];
	$slctjours1_modifie = $_POST["slct_jours1_modifie"];
	$txtdate_de_retour__modifie = $_POST["txt_date_de_retour__modifie"];
	$slctjours2_modifie = $_POST["slct_jours2_modifie"];
	$slctmotif = $_POST["slct_motif"];
	//$txtdate_demande = $_POST["txt_date_demande"];
	$txtnom_demande = $_POST["txt_nom_demande"];
	
	$req = "UPDATE  deposition SET ID_MOTIF='".$slctmotif."', ID_EMPLOYER=".$txtnom_demande.",DATE_DE_DEMANDE=now(),DATE_DEPART='".$txtdate_de_depart_modifie."',JOURNE_DE_DEPART='".$slctjours1_modifie."',DATE_RETOUR='".$txtdate_de_retour__modifie."',RENOUVELMENT=0,JOURNE_DE_RETOUR='".$slctjours2_modifie."' WHERE ID_DEPOSITION=".$id;
	
	if ($resultat = mysql_query($req)) echo "<script> alert(\"modification reussie\")</script>";
	else echo mysql_error;
	
	?>

	<SCRIPT language="javascript">
		document.location = "index.php?id=8";
	</SCRIPT>
	
	<?php }
	$mode=$_GET['mode'];
	switch($mode)
	{
		case 7:modifier_demande_annulation();break;
	}
	
?>

<?php 
	
	function modifier_fin_contrat()
{
	//recuperation des données du formulaire:
	$id = $_POST["txt_id_fin_contrat"];
	$Id_employer_fin = $_POST["slct_id_employe_fin"];
	$dt_fin_contrat = $_POST["txt_dt_fin_contrat"];

	$req = "UPDATE  fin_contrat SET ID_EMPLOYER='".$Id_employer_fin."',DATE_FIN_CONTRAT='".$dt_fin_contrat."' WHERE ID_FIN_CONTRAT=".$id;
	
	if ($resultat = mysql_query($req)) echo "<script> alert(\"modification reussie\")</script>";
	else echo mysql_error();
	
	?>

	<SCRIPT language="javascript">
		document.location = "index.php?id=14";
	</SCRIPT>
	
	<?php }
	$mode=$_GET['mode'];
	switch($mode)
	{
		case 8:modifier_fin_contrat();break;
	}
	
?>

<?php 
	
	function modifier_departement()
{
	//recuperation des données du formulaire:
	$id = $_POST["txt_id_departement"];
	//$slctidemployerdepartement = $_POST["slct_id_employer_departement"];
	$txtnomdepartement = $_POST["txt_nom_departement"];

	$req = "UPDATE  departement SET NOM_DEPARTEMENT='".$txtnomdepartement."' WHERE ID_DEPARTEMENT=".$id;
	
	if ($resultat = mysql_query($req)) echo "<script> alert(\"modification reussie\")</script>";
	else echo "<script> alert(\"NOM DEPARTEMENT ou CHEF EXIST DEJA,CHANGEZ SVP\")</script>";
	
	?>

	<SCRIPT language="javascript">
		document.location = "index.php?id=15";
	</SCRIPT>
	
	<?php }
	$mode=$_GET['mode'];
	switch($mode)
	{
		case 9:modifier_departement();break;
	}
	
?>