<?php
session_start();
include("../connexion/connexion.php");
/*$req="select * from employer";
$req=mysql_query($req);

$fichier=fopen("employer.txt","w");
while($req_nom=mysql_fetch_array($req))
{
	$data=$req_nom['MATRICULE'].";".$req_nom['NOM'].";".$req_nom['PRENOM'].";\n";
	fputs($fichier,html_entity_decode($data));
}*/
$req="select * from employer,valider,deposition,motif where employer.ID_EMPLOYER=deposition.ID_EMPLOYER and deposition.ID_DEPOSITION=valider.ID_DEPOSITION and motif.ID_MOTIF=deposition.ID_MOTIF and deposition.ID_EMPLOYER=".$_SESSION['id']." and (VALIDE_DEPARTEMENT<>'non vu' and VALIDE_RESPONSABLE<>'non vu')";
$req=mysql_query($req) or die(mysql_error());
$fichier=fopen("imprimer_conger.txt","w");
while($row=mysql_fetch_array($req))
{
	$req_motif="select * from type_deposition where ID_TYPE_DEP=".$row['ID_TYPE_DEP'];
	$req_motif=mysql_query($req_motif) or die(mysql_error());
	if($row_motif=mysql_fetch_array($req_motif))
	{
	echo $row_motif['NOM'];
	}
	else echo "misy error an";
	$data=$row['DATE_DEPART']." ".$row['JOURNE_DE_DEPART'].";".$row['DATE_RETOUR']." ".$row['JOURNE_DE_RETOUR'].";".$row['MOTIF'].";".$row['VALIDE_DEPARTEMENT'].";".$row['VALIDE_RESPONSABLE'].";".$row_motif['NOM'].";\n";
	fputs($fichier,html_entity_decode($data));
}

?>