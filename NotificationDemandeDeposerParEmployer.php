<script>

	function reffuser(id){
		if(confirm("Voulez vous refuser cette demande ?"))
		{
			ident=document.getElementById('id_deposition'+id).value;
			document.getElementById('form1').action="ReffuserDemande.php?code="+ident;
		}
	}
	function accepter_demande(id){
		if(confirm("Voulez vous accepter cette demande ?"))
		{
			ident=document.getElementById('id_deposition'+id).value;
			//ident=document.getElementById('id_employer'+id).value;
			type_deposition=document.getElementById('id_type_deposition'+id).value;
			document.getElementById('form1').action="AcceptationDeDemande.php?code="+ident+"&type_dep="+type_deposition;
		
		}
	}
</script>
<div class="display_bg" >
        <div class="navback">
            <div id="navigation">
                    <ul>
                        <li><a href="index.php?id=1" title="Accueil">Accueil</a></li>
                        <li><a href="#" title="Notification">Notification</a></li>
                        <li><a href="index.php?id=11" title="Démande déposé par employé">Démande déposé par employé</a></li>
                        
                        <!--<li><a href="index.php?id=8" title="MOTIF">MOTIF</a></li>-->
                    </ul>
             </div>
        </div>
    </div>
<div id="container">
<div id="content_container">
		<div id="content">
			<h1 align="center">DEMANDE NON VU</h1>

			<hr />
            <div class="contact_form">
            <div>
            
            <?php
			/*$mitady_chef="select * from departement where ID_DEPARTEMENT=".$_SESSION['departement'];
			if($mitady_chef=mysql_query($mitady_chef))
			{
				$mitady_chef_res=mysql_fetch_array($mitady_chef);
				if($mitady_chef_res['ID_EMPLOYER']==$_SESSION['id'])
				{
				}
				
			}
			else echo "tsy mande ny mitady chef zao an";*/
			
			/*function nbJours($debut, $fin) {
					//60 secondes X 60 minutes X 24 heures dans une journée
					$nbSecondes= 60*60*24;
			 
					$debut_ts = strtotime($debut);
					$fin_ts = strtotime($fin);
					$diff = $fin_ts - $debut_ts;
					return round($diff / $nbSecondes);
				}*/
			
				$req="select deposition.ID_DEPOSITION as depos_id,deposition.ID_MOTIF as depos_motif,ID_EMPLOYER,DATE_DE_DEMANDE,DATE_DEPART,JOURNE_DE_DEPART,DATE_RETOUR,RENOUVELMENT,JOURNE_DE_RETOUR,EXPLICATION,valider.ID_DEPOSITION as val_id_dep,ID_RESPONSABLE_SITE,ID_DEPARTEMENT,VALIDE_DEPARTEMENT,VALIDE_RESPONSABLE,DATE_VALIDATION_DEP,DATE_VALIDATION_RESPONSABLE from deposition,valider where valider.ID_DEPOSITION=deposition.ID_DEPOSITION and (valider.ID_RESPONSABLE_SITE=".$_SESSION['departement']." and VALIDE_RESPONSABLE = 'non vu' and VALIDE_DEPARTEMENT = 'oui' or valider.ID_DEPARTEMENT=".$_SESSION['departement']." and VALIDE_DEPARTEMENT = 'non vu') order by DATE_DE_DEMANDE DESC"; 
				if($req=mysql_query($req))
				{
					?>
                    <form method="post" id="form1" action="javascript:void(0)">
                    <?php
					$i=0;
					while($ligne=mysql_fetch_array($req))
					{
						$requete="select * from employer,valider,deposition where valider.ID_DEPOSITION=deposition.ID_DEPOSITION and employer.ID_EMPLOYER=deposition.ID_EMPLOYER and valider.ID_DEPOSITION=".$ligne['depos_id'];
						$requete=mysql_query($requete);
						$anarana=mysql_fetch_array($requete);
						$requete1="select * from employer,poste where employer.ID_POSTE=poste.ID_POSTE and poste.ID_POSTE=".$anarana['ID_POSTE'];
						$requete1=mysql_query($requete1);
						$anarana_poste=mysql_fetch_array($requete1);
						
						
						$requete2="select * from employer,departement where employer.ID_DEPARTEMENT=departement.ID_DEPARTEMENT and departement.ID_DEPARTEMENT=".$anarana['ID_DEPARTEMENT'];
						$requete2=mysql_query($requete2);
						$anarana_departement=mysql_fetch_array($requete2);
						
						
							$mitady_anarana_motif="select * from motif where ID_MOTIF=".$ligne['depos_motif'];
							$mitady_anarana_motif=mysql_query($mitady_anarana_motif);
							$req_mitady_anarana_motif=mysql_fetch_array($mitady_anarana_motif);
							$motif=$req_mitady_anarana_motif['ID_TYPE_DEP'];
							$motif_nom=$req_mitady_anarana_motif['MOTIF'];
							
							$conger_perm="select * from type_deposition where ID_TYPE_DEP =".$motif;
							$conger_perm=mysql_query($conger_perm) or die(mysql_error());
							$req_conger_perm=mysql_fetch_array($conger_perm);
							$id_type_deposition=$req_conger_perm['ID_TYPE_DEP'];
							$type_deposition=$req_conger_perm['NOM'];
						?>
                         <p>
                           <div class="div_accept" style="border:1px solid #CCCCCC;border-radius:5px;padding:20px; box-shadow:5px 5px 5px #CCCCCC;">
                           <input id="id_deposition<?php echo $i;?>" type="hidden" value="<?php echo $ligne['depos_id'];?>" />
                           <input id="id_employer<?php echo $i;?>" type="hidden" value="<?php echo $ligne['ID_EMPLOYER'];?>" />
                           <input id="id_type_deposition<?php echo $i;?>" type="hidden" value="<?php echo $id_type_deposition;?>" />
                           
                            <div><span style="color:#00CCFF;">NOM : </span><?php echo $anarana['NOM'];?></div>
                            <div><span style="color:#00CCFF;">PRENOM : </span><?php echo $anarana['PRENOM'];?></div>
                            <div><span style="color:#00CCFF;">DEPARTEMENT : </span><?php echo $anarana_departement['NOM_DEPARTEMENT']?></div>
                            
                            <div><span style="color:#00CCFF;">POSTE : </span><?php echo $anarana_poste['NOM_POSTE']?></div>
                            <div><span style="color:#00CCFF;">SOLDE : </span><?php echo $anarana['SOLDE_CONGE']." jours"?></div>
                            <br>
                            <div><u>Demande de <?php echo $type_deposition?></u>:
							<?php 
								$date=$ligne['DATE_DE_DEMANDE']; List($annee,$mois,$jour)=explode('-',$date);
								echo $jour.'-'.$mois.'-'.$annee;
							?></div>
                            <?php $date=$ligne['DATE_DEPART']; List($annee,$mois,$jour)=explode('-',$date);
								$date1=$ligne['DATE_RETOUR']; List($annee1,$mois1,$jour1)=explode('-',$date1);
								$date_dep=$ligne['DATE_VALIDATION_DEP']; List($annee_dep,$mois_dep,$jour_dep)=explode('-',$date_dep);
			
								echo '<span style="color:#00CCFF"> DATE DE DEPART : </span>'.$jour.'-'.$mois.'-'.$annee.'    '.$ligne['JOURNE_DE_DEPART'].'<br>';
                                 echo '<span style="color:#00CCFF"> DATE DE RETOUR : </span>'.$jour1.'-'.$mois1.'-'.$annee1.'    '.$ligne['JOURNE_DE_RETOUR'].'<br>';?>
                            <div><span style="color:#00CCFF;">Motif : </span><?php echo $motif_nom?></div>
                            <div><span style="color:#00CCFF;">Cause : </span><?php echo $ligne['EXPLICATION']?></div><br>
                            <?php
								if($_SESSION['departement']!=$anarana['ID_DEPARTEMENT'])
								{
			
                                    echo '<span style="color:#00CCFF"> Valider par son chef de departement le </span>'.$jour_dep.'-'.$mois_dep.'-'.$annee_dep.'    '.$ligne['JOURNE_DE_DEPART'].'<br>';
                                    
								}
						
						?>
                        <div style="float:right"><button onclick="accepter_demande(<?php echo $i?>);" name="accepter" type="submit" >Accepter</button><?php echo "     ";?><button type="submit" onclick="reffuser(<?php echo $i?>)" name="refuser">Refuser</button></div>
                        <br>
                       
                        </div>
                        </p>
                        
                        <?php
						$i++;
					}
					
				?>
                </form>
                <?php
				}
				else echo "demmande vide".mysql_error();
				
			
			?>
            </div>
            </div>
            </div>
            
		</div>
		<div class="spacer"></div>
	</div>
</div>