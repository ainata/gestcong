
<?php 
	session_start();
	//recuperation des données du formulaire:
	include("connexion/connexion.php");

?>

<body  onLoad="window.print();window.close();">
<div>

<h1><img src="images/logo-ige+xao.png"/></h1>

<?php

	//recuperation du code à modifier

$requete_objet=" SELECT deposition.ID_EMPLOYER as ID_EMPL_DP,SOLDE_CONGE,DATE_DEPART,DATE_RETOUR,MOTIF,type_deposition.NOM as NOM_TYPE_DEP,employer.NOM as NOM_EMPLOYE,PRENOM,NOM_DEPARTEMENT,NOM_POSTE,JOURNE_DE_DEPART,JOURNE_DE_RETOUR,VALIDE_DEPARTEMENT,VALIDE_RESPONSABLE from deposition,motif,type_deposition,employer,departement,poste,valider where deposition.ID_DEPOSITION=valider.ID_DEPOSITION and motif.ID_MOTIF=deposition.ID_MOTIF and motif.ID_TYPE_DEP = type_deposition.ID_TYPE_DEP and employer.ID_EMPLOYER = deposition.ID_EMPLOYER and employer.ID_DEPARTEMENT = departement.ID_DEPARTEMENT and employer.ID_POSTE = poste.ID_POSTE and employer.ID_EMPLOYER='".$_SESSION['id']."' and deposition.ID_DEPOSITION IN (SELECT ID_DEPOSITION from valider WHERE (VALIDE_DEPARTEMENT='oui' or VALIDE_DEPARTEMENT='non') and (VALIDE_RESPONSABLE='oui' or VALIDE_RESPONSABLE='non')) order by DATE_DEPART ";

		$resultat_objet = mysql_query($requete_objet) or die(mysql_error());
			if ($resultat_objet==0)
			{
					print(" <B> Impossible d'executer la requete SELECT </B> ");
					exit;
			}
			if (!mysql_num_rows($resultat_objet))
			{
					echo "<script> alert(\"Vous n'avez pas encors déposer au moins une demande de conge\")</script>";?>
					<SCRIPT language="javascript">
					 document.location = "index.php";
					</SCRIPT>
<?php					exit;
			}
		$data=mysql_fetch_object($resultat_objet);

	//requete pour la fiche
$requete=" SELECT deposition.ID_EMPLOYER as ID_EMPL_DP,SOLDE_CONGE,DATE_DEPART,DATE_RETOUR,MOTIF,type_deposition.NOM as NOM_TYPE_DEP,employer.NOM as NOM_EMPLOYE,PRENOM,NOM_DEPARTEMENT,NOM_POSTE,JOURNE_DE_DEPART,JOURNE_DE_RETOUR,VALIDE_DEPARTEMENT,VALIDE_RESPONSABLE from deposition,motif,type_deposition,employer,departement,poste,valider where deposition.ID_DEPOSITION=valider.ID_DEPOSITION and motif.ID_MOTIF=deposition.ID_MOTIF and motif.ID_TYPE_DEP = type_deposition.ID_TYPE_DEP and employer.ID_EMPLOYER = deposition.ID_EMPLOYER and employer.ID_DEPARTEMENT = departement.ID_DEPARTEMENT and employer.ID_POSTE = poste.ID_POSTE and employer.ID_EMPLOYER='".$_SESSION['id']."' and deposition.ID_DEPOSITION IN (SELECT ID_DEPOSITION from valider WHERE (VALIDE_DEPARTEMENT='oui' or VALIDE_DEPARTEMENT='non') and (VALIDE_RESPONSABLE='oui' or VALIDE_RESPONSABLE='non')) order by DATE_DEPART ";

		$resultat = mysql_query($requete) or die(mysql_error());
					if ($resultat==0)
					{
							print("<B> Impossible d'executer la requete SELECT </B> ");
							exit;
					}
					if (!mysql_num_rows($resultat))
					{ 
							//echo "Aucun enregistrement "; 
					}
//'".$_SESSION['id']."'
//requete pour le jour solicite
$tableauNombreJours = array();

