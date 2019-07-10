
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
			if(document.forms[0].txt_nom_poste.value=="")
				{
				alert("vous devez remplir la poste");
				document.forms[0].elements[0].focus();
				return false;
				}
				else return true;
		}
		
		function script_ajout_poste()
		{
			  if(valider()) 
			  {
				// les données sont ok, on peut envoyer le formulaire  
				var str = "Voulez vous ajouter vraiment?";
				if(confirm(str))
				{
					document.getElementById("form_poste").action="Ajout_poste.php?mode=5";
					return true;
				}
			  }
			  else {
				
				return false;
			  }
		}
		
		function script_modifier_poste()
		{
			  if(valider()) {
				// les données sont ok, on peut envoyer le formulaire  
				var str = "Voulez vous modifier vraiment?";
				if(confirm(str))
				{
					document.getElementById("form_poste").action="Modification.php?mode=5";
					return true;
				}
			  }
			  else {
				return false;
			  }
		}
		
		function script_suppression_poste()
		{
			  if(valider()) {
				// les données sont ok, on peut envoyer le formulaire  
				var str = "Voulez vous supprimer vraiment?";
				if(confirm(str))
				{
					document.getElementById("form_poste").action="Suppression.php?mode=5";
					return true;
				}
			  }
			  else {
				
				return false;
			  }
		}
		
function akor(i)
{

		document.forms[0].txt_id_poste.value=document.getElementById("id_pst"+i).textContent;
		document.forms[0].txt_nom_poste.value=document.getElementById("pst"+i).textContent;
						
}

</script>
<div class="display_bg" >
        <div class="navback">
            <div id="navigation">
                    <ul>
                        <li><a href="index.php?id=1" title="Accueil">Accueil</a></li>
                        <li><a href="#" title="Mis à jour">Mis &agrave; jour</a></li>
                        <li><a href="index.php?id=13" title="Poste">Poste</a></li>
                        
                        <!--<li><a href="index.php?id=8" title="MOTIF">MOTIF</a></li>-->
                    </ul>
             </div>
        </div>
    </div>
<div id="container">
   <div id="content_container">
		<div id="content">
			<h1>POSTE</h1>
			<hr />
			<div class="contact_form">
				
				
				<div align="center">
				  <table width="456" height="224" border="0">
				    <form id="form_poste" name="form_poste" method="post" action="javascript:void(0)">
				      <tr>
				        <td>&nbsp;</td>
					  <td><input id="txt_id_poste" type="hidden" name="txt_id_poste"/>&nbsp;</td>
				    </tr>
				      <tr height="">
				        <td height="77"><label>
				          <div align="center">Nom poste :</div>
				        </label>&nbsp;</td>
					  <td><input id="txt_nom_poste" type="text" name="txt_nom_poste"/>&nbsp;</td>
				    </tr>
				      <tr>
				        <td align="center" class="colone_btn"><button onClick="return script_ajout_poste();" type="submit"  name="ajout" value="ajout" >Ajouter</button></td>
				  <td align="center" class="colone_btn"><button onClick="return script_modifier_poste();" type="submit" name="modifier" value="modifier">Modifier</button></td>  
				    </tr>
				      <tr>
				        <td align="center" class="colone_btn"><button onClick="return script_suppression_poste();" type="submit" name="supprimer" value="supprimer">Supprimer</button></td>
				  <td align="center" class="colone_btn"><button type="reset" name="annuler" value="annuler">Annuler</button></td>
				    </tr>
			        </form>
			    </table>
			  </div>
				<hr />
				

		  </div>		
		</div>
        		
        
       	<div class="spacer"></div>
		
		<form id="form_poste" name="form_poste" method="post" >
		<div id="liste_poste">
			<fieldset class="liste_emp" style="border-radius:10px;margin:20px;padding:20px;"><legend>Liste des postes</legend>
 				<table width="100%" border="0px">
      
                    <tr bgcolor="#666666"> 
                        <td ><div align="center"><font color="#FFFFFF">N&deg;</div></td>
                        <td ><div align="center"><font color="#FFFFFF">Nom poste</div></td>                        
                    </tr>
                       <?php
                  
						$requete = " SELECT * FROM poste ORDER BY ID_POSTE ASC ";

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
                            while ($ligne = mysql_fetch_array($result))
                            { 
                            $id_poste=$ligne['ID_POSTE'];
                            $nom_poste=$ligne['NOM_POSTE'];
							
					  ?>
							
                                    <tr onclick="javascript:akor(<?php echo $i?>);" bgcolor="#CCCCCC" height="35px"> 
										<td id="id_pst<?php echo $i;?>"><div align="center"><?php echo $id_poste?><input type="hidden" name="id<?php echo $i?>" value="<?php echo $id_poste?>" /></div></td>
                                        <td id="pst<?php echo $i;?>"><div align="center"><?php echo $nom_poste?></div></td>
                             
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
