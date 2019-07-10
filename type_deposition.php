
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
			if(document.forms[0].txt_nom_type_deposition.value=="")
				{
				alert("vous devez remplir le type de deposition");
				document.forms[0].elements[0].focus();
				return false;
				}
				/*else if(document.forms[0].txt_nom_type_deposition.value=="")
				{
					alert("vous devez remplir le type de contrat");
					document.forms[0].txt_nom_type_deposition.focus();
					return false;
				}*/
				else return true;
		}
		
		function script_ajout_type_deposition()
		{
			  if(valider()) {
				// les données sont ok, on peut envoyer le formulaire  
				var str = "Voulez vous ajouter vraiment?";
				if(confirm(str))
				{
					document.getElementById("form_type_deposition").action="Ajout_type_deposition.php?mode=6";
					return true;
				}
			  }
			  else {
				
				return false;
			  }
		}
		
		function script_modifier_type_deposition()
		{
			  if(valider()) {
				// les données sont ok, on peut envoyer le formulaire  
				var str = "Voulez vous modifier vraiment?";
				if(confirm(str))
				{
					document.getElementById("form_type_deposition").action="Modification.php?mode=6";
					return true;
				}
			  }
			  else {
				return false;
			  }
		}
		
		function script_suppression_type_deposition()
		{
			  if(valider()) {
				// les données sont ok, on peut envoyer le formulaire  
				var str = "Voulez vous supprimer vraiment?";
				if(confirm(str))
				{
					document.getElementById("form_type_deposition").action="Suppression.php?mode=6";
					return true;
				}
			  }
			  else {
				
				return false;
			  }
		}
		
		//Test id contrat
		/*function TesterIdcontrat(nombre){
	   			if (isNaN(nombre)==true){
	        	alert("Le numero d'identite contrat doit etre en nombre!svp!");
	   		}
		}
		
		function ControlerIdcontrat(form_contrat){
	        TesterIdcontrat(document.forms[0].txt_id_contrat.value);
		}*/
		
		
function akor(i)
{

		document.forms[0].txt_id_type_deposition.value=document.getElementById("id_tpdep"+i).textContent;
		document.forms[0].txt_nom_type_deposition.value=document.getElementById("nom_tpdep"+i).textContent;
						
}

</script>
<div class="display_bg" >
        <div class="navback">
            <div id="navigation">
                    <ul>
                        <li><a href="index.php?id=1" title="Accueil">Accueil</a></li>
                        <li><a href="#" title="Mis à jour">Mis &agrave; jour</a></li>
                        <li><a href="index.php?id=14" title="Type de deposition">Type de deposition</a></li>
                        
                        <!--<li><a href="index.php?id=8" title="MOTIF">MOTIF</a></li>-->
                    </ul>
             </div>
        </div>
    </div>
<div id="container">
   <div id="content_container">
		<div id="content">
			<h1>TYPE DEPOSITION</h1>
			<hr />
			<div class="contact_form">
				
				<div align="center">
				  <table width="513" height="228" border="0">
				    <form id="form_type_deposition" name="form_type_deposition" method="post" action="javascript:void(0)">
				      <tr>
				        <td width="248">&nbsp;</td>
					    <td width="255"><input id="txt_id_type_deposition" type="hidden" name="txt_id_type_deposition"/>&nbsp;</td>
				      </tr>
				      <tr height="">
				        <td height="40"><div align="center"><strong>Type de deposition :</strong></div></td>
					    <td><input id="txt_nom_type_deposition" type="text" name="txt_nom_type_deposition"/>&nbsp;</td>
				      </tr>
				      <tr>
				        <td align="center" class="colone_btn"><button onClick="return script_ajout_type_deposition();" type="submit"  name="ajout" value="ajout">Ajouter</button></td>
				    <td align="center" class="colone_btn"><button onClick="return script_modifier_type_deposition();" type="submit" name="modifier" value="modifier">Modifier</button></td>  
				      </tr>
				      <tr>
				        <td align="center" class="colone_btn"><button onClick="return script_suppression_type_deposition();" type="submit" name="supprimer" value="supprimer">Supprimer</button></td>
				    <td align="center" class="colone_btn"><button type="reset" name="annuler" value="annuler">Annuler</button></td>
				      </tr>
			        </form>
			      </table>
				  <!--<table border="0">
                <form id="form_type_deposition" name="form_type_deposition" method="post" action="javascript:void(0)">
                <tr><td>
					<label> 
					</label>
                <td>
                    <input id="txt_id_type_deposition" type="text" name="txt_id_type_deposition" />
					<td>
                     <label>type deposition :
					</label>
					<td>
					<input id="txt_nom_type_deposition" type="text" name="txt_nom_type_deposition" />
               </tr>

					<tr >
						<td align="center" class="colone_btn">					
						<button onClick="return script_ajout_type_deposition();" type="submit"  name="ajout" value="ajout" >Ajouter</button>
						<td align="center" class="colone_btn">											
						<button onClick="return script_modifier_type_deposition();" type="submit" name="modifier" value="modifier">Modifier</button>
						<td align="center" class="colone_btn">					
						<button onClick="return script_suppression_type_deposition();" type="submit" name="supprimer" value="supprimer">Supprimer</button>
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
		
		<form id="form_type_deposition" name="form_type_deposition" method="post">
		<div id="liste_contrat">
			<fieldset class="liste_emp" style="border-radius:10px;margin:20px;padding:20px;"><legend>Liste des types deposition</legend>
 				<table width="100%" border="0px">
      
                    <tr bgcolor="#666666"> 
                        <td ><div align="center"><font color="#FFFFFF">N&deg;</font></div></td>
                        <td ><div align="center"><font color="#FFFFFF">type deposition</font></div></td>                        
                    </tr>
                       <?php
                  
						$requete = " SELECT * FROM type_deposition ORDER BY ID_TYPE_DEP ASC ";

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
                            $id_Type_deposition=$ligne['ID_TYPE_DEP'];
                            $nom_type_deposition=$ligne['NOM'];
							
					  ?>
							
                                    <tr onclick="javascript:akor(<?php echo $i?>);" bgcolor="#CCCCCC" height="35px"> 
										<td id="id_tpdep<?php echo $i;?>"><div align="center"><?php echo $id_Type_deposition?><input type="hidden" name="id<?php echo $i?>" value="<?php echo $id_Type_deposition?>" /></div></td>
                                        <td id="nom_tpdep<?php echo $i;?>"><div align="center"><?php echo $nom_type_deposition?></div></td>
                             
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
