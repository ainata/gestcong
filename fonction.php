<script>
</script>
<?php

	
	function entete_table_liste()
	{
		?><table width="100%" border="0px">
      
                    <tr bgcolor="#666666"> 
                        <td ><div align="center"><font color="#FFFFFF" >Id</div></td>
                        <td ><div align="center"><font color="#FFFFFF">Matricule</div></td>
                        <td width=20%><div align="center"><font color="#FFFFFF">Nom</div></td>
                        <td width=20%><div align="center"><font color="#FFFFFF" >Prenom</div></td>
                        <td ><div align="center"><font color="#FFFFFF">Address e-mail</div></td>
                        <td><div align="center"><font color="#FFFFFF" >Date d'entrée</div></td>
                        <td ><div align="center"><font color="#FFFFFF" >Solde de congé</div></td>
                        <td><div align="center"><font color="#FFFFFF" >Departement</div></td>
                        <td><div align="center"><font color="#FFFFFF" >Poste</div></td>
                        <td><div align="center"><font color="#FFFFFF" >Contrat</div></td>
                        
                    </tr>
                       <?php }
     function affichage_table_employer(){
                  
                        $requete = "SELECT employer.ID_EMPLOYER as id_emp,MATRICULE,NOM,PRENOM,ADRESSEMAIL,DATE_D_ENTREE,SOLDE_CONGE,TYPE_CONTRAT,NOM_DEPARTEMENT,NOM_POSTE FROM employer,departement,poste,status where employer.ID_DEPARTEMENT=departement.ID_DEPARTEMENT and employer.ID_CONTRAT=status.ID_CONTRAT and employer.ID_POSTE=poste.ID_POSTE " ;
                        $result = mysql_query($requete);
                        if ($result==0)
                        {
                        print("<B> Impossible d'executer la requete SELECT </B> ");
                        exit;
                        }
                        if (!mysql_num_rows($result))
                        { 
                        echo "Aucun enregistrement " ; 
                        }
                        else
                        {
                            while ($ligne =mysql_fetch_array($result))
                            { 
                            $id_employer=$ligne['id_emp'];
                            $matricule=$ligne['MATRICULE'];
                            $nom=$ligne['NOM'];
                            $prenom=$ligne['PRENOM'];
							$mail=$ligne['ADRESSEMAIL'];
							$date=$ligne['DATE_D_ENTREE'];
							$solde=$ligne['SOLDE_CONGE'];
							$contrat=$ligne['TYPE_CONTRAT'];
							$poste=$ligne['NOM_POSTE'];
							$departement=$ligne['NOM_DEPARTEMENT'];
                            echo "<tr onclick=\"\"  bgcolor=\"#CCCCCC\" height=\"35px\"> 
                                        <td > <div align=\"center\">$id_employer</div></td>
                                        <td> <div align=\"center\">$matricule</font></div></td>
                                        <td width=20%> <div align=\"center\">$nom</font></div></td>
                                        <td width=20%> <div align=\"center\">$prenom</div></td>
										<td> <div align=\"center\">$mail</div></td>
                                        
                                        <td> <div align=\"center\">$date</div></td>
										<td> <div align=\"center\">$solde</div></td>
										
                                        <td> <div align=\"center\">$departement</div></td>
										
                                        <td> <div align=\"center\">$poste</div></td>
										<td> <div align=\"center\">$contrat</div></td>
                                    </tr>" ;
                                  
                            }
                        }
                       
                        
               echo "</table> ";
			   
	}
	
	
	function select_departement()
	{
		
                
                $requete = "SELECT * FROM departement Order by ID_DEPARTEMENT" ;
                $result = mysql_query($requete);
                if ($result==0)
                {
                    print("<B> Impossible d'executer la requete SELECT </B> ");
                    exit;
                }
                if (!mysql_num_rows($result))
                { echo "Aucun enreg. correspondant " ; }
                else
                {
                    while ($ligne =mysql_fetch_array($result))
                    {
                        $id_departement=$ligne['ID_DEPARTEMENT'];
                        $nom_departement=$ligne['NOM_DEPARTEMENT'];
                        echo '<option value="' .$id_departement. '">' .$nom_departement. "</option>\n";
                    }
                }
               
                
	}
	
	
	function select_statut()
	{
		
                
                $requete = "SELECT * FROM status Order by ID_CONTRAT" ;
                $result = mysql_query($requete);
                if ($result==0)
                {
                    print("<B> Impossible d'executer la requete SELECT </B> ");
                    exit;
                }
                if (!mysql_num_rows($result))
                { echo "Aucun enreg. correspondant " ; }
                else
                {
                    while ($ligne =mysql_fetch_array($result))
                    {
                        $id_contrat=$ligne['ID_CONTRAT'];
                        $nom_contrat=$ligne['TYPE_CONTRAT'];
                        echo '<option value="' .$id_contrat. '">' .$nom_contrat. "</option>\n";
                    }
                }
               
                
	}
	
	function alert_ex(){
		echo "<script>alert(\"iha\");</script>";
	}
	
	function select_poste()
	{
		
                
                $requete = "SELECT * FROM poste Order by ID_POSTE" ;
                $result = mysql_query($requete);
                if ($result==0)
                {
                    print("<B> Impossible d'executer la requete SELECT </B> ");
                    exit;
                }
                if (!mysql_num_rows($result))
                { echo "Aucun enreg. correspondant " ; }
                else
                {
                    while ($ligne =mysql_fetch_array($result))
                    {
                        $id_poste=$ligne['ID_POSTE'];
                        $nom_poste=$ligne['NOM_POSTE'];
                        echo '<option value="' .$id_poste. '">' .$nom_poste. "</option>\n";
                    }
                }
               
                
	}
	
	function select_id_deposition_demande_annule()
	{
		
                
                $requete = " SELECT DISTINCT *,NOM,MOTIF,JOURNE_DE_DEPART,JOURNE_DE_RETOUR,VALIDE_DEPARTEMENT,VALIDE_RESPONSABLE FROM employer,deposition,motif,valider where employer.ID_EMPLOYER = deposition.ID_EMPLOYER AND motif.ID_MOTIF = deposition.ID_MOTIF AND valider.ID_DEPOSITION=deposition.ID_DEPOSITION and ( VALIDE_DEPARTEMENT='non vu' OR VALIDE_RESPONSABLE='non vu' OR VALIDE_DEPARTEMENT='oui' OR VALIDE_RESPONSABLE='oui' ) and ( DATE_DEPART > now()) order by NOM ";
                
				$result = mysql_query($requete);
                if ($result==0)
                {
                    print("<B> Impossible d'executer la requete SELECT </B> ");
                    exit;
                }
                if (!mysql_num_rows($result))
                { echo "Aucun enreg. correspondant " ; }
                else
                {
                    while ($ligne =mysql_fetch_array($result))
                    {
                        $id_dep_an=$ligne['ID_DEPOSITION'];
                        $nom_dep_an=$ligne['NOM'];
                        echo '<option value="' .$id_dep_an. '">' .$nom_dep_an. "</option>\n";
                    }
                }
               
                
	}
	
	function ajout_employer(){
		
	echo "eto zao";
		//recuperation des données du formulaire:
		/*$id = $_POST["txt_id_employer"];
		$matricule = $_POST["txt_matricule"];
		$nom = $_POST["txt_nom"];
		$prenom = $_POST["txt_prenom"];
		$mail = $_POST["txt_mail"];
		$date_d_entre = $_POST["txt_date_d_entree"];
		$solde_conger = $_POST["txt_solde_de_conge"];
		$login = $_POST["txt_login"];
		$mot_pass = $_POST["txt_mot_de_passe"];
		$departement = $_POST["slct_departement"];
		$poste = $_POST["slct_poste"];
		$status = $_POST["slct_contrat"];

		$req = "INSERT INTO  employer VALUES (".$id.",'".$status."','" .$poste."','".$departement."',".$matricule.",'".$nom."','".$prenom."',".$mail.",".$date_d_entre.",'".$solde_conger ."','".$login ."','".$mot_pass."')";;
		
		if ($resultat=mysql_query($req)) echo "<script> alert(\"insertion reussie\")</script>";
		else echo mysql_error();*/
	
		
		
	}
	
	
	//DEPOSITION
	
	function select_motif()
	{
		
                
                $requete = "SELECT * FROM MOTIF Order by ID_MOTIF" ;
                $result = mysql_query($requete);
                if ($result==0)
                {
                    print("<B> Impossible d'executer la requete SELECT </B> ");
                    exit;
                }
                if (!mysql_num_rows($result))
                { echo "Aucun enreg. correspondant " ; }
                else
                {
                    while ($ligne =mysql_fetch_array($result))
                    {
                        $id_motif=$ligne['ID_MOTIF'];
                        $motif=$ligne['MOTIF'];
                        echo '<option value="' .$id_motif. '">' .$motif. "</option>\n";
                    }
                }
               
                
	}
	
	function select_employer()
	{
		
                
                $requete = "SELECT * FROM employer Order by ID_EMPLOYER" ;
                $result = mysql_query($requete);
                if ($result==0)
                {
                    print("<B> Impossible d'executer la requete SELECT </B> ");
                    exit;
                }
                if (!mysql_num_rows($result))
                { echo "Aucun enreg. correspondant " ; }
                else
                {
                    while ($ligne =mysql_fetch_array($result))
                    {
                        $id_employer=$ligne['ID_EMPLOYER'];
                        $nom=$ligne['NOM'];
                        echo '<option value="' .$id_employer. '">' .$nom. "</option>\n";
                    }
                }
               
                
	}
	
	function select_employer_fin()
	{
		
                
                //$requete = "SELECT * FROM employer Order by ID_EMPLOYER" ;
	$requete =" SELECT ID_EMPLOYER,NOM,TYPE_CONTRAT FROM employer,status where employer.ID_CONTRAT=status.ID_CONTRAT and (TYPE_CONTRAT='CDD' or TYPE_CONTRAT='STAGIAIRE')";
				
                $result = mysql_query($requete);
                if ($result==0)
                {
                    print("<B> Impossible d'executer la requete SELECT </B> ");
                    exit;
                }
                if (!mysql_num_rows($result))
                { echo "Aucun enreg. correspondant " ; }
                else
                {
                    while ($ligne =mysql_fetch_array($result))
                    {
                        $id_employer=$ligne['ID_EMPLOYER'];
                        $nom=$ligne['NOM'];
                        echo '<option value="' .$id_employer. '">' .$nom. "</option>\n";
                    }
                }
               
                
	}


		function select_id_type_deposition()
	{		
                
                $requete = "SELECT * FROM type_deposition Order by ID_TYPE_DEP" ;
                $result = mysql_query($requete);
                if ($result==0)
                {
                    print("<B> Impossible d'executer la requete SELECT </B> ");
                    exit;
                }
                if (!mysql_num_rows($result))
                { echo "Aucun enreg. correspondant " ; }
                else
                {
                    while ($ligne =mysql_fetch_array($result))
                    {
                        $id_type_dep=$ligne['ID_TYPE_DEP'];
                        $nom_type_deposition=$ligne['NOM'];
                        echo '<option value="' .$id_type_dep. '">' .$nom_type_deposition. "</option>\n";
                    }
                }                
	}
	
	function select_id_contrat()
	{		
                
                $requete = "SELECT * FROM status Order by ID_CONTRAT" ;
                $result = mysql_query($requete);
                if ($result==0)
                {
                    print("<B> Impossible d'executer la requete SELECT </B> ");
                    exit;
                }
                if (!mysql_num_rows($result))
                { echo "Aucun enreg. correspondant " ; }
                else
                {
                    while ($ligne =mysql_fetch_array($result))
                    {
                        //$id_contrat=$ligne['ID_CONTRAT'];
                        $nom_type_contrat=$ligne['TYPE_CONTRAT'];
                        echo '<option value="' .$nom_type_contrat. '">' .$nom_type_contrat. "</option>\n";
                    }
                }                
	}
	
	function select_id_deposition_dem_an()
	{		
                
                $requete = "SELECT * FROM deposition Order by ID_DEPOSITION" ;
                $result = mysql_query($requete);
                if ($result==0)
                {
                    print("<B> Impossible d'executer la requete SELECT </B> ");
                    exit;
                }
                if (!mysql_num_rows($result))
                { echo "Aucun enreg. correspondant " ; }
                else
                {
                    while ($ligne =mysql_fetch_array($result))
                    {
                        $id_dep=$ligne['ID_DEPOSITION'];
                        $id_dep1=$ligne['ID_DEPOSITION'];
                        echo '<option value="' .$id_type_dep. '">' .$id_dep1. "</option>\n";
                    }
                }                
	}
	
	// AFFICHER LA LISTE DES CLIENTS
	/*function Afficher_Liste_Client()
	{
		// création et envoi requete 
		$requete = "SELECT codecli,nom,adresse,solde FROM client Order by Codecli" ;
		$result = mysql_query($requete);
		if ($result==0)
		{
			print("<B> Impossible d'executer la requete SELECT </B> ");
			exit;
		}
		// Recupération
		if (!mysql_fetch_row($result))
		{ echo "Aucun enreg. correspondant " ; }
		else
		{
			echo "<TABLE BORDER =\"1\"> ";
			echo "<TR> <TH> CODECLI </TH> <TH>NOM </TH><TH>ADRESSE</TH> <TH>SOLDE</TH> </TR> \n" ;
			while ($ligne =mysql_fetch_row($result))
			{
				$codecli=$ligne[0];
				$nom=$ligne[1];
				$adresse=$ligne[2];
				$solde=$ligne[3];
				echo "<TR>
				<TD>$codecli</TD><TD>$nom</TD><TD>$adresse</
				TD>
				<TD>$solde</TD> </TR> \n";
			}
			echo ("</TABLE>");
		}
	}
	// AFFICHER LES INFORMATIONS D'UN CLIENT
	function Afficher_Client($codecli)
	{
		$requete = "SELECT * FROM client where codecli='$codecli'" ;
		$result = mysql_query($requete);
		if($result==0)
		{
			print("<B> Impossible d'executer la requete <B> ");
			exit;
		}
		// Recupération
		if(!mysql_num_rows($result))
		{ 
			echo "Aucun enreg. correspondant... $codecli " ; 
		}
		else
		{
			$ligne =mysql_fetch_row($result) ;
			$codecli=$ligne[0];
			$nom=$ligne[1];
			$adresse=$ligne[2];
			$solde=$ligne[3];
			//echo " Nom : $nom \n ";
			//echo " Adress : $adresse \n ";
			//echo " Solde : $solde \n ";
			echo " Nom... : $nom <BR>";
			echo " Adresse : $adresse <BR> ";
			echo " Solde : $solde <BR> ";
		}
	}
	// AFFICHER LES COMMANDES D'UN CLIENT
	function Afficher_Commande_Client($codecli)
	{
		$requete = "SELECT Nom,Libelle,Qtecom,Pu,qtecom*pu as Montant FROM client,Commande,produit where client.codecli=commande.codecli and commande.codepro=produit.codepro and client.codecli='$codecli'" ;
		$result = mysql_query($requete);
		if ($result==0)
		{
		print("<B> Impossible d'executer la requete <B> ");
		exit;
		}
	// Recupération
		if (!mysql_fetch_row($result))
		{ echo "Aucun enreg. correspondant... $codecli " ; }
		else
		{
		echo "<HTML>";
		echo "<HEAD> <TITLE> COMMANDES CLIENT </TITLE> </HEAD>";
		echo "<BODY>" ;
		echo "<TABLE BORDER =\"1\"> ";
		echo "<TR> <TH> NOM </TH> <TH>LIBELLE </TH>
		<TH>QTECOM</TH> <TH>PU</TH> <TH>MONTANT
		</TH> </TR> \n" ;
		while ($ligne =mysql_fetch_row($result))
		{
			$nom=$ligne[0];
			$libelle=$ligne[1];
			$qtecom=$ligne[2];
			$pu=$ligne[3];
			$montant=$ligne[4];
			echo "<TR> <TD>$nom</TD><TD>$libelle</TD>
			<TD>$qtecom</TD><TD>$pu</TD>
			<TD>$montant</TD></TR> \n";
		}
		}
		echo "</BODY>";
		echo "</HTML>" ;
		}
// SUPPRIMER UN CLIENT
	function Sup_Client($codecli)
	{
	$requete = "SELECT * FROM client where codecli='$codecli'" ;
	$result = mysql_query($requete);
	if ($result==0)
	{
	print("<B> Impossible d'executer la requete <B> ");
	exit;
	}
	// Recupération
	if (!mysql_num_rows($result))
	{ 
	echo "Aucun enreg. correspondant... $codecli " ; 
	}
	else
	{
	$requete = "DELETE FROM client where codecli='$codecli'" ;
	$result = mysql_query($requete);
	if ($result==0)
	{
	print("<B> Impossible d'executer la requete DELETE </B> ");
	exit;
	}
	else
	{echo "<B> SUPPRESSION REUSSIE </B> " ;}
	}
	}
	
	
	// MODIFIER UN CLIENT
	function Modif_Client($codecli,$nom,$adresse,$solde)
	{
	$requete = "SELECT * FROM client where codecli='$codecli'" ;
	$result = mysql_query($requete);
	if ($result==0)
	{
	print("<B> Impossible d'executer la requete <B> ");
	exit;
	}
	// Recupération
	if (!mysql_num_rows($result))
	{ 
	echo "Aucun enreg. correspondant... $codecli " ; 
	}
	else
	{
	// création et envoi requete 
	$requete = "UPDATE client SET nom = '$nom',adresse='$adresse',solde= '$solde' WHERE codecli='$codecli'" ;
	$result = mysql_query($requete);
	if ($result==0)
	{
		print("<B> Impossible d'executer la requete UPDATE </B> ");
		exit;
	}
	else
	{
		echo "<B> MODIFICATION REUSSIE </B> " ;}
	}
	}
	// AJOUTER UN CLIENT
	function Ajout_Client($codecli,$nom,$adresse,$solde)
	{
	$requete = "SELECT * FROM client where codecli='$codecli'" ;
	$result = mysql_query($requete);
	if ($result==0)
	{
	print("<B> Impossible d'executer la requete SELECT..
	</B> ");
	exit;
	}
	else
	if (mysql_num_rows($result)!=0)
	{ echo "Le client $codecli existe déjà " ; }
	else
	{
	// création et envoi requete 
		$requete = "INSERT INTO client(codecli,nom,adresse,solde) VALUES ('$codecli','$nom' ,'$adresse', '$solde' ) " ;
		$result = mysql_query($requete);
		if ($result==0)
		{
		print("<B> Impossible d'executer la requete INSERT
		</B> ");
		exit;
		}
		else
		{echo "<B> INSERTION REUSSIE </B> " ;}
	}
	}*/
?>

