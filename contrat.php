
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
			if(document.forms[0].slct_type_contrat.value=="")
				{
				alert("vous devez remplir le champ type de contrat");
				document.forms[0].elements[0].focus();
				return false;
				}
				else return true;
		}
		
		function script_ajout_contrat()
		{
			  if(valider()) {
				// les données sont ok, on peut envoyer le formulaire  
				var str = "Voulez vous ajouter vraiment?";
				if(confirm(str))
				{
					document.getElementById("form_contrat").action="Ajout_contrat.php?mode=3";
					return true;
				}
			  }
			  else {
				
				return false;
			  }
		}
		
		function script_modifier_contrat()
		{
			  if(valider()) {
				// les données sont ok, on peut envoyer le formulaire  
				var str = "Voulez vous modifier vraiment?";
				if(confirm(str))
				{
					document.getElementById("form_contrat").action="Modification.php?mode=3";
					return true;
				}
			  }
			  else {
				return false;
			  }
		}
		
		function script_suppression_contrat()
		{
			  if(valider()) {
				// les données sont ok, on peut envoyer le formulaire  
				var str = "Voulez vous supprimer vraiment?";
				if(confirm(str))
				{
					document.getElementById("form_contrat").action="Suppression.php?mode=3";
					return true;
				}
			  }
			  else {
				
				return false;
			  }
		}
		
		
function akor(i)
{

		document.forms[0].txt_id_contrat.value=document.getElementById("id_cntrt"+i).textContent;
		document.forms[0].slct_type_contrat.value=document.getElementById("type_cntrt"+i).textContent;
						
}

</script>
<div class="display_bg" >
        <div class="navback">
            <div id="navigation">
                    <ul>
                        <li><a href="index.php?id=1" title="Accueil">Accueil</a></li>
                        <li><a href="#" title="Mis à jour">Mis &agrave; jour</a></li>
                        <li><a href="index.php?id=4" title="Contrat">Contrat</a></li>
                        
                        <!--<li><a href="index.php?id=8" title="MOTIF">MOTIF</a></li>-->
                    </ul>
             </div>
        </div>
    </div>

<div id="container">
   <div id="content_container">
		<div id="content">
			<h1>CONTRAT</h1>
			<hr />
			<div class="contact_form">
			
			
			  <div align="center">
			    <table width="456" height="224" border="0">
			      <form id="form_contrat" name="form_contrat" method="post" action="javascript:void(0)">
			        <tr>
			          <td>&nbsp;</td>
				      <td><input id="txt_id_contrat" type="hidden" name="txt_id_contrat"/>&nbsp;</td>
			        </tr>
			        <tr height="">
			          <td height="77"><label>
			            <div align="center">Type de contrat:</div>
		              </label>&nbsp;</td>
				      <td><input id="slct_type_contrat" type="text" name="slct_type_contrat"/>&nbsp;</td>
			        </tr>
			        <tr>
			          <td align="center" class="colone_btn"><button onClick="return script_ajout_contrat();" type="submit"  name="ajout" value="ajout" >Ajouter</button></td>
				    <td align="center" class="colone_btn"><button onClick="return script_modifier_contrat();" type="submit" name="modifier" value="modifier">Modifier</button></td>  
			        </tr>
			        <tr>
			          <td align="center" class="colone_btn"><button onClick="return script_suppression_contrat();" type="submit" name="supprimer" value="supprimer">Supprimer</button></td>
				    <td align="center" class="colone_btn"><button type="reset" name="annuler" value="annuler">Annuler</button></td>
			        </tr>
			        </form>
			      </table>
			    <!--<table border="0">
                <form id="form_contrat" name="form_contrat" method="post" action="javascript:void(0)">
                <tr><td>
					<label>
					</label>
                <td>
                    <input id="txt_id_contrat" type="text" name="txt_id_contrat"/>
				  <td>
                     <label>Type de contrat :
					</label>
				  <td>
					<input id="slct_type_contrat" type="text" name="slct_type_contrat"/>
               </tr>

					<tr>
						<td align="center" class="colone_btn">					
						<button onClick="return script_ajout_contrat();" type="submit"  name="ajout" value="ajout" >Ajouter</button>
						<td align="center" class="colone_btn">											
						<button onClick="return script_modifier_contrat();" type="submit" name="modifier" value="modifier">Modifier</button>
						<td align="center" class="colone_btn">					
						<button onClick="return script_suppression_contrat();" type="submit" name="supprimer" value="supprimer">Supprimer</button>
						<td align="center" class="colone_btn">					
						<button onClick="return effacer();" type="reset" name="annuler" value="annuler">Annuler</button>                    
                    </tr>
				</form>
                </table> -->
		      </div>
			  <hr />
				

		  </div>		
		</div>
        		
        
       	<div class="spacer"></div>
		
		<form id="form_contrat" name="form_contrat" method="post" action="Ajout_deposition.php">
		<div id="liste_contrat">
			<fieldset class="liste_emp" style="border-radius:10px;margin:20px;padding:20px;"><legend>Liste des contrats</legend>
 				<table width="100%" border="0px">
      
                    <tr bgcolor="#666666"> 
                        <td ><div align="center"><font color="#FFFFFF">N&deg;</div></td>
                        <td ><div align="center"><font color="#FFFFFF">type de contrat</div></td>                        
                    </tr>
                       <?php
                  
						$requete = " SELECT * FROM status ";

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
                            $id_contrat=$ligne['ID_CONTRAT'];
                            $typecontrat=$ligne['TYPE_CONTRAT'];
							
					  ?>
							
                                    <tr onclick="javascript:akor(<?php echo $i?>);" bgcolor="#CCCCCC" height="35px"> 
										<td id="id_cntrt<?php echo $i;?>"><div align="center"><?php echo $id_contrat?><input type="hidden" name="id<?php echo $i?>" value="<?php echo $id_contrat?>" /></div></td>
                                        <td id="type_cntrt<?php echo $i;?>"><div align="center"><?php echo $typecontrat?></div></td>
                             
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
