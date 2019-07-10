<script type="text/javascript">
/*$(document).ready( function () {

	$(".navback").hide();

$("#option").click( function () {

			if ($('.navback:visible').length != 0) {
			$('.navback').slideUp("normal");
			}
			
			else {
			$('.navback').slideDown("normal");
			}
			
			return false;
		});
} ) ;*/
</script>
<body class="right-sidebar loading">

            
            <?php
					$req="SELECT COUNT(*) AS nb FROM valider,deposition where valider.ID_DEPOSITION=deposition.ID_DEPOSITION and deposition.ID_EMPLOYER=".$_SESSION['id']." and VU_UTILISATEUR='non vu'";
					$req=mysql_query($req);
					$resultat=mysql_fetch_array($req);
				$nb1=0;
				$req1="select * from departement where ID_DEPARTEMENT = ".$_SESSION['departement'];
									$req1=mysql_query($req1);
									$ligne1=mysql_fetch_array($req1);
									if($ligne1['ID_EMPLOYER']==$_SESSION['id'])
									{
				
					$req1="select COUNT(*) as nb1 from valider where ID_RESPONSABLE_SITE=".$_SESSION['departement']." and VALIDE_RESPONSABLE = 'non vu' and VALIDE_DEPARTEMENT = 'oui' or ID_DEPARTEMENT=".$_SESSION['departement']." and VALIDE_DEPARTEMENT = 'non vu'";
					$req1=mysql_query($req1);
					$resultat1=mysql_fetch_array($req1);
					$nb1=$resultat1['nb1'];
					
					
									}
									
					$req_nom_dep="select * from departement where ID_DEPARTEMENT=".$_SESSION['departement'];
					$req_nom_dep=mysql_query($req_nom_dep) or die(mysql_error());
					$res_nom_dep=mysql_fetch_array($req_nom_dep);
					
			?>
            <div class="navbar">
			<div class="navbar-inner" >
				<div class="container">
					<button class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse" type="button">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
                    
					<a class="brand" href="index.php?id=6">
						<img src="upload/<?php echo $_SESSION['photo']?>" width="35px" height="35px" style="margin-top:-20px">  
						   <div style="display:inline-block"><span><!--Bonjour!--><span style="font-size:12px"><?php echo " ".$_SESSION['nom']." ".$_SESSION['prenom']; ?></span>
                        <br>
                        
						<?php  echo " <span style=\"font-size:14px;color:black;\"><u>Dep</u>:</span> <span style=\"font-size:12px\">".$res_nom_dep['NOM_DEPARTEMENT']."</span>"; ?>
                        </span></div>
					</a>
					<nav style="float:right;" class="nav-collapse" role="navigation">
						<ul class="nav">
							<li><a href="index.php">Accueil</a></li>
							<li class="divider-vertical"></li>
                            <li><a href="index.php?id=7">Envoye demande</a></li>
                             <li class="divider-vertical"></li>
							<li class="dropdown">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">Notification 
                                <div style="display:inline-block;margin-left:10px;border:blue solid 1px;background-color:blue;padding:0px 5px;border-radius:40px;">
								<?php
									$nb=$resultat['nb']+$nb1;
									if($nb>0)
								 echo "<span style=\"color:white\">".$nb."</span>";
								 else echo "<span style=\"color:white\">0</span>";
								 ?>
                                 </div> <b class="caret"></b></a>
								<ul class="dropdown-menu">
                                	<?php $mamantatra_resp_site="select * from valider where ID_RESPONSABLE_SITE=".$_SESSION['departement'];
									 		$mamantatra_resp_site=mysql_query($mamantatra_resp_site);
											if(!mysql_num_rows($mamantatra_resp_site))
											{
									  ?>
									<li><a href="index.php?id=8">Demande accepté <span style="color:blue"> 
                                    <?php
										
										$req="SELECT COUNT(*) AS nb FROM valider,deposition where valider.ID_DEPOSITION=deposition.ID_DEPOSITION and deposition.ID_EMPLOYER=".$_SESSION['id']." and VU_UTILISATEUR='non vu' and VALIDE_DEPARTEMENT = 'oui' and VALIDE_RESPONSABLE = 'oui' ";
										
										$req=mysql_query($req);
										$resultat=mysql_fetch_array($req);
										$nb=$resultat['nb'];
									if($nb>0)
									 echo "<b>$nb</b>";
									 else echo '0';
										
									?>
                                     </span></a></li>
									<li><a href="index.php?id=9">Demande rejeté <span style="color:blue"> 
                                    <?php
										$req="SELECT COUNT(*) AS nb FROM valider,deposition where valider.ID_DEPOSITION=deposition.ID_DEPOSITION and deposition.ID_EMPLOYER=".$_SESSION['id']." and VU_UTILISATEUR='non vu' and (VALIDE_DEPARTEMENT = 'non' or VALIDE_RESPONSABLE = 'non')";
										
										$req=mysql_query($req);
										$resultat=mysql_fetch_array($req);
										$nb=$resultat['nb'];
									if($nb>0)
									 echo "<b>$nb</b>";
									 else echo '0';
									?>
                                     </span></a></li>
                                     
                                     
                                    <li><a href="index.php?id=10">Demande en cours <span>
                                    <?php
										$req="SELECT COUNT(*) AS nb FROM valider,deposition where valider.ID_DEPOSITION=deposition.ID_DEPOSITION and deposition.ID_EMPLOYER=".$_SESSION['id']." and ( VALIDE_DEPARTEMENT = 'non vu' or VALIDE_RESPONSABLE = 'non vu')";
										
										$req=mysql_query($req);
										$resultat=mysql_fetch_array($req);
										$nb=$resultat['nb'];
									if($nb>0)
									 echo "<b>$nb</b>";
									 else echo '0';
									?>
                                    </span></a></li>
                                    <?php
									
											}
									$req="select * from departement where ID_DEPARTEMENT = ".$_SESSION['departement'];
									$req=mysql_query($req);
									$ligne=mysql_fetch_array($req);
									if($ligne['ID_EMPLOYER']==$_SESSION['id'])
									{
									 ?>
                                    <li><a href="index.php?id=11">Demande deposer par employer  <span style="color:blue"><b><?php echo $nb1; ?></b></span></a></li>
									
									
                                    <?php
									}
									?>
								</ul>
							</li>
                            <li class="divider-vertical"></li>
                            <?php
							
						
							if($_SESSION['departement']==4)
							{
							$req="select count(*) as nb_inscription from employer where MATRICULE='0'";
							$req=mysql_query($req);
							$nb_inscription=mysql_fetch_array($req);
							?>
                            <li><a href="index.php?id=12">Demade d'inscription <div style="display:inline-block;margin-left:10px;border:blue solid 1px;background-color:blue;padding:0px 5px;border-radius:40px;color:white;"><?php echo $nb_inscription['nb_inscription']; ?></div></a></li>
							<li class="divider-vertical"></li>
                            <li class="dropdown">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">Mise à jour <b class="caret"></b></a>
                      			<ul class="dropdown-menu">
                                	
									<li><a href="index.php?id=2">Employer</a></li>
                                    <li><a href="index.php?id=15">Departement</a></li>
                                    <li><a href="index.php?id=4">Contrat</a></li>
                                    <li><a href="index.php?id=5">Motif</a></li>
                                    <li><a href="index.php?id=13">Poste</a></li>
									<li><a href="index.php?id=14">Type deposition</a></li>
                                    <li><a href="index.php?id=17">Congée annuelle</a></li>
                                </ul>
                                </li>
                                <li class="divider-vertical"></li>
                            
                            <?php
							}
							?>
                            
                            <li class="dropdown">
                            
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">Plus <b class="caret"></b></a>
								<ul class="dropdown-menu">
                                	
									<li><a href="index.php?id=16">Historique</a></li>
									
									<!--GRAPHE TAFARA -->
									<li><a href="jpgraph-3.5.0b1/src/gestion_conge_jp_graf/jp_graf_session.php" title="GRAPHE" target="_blank">Graphe personnel</a></li>
									
                                    <?php
							
						
							if($_SESSION['departement']==4)
							{
							$req="select count(*) as nb_inscription from employer where MATRICULE='0'";
							$req=mysql_query($req);
							$nb_inscription=mysql_fetch_array($req);
							?>

									<li><a href="jpgraph-3.5.0b1/src/gestion_conge_jp_graf/jp_graf_admin_conge_ans_pr_employe.php" title="GRAPHE" target="_blank">Graphe des employés</a></li>
									<li><a href="jpgraph-3.5.0b1/src/gestion_conge_jp_graf/jp_graf_admin_sum_nbjr_pr_employe.php" title="GRAPHE" target="_blank">Graphe pour administration</a></li>
									<li><a href="jpgraph-3.5.0b1/src/gestion_conge_jp_graf/jp_graf_solde_conge.php" title="GRAPHE" target="_blank">Graphe solde congé</a></li>
									<li><a href="jpgraph-3.5.0b1/src/gestion_conge_jp_graf/jp_graf_solde_permission.php" title="GRAPHE" target="_blank">Graphe solde permission</a></li>
                                    <?php
							}
							?>
                            <?php
                            $req="select * from departement where ID_DEPARTEMENT = ".$_SESSION['departement'];
									$req=mysql_query($req);
									$ligne=mysql_fetch_array($req);
									if($ligne['ID_EMPLOYER']==$_SESSION['id'])
									{
									 ?>
									<li><a href="jpgraph-3.5.0b1/src/gestion_conge_jp_graf/jp_graf_departement_conge_ans_pr_employe.php" title="GRAPHE" target="_blank">Graphe employés par departement</a></li>
									<li><a href="jpgraph-3.5.0b1/src/gestion_conge_jp_graf/jp_graf_departement_sum_nbjr_pr_employe.php" title="GRAPHE" target="_blank">Graphe par departement</a></li>
									<li><a href="jpgraph-3.5.0b1/src/gestion_conge_jp_graf/jp_graf_solde_conge_pr_departement.php" title="GRAPHE" target="_blank">Graphe solde congé par departement</a></li>
									<li><a href="jpgraph-3.5.0b1/src/gestion_conge_jp_graf/jp_graf_solde_permission_pr_departement.php" title="GRAPHE" target="_blank">Graphe solde permission par departement</a></li>
									<?php
										}
									?>
		
                                    <!--<li><a href="statistique.php">Statistique durant un an</a></li>-->
								</ul>
							</li>
                            <li class="divider-vertical"></li>
							
							<li><a href="detruire_session.php" style="color:#fff;background-color:#EB0A1B;cursor:pointer">Deconnection</a></li>
                            
                            <!--<li><a href="detruire_session.php"><button class="deconnection">Deconnexion</button></a></li>-->
							
						</ul>
                        </nav>
				</div><!-- end of .container -->
			</div><!-- end of .navbar-inner -->
		</div><!-- end of .navbar .navbar -->

   

