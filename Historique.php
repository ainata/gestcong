<div class="display_bg" >
        <div class="navback">
            <div id="navigation">
                    <ul>
                        <li><a href="index.php?id=1" title="Accueil">Accueil</a></li>
                        <li><a href="#" title="Plus">Plus</a></li>
                        <li><a href="index.php?id=16" title="Historique">Historique</a></li>
                        
                        <!--<li><a href="index.php?id=8" title="MOTIF">MOTIF</a></li>-->
                    </ul>
             </div>
        </div>
    </div>

<div id="container">
<div id="content_container">
		<div id="content">
			<h1 align="center">HISTORIQUE</h1>

			<hr />
            <div class="contact_form">
            
       		<?php
			function date_fr($date)
			{
				List($annee,$mois,$jour)=explode('-',$date);
				return $jour."-".$mois."-".$annee;
			}
			
			/*$req_chef="select * fom departement where ID_EMPLOYER=".$SESSION['id'];
			$req_chef=mysql_query($req_chef);
			if(mysql_num_rows($req_chef))
			{*/
			
			//$req_verifier_si_resp="select * from va
			/*$req="select * from deposition,valider where deposition.ID_DEPOSITION=valider.ID_DEPOSITION and (VALIDE_RESPONSABLE='oui' or VALIDE_RESPONSABLE='non') and  ID_RESPONSABLE_SITE=".$_SESSION['departement']." and ID_EMPLOYER <> ".$_SESSION['id']." order by DATE_VALIDATION_RESPONSABLE DESC ";
			if($req=mysql_query($req))
			{
				while($row_req=mysql_fetch_array($req))
				{
					$req_employer="select * from employer where ID_EMPLOYER=".$row_req['ID_EMPLOYER'];
					$req_employer=mysql_query($req_employer) or die(mysql_error());
					$row_employer=mysql_fetch_array($req_employer);
					$nom=strtoupper($row_employer['NOM']);
					$prenom=$row_employer['PRENOM'];
					
					
					
					
					$req_departement="select * from departement where ID_DEPARTEMENT=".$row_employer['ID_DEPARTEMENT'];
					$req_departement=mysql_query($req_departement) or die(mysql_error());
					$row_departement=mysql_fetch_array($req_departement);
					$departement=strtoupper($row_departement['NOM_DEPARTEMENT']);
					
							$mitady_anarana_motif="select * from motif where ID_MOTIF=".$row_req['ID_MOTIF'];
							$mitady_anarana_motif=mysql_query($mitady_anarana_motif);
							$req_mitady_anarana_motif=mysql_fetch_array($mitady_anarana_motif);
							$motif=$req_mitady_anarana_motif['ID_TYPE_DEP'];
							$motif_nom=$req_mitady_anarana_motif['MOTIF'];
							
							$conger_perm="select * from type_deposition where ID_TYPE_DEP =".$motif;
							$conger_perm=mysql_query($conger_perm);
							$req_conger_perm=mysql_fetch_array($conger_perm);
							$type_deposition=$req_conger_perm['NOM'];
					
					
					if($row_req['VALIDE_RESPONSABLE']=='oui')
					{
					?>
					
					<div class="info" style="border:1px solid #CCCCCC;border-radius:5px;padding:20px; box-shadow:5px 5px 5px #CCCCCC;" ><span style="color:#00CCFF;">Vous avez accepter la demande de <?php echo $type_deposition;?> </span><?php echo $nom." ".$prenom." le ".date_fr($row_req['DATE_VALIDATION_RESPONSABLE'])." <br><span style=\"color:#00CCFF;\">Departement :</span>".$departement;?>
                    <div><span style="color:#00CCFF;"> Motif: </span><?php echo $motif_nom ?> .Date de depart: <?php echo date_fr($row_req['DATE_DEPART'])." ".$row_req['JOURNE_DE_DEPART'];?> et la date de retour: <?php echo date_fr($row_req['DATE_RETOUR'])." ".$row_req['JOURNE_DE_RETOUR'] ?></div>
                    <div style="border-top:solid 1px #CCCCCC;"><span style="color:#00CCFF;">Cause: </span><?php echo $row_req['EXPLICATION'];?></div>
                    
                    </div>
                    
                    <hr />
					<?php
					}
					if($row_req['VALIDE_RESPONSABLE']=='non')
					{
					?>
					
					<div class="info" style="border:1px solid #CCCCCC;border-radius:5px;padding:20px; box-shadow:5px 5px 5px #CCCCCC;"><span style="color:#00CCFF;">Vous avez rejeter la demande de <?php echo $type_deposition;?> </span><?php echo $nom." ".$prenom." le ".date_fr($row_req['DATE_VALIDATION_RESPONSABLE'])." <br><span style=\"color:#00CCFF;\">Departement :</span>".$departement;?> 
                      <div><span style="color:#00CCFF;">Motif:</span> <?php echo $motif_nom ?> .Date de depart: <?php echo date_fr($row_req['DATE_DEPART'])." ".$row_req['JOURNE_DE_DEPART'];?> et la date de retour: <?php echo date_fr($row_req['DATE_RETOUR'])." ".$row_req['JOURNE_DE_RETOUR'] ?></div>
                      
                      <div style="border-top:solid 1px #CCCCCC;"><span style="color:#00CCFF;">Cause: </span><?php echo $row_req['EXPLICATION'];?></div>
                    </div>
                 
                    <hr />
					<?php
					}
					
				}
			}
			else
			echo mysql_error();
			//}
			*/
			
			$requete="select * from historique where ID_EMPLOYER=".$_SESSION['id'];
			$requete=mysql_query($requete);
			?>
            Vous avez :
            <hr />
            
            <?php
			
			while($ligne=mysql_fetch_array($requete))
			{?>
				<div class="info" style="border:1px solid #CCCCCC;border-radius:5px;padding:20px; box-shadow:5px 5px 5px #CCCCCC;">
                <span style="color:#00CCFF"> <?php  echo date('H\:i\:s',$ligne['HEURE'])." ".date_fr($ligne['DATE_HISTORIQUE'])?></span><br /><?php echo htmlentities(stripslashes($ligne['HISTOIRE']))?></div>
                <br />
                      <?php
			}
            ?>
            </div>
		</div>
		<div class="spacer"></div>
	</div>
</div>