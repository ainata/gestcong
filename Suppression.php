<?php
include("connexion/connexion.php");
function suppression_employer()
{
	$id = $_POST["txt_id_employer"];
	$req = "delete from employer where ID_EMPLOYER=".$id ;
	
	$req_deposition="delete from deposition where ID_EMPLOYER=".$id;
	mysql_query($req_deposition) or die(mysql_error());
	
	$req_historique="delete from historique where ID_EMPLOYER=".$id;
	mysql_query($req_historique) or die(mysql_error());
		//execution de la requete
		if ($resultat=mysql_query($req)){
			echo "<script> alert(\"suppression reussie\")</script>";
			?>
			<SCRIPT language="javascript">
				document.location = "index.php?id=2";
		
			</SCRIPT>
		<?php
		}
		else echo mysql_error();
		
}

function suppression_motif()
{
	$id = $_POST["txt_id_motif"];
	$req = "delete from motif where ID_MOTIF=".$id ;
		//execution de la requete
		if ($resultat=mysql_query($req)){
			echo "<script> alert(\"suppression reussie\")</script>";
			?>
			<SCRIPT language="javascript">
				document.location = "index.php?id=5";
		
			</SCRIPT>
		<?php
		}
		else echo mysql_error();
}

function suppression_contrat()
{
	$id = $_POST["txt_id_contrat"];
	$req = "delete from status where ID_CONTRAT=".$id ;
		//execution de la requete
		if ($resultat=mysql_query($req)){
			echo "<script> alert(\"suppression reussie\")</script>";
			?>
			<SCRIPT language="javascript">
				document.location = "index.php?id=4";
		
			</SCRIPT>
		<?php
		}
		else echo mysql_error();
}

function suppression_deposition()
{
	$id = $_POST["txt_id_deposition"];
	$req = "delete from deposition where ID_DEPOSITION=".$id ;
		//execution de la requete
		if ($resultat=mysql_query($req)){
			echo "<script> alert(\"suppression reussie\")</script>";
			?>
			<SCRIPT language="javascript">
				document.location = "index.php?id=3";
		
			</SCRIPT>
		<?php
		}
		else echo mysql_error();
}

function suppression_poste()
{
	$id = $_POST["txt_id_poste"];
	$req = "delete from poste where ID_POSTE=".$id ;
		//execution de la requete
		if ($resultat=mysql_query($req)){
			echo "<script> alert(\"suppression reussie\")</script>";
			?>
			<SCRIPT language="javascript">
				document.location = "index.php?id=13";
		
			</SCRIPT>
		<?php
		}
		else echo mysql_error();
}

function suppression_type_deposition()
{
	$id = $_POST["txt_id_type_deposition"];
	$req = "delete from type_deposition where ID_TYPE_DEP=".$id ;
		//execution de la requete
		if ($resultat=mysql_query($req)){
			echo "<script> alert(\"suppression reussie\")</script>";
			?>
			<SCRIPT language="javascript">
				document.location = "index.php?id=14";
		
			</SCRIPT>
		<?php
		}
		else echo mysql_error();
}

function suppression_fin_contrat()
{
	$id = $_POST["txt_id_fin_contrat"];
	$req = "delete from fin_contrat where ID_FIN_CONTRAT=".$id ;
		//execution de la requete
		if ($resultat=mysql_query($req)){
			echo "<script> alert(\"suppression reussie\")</script>";
			?>
			<SCRIPT language="javascript">
				document.location = "index.php?id=14";
		
			</SCRIPT>
		<?php
		}
		else echo mysql_error();
}

function suppression_departement()
{
	$id = $_POST["txt_id_departement"];
	$req = "delete from departement where ID_DEPARTEMENT=".$id ;
		//execution de la requete
		if ($resultat=mysql_query($req)){
			echo "<script> alert(\"suppression reussie\")</script>";
			?>
			<SCRIPT language="javascript">
				document.location = "index.php?id=15";
		
			</SCRIPT>
		<?php
		}
		else echo mysql_error();
}

$mode=$_GET['mode'];
switch($mode)
{
	case 1:suppression_employer();break;
	case 2:suppression_motif();break;
	case 3:suppression_contrat();break;
	case 4:suppression_deposition();break;
	case 5:suppression_poste();break;
	case 6:suppression_type_deposition();break;
	case 8:suppression_fin_contrat();break;
	case 9:suppression_departement();break;
}
?>