<br>
<br>
<br>
<br>
<!--<div id="display">
<img src="SARY_AMBONY.jpg">
		<!--<ul id="pikame">
			<li><img src="images/display/thumbs/creative_sessions.jpg" ref="images/display/creative_sessions.jpg" alt="FreelanceSwitch" /><span>Creative Sessions<br /><small>Interface Design</small></span></li>

			<li><img src="images/display/thumbs/appstorm.jpg" ref="images/display/appstorm.jpg" alt="AppStorm" /><span>AppStorm<br /><small>Mac Applications Blog</small></span></li>
			<li><img src="images/display/thumbs/nettuts.jpg" ref="images/display/nettuts.jpg" alt="NetTuts" /><span>NetTuts<br /><small>Web Development &amp; Design Tutorials</small></span></li>
			<li><img src="images/display/thumbs/tutsplus.jpg" ref="images/display/tutsplus.jpg" alt="VideoHive" /><span>Tutsplus<br /><small>Power Up Your Skill Set</small></span></li>
			<li><img src="images/display/thumbs/envato.jpg" ref="images/display/envato.jpg" alt="Creattica" /><span>Envato<br /><small>Learn Creative Skills</small></span></li>

		</ul>-->
	<!--</div>-->
<iframe src="slide tena izy/slider1.html" style="width:1224px;height:230px;max-width:100%;overflow:hidden;border:none;padding:0;margin:0 auto;display:block;" marginheight="0" marginwidth="0"></iframe>


</body>
</html>