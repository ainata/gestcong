<?php
	session_start();
	include("connexion/connexion.php");
	$id_deposition=$_GET['code'];
	if(isset($id_deposition))
	{
		$req="select * from departement where ID_EMPLOYER=".$_SESSION['id'];
		$req=mysql_query($req);
		if(mysql_num_rows($req))
		{
			$re="select * from valider where ID_DEPOSITION=".$id_deposition." and VALIDE_RESPONSABLE='oui'";
		}
		else{
		$re="select * from valider where ID_DEPOSITION=".$id_deposition." and (VALIDE_DEPARTEMENT='oui' or VALIDE_RESPONSABLE='oui')";
		}
		
		$re=mysql_query($re);
		if(mysql_num_rows($re))
		{
			?>
			<SCRIPT language="javascript">
					alert("Vous ne pouvait pas faire cette annulation car cet demande est deja accepter par un responsable");
					document.location = "index.php?id=7";
				</SCRIPT>
			<?php
		}
		else
		{
			$req="DELETE FROM valider WHERE ID_DEPOSITION=".$id_deposition;
			mysql_query($req);
			$req="insert into demande_annulation (ID_DEPOSITION,DATE_ANNULATION) values(".$id_deposition.",now())";
			mysql_query($req);
			
			$req_deposition="select * from deposition where ID_DEPOSITION=".$id_deposition;
			$req_deposition=mysql_query($req_deposition) or die(mysql_error());
			$row_deposition=mysql_fetch_array($req_deposition);
			
			
			$req_historique="INSERT INTO historique (ID_EMPLOYER,DATE_HISTORIQUE,HEURE,HISTOIRE) values (".$_SESSION['id'].",now(),'".time()."','Annulation de demande.depose le ".$row_deposition['DATE_DE_DEMANDE'].".Cause de cet demande".$row_deposition['EXPLICATION']."')";
			mysql_query($req_historique);
			
			?>
			<SCRIPT language="javascript">
					alert("annulation reussie");
					document.location = "index.php?id=7";
				</SCRIPT>
			<?php
		}
	}
?>