$requete_jr_solicite=" SELECT deposition.ID_EMPLOYER as ID_EMPL_DP,SOLDE_CONGE,DATE_DEPART,DATE_RETOUR,MOTIF,type_deposition.NOM as NOM_TYPE_DEP,employer.NOM as NOM_EMPLOYE,PRENOM,NOM_DEPARTEMENT,NOM_POSTE,JOURNE_DE_DEPART,JOURNE_DE_RETOUR,VALIDE_DEPARTEMENT,VALIDE_RESPONSABLE from deposition,motif,type_deposition,employer,departement,poste,valider where deposition.ID_DEPOSITION=valider.ID_DEPOSITION and motif.ID_MOTIF=deposition.ID_MOTIF and motif.ID_TYPE_DEP = type_deposition.ID_TYPE_DEP and employer.ID_EMPLOYER = deposition.ID_EMPLOYER and employer.ID_DEPARTEMENT = departement.ID_DEPARTEMENT and employer.ID_POSTE = poste.ID_POSTE and employer.ID_EMPLOYER='".$_SESSION['id']."' and deposition.ID_DEPOSITION IN (SELECT ID_DEPOSITION from valider WHERE (VALIDE_DEPARTEMENT='oui' or VALIDE_DEPARTEMENT='non') and (VALIDE_RESPONSABLE='oui' or VALIDE_RESPONSABLE='non')) order by DATE_DEPART ";

		$resultat_jr_solicite = mysql_query($requete_jr_solicite) or die(mysql_error());
					if ($resultat_jr_solicite==0)
					{
							print("<B> Impossible d'executer la requete SELECT </B> ");
							exit;
					}
					if (!mysql_num_rows($resultat_jr_solicite))
					{ 
							//echo "Aucun enregistrement "; 
					}
					
		$i=0;
		while ($row_jr_solicite = mysql_fetch_array($resultat_jr_solicite,  MYSQL_ASSOC)) {
		
			$dt_depart = $row_jr_solicite['DATE_DEPART'];
			$dt_retour = $row_jr_solicite['DATE_RETOUR'];
			$jr_depart = $row_jr_solicite['JOURNE_DE_DEPART'];
			$jr_retour = $row_jr_solicite['JOURNE_DE_RETOUR'];
			$solde_conge = $row_jr_solicite['SOLDE_CONGE'];
			
			$nbSecondes= 60*60*24;
	
			$debut_ts = strtotime($dt_depart);
			$fin_ts = strtotime($dt_retour);
			$diff = $fin_ts - $debut_ts;
			
			$round1['$i'] = round($diff / $nbSecondes);
			
				if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
		
				$tableauNombreJours[$i] = $round1['$i'] + 0.5;
				//echo 'a:'.$tableauNombreJours[$i];
		
				}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
				
					$tableauNombreJours[$i] = $round1['$i'] - 0.5;
					//echo 'b:'.$tableauNombreJours[$i];
				
				}else{
				
					$tableauNombreJours[$i] = $round1['$i'];
					//echo 'c:'.$tableauNombreJours[$i];
				
				}
		    $i++;
		}

?>


<table width="371" height="43" border="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="369">
      <div align="left"><label for="textfield"><?php echo $data->NOM_EMPLOYE?> <?php echo $data->PRENOM?></label></div>
    </td>
  </tr>
</table>
  <table width="395" height="105" border="0" cellspacing="0" bordercolor="#000000" >
    <tr>
      <td width="112">Departement :</td>
        <td width="240">
          <label for="label"><?php echo $data->NOM_DEPARTEMENT?></label>
        </td>
    </tr>
    <tr>
      <td>Poste :</td>
        <td>
          <label for="label2"><?php echo $data->NOM_POSTE?></label>
        </td>
    </tr> 
  </table>
<form id="form_fiche_conge" name="form_fiche_conge">
  <div align="center">
    <table width="1150" height="126" border="1" cellspacing="0" bordercolor="#000000">
      <tr>
        <td width="111"><div align="center">date d&eacute;part</div></td>
		<td width="111"><div align="center">journee d&eacute;part</div></td>
        <td width="88"><div align="center">date retour</div></td>
		<td width="111"><div align="center">journee de retour</div></td>
        <td width="92"><div align="center">jours sollicit&eacute;s</div></td>
        <td width="198"><div align="center">motif</div></td>
        <td width="180"><div align="center">chef d'equipe</div></td>
        <td width="222"><div align="center">responsable de site</div></td>
        <td width="133"><div align="center">cong&eacute; ou permission</div></td>
      </tr>
      <br/>
	  <?php $i = 0 ;?>
        <?php while($row = mysql_fetch_array($resultat)){?>
      <tr>	  	
			            <td><div align="center"><?php echo $row['DATE_DEPART']?></div></td>
						<td><div align="center"><?php echo $row['JOURNE_DE_DEPART']?></div></td>
			            <td><div align="center"><?php echo $row['DATE_RETOUR']?></div></td>
						<td><div align="center"><?php echo $row['JOURNE_DE_RETOUR']?></div></td>
			            <td><div align="center"><?php echo $tableauNombreJours[$i]?></div></td>
			            <td><div align="center"><?php echo $row['MOTIF']?></div></td>
						<td><div align="center"><?php echo $row['VALIDE_DEPARTEMENT']?></div></td>
						<td><div align="center"><?php echo $row['VALIDE_RESPONSABLE']?></div></td>
				        <td><div align="center"><?php echo $row['NOM_TYPE_DEP']?></div></td>
      	<?php $i++ ;?>
	  </tr>
	  <?php } ?>
    </table>
	<table width="285" height="42" border="0" align="left">
	  <tr>
		<td width="287">Votre solde de congé est <?php echo $solde_conge?> jours</td>
	  </tr>
	</table>

  </div>
</form>
</div>
</body>