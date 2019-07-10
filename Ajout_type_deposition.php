
<?php 

	//recuperation des données du formulaire:
	include("connexion/connexion.php");
	
	function ajout_type_deposition()
	{
			

			$nomtypedeposition = $_POST["txt_nom_type_deposition"];

			$req = "INSERT INTO type_deposition (NOM) VALUES ('".$nomtypedeposition."')";
			
			if ($resultat=mysql_query($req)) 
			{
				echo "<script> alert(\"insertion reussie\")</script>";?>
                <SCRIPT language="javascript">
					document.location = "index.php?id=14";
				</SCRIPT>
                
				<?php
			}
			else echo "<script> alert(\"TYPE DEPOSITION EXIST DEJA,CHANGEZ SVP\")</script>";?>
				<SCRIPT language="javascript">
					document.location = "index.php?id=14";
				</SCRIPT>
<?php
}

$mode=$_GET['mode'];
switch($mode)
{
	case 6:ajout_type_deposition();break;
}
?>