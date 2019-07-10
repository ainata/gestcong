
 <div class="display_bg" >
        <div class="navback">
            <div id="navigation">
                    <ul>
                        <li><a href="index.php?id=1" title="ACCUEIL">Accueil</a></li>
                        <!--<li><a href="index.php?id=2" title="EMPLOYER">EMPLOYER</a></li>
                        <li><a href="index.php?id=3" title="DEPOSITION">DEPOSITION</a></li>
                        
                        <li><a href="index.php?id=5" title="MOTIF">MOTIF</a></li>-->
                    </ul>
             </div>
        </div>
    
        
    </div>
<div id="container">
<div id="content_container">
		<div id="content" style="width:90%">
			<h1 style="text-align:center">BIENVENUE</h1>

			<hr />
			<div class="contact_form">
				
                <?php
				
				function date_format_fr($daty)
				{
					
					List($annee,$mois,$jour)=explode('-',$daty);
					return $jour."-".$mois."-".$annee;
				}
			
				function liste_de_demande_accepter_refuser($titr_tab,$val,$dep_val,$id_dep_ou_resp)
				{
					$req_verifier="select * from valider where ID_RESPONSABLE_SITE=".$_SESSION['departement'];
					$req_verifier=mysql_query($req_verifier);
					?>
                    
                     <table  cellpadding="0" cellspacing="0" border="0" class="display example"  style="font-size:12px">
                        <thead>
                            <tr  bgcolor="#FAAFAF">
                            	<th >N°</th>
                            	<th >Nom</th>
                                <th >Prenom</th>
                                <?php if(mysql_num_rows($req_verifier))
								{
									?>
                                <th >Departement</th>
                                <?php
								}?>
                                <th >Poste</th>
                                <th ><?php echo $titr_tab;?></th>
                                <th >Date de depart</th>
                                <th >Date d'entree</th>
                                <th >Conge ou Permission</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        <?php
						$req="select * from valider,deposition where valider.ID_DEPOSITION=deposition.ID_DEPOSITION and valider.".$id_dep_ou_resp."=".$_SESSION['departement']." and ".$dep_val."='".$val."' and ID_EMPLOYER<>".$_SESSION['id'];
						if($req=mysql_query($req))
						{
							while($andalany=mysql_fetch_array($req))
							{
								$req1="select * from employer,poste,departement where poste.ID_POSTE=employer.ID_POSTE and employer.ID_DEPARTEMENT=departement.ID_DEPARTEMENT  and employer.ID_EMPLOYER=".$andalany['ID_EMPLOYER'];
								if($req1=mysql_query($req1))
								{
									$anarana=mysql_fetch_array($req1);
									$req_motif="select * from motif,type_deposition where type_deposition.ID_TYPE_DEP=motif.ID_TYPE_DEP and ID_MOTIF=".$andalany['ID_MOTIF'];
									$req_motif=mysql_query($req_motif);
									$anarana_motif=mysql_fetch_array($req_motif);
									
								
								?>
                                <tr   height="35">
                                    <td ><?php echo $anarana['MATRICULE']; ?></td>
                                    <td ><?php echo $anarana['NOM']; ?></td>
                                    <td ><?php echo $anarana['PRENOM']; ?></td>
                                     <?php if(mysql_num_rows($req_verifier))
									{
									?>
                                    <td ><?php echo $anarana['NOM_DEPARTEMENT']; ?></td>
                                    <?php
									}
									?>
                                    <td ><?php echo $anarana['NOM_POSTE']; ?></td>
                                    <td ><?php echo date_format_fr($andalany['DATE_VALIDATION_DEP']); ?></td>
                                    <td ><?php echo date_format_fr($andalany['DATE_DEPART']); ?></td>
                                    <td ><?php echo date_format_fr($andalany['DATE_RETOUR']); ?></td>
                                    <td ><?php echo $anarana_motif['NOM']; ?></td>
                            	</tr>
                                <?php
								}
								else echo mysql_error();
							}
						
						}?>
						
						  </tbody>
                        <tfoot>
                            <tr bgcolor="#faafaf" align="center"  >
                            	<th >N°</th>
                            	<th>Nom</th>
                                <th >Prenom</th>
                                   <?php if(mysql_num_rows($req_verifier))
								{
									?>
                                <th >Departement</th>
                                <?php
								}?>
                                <th >Poste</th>
                                <th ><?php echo $titr_tab;?></th>
                                <th >Date de depart</th>
                                <th >Date d'entree</th>
                                <th >Conge ou Permission</th>
                            </tr>
                        </tfoot>
                        </table>
                    
                    <?php
				}
				
				$req_reste_solde="select * from employer where ID_EMPLOYER=".$_SESSION['id'];
				if($req_reste_solde=mysql_query($req_reste_solde))
				{
					$res=mysql_fetch_array($req_reste_solde);
					echo "<div style=\"border:1px solid #CCCCCC;border-radius:5px;padding:20px;text-align:center;color:#faafaf;background-color:#fe2222;\">Le reste de votre solde de congé est de : ".$res['SOLDE_CONGE']." jour(s)</div>";
				
					
				}
				else echo mysql_error();
				
			
				
				echo "<hr>";
				
				//$req_admin="seclect * from departement where ID_DEPARTEMENT=
				if($_SESSION['departement']!=4 || $_SESSION['departement']!=5 )
				{
			  $requete = "SELECT employer.ID_EMPLOYER as id_emp,MATRICULE,PHOTO,NOM,PRENOM,DATE_DEPART,JOURNE_DE_DEPART,DATE_RETOUR,DATE_VALIDATION_RESPONSABLE from deposition,employer,valider where employer.ID_EMPLOYER=deposition.ID_EMPLOYER and  deposition.ID_DEPOSITION=valider.ID_DEPOSITION  and deposition.ID_EMPLOYER<>".$_SESSION['id']." and VALIDE_RESPONSABLE='oui' and DATE_DEPART<=now() and DATE_RETOUR>=now() and (employer.ID_DEPARTEMENT=".$_SESSION['departement']." or valider.ID_RESPONSABLE_SITE=".$_SESSION['departement'].")";
                        $result = mysql_query($requete);
                        if ($result==0)
                        {
                        print("<B> Impossible d'executer la requete SELECT </B> ");
                        exit;
                        }
                        if (!mysql_num_rows($result))
                        { 
                        echo "<div style=\"margin-left:50px;\">Tout le monde est present</div>" ; 
                        }
                        else
                        {
                            while ($ligne =mysql_fetch_array($result))
                            { 
							$matricule=$ligne['MATRICULE'];
							$nom=$ligne['NOM'];
							$prenom=$ligne['PRENOM'];
							$photo=$ligne['PHOTO'];
                            $date_depart=$ligne['DATE_DEPART'];
                            $date_retour=$ligne['DATE_RETOUR'];
                          	$date = date("Y-m-d");
							
							
						/*	if($date_depart <= $date and $date<=$date_retour)
							{*/
								
								if($date_depart==$date){?>
                                
                                
                                
								<p style="border:1px solid #CCCCCC;border-radius:5px;padding:20px; box-shadow:5px 5px 5px #CCCCCC;"> <img src="upload/<?php echo $photo?>" width="35px" height="35px" style="margin-top:0px"> <span style="color:#0081c2" ><?php echo $nom." ".$prenom ?></span> est en congé depuis aujourd'hui jusqu'à <?php echo $date_retour ?><p><?php
								}
								else {?><p style="border:1px solid #CCCCCC;border-radius:5px;padding:20px; box-shadow:5px 5px 5px #CCCCCC;" > <img src="upload/<?php echo $photo?>" width="35px" height="35px" style="margin-top:0px"> <span style="color:#0081c2" ><?php echo $nom." ".$prenom ?></span> est en congé depuis <?php echo $date_depart." jusqu'à ".$date_retour; ?></p>
								<?php
                                }
                           /*	 }
							 else
							 {
								 echo "tous est la";
							 }*/
							 
							}
                        }
				}
				else
				{
					$requete = "SELECT employer.ID_EMPLOYER as id_emp,employer.ID_DEPARTEMENT as id_dep,MATRICULE,NOM,PHOTO,PRENOM,DATE_DEPART,JOURNE_DE_DEPART,DATE_RETOUR,DATE_VALIDATION_RESPONSABLE from deposition,employer,valider where employer.ID_EMPLOYER=deposition.ID_EMPLOYER and  deposition.ID_DEPOSITION=valider.ID_DEPOSITION and deposition.ID_EMPLOYER<>".$_SESSION['id']." and VALIDE_RESPONSABLE='oui' and DATE_DEPART<=now() and DATE_RETOUR>=now() order by  id_dep";
                        $result = mysql_query($requete);
						 if ($result==0)
                        {
                        print("<B> Impossible d'executer la requete SELECT </B> ");
                        exit;
                        }
                        if (!mysql_num_rows($result))
                        { 
                        echo "<div style=\"margin-left:50px;\">Tout le monde est present</div>" ; 
                        }
                        else
                        {
                            while ($ligne =mysql_fetch_array($result))
                            { 
							$matricule=$ligne['MATRICULE'];
							$nom=$ligne['NOM'];
							$prenom=$ligne['PRENOM'];
							$photo=$ligne['PHOTO'];
                            $date_depart=$ligne['DATE_DEPART'];
                            $date_retour=$ligne['DATE_RETOUR'];
                          	$date = date("Y-m-d");
							$departement=$ligne['id_dep'];
							
							$req_departement="select * from departement where ID_DEPARTEMENT=".$departement;
							$req_departement=mysql_query($req_departement);
							$row_departement=mysql_fetch_array($req_departement);
							
						/*	if($date_depart <= $date and $date<=$date_retour)
							{*/
								
								if($date_depart==$date){?>
								<p style="border:1px solid #CCCCCC;border-radius:5px;padding:20px; box-shadow:5px 5px 5px #CCCCCC;"> <img src="upload/<?php echo $photo?>" width="35px" height="35px" style="margin-top:0px"> <span style="color:#0081c2" ><?php echo $nom." ".$prenom ?></span> est en congé depuis aujourd'hui jusqu'à <?php echo $date_retour ?>.<span style="color:#0081c2" >Departement :</span><?php echo $row_departement['NOM_DEPARTEMENT'];?><p><?php
								}
								else {?><p style="border:1px solid #CCCCCC;border-radius:5px;padding:20px; box-shadow:5px 5px 5px #CCCCCC;">  <img src="upload/<?php echo $photo?>" width="35px" height="35px" style="margin-top:0px"> <span style="color:#0081c2" ><?php echo $nom." ".$prenom ?></span> est en congé depuis <?php echo $date_depart." jusqu'à ".$date_retour; ?>.<span style="color:#0081c2" >Departement :</span><?php echo $row_departement['NOM_DEPARTEMENT'];?></p>
								<?php
								}
							 
							}
                        }
				}
				
						?>
               
               
               </div>
            <hr />
            
            <div>
             
            <?php
				$req_voloany="select * from departement where ID_DEPARTEMENT=".$_SESSION['departement']." and NOM_DEPARTEMENT<>'Administration'";
				if($req_voloany=mysql_query($req_voloany))
				{

					$ligne=mysql_fetch_array($req_voloany);
					if($ligne['ID_EMPLOYER']==$_SESSION['id'])
					{
						
						?> 
                <h3>Liste des demandes des employés :</h3>
                
                
<div id="tabs" >
	<ul>
		<li><a href="#tabs-1">Que vous avez accepté</a></li>
		<li><a href="#tabs-2">Que vous avez rejeté</a></li>
	
	</ul>
	<div id="tabs-1">
		<p>
        <?php
        $req_verifier="select * from valider where ID_RESPONSABLE_SITE=".$_SESSION['departement'];
		$req_verifier=mysql_query($req_verifier);
		if(!mysql_num_rows($req_verifier))
            liste_de_demande_accepter_refuser("Date d'acceptation",'oui','VALIDE_DEPARTEMENT','ID_DEPARTEMENT');
			else
			 liste_de_demande_accepter_refuser("Date d'acceptation",'oui','VALIDE_RESPONSABLE','ID_RESPONSABLE_SITE');
			?>
           
        </p>
	</div>
	<div id="tabs-2">
		<p>
         <?php
        $req_verifier="select * from valider where ID_RESPONSABLE_SITE=".$_SESSION['departement'];
		$req_verifier=mysql_query($req_verifier);
		if(!mysql_num_rows($req_verifier))
            liste_de_demande_accepter_refuser("Date de rejet",'non','VALIDE_DEPARTEMENT','ID_DEPARTEMENT');
			else
			 liste_de_demande_accepter_refuser("Date de rejet",'non','VALIDE_RESPONSABLE','ID_RESPONSABLE_SITE');
			?>
        </p>
	</div>
	
</div>

                        
          
                        <?php
					}
				}
			?>
                       
           		
            </div>
		</div>
		
		
		<!--<div><a href="jpgraph-3.5.0b1/src/gestion_conge_jp_graf/jp_graf_session.php" title="GRAPHE" target="_blank">graphe</a></div>
		<div><a href="jpgraph-3.5.0b1/src/gestion_conge_jp_graf/jp_graf_admin_conge_ans_pr_employe.php" title="GRAPHE" target="_blank">graphe de tous les employés par année</a></div>
		<div><a href="jpgraph-3.5.0b1/src/gestion_conge_jp_graf/jp_graf_departement_conge_ans_pr_employe.php" title="GRAPHE" target="_blank">graphe de tous les employés par departement par année</a></div>
		<div><a href="jpgraph-3.5.0b1/src/gestion_conge_jp_graf/jp_graf_admin_sum_nbjr_pr_employe.php" title="GRAPHE" target="_blank">graphe de tous les congés pris par les employés par année</a></div>
		<div><a href="jpgraph-3.5.0b1/src/gestion_conge_jp_graf/jp_graf_departement_sum_nbjr_pr_employe.php" title="GRAPHE" target="_blank">graphe de tous les congés pris par les employés par departement par année</a></div> -->
				
		
       <!-- <div><a target="_blank" href="imprimer_fiche_conge.php">imprimer</a></div>-->
        
		
		
        <!--<div id="accordion">
        <h3>Section 1</h3>
        <div>
            <p>Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.</p>
        </div>
        <h3>Section 2</h3>
        <div>
            <p>Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In suscipit faucibus urna. </p>
        </div>
        <h3>Section 3</h3>
        <div>
            <p>Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui. </p>
            <ul>
                <li>List item one</li>
                <li>List item two</li>
                <li>List item three</li>
            </ul>
        </div>
        <h3>Section 4</h3>
        <div>
            <p>Cras dictum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia mauris vel est. </p><p>Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </p>
        </div>
    </div>-->
        
        
        
        
        
        
		<!--<div id="sidebar">
			<div class="sidebar_section">
				<div class="sidebar_title">
					<h4>Affiliates</h4>
					<small>Subtitle w/ Information</small>
				</div>

				<ul class="ads clearfix">
						<li><a href="http://themeforest.net?ref=jdsans" title="ThemeForest"><img src="images/affiliates/themeforest.jpg" alt="ThemeForest" /></a></li>
						<li><a href="http://graphicriver.net?ref=jdsans" title="GraphicRiver"><img src="images/affiliates/graphicriver.jpg" alt="Graphic River" /></a></li>
						<li><a href="http://videohive.net?ref=jdsans" title="VideoHive"><img src="images/affiliates/videohive.jpg" alt="VideoHive" /></a></li>
						<li><a href="http://flashden.net?ref=jdsans" title="FlashDen"><img src="images/affiliates/flashden.jpg" alt="FlashDen" /></a></li>
				</ul>
			</div>
			<div class="sidebar_section" style="border-bottom: 0;">
				<div class="sidebar_title">
					<h4>Contact Us</h4>
					<small>Subtitle w/ Information</small>
				</div>

				<div class="left_column">Email:</div><div class="right_column">example@example.com</div>
				<div class="left_column">Phone:</div><div class="right_column">123 - 456 - 7890</div>
				<div class="left_column">Address:</div><div class="right_column">1234 Make Believe<br />New York, NY 50210<br /> United States of America</div>
				<br style="clear: both;" />

				<div class="sidebar_link"><a href="contact.htm" title="Contact Us">View Our Contact Page</a></div>
			</div>
		</div>-->
		<div class="spacer"></div>
	</div></div>
