<?php
		session_start();
		include("connexion/connexion.php");
		$select_motif=$_POST['slct_motif'];
		if($tab_motif=mysql_query("SELECT * FROM motif where ID_MOTIF='".$select_motif."'"))
		{
			$resultat=mysql_fetch_array($tab_motif);
			
			if($resultat['ID_TYPE_DEP']==1)
			{
				$requete_solde_conge="select * from employer where ID_EMPLOYER=".$_SESSION['id'];
				$requete_solde_conge=mysql_query($requete_solde_conge);
				$solde_conge=mysql_fetch_array($requete_solde_conge);
				$droit_nb_jour=$solde_conge['SOLDE_PERMISSION'];
				$lettre="Droit de permission : ";
			}
			else
			{
				$requete_solde_conge="select * from employer where ID_EMPLOYER=".$_SESSION['id'];
				$requete_solde_conge=mysql_query($requete_solde_conge);
				$solde_conge=mysql_fetch_array($requete_solde_conge);
				$droit_nb_jour=$solde_conge['SOLDE_CONGE'];
				$lettre="Solde conge : ";
				
			}
			$mois=$droit_nb_jour/30;
			if($mois<1)
			{
				echo "<div><span style=\"color:blue;\">".$lettre."<br> </span>".$droit_nb_jour." jours </div>";
			}
			else echo "<div><span style=\"color:blue;\">".$lettre."</span>".$droit_nb_jour." jours environs ".$mois." mois </div>";
		}
		else echo "ts ao mints requete zan an";
?>