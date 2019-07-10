<div class="display_bg" >
        <div class="navback">
            <div id="navigation">
                    <ul>
                        <li><a href="index.php?id=1" title="Accueil">Accueil</a></li>
                        <li><a href="#" title="Notification">Notification</a></li>
                        <li><a href="index.php?id=8" title="Démande accepté">Démande accepté</a></li>
                        
                        <!--<li><a href="index.php?id=8" title="MOTIF">MOTIF</a></li>-->
                    </ul>
             </div>
        </div>
    </div>
<div id="container">
<div id="content_container">
		<div id="content">
			<h1 align="center">LISTES DES DEMANDES ACCEPTEES</h1>

			<hr />
            <div class="contact_form">
            <div>
                <?php
				/*function nbJours($debut, $fin) {
					//60 secondes X 60 minutes X 24 heures dans une journée
					$nbSecondes= 60*60*24;
			 
					$debut_ts = strtotime($debut);
					$fin_ts = strtotime($fin);
					$diff = $fin_ts - $debut_ts;
					return round($diff / $nbSecondes);
				}*/
				
				$mamova="update valider,deposition set VU_UTILISATEUR='vu' where valider.ID_DEPOSITION=deposition.ID_DEPOSITION and deposition.ID_EMPLOYER=".$_SESSION['id']." and VALIDE_DEPARTEMENT = 'oui' and VALIDE_RESPONSABLE = 'oui' ";
			mysql_query($mamova);
				
				
					$req="select deposition.ID_DEPOSITION as id_dep_depo,ID_RESPONSABLE_SITE,ID_DEPARTEMENT,VALIDE_DEPARTEMENT,DATE_VALIDATION_DEP,VALIDE_RESPONSABLE,DATE_VALIDATION_RESPONSABLE,VU_UTILISATEUR,valider.ID_DEPOSITION as id_dep_val,ID_MOTIF,ID_EMPLOYER,DATE_DE_DEMANDE,DATE_DEPART,JOURNE_DE_DEPART,DATE_RETOUR,JOURNE_DE_RETOUR,EXPLICATION from valider,deposition where valider.ID_DEPOSITION=deposition.ID_DEPOSITION and deposition.ID_EMPLOYER=".$_SESSION['id']." and VALIDE_DEPARTEMENT = 'oui' and VALIDE_RESPONSABLE = 'oui' and DATE_DEPART > now() order by DATE_DE_DEMANDE DESC";
					//." and VALIDE_RESPONSABLE = 'oui' and DATE_VALIDATION_DEP='oui'";
					//."and explication_de_demande.ID_DEPOSITION=deposition.ID_DEPOSITION";
					// and explication_de_demande.ID_DEPOSITION=deposition.ID_DEPOSITION
					//,explication_de_demande
					$resultat=mysql_query($req);
					if($resultat)
					{
						?>
                        <form method="post" id="form1" action="javascript:void(0)">
                        
                        <?php
						$i=0;
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
							$type_deposition=$req_conger_perm['NOM'];
							?>
                           <p>
                           <div class="div_accept" style="border:1px solid #CCCCCC;border-radius:5px;padding:10px; box-shadow:5px 5px 5px #CCCCCC;">
                            <div><span style="color:#00CCFF;"><input name="txt_id_dep_depo<?php echo $i;?>" type="hidden" value="<?php echo $ligne['id_dep_depo'];?>" />Vous avez déposé le demande le :</span>
							<?php 
								$date=$ligne['DATE_DE_DEMANDE']; List($annee,$mois,$jour)=explode('-',$date);
								echo $jour.'-'.$mois.'-'.$annee;
							?>
                            </div>
                            <div style="padding:5px 20px;">
                            <?php echo $type_deposition; ?> pendant : <?php 
							$date=$ligne['DATE_DEPART']; List($annee,$mois,$jour)=explode('-',$date);
							$date1=$ligne['DATE_RETOUR']; List($annee1,$mois1,$jour1)=explode('-',$date1);
							$date_dep=$ligne['DATE_VALIDATION_DEP']; List($annee_dep,$mois_dep,$jour_dep)=explode('-',$date_dep);
							$date_resp=$ligne['DATE_VALIDATION_RESPONSABLE']; List($annee_resp,$mois_resp,$jour_resp)=explode('-',$date_resp);
			 			
													
							echo nbJours($date, $date1).'jours <br>';
							?>
                            
                            <?php echo '<span style="color:#00CCFF"> DATE DE DEPART : </span>'.$jour.'-'.$mois.'-'.$annee.'    '.$ligne['JOURNE_DE_DEPART'].'<br>';
							echo '<span style="color:#00CCFF"> DATE DE RETOUR : </span>'.$jour1.'-'.$mois1.'-'.$annee1.'    '.$ligne['JOURNE_DE_RETOUR'].'<br>';
							echo '<span style="color:#00CCFF"> Type de motif : </span>'.$motif_nom.'<br>';
							echo '<span style="color:#00CCFF"> Motif : </span>'.$ligne['EXPLICATION'].'<br><br>';
							?>
							<div style="float:right;"><button onclick="annuler_demande(id)" name="Annuler" type="submit" >Annuler</button></div>
                           	<?php
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
											echo "<span style=\"color:#00CCFF\">Valider par : </span>".$nom ." ".$prenom." ";
											if($req_anarana['ID_DEPARTEMENT']!=$ligne['ID_RESPONSABLE_SITE'])
											echo " <span style=\"color:#00CCFF\">le : </span>".$jour_dep.'-'.$mois_dep.'-'.$annee_dep."<br>";
										}
										if($req_anarana['ID_DEPARTEMENT']==$ligne['ID_RESPONSABLE_SITE'])
										echo " <span style=\"color:#00CCFF\">le : </span>".$jour_resp.'-'.$mois_resp.'-'.$annee_resp."<br>";
									}
									else echo "mis diso an";
								}
							}
							else echo "misy diso koa ny ao";
							
							
						
                             ?>
                              
                            </div>
                            </div>
                            </p>
                            </form>
                            <?php
							$i++;
						}
						
					}
					else echo mysql_error();
					
					
				?>
            </div>  
		</div>
		</div>
		<div class="spacer"></div>
	</div>
</div>
<script>
function annuler_demande(id){
		if(confirm("Voulez vous annuler cette demande ?"))
		{
			ident=document.getElementById('id_deposition'+id).value;
			//ident=document.getElementById('id_employer'+id).value;
			type_deposition=document.getElementById('id_type_deposition'+id).value;
			document.getElementById('form1').action="AcceptationDeDemande.php?code="+ident+"&type_dep="+type_deposition;
		
		}
	}
</script>