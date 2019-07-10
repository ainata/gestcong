<script language="JavaScript">

		
		function valider()
		{
			if(document.forms[0].txt_nom_departement.value=="")
				{
				alert("vous devez remplir le nom de departement");
				document.forms[0].elements[0].focus();
				return false;
				}
				else return true;
				
		}
		
		function script_ajout_departement()
		{
			  if(valider()) 
			  {
				// les données sont ok, on peut envoyer le formulaire  
				var str = "Voulez vous ajouter vraiment?";
				if(confirm(str))
				{
					document.getElementById("form_departement").action="Ajout_departement.php?mode=9";
					return true;
				}
			  }
			  else {
				
				return false;
			  }
		}
		
		function script_modifier_departement()
		{
			  if(valider()) {
				// les données sont ok, on peut envoyer le formulaire  
				var str = "Voulez vous modifier vraiment?";
				if(confirm(str))
				{
					document.getElementById("form_departement").action="Modification.php?mode=9";
					return true;
				}
			  }
			  else {
				return false;
			  }
		}
		
		function script_suppression_departement()
		{
			  if(valider()) {
				// les données sont ok, on peut envoyer le formulaire  
				var str = "Voulez vous supprimer vraiment?";
				if(confirm(str))
				{
					document.getElementById("form_departement").action="Suppression.php?mode=9";
					return true;
				}
			  }
			  else {
				
				return false;
			  }
		}
		
function ok_ar_e(i)
{

		document.forms[0].txt_id_departement.value=document.getElementById("id_departement"+i).textContent;
		//document.forms[0].slct_id_employer_departement.value=document.getElementById("nom_chef_dep"+i).textContent;
		document.forms[0].txt_nom_departement.value=document.getElementById("nom_departement"+i).textContent;
						
}

</script>
<div class="display_bg" >
        <div class="navback">
            <div id="navigation">
                    <ul>
                        <li><a href="index.php?id=1" title="Accueil">Accueil</a></li>
                        <li><a href="#" title="Mis à jour">Mis &agrave; jour</a></li>
                        <li><a href="index.php?id=15" title="Département">D&eacute;partement</a></li>
                        
                        <!--<li><a href="index.php?id=8" title="MOTIF">MOTIF</a></li>-->
                    </ul>
             </div>
        </div>
    </div>
<div id="container">
   <div id="content_container">
		<div id="content">
			<h1>departement</h1>
			<hr />
			<div class="contact_form">
				
				
				<div align="center">
				  <table width="456" height="229" border="0">
				    <form id="form_departement" name="form_departement" method="post" action="javascript:void(0)">
					<tr>
				        <td height="45">&nbsp;</td>
					  	<td><input id="txt_id_departement" type="hidden" name="txt_id_departement"/>&nbsp;</td>
				      </tr>
				      <tr>
				        <td height="44"><label><div align="center">Nom Chef de departement :</div></label></td>
					  	<td>
								<select id="slct_id_employer_departement" name="slct_id_employer_departement" >
									<option selected>Selectionner</option>
                                	<?php select_employer();?>
                            	</select>
						</td>
				      </tr>
				      <tr height="">
				        <td height="59"><label>
				          <div align="center">Nom departement :</div>
				        </label>&nbsp;</td>
					  <td>
					  		<input id="txt_nom_departement" type="text" name="txt_nom_departement"/>
					  		<!--<select id="txt_nom_departement" name="txt_nom_departement" >
									<option selected>Selectionner</option>
                                	<option value='Admin'>Admin</option>
                  
                ;
	         
                
                                    <option value='C++'>C++</option>
                  
                ;
	         
                
                                    <option value='Marketing and standardisation'>Marketing and standardisation</option>
                  
                ;
	         
                
                                    <option value='Responsable de site'>Responsable de site</option>
				;
                					
									<option value='Web'>Web</option>
									
                         </select> -->
					  </td>
				    </tr>
				      <tr >
				        <td align="center" class="colone_btn"><button onClick="return script_ajout_departement();" type="submit"  name="ajout" value="ajout" >Ajouter</button></td>
				  <td align="center" class="colone_btn"><button onClick="return script_modifier_departement();" type="submit" name="modifier" value="modifier">Modifier</button></td>  
				    </tr>
				      <tr>
				        <td align="center" class="colone_btn"><button onClick="return script_suppression_departement();" type="submit" name="supprimer" value="supprimer">Supprimer</button></td>
				  <td align="center" class="colone_btn"><button type="reset" name="annuler" value="annuler">Annuler</button></td>
				    </tr>
			        </form>
			    </table>
			  </div>
				<hr />
				

		  </div>		
		</div>
        		
        
       	<div class="spacer"></div>
		
		<form id="form_departement" name="form_departement" method="post" >
		<div id="liste_departement">
			<fieldset class="liste_emp" style="border-radius:10px;margin:20px;padding:20px;"><legend>Liste des departements</legend>
 				<table width="100%" border="0px">
      
                    <tr bgcolor="#666666"> 
                        <td ><div align="center"><font color="#FFFFFF">ID</font></div></td>
                        
                        <td ><div align="center"><font color="#FFFFFF">Nom Chef de departement</font></div></td>
						<td ><div align="center"><font color="#FFFFFF">Nom Departement</font></div></td>                        
                    </tr>
                       <?php
                  
						$requete = " SELECT * from departement";

                        $result = mysql_query($requete);
                        if ($result==0)
                        {
                        print("<B> Impossible d'executer la requete SELECT </B> ");
                        exit;
                        }
                        if (!mysql_num_rows($result))
                        { 
                        echo " Aucun enregistrement " ; 
                        }
                        else
                        {
							$i = 0 ;
                            while ($ligne = mysql_fetch_array($result))
                            { 
                            $id_departement=$ligne['ID_DEPARTEMENT'];
							if($ligne['ID_EMPLOYER']!=0)
							{
							$requete_employer="select * from employer where ID_EMPLOYER=".$ligne['ID_EMPLOYER'];
							$requete_employer=mysql_query($requete_employer) or die (mysql_error());
							$ligne1=mysql_fetch_array($requete_employer);
                            $nom_chef_dep=$ligne1['NOM'];
							
							$prenom_chef_dep=' '.$ligne1['PRENOM'];
							}
							else
							{
								$nom_chef_dep='NU';
								$prenom_chef_dep='LL';
							}
							
							$nom_departement=$ligne['NOM_DEPARTEMENT'];
					  ?>
							
                                    <tr class="list_line" onClick="javascript:ok_ar_e(<?php echo $i?>);" bgcolor="#CCCCCC" height="35px"> 
										<td id="id_departement<?php echo $i;?>"><div align="center"><?php echo $id_departement?><input type="hidden" name="id<?php echo $i?>" value="<?php echo $id_departement?>" /></div></td>
                                        <td id="nom_chef_dep<?php echo $i;?>"><div align="center"><?php echo $nom_chef_dep.''.$prenom_chef_dep; ?></div></td>
                             			<td id="nom_departement<?php echo $i;?>"><div align="center"><?php echo $nom_departement?></div></td>
							 	<?php $i++ ;?>    
                         			</tr>
						 <?php	}
						}?>
                        
               </table>
		<br />
					
				</fieldset>
			</div>
		</form>
	</div>
   </div>
