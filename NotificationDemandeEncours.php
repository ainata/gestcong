<div class="display_bg" >
        <div class="navback">
            <div id="navigation">
                    <ul>
                        <li><a href="index.php?id=1" title="Accueil">Accueil</a></li>
                        <li><a href="#" title="Notification">Notification</a></li>
                        <li><a href="index.php?id=10" title="Démande en cours">Démande en cours</a></li>
                        
                        <!--<li><a href="index.php?id=8" title="MOTIF">MOTIF</a></li>-->
                    </ul>
             </div>
        </div>
    </div>
<div id="container">
<div id="content_container">
		<div id="content">
			<h1 align="center">LISTES DES DEMANDES ENCOURS</h1>

			<hr />
            <div>
            <?php
			
			
				$req="select * from valider,deposition where valider.ID_DEPOSITION=deposition.ID_DEPOSITION and deposition.ID_EMPLOYER=".$_SESSION['id']." and ( VALIDE_DEPARTEMENT = 'non vu' or VALIDE_RESPONSABLE = 'non vu') order by DATE_DE_DEMANDE DESC";
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
                            <div><span style="color:#00CCFF;">La demande qui a été deposé le : </span>
                            <?php 
								$date=$ligne['DATE_DE_DEMANDE']; List($annee,$mois,$jour)=explode('-',$date);
								echo $jour.'-'.$mois.'-'.$annee;
								echo " est en cours.";
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
                                 echo '<span style="color:#00CCFF"> Type de motif : </span>'.$motif_nom.'<br>';
									echo '<span style="color:#00CCFF"> Motif : </span>'.$ligne['EXPLICATION'].'<br><br>';
                                 
                                 $req_chef="SELECT * from departement where ID_DEPARTEMENT =".$ligne['ID_DEPARTEMENT']." or ID_DEPARTEMENT=".$ligne['ID_RESPONSABLE_SITE'] ;
							if($req_chef=mysql_query($req_chef))
							{
								while($res_chef=mysql_fetch_array($req_chef))
								{
									$chef=$res_chef['ID_EMPLOYER'];
									
									$req_ananrana="SELECT * from employer where ID_EMPLOYER = ".$chef;
									if($req_anarana=mysql_query($req_ananrana))
									{
										$req_anarana=mysql_fetch_array($req_anarana);
										$nom=$req_anarana['NOM'];
										$prenom=$req_anarana['PRENOM'];
										if($_SESSION['id']!=$chef)
										{
											
												if($ligne['VALIDE_DEPARTEMENT']=='non vu' && $ligne['ID_DEPARTEMENT']==$req_anarana['ID_DEPARTEMENT'])
												{
												echo $nom ." ".$prenom." "."<span >n'a encore vu </span><br>";continue;
												}
												if($ligne['VALIDE_RESPONSABLE']=='non vu' && $ligne['ID_RESPONSABLE_SITE']==$req_anarana['ID_DEPARTEMENT'])
												{
												echo $nom ." ".$prenom." "."<span >n'a encore vu </span><br>";
												}
											
											/*else
											if($ligne['VALIDE_DEPARTEMENT']=='non vu' && $ligne['VALIDE_RESPONSABLE']=='non vu')
											{
											}*/
											
										}
										
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