
<?php 

	//recuperation des données du formulaire:
	include("connexion/connexion.php");
	
	function ajout_departement()
	{
			
			//$slctidemployedepartement = $_POST["slct_id_employer_departement"];
			$nomdepartement = $_POST["txt_nom_departement"];
			
			/*$req = "INSERT INTO departement (ID_EMPLOYER,NOM_DEPARTEMENT) VALUES ('".$slctidemployedepartement."','".$nomdepartement."')";*/

			$req = "INSERT INTO departement (NOM_DEPARTEMENT) VALUES ('".$nomdepartement."')";
			if ($resultat=mysql_query($req)) 
			{
				echo "<script> alert(\"insertion reussie\")</script>";?>
                <SCRIPT language="javascript">
					document.location = "index.php?id=15";
				</SCRIPT>
                
				<?php
			}
			else echo "<script> alert(\"NOM DEPARTEMENT ou CHEF EXIST DEJA,CHANGEZ SVP\")</script>";?>
			<SCRIPT language="javascript">
					document.location = "index.php?id=15";
			</SCRIPT>
<?php
}

$mode=$_GET['mode'];
switch($mode)
{
	case 9:ajout_departement();break;
}

?>