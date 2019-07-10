
<?php 

	//recuperation des données du formulaire:
	include("connexion/connexion.php");
	
	function ajout_poste()
	{

			
			//$id_poste = $_POST["txt_id_poste"];
			$nomposte = $_POST["txt_nom_poste"];
			
			$req = "INSERT INTO poste (NOM_POSTE) VALUES ('".$nomposte."')";

			
			if ($resultat=mysql_query($req)) 
			{
				echo "<script> alert(\"insertion reussie\")</script>";?>
                <SCRIPT language="javascript">
					document.location = "index.php?id=13";
				</SCRIPT>
                
				<?php
			}
			else echo "<script> alert(\"POSTE EXIST DEJA,CHANGEZ SVP\")</script>";?>
			<SCRIPT language="javascript">
					document.location = "index.php?id=13";
			</SCRIPT>
<?php
}

$mode=$_GET['mode'];
switch($mode)
{
	case 5:ajout_poste();break;
}

?>