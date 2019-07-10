
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
			if(document.forms[0].slct_id_type_deposition.value=="")
				{
				alert("vous devez remplir l'identite motif");
				document.forms[0].elements[0].focus();
				return false;
				}
				else if(document.forms[0].slct_id_type_deposition.value=="")
				{
					alert("vous devez selectionner type deposition");
					document.forms[0].slct_id_type_deposition.focus();
					return false;
				}
				else if(document.forms[0].txt_Nb_jours_Max.value==""){
					
					alert("vous devez remplir le nombre du jours maximum");
					document.forms[0].txt_Nb_jours_Max.focus();
					return false;
					}
					else if(document.forms[0].txt_Motif.value=="")
					{
						alert("vous devez remplir motif");
						document.forms[0].txt_Motif.focus();
						return false;

					}
					else return true;
		}
		
		function script_ajout_motif()
		{
			  if(valider()) {
				// les données sont ok, on peut envoyer le formulaire  
				var str = "Voulez vous ajouter vraiment?";
				if(confirm(str))
				{
					document.getElementById("form_motif").action="Ajout_motif.php?mode=2";
					return true;
				}
			  }
			  else {
				
				return false;
			  }
		}
		
		function script_modifier_motif()
		{
			  if(valider()) {
				// les données sont ok, on peut envoyer le formulaire  
				var str = "Voulez vous modifier vraiment?";
				if(confirm(str))
				{
					document.getElementById("form_motif").action="Modification.php?mode=2";
					return true;
				}
			  }
			  else {
				return false;
			  }
		}
		
		function script_suppression_motif()
		{
			  if(valider()) {
				// les données sont ok, on peut envoyer le formulaire  
				var str = "Voulez vous supprimer vraiment?";
				if(confirm(str))
				{
					document.getElementById("form_motif").action="Suppression.php?mode=2";
					return true;
				}
			  }
			  else {
				
				return false;
			  }
		}
		
		//Test NB MAX
		function TesterNBjoursMax(nombre){
	   			if (isNaN(nombre)==true){
	        	alert("Le nombre de jours doit etre en nombre!svp!");
	   		}
		}
		function ControlerNBjoursMax(form_motif){
	        TesterNBjoursMax(document.forms[0].txt_Nb_jours_Max.value);
		}
		
function zanve(i)
{

		document.forms[0].txt_id_motif.value=document.getElementById("id_mtf"+i).textContent;
		document.forms[0].slct_id_type_deposition.value=document.getElementById("id_type_depo"+i).textContent;
		document.forms[0].txt_Nb_jours_Max.value=document.getElementById("nbjourmax"+i).textContent;
		document.forms[0].txt_Motif.value=document.getElementById("motif"+i).textContent;
				
}
</script>
<div class="display_bg" >
        <div class="navback">
            <div id="navigation">
                    <ul>
                        <li><a href="index.php?id=1" title="Accueil">Accueil</a></li>
                        <li><a href="#" title="Mis à jour">Mis &agrave; jour</a></li>
                        <li><a href="index.php?id=5" title="Motif">Motif</a></li>
                        
                        <!--<li><a href="index.php?id=8" title="MOTIF">MOTIF</a></li>-->
                    </ul>
             </div>
        </div>
    </div>
<div id="container">
   <div id="content_container">
		<div id="content">
			<h1>MOTIF</h1>
			<hr />
			<div class="contact_form">
				
                <div align="left">
				<form id="form_motif" name="form_motif" method="post" action="javascript:void(0)">
                  
                    <table width="622" height="193" border="0" align="center">
                      
                      <tr>
                        <td></td>
			             <td width="175" height="39"></td>
					     <td width="241"><input id="txt_id_motif" type="hidden" name="txt_id_motif" /></td>
					     <td></td>
				      </tr>
                      <tr>
                        <td></td>
			            <td width="175" height="39"><strong>Type deposition :</strong></td>
					    <td width="241">
					      <select id="slct_id_type_deposition" name="slct_id_type_deposition">
					        <option selected>Selectionner</option>
					        <?php select_id_type_deposition();?>
				          </select></td>
					    <td></td>
				      </tr>
                      <tr>
                        <td></td>
			            <td height="40"><strong>Nombre de jours :</strong></td>
					    <td><input id="txt_Nb_jours_Max" type="text" name="txt_Nb_jours_Max" onBlur="ControlerNBjoursMax(form_motif)"/></td>
					    <td></td>
				      </tr>
                      <tr>
                        <td></td>
			            <td width="179" height="60"><strong>Motif :</strong></td>
					    <td width="243"><textarea id="txt_Motif" type="text" name="txt_Motif"> </textarea></td>
					    <td></td>
				      </tr>
                    </table> 

                    <div align="center">
                      <table width="673" height="47" border="0">
                        
                        <td align="center" class="colone_btn">					
                          <button onClick="return script_ajout_motif();" type="submit"  name="ajout" value="ajout" >Ajouter</button></td>
					      <td align="center" class="colone_btn">											
					        <button onClick="return script_modifier_motif();" type="submit" name="modifier" value="modifier">Modifier</button></td>
					      <td align="center" class="colone_btn">					
					        <button onClick="return script_suppression_motif();" type="submit" name="supprimer" value="supprimer">Supprimer</button></td>
					      <td align="center" class="colone_btn"><button onClick="return effacer();" type="reset" name="annuler" value="annuler">Annuler</button></td>
                       
                    </table>
                    </div>
				</form>
                </div>
                <hr />
				

		  </div>		
		</div>
        		
        
       	<div class="spacer"></div>
		
		<form id="formMotif" name="formMotif" method="post" action="">
		<div id="liste_motif">
			<fieldset class="liste_emp" style="border-radius:10px;margin:20px;padding:20px;"><legend>Liste des motifs</legend>
 				<table width="100%" border="0px">
      
                    <tr bgcolor="#666666"> 
                        <td ><div align="center"><font color="#FFFFFF">Id</div></td>
                        <td ><div align="center"><font color="#FFFFFF">type deposition</div></td>
                        <td ><div align="center"><font color="#FFFFFF">Nb Jours Max</div></td>
                        <td ><div align="center"><font color="#FFFFFF">Motif</div></td>                        
                    </tr>
                       <?php
                  
						$requete = "SELECT *,NOM FROM motif,type_deposition where motif.ID_TYPE_DEP = type_deposition.ID_TYPE_DEP ";

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
                            $id_motif=$ligne['ID_MOTIF'];
                            $typedeposition=$ligne['NOM'];
                            $nbjoursmax=$ligne['NOMBRE_JOUR_MAX'];
                            $motif=$ligne['MOTIF'];?>
							
                                    <tr onclick="javascript:zanve(<?php echo $i?>);" bgcolor="#CCCCCC" height="35px"> 
										<td id="id_mtf<?php echo $i;?>"><div align="center"><?php echo $id_motif?><input type="hidden" name="id<?php echo $i?>" value="<?php echo $id_motif?>" /></div></td>
                                        <td id="id_type_depo<?php echo $i;?>"><div align="center"><?php echo $typedeposition?></div></td>
                                        <td id="nbjourmax<?php echo $i;?>"><div align="center"><?php echo $nbjoursmax?></div></td>
                                        <td id="motif<?php echo $i;?>"><div align="center"><?php echo $motif?></div></td>
                                    
                             
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
