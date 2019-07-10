
<?php 

	//recuperation des données du formulaire:
	include("connexion/connexion.php");
	
	function ajout_motif()
	{
			$Idtypedeposition= $_POST["slct_id_type_deposition"];	
			$NombredejourMax = $_POST["txt_Nb_jours_Max"];
			$Motif = $_POST["txt_Motif"];
		
			
			$req = "INSERT INTO motif ( ID_TYPE_DEP,MOTIF,NOMBRE_JOUR_MAX ) VALUES (".$Idtypedeposition.",'".$Motif."',".$NombredejourMax.")";
			
			if ($resultat=mysql_query($req)) 
					{
						echo "<script> alert(\"insertion reussie\")</script>";?>
						<SCRIPT language="javascript">
							document.location = "index.php?id=5";
						</SCRIPT>
						
						<?php
			}
			else echo mysql_error();
}

$mode=$_GET['mode'];
switch($mode)
{
	case 2:ajout_motif();break;
}

?>



