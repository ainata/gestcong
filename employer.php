 <script>
		$(function() {
		$( "#dialog" ).dialog({
		autoOpen: false,
		show: {
		effect: "blind",
		duration: 1000
		},
		hide: {
		effect: "explode",
		duration: 1000
		},
		position: ["center",200]
		});
		$( "#opener" ).click(function() {
		$( "#dialog" ).dialog( "open" );
		});
		$("#ok").click(function(){
			$( "#dialog" ).dialog( "close" )
		});
		$("#slct_contrat").change(function(){
			if($(this).val()==1 || $(this).val()==3 )
			$( "#dialog" ).dialog( "open","position","center");
		}
		);
		});
	</script>
<script type="text/javascript">
$(document).ready( function () {

	$("#miseho_ambany").hide();

	$("#option").click( function () {

			if ($('#miseho_ambany:visible').length != 0) {
			$('#miseho_ambany').slideUp("normal");
			}
			
			else {
			$('#miseho_ambany').slideDown("normal");
			
			}
			
			return false;
		});
} ) ;
</script>



<script language="JavaScript" >
 function effacer() 
        { 
		if(confirm("voulez vous annuler?")){

            document.forms[0].elements[0].focus();
			return true
            
		}
		else return false;
        }
		
		function valider()
		{
			if(document.forms[0].txt_matricule.value=="")
				{
					alert("vous devez remplir la numero matricule");
					document.forms[0].txt_matricule.focus();
					return false;
				}
				else if(document.forms[0].txt_nom.value==""){
					
					alert("vous devez remplir le nom d'employe");
					document.forms[0].txt_nom.focus();
					return false;
					}
					else if(document.forms[0].txt_mail.value=="")
					{
						alert("vous devez remplir l'adresse e-mail");
						document.forms[0].txt_mail.focus();
						return false;

					}
					else if(document.forms[0].txt_date_d_entree.value=="")
					{
						alert("vous devez remplir le date d'entree de l'employe");
						document.forms[0].txt_date_d_entree.focus();
						return false;
					}
					else if(document.forms[0].txt_solde_de_conge.value=="")
					{
						alert("vous devez remplir le nom d'employe");
						document.forms[0].txt_solde_de_conge.focus();
						return false;
					}
					/*else if(document.forms[0].txt_login.value=="")
					{
						alert("vous devez remplir le login");
						document.forms[0].txt_login.focus();
						return false;
					}*/
					else if(document.forms[0].txt_mot_de_passe.value=="")
					{
						alert("vous devez remplir le mot de passe");
						document.forms[0].txt_mot_de_passe.focus();
						return false;
					}
					else if(document.forms[0].slct_departement.value=="")
					{
						alert("vous devez remplir le nom de departement");
						document.forms[0].slct_departement.focus();
						return false;
					}
					else if(document.forms[0].slct_poste.value=="")
					{
						alert("vous devez remplir le poste d'employer");
						document.forms[0].slct_poste.focus();
						return false;
					}
					else if(document.forms[0].slct_contrat.value=="")
					{
						alert("vous devez remplir le contrat");
						document.forms[0].slct_contrat.focus();
						return false;
					}
					else return true;
		}
		
		function script_ajout_employer()
		{
			 if(valider()) {
				
				var str = "Voulez vous ajouter vraiment?";
				if(confirm(str))
					document.getElementById("form_employer").action="AjoutEmployer.php?mode=1";
		
			 }
		}
		
	
		
		
		function script_modifier_employer()
		{
			  if(valider()) {
				// les données sont ok, on peut envoyer le formulaire  
				var str = "Voulez vous modifier vraiment?";
				if(confirm(str))
				{
					document.getElementById("form_employer").action="Modification.php?mode=1";
					return true;
				}
			  }
			  else {
				return false;
			  }
		}
		
		function script_suppression_employer()
		{
			  if(valider()) {
				// les données sont ok, on peut envoyer le formulaire  
				var str = "Voulez vous supprimer vraiment?";
				if(confirm(str))
				{
					document.getElementById("form_employer").action="Suppression.php?mode=1";
					return true;
				}
			 }
			 /* else {
				
				return false;
			  }*/
		}
		
		function aoira(i)
		{
			
		document.getElementById("txt_id_employer").value=document.getElementById("id_emp"+i).textContent;
		document.getElementById("txt_matricule").value=document.getElementById("matricule"+i).textContent;
		document.getElementById("txt_nom").value=document.getElementById("nom"+i).textContent;
		document.getElementById("txt_prenom").value=document.getElementById("prenom"+i).textContent;
		document.getElementById("txt_mail").value=document.getElementById("mail"+i).textContent;
		document.getElementById("txt_date_d_entree").value=document.getElementById("date"+i).textContent;
		document.forms[0].txt_solde_de_conge.value=document.getElementById("solde"+i).textContent;
		document.getElementById("slct_poste").value=document.getElementById("id_poste"+i).textContent;
		document.getElementById("slct_contrat").value=document.getElementById("id_contrat"+i).textContent;
		document.getElementById("slct_departement").value=document.getElementById("id_dep"+i).textContent;
		/*
		switch(text)
		{ 
			case "web":document.forms[0].slct_departement.value=1;break;
			case "C++":document.forms[0].slct_departement.value=2;break;
			case "electrionique":document.forms[0].slct_departement.value=3;break;
		}*/
		
		/*document.forms[0].slct_poste.value=document.getElementById("poste"+i).textContent;
		document.forms[0].slct_contrat.value=document.getElementById("contrat"+i).textContent;
		document.forms[0].txt_matricule.focus();*/
		
		
		
		}
		
		function contrat()
		{
			document.getElementById("txt_date_contrat").value=document.getElementById("txt_date_fin_contrat").value;
		}
