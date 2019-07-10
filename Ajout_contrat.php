<?php 

	//recuperation des données du formulaire:
	include("connexion/connexion.php");
	
	function ajout_contrat()
	{

			//$Idcontrat = $_POST["txt_id_contrat"];
			$typecontrat = $_POST["slct_type_contrat"];
			
			$req = "INSERT INTO status (TYPE_CONTRAT) VALUES ('".$typecontrat."')";
			
			if ($resultat=mysql_query($req)) 
			{
				echo "<script> alert(\"insertion reussie\")</script>";?>
                <SCRIPT language="javascript">
					document.location = "index.php?id=4";
				</SCRIPT>
                
				<?php
			}
			else echo "<script> alert(\"TYPE DE CONTRAT EXIST DEJA,CHANGEZ SVP\")</script>";?>
			     <SCRIPT language="javascript">
					document.location = "index.php?id=4";
				 </SCRIPT>
<?php
}

$mode=$_GET['mode'];
switch($mode)
{
	case 3:ajout_contrat();break;
}

?>