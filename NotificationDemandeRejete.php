<div class="display_bg" >
        <div class="navback">
            <div id="navigation">
                    <ul>
                        <li><a href="index.php?id=1" title="Accueil">Accueil</a></li>
                        <li><a href="#" title="Notification">Notification</a></li>
                        <li><a href="index.php?id=9" title="Démande rejeté">Démande rejeté</a></li>
                        
                        <!--<li><a href="index.php?id=8" title="MOTIF">MOTIF</a></li>-->
                    </ul>
             </div>
        </div>
    </div>
<div id="container">
<div id="content_container">
		<div id="content">
			<h1 align="center">LISTES DES DEMANDES REJETEES</h1>

			<hr />
            <div>
            <?php
			$mamova="update valider,deposition set VU_UTILISATEUR='vu' where valider.ID_DEPOSITION=deposition.ID_DEPOSITION and deposition.ID_EMPLOYER=".$_SESSION['id']." and ( VALIDE_DEPARTEMENT = 'non' or VALIDE_RESPONSABLE = 'non') ";
			if(mysql_query($mamova)) ;
			else echo "tsy niova zay an ".mysql_error();
			
				$req="select * from valider,deposition where valider.ID_DEPOSITION=deposition.ID_DEPOSITION and deposition.ID_EMPLOYER=".$_SESSION['id']." and ( VALIDE_DEPARTEMENT = 'non' or VALIDE_RESPONSABLE = 'non') order by DATE_DE_DEMANDE DESC";
				$resultat=mysql_query($req);
					if($resultat)
					{
						while($ligne=mysql_fetch_array($resultat))
						{
							
							$mitady_anarana_motif="select * from motif where ID_MOTIF=".$ligne['ID_MOTIF'];
							$mitady_anarana_motif=mysql_query($mitady_anarana_motif);
							$req_mitady_anarana_motif=mysql_fetch_array($mitady_anarana_motif);
							$motif=$req_mitady_anarana_motif['ID_TYPE_DEP'];
							$motif_nom=$req_mitady_anarana_motif['MOTIF'];
							
							$conger_perm="select * from type_deposition where ID_TYPE_DEP =".$motif;
							$conger_perm=mysql_query($conger_perm);
							$req_conger_perm=mysql_fetch_array($conger_perm);
							$type_deposition=$req_conger_perm['NOM']
							?>
                           <p>
                           <div class="div_accept" style="border:1px solid #CCCCCC;border-radius:5px;padding:10px; box-shadow:5px 5px 5px #CCCCCC;">
                            <div><span style="color:#00CCFF;">La demande qui a deposé le : </span>
                            <?php 
								$date=$ligne['DATE_DE_DEMANDE']; List($annee,$mois,$jour)=explode('-',$date);
								echo $jour.'-'.$mois.'-'.$annee;
								echo " est rejeté.";
							?>
                            </div>
                            <div style="padding:5px 20px;">
								<?php 
								echo "Information :<br>";
								$date=$ligne['DATE_DEPART']; List($annee,$mois,$jour)=explode('-',$date);
								$date1=$ligne['DATE_RETOUR']; List($annee1,$mois1,$jour1)=explode('-',$date1);
								$date_dep=$ligne['DATE_VALIDATION_DEP']; List($annee_dep,$mois_dep,$jour_dep)=explode('-',$date_dep);
							$date_resp=$ligne['DATE_VALIDATION_RESPONSABLE']; List($annee_resp,$mois_resp,$jour_resp)=explode('-',$date_resp);
								echo '<span style="color:#00CCFF"> DATE DE DEPART : </span>'.$jour.'-'.$mois.'-'.$annee.'    '.$ligne['JOURNE_DE_DEPART'].'<br>';
                                 echo '<span style="color:#00CCFF"> DATE DE RETOUR : </span>'.$jour1.'-'.$mois1.'-'.$annee1.'    '.$ligne['JOURNE_DE_RETOUR'].'<br>';
                                 
                                 
                                 $req_chef="SELECT * from departement where ID_DEPARTEMENT =".$ligne['ID_DEPARTEMENT']." or ID_DEPARTEMENT=".$ligne['ID_RESPONSABLE_SITE'] ;
							if($req_chef=mysql_query($req_chef))
							{
								while($res_chef=mysql_fetch_array($req_chef))
								{
									$chef=$res_chef['ID_EMPLOYER'];
									
									$req_ananrana="SELECT * from employer where ID_EMPLOYER = ".$chef;
									if($req_anarana=mysql_query($req_ananrana))
									{
										/*$req_anarana=mysql_fetch_array($req_anarana);
										$nom=$req_anarana['NOM'];
										$prenom=$req_anarana['PRENOM'];
										if($_SESSION['id']!=$chef)
										{
											if($ligne['VALIDE_DEPARTEMENT']=='non' && $ligne['VALIDE_RESPONSABLE']=='non' )
											{
											echo "<span style=\"color:#00CCFF\">Rejeté par : </span>".$nom ." ".$prenom." ";
											if($req_anarana['ID_DEPARTEMENT']!=$ligne['ID_RESPONSABLE_SITE'])
											echo " <span style=\"color:#00CCFF\">le : </span>".$jour_dep.'-'.$mois_dep.'-'.$annee_dep."<br>";continue;
											}
											if($ligne['VALIDE_RESPONSABLE']=='non' && $ligne['VALIDE_DEPARTEMENT']=='oui')
											{
											echo "<span style=\"color:#00CCFF\">Rejeté par : </span>".$nom ." ".$prenom." ";
											}
											
										}
										if($req_anarana['ID_DEPARTEMENT']==$ligne['ID_RESPONSABLE_SITE'])
										echo " <span style=\"color:#00CCFF\">le : </span>".$jour_resp.'-'.$mois_resp.'-'.$annee_resp."<br>";*/
									}
									else echo "mis diso an";
								}
							}
							else echo "misy diso koa ny ao";
                             ?>
                            </div>
                            </div>
                            </p>
                            <?php
						}?>
						
					<?php
                    }
				
				
			?>
            
			</div>
		</div>
		<div class="spacer"></div>
	</div>
</div>