</script>


<div class="display_bg" >
        <div class="navback">
            <div id="navigation">
                    <ul>
                        <li><a href="index.php?id=1" title="Accueil">Accueil</a></li>
                        <li><a href="#" title="Mis à jour">Mis à jour</a></li>
                        <li><a href="index.php?id=2" title="Employé">Employé</a></li>
                        
                        <!--<li><a href="index.php?id=8" title="MOTIF">MOTIF</a></li>-->
                    </ul>
             </div>
        </div>
    </div>

<div id="container">
        <div id="content_container">
                <div id="content">
                    <h1 style="text-align:center;">SAISIE EMPLOYE</h1>
        
                    <hr />
                   
                    <div class="contact_form">
                        
                        <table style="margin-left:10px;" border="0" align=left>
                        <form id="form_employer" name="form1" method="post" action="javascript:void(0)">
                        <tr ><td>
                            <label>MATRICULE : </label></td>
                            <td>
                            <input id="txt_id_employer" type="hidden" name="txt_id_employer" placeholder="id_emmployer" />
                            <input id="txt_matricule" type="text" name="txt_matricule" placeholder="Matricule"/></td>
                            <td></td>						
                           <td></td>
                            
                        </tr>
                        <tr>
                        	<td><label>Nom:</label></td>
                            <td><input id="txt_nom" type="text" name="txt_nom" placeholder="Nom" /></td>
                            <td><label class="misitaka">Prenom :</label></td>
                            <td><input id="txt_prenom" type="text" name="txt_prenom" placeholder="Prenom"/></td>
                            
                      
                       <tr>
                       
                            <td><label class="misitaka">Date d'entrée :</label></td>
                            <td><input  class="date" id="txt_date_d_entree" type="text" name="txt_date_d_entree" placeholder="Date d'entree" /></td>
                         	 <td><label>Solde de congé :</label></td>
                            <td><input id="txt_solde_de_conge" type="text" name="txt_solde_de_conge" placeholder="Solde de conge"/></td>

                       </tr>
                       <tr>
                          
                            <td><label class="misitaka">Departement :</label></td>
                            <td>
                            	<select id="slct_departement" name="slct_departement"  >
                                <option selected></option>
                                <?php select_departement();?>
                                </select>
                           </td>
                      </tr>
                                            
                      	<tr>
                        	<td><label>Poste :</label></td>
                            <td>
                                <select id="slct_poste" name="slct_poste" >
                                    <option selected></option>
                                    <?php select_poste();?>
                                 
                                </select>
                          	</td>
                            <td><label class="misitaka">Contrat :</label></td>
                            <td><select id="slct_contrat" name="slct_contrat" >
                                <option selected></option>
                                <?php select_statut();?>
                        		</select>
                       	<input type="hidden" name="txt_date_contrat" id="txt_date_contrat" />
                        <div class="jquery_miova " id="dialog" align="center"  title="Fin de contrat">
                        <p >
                        <input name="txt_date_fin_contrat" id="txt_date_fin_contrat" style="margin-left:50px" class="date" type="text" /><br /><p>
                        <input onclick="contrat()" style="margin-left:70px" type="button" value="ok" id="ok" />
                        </p>
                        </p>
                        </div>
                        
                        </tr>
                          <tr>
                        	<td><label>Adress e-mail :</label></td>
                            <td><input id="txt_mail" type="text" name="txt_mail" placeholder="e-mail"/></td>
                     		<td><label>Mot de passe :</label></td>
                            <td><input id="txt_mot_de_passe" type="password" name="txt_mot_de_passe" placeholder="Mot de passe"/></td>
                       </tr>
                            <!--<input type="text" name="Email" />-->
                                                
                            <!--<label>Message
                                <span class="small">Communicate with us</span>
                            </label>
                            <textarea name="Message" cols="0" rows="7"></textarea>-->
                            <tr ><td align="center" class="colone_btn">					
                            <button id="btn_ajout_employer"  onclick="script_ajout_employer();" type="submit"  name="ajout" value="ajout" >Ajouter</button>
                            <td align="center" class="colone_btn">					
                            
							<button onclick="return script_modifier_employer();" type="submit" name="modifier" value="modifier">Modifier</button>
                            
                            <td align="center" class="colone_btn">					
                            <button onclick="return script_suppression_employer();" type="submit" name="supprimer" value="supprimer">Supprimer</button>
                            
                            <td align="center" class="colone_btn">					
                            <button onClick="return effacer();" type="reset" name="annuler" value="annuler">Annuler</button>
                           
                            </tr>
                        </form>
                        </table>
                        
                        
        				<div><span id="resultat"></span></div>
                       <!-- <script src="js/Ajax_ajout_emp.js" type="text/javascript"></script>-->
                    </div>		
                </div>

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
        
            <div id="liste_employer">
            <fieldset class="liste_emp" style="border-radius:10px;margin:20px;padding:10px;"><legend>Liste des Employés</legend>
               
               
               
               <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" style="font-size:12px">
                        <thead>
                            <tr  bgcolor="#CCCCCC">
                            	<th style="display:none" width="4%">Id</th>
                            	<th width="7%">Matricule</th>
                                <th width="18%">Nom</th>
                                <th width="18%">Prenom</th>
                                <th width="10%">Address e-mail</th>
                                <th width="10%">Date d'entrée</th>
                                <th width="6%">Solde de congé</th>
                                <th width="7%">Departement</th>
 								<th width="10%">Poste</th>
								<th width="10%">Contrat</th>
                                <th style="display:none" width="10%">id_dep</th>
                                <th style="display:none" width="10%">id_poste</th>
                                <th style="display:none" width="10%">id_contrat</th>
                                
                            </tr>
                            
                            
                            
                        </thead>
                        <tbody>
                         <?php
											
											$requete = "SELECT employer.ID_EMPLOYER as id_emp,employer.ID_DEPARTEMENT as id_dep,employer.ID_POSTE as id_poste,employer.ID_CONTRAT as id_contrat, MATRICULE,NOM,PRENOM,ADRESSEMAIL,DATE_D_ENTREE,SOLDE_CONGE,TYPE_CONTRAT,NOM_DEPARTEMENT,NOM_POSTE FROM employer,departement,poste,status where employer.ID_DEPARTEMENT=departement.ID_DEPARTEMENT and employer.ID_CONTRAT=status.ID_CONTRAT and employer.ID_POSTE=poste.ID_POSTE and MATRICULE<>'0' " ;
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
												$i = 0 ;
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
												$id_dep=$ligne['id_dep'];
												$id_poste=$ligne['id_poste'];
												$id_contrat=$ligne['id_contrat'];	
												
						?>
                        
                                        
                                              <tr class="list_line" onclick="javascript:aoira(<?php echo $i?>);"  height="35">
                                              	 <td style="display:none" align="center" id="id_emp<?php echo $i;?>" width="4%"><?php echo $id_employer?></td>
                                                <td align="center" id="matricule<?php echo $i;?>" width="7%"><?php echo $matricule?></td>
                                                <td align="center" id="nom<?php echo $i;?>" width="18%"><?php echo $nom?></td>
                                                <td align="center" id="prenom<?php echo $i;?>" width="18%"><?php echo $prenom?></td>
                                                <td align="center" id="mail<?php echo $i;?>" width="10%"><?php echo $mail?></td>
                                                <td align="center" id="date<?php echo $i;?>" width="10%"><?php echo $date?></td>
                                                <td align="center" id="solde<?php echo $i;?>" width="6%"><?php echo $solde?></td>
                                                <td align="center" id="departement<?php echo $i;?>" width="7%"><?php echo $departement?></td>
                                                <td align="center" id="poste<?php echo $i;?>" width="10%"><?php echo $poste?></td>
                                                <td align="center" width="10%"><?php echo $contrat?></td>
                                                <td style="display:none" id="id_dep<?php echo $i;?>" align="center" width="10%"><?php echo $id_dep?></td>
                                                <td style="display:none" id="id_poste<?php echo $i;?>" align="center" width="10%"><?php echo $id_poste?></td>
                                                <td style="display:none" id="id_contrat<?php echo $i;?>" align="center" width="10%"><?php echo $id_contrat?></td>
                                            </tr>
                           <?php 
						   					$i++ ;
												}
											}
							?>
                         </tbody>
                        <tfoot>
                            	<tr bgcolor="#CCCCCC" align="center"  >
                            	<th style="display:none" width="4%">Id</th>
                            	<th width="7%">Matricule</th>
                                <th width="18%">Nom</th>
                                <th width="18%">Prenom</th>
                                <th width="10%">Address e-mail</th>
                                <th width="10%">Date d'entrée</th>
                                <th width="6%">Solde de congé</th>
                                <th width="7%">Departement</th>
 								<th width="10%" class="DefaultStyleButton">Poste</th>
								<th width="10%" class="DefaultStyleButtonRed">Contrat</th>
                                 <th style="display:none" width="10%">id_dep</th>
                                <th style="display:none" width="10%">id_poste</th>
                                <th style="display:none" width="10%">id_contrat</th>
                            </tr>
                        </tfoot>
                        </table>
               
               
               
               <!---->
               
               
               
               
               
              <!-- <div class="search">
                        <form name="search" method="post" action="">
            				
                            <a href="#"><span id="option" style="border:solid white 1px;border-radius:5px;box-shadow:2px 2px 2px black;">Option <span style="margin-top:5px;"><img src="images/fleche.jpg"  /></span></span></a>
                            <input id="s" type="text" name="search" />
                            <input type="submit" id="search_btn" value="Search"/>
                            <div id="miseho_ambany">
                            <span>Recherche par: </span>
                            <select id="slct_recherche_emp" name="slct_departement"  >
                            <option selected>Matricule</option>
                            <option selected>Nom</option>
                            <option selected>Prenom</option>
                            </select>
                            </div>
                        </form>
                    </div>
                    <br />
                    
                    				
                    
                                      <table width="100%" border="0px" class="display" id="example">
                                      <thead>
                                        <tr bgcolor="#666666"> 
                                            <td ><div align="center"><font color="#FFFFFF" >Id</font></div></td>
                                            <td ><div align="center"><font color="#FFFFFF">Matricule</font></div></td>
                                            <td width=20%><div align="center"><font color="#FFFFFF">Nom</font></div></td>
                                            <td width=20%><div align="center"><font color="#FFFFFF" >Prenom</font></div></td>
                                            <td ><div align="center"><font color="#FFFFFF">Address e-mail</font></div></td>
                                            <td><div align="center"><font color="#FFFFFF" >Date d'entrée</font></div></td>
                                            <td ><div align="center"><font color="#FFFFFF" >Solde de congé</font></div></td>
                                            <td><div align="center"><font color="#FFFFFF" >Departement</font></div></td>
                                            <td><div align="center"><font color="#FFFFFF" >Poste</font></div></td>
                                            <td><div align="center"><font color="#FFFFFF" >Contrat</font></div></td>
                                            
                                        </tr>
                                       </thead>
                                        <?php
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
											{?>
											
											<?php
												$i = 0 ;
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
												$departement=$ligne['NOM_DEPARTEMENT'];?>
												
												<a href="#"><tr class="list_line" onclick="javascript:aoira(<?php echo $i?>);" bgcolor="#CCCCCC" height="35px"> 
															<td id="id_emp<?php echo $i;?>" ><div align="center"><?php echo $id_employer?><input type="hidden" name="id<?php echo $i?>" value="<?php echo $id_employer?>" /></div></td>
															<td id="matricule<?php echo $i;?>"><div align="center"><?php echo $matricule?></font></div></td>
															<td id="nom<?php echo $i;?>" width=20%><div align="center"><?php echo $nom?></font></div></td>
															<td id="prenom<?php echo $i;?>" width=20%><div align="center"><?php echo $prenom?></div></td>
															<td id="mail<?php echo $i;?>"><div align="center"><?php echo $mail?></div></td>
															
															<td id="date<?php echo $i;?>"><div align="center"><?php echo $date?></div></td>
															<td id="solde<?php echo $i;?>"><div align="center"><?php echo $solde?></div></td>
															
															<td id="departement<?php echo $i;?>"><div align="center"><?php echo $departement?></div></td>
															
															<td id="poste<?php echo $i;?>"><div align="center"><?php echo $poste?></div></td>
															<td id="contrat<?php echo $i;?>"><div align="center"><?php echo $contrat?></div></td>
                                                            
                                            
                                            <?php $i++ ;?>
                                        
														</tr>
                                                        </a>
                                                        
													  
											<?php	}
											}?>
                                           
										</table>
                                        
                                         <br />
                                      
    						-->
                                        
                    
                                  
            </fieldset>
            </div>
    
    </div>
    </div>
  
    
  
    
     
    
    
    






