
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
			if(document.forms[0].txt_id_deposition.value=="")
				{
				alert("vous devez remplir l'identite motif");
				document.forms[0].elements[0].focus();
				return false;
				}
				else if(document.forms[0].txt_date_de_demande.value=="")
				{
					alert("vous devez selectionner type deposition");
					document.forms[0].txt_date_de_demande.focus();
					return false;
				}
				else if(document.forms[0].txt_date_de_retour.value==""){
					
					alert("vous devez remplir le nombre du jours maximum");
					document.forms[0].txt_date_de_retour.focus();
					return false;
					}
					else return true;
		}
		
		/*function script_ajout_deposition()
		{
			  if(valider()) {
				// les données sont ok, on peut envoyer le formulaire  
				var str = "Voulez vous ajouter vraiment?";
				if(confirm(str))
				{
					document.getElementById("form_deposition").action="Ajout_deposition.php?mode=4";
					return true;
				}
			  }
			  else {
				
				return false;
			  }
		}*/
		
		function script_modifier_deposition()
		{
			  if(valider()) {
				// les données sont ok, on peut envoyer le formulaire  
				var str = "Voulez vous modifier vraiment?";
				if(confirm(str))
				{
					document.getElementById("form_deposition").action="Modification.php?mode=4";
					return true;
				}
			  }
			  else {
				return false;
			  }
		}
		
		function script_suppression_deposition()
		{
			  if(valider()) {
				// les données sont ok, on peut envoyer le formulaire  
				var str = "Voulez vous supprimer vraiment?";
				if(confirm(str))
				{
					document.getElementById("form_deposition").action="Suppression.php?mode=4";
					return true;
				}
			  }
			  else {
				
				return false;
			  }
		}
		
function zanve(i)
{

		document.forms[0].txt_id_deposition.value=document.getElementById("id_dep"+i).textContent;
		document.forms[0].slct_employer.value=document.getElementById("id_emplo"+i).textContent;
		document.forms[0].txt_date_de_demande.value=document.getElementById("dtdemande"+i).textContent;
		document.forms[0].txt_date_de_depart.value=document.getElementById("dtdepart"+i).textContent;
		document.forms[0].txt_date_de_retour.value=document.getElementById("dtretour"+i).textContent;
		document.forms[0].slct_motif.value=document.getElementById("motif"+i).textContent;
				
}

</script>

<div id="container">
<div id="content_container">
		<div id="content">
			<h1>DEPOSITION DE DEMANDE</h1>
			<hr />
			<div class="contact_form">
				
                <table border="0">
                <form id="form_deposition" name="form_deposition" method="post" action="Ajout_deposition.php">
                <tr><td>
					<label>N° déposition: </label>
                  	<td >
					<input id="txt_id_deposition" type="text" name="txt_id_deposition" />
					<td>
                    <label>Matricule :					</label>
					<td>
                    <select id="slct_employer" name="slct_employer"  >
                
                <?php select_employer();?>
                </select>
                    
                    							
					
                  </tr>
                <tr><td>
                
                <label class="misitaka">Date de demande:					</label><td>
                  <input id="txt_date_de_demande" type="text" name="txt_date_de_demande" />
               	  <td>
                    
                    <label>Date de depart:					</label><td>
                    <input class="date" id="txt_date_de_depart" type="text" name="txt_date_de_depart" />
                  </tr>
                <tr>
                    <td>
                    
                    <label >Date de retour :					</label><td>
                    <input class="date" id="txt_date_de_retour" type="text" name="txt_date_de_retour" />          
                 <td>
                   <label >Motif:					</label><td>
                     <select id="slct_motif" name="slct_motif" >
                <option selected>----------</option>
                <?php select_motif();?>
                </select>
                   
                </tr>
                    
                
					<!--<input type="text" name="Email" />-->
										
					<!--<label>Message
						<span class="small">Communicate with us</span>
					</label>
					<textarea name="Message" cols="0" rows="7"></textarea>-->
					<tr >
                    	
						<td align="center" class="colone_btn">											
						<button onClick="return script_ajout_deposition();" type="submit"  name="Envoyer" value="Envoyer" >Envoyer</button>
						<td align="center" class="colone_btn">											
						<button onClick="return script_modifier_deposition();" type="submit" name="modifier" value="modifier">Modifier</button>
						<td align="center" class="colone_btn">					
						<button onClick="return script_suppression_deposition();" type="submit" name="supprimer" value="supprimer">Supprimer</button>
						<td align="center" class="colone_btn">					
						<button onClick="return effacer();" type="reset" name="annuler" value="annuler">Annuler</button>                    
					</tr>
				</form>
                </table>
                <hr />
                

			</div>		
	</div>
        		<div class="spacer"></div>
		<form id="form_deposition" name="form_deposition" method="post" action="Ajout_deposition.php">
				<div id="liste_deposition">
					<fieldset class="liste_emp" style="border-radius:10px;margin:20px;padding:20px;"><legend>Liste des depositions</legend>
						<table width="100%" border="0px">
			  
							<tr bgcolor="#666666"> 
								<td ><div align="center"><font color="#FFFFFF">Id</div></td>
								<td ><div align="center"><font color="#FFFFFF">Matricule</div></td>
								<td ><div align="center"><font color="#FFFFFF">Date demande</div></td>
								<td ><div align="center"><font color="#FFFFFF">Date depart</div></td> 
								<td ><div align="center"><font color="#FFFFFF">Date retour</div></td>
								<td ><div align="center"><font color="#FFFFFF">Motif</div></td>                       
							</tr>
							   <?php
     $requete = "SELECT *,MATRICULE,MOTIF FROM employer,deposition,motif where employer.ID_EMPLOYER = deposition.ID_EMPLOYER AND motif.ID_MOTIF = deposition.ID_MOTIF";
		
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
									$id_deposition=$ligne['ID_DEPOSITION'];
									$id_employe=$ligne['MATRICULE'];
									$datedemande=$ligne['DATE_DE_DEMANDE'];
									$datedepart=$ligne['DATE_DEPART'];
									$dateretour=$ligne['DATE_RETOUR'];
									$motif=$ligne['MOTIF'];
									
								?>
									
											<tr onclick="javascript:zanve(<?php echo $i?>);" bgcolor="#CCCCCC" height="35px"> 
												<td id="id_dep<?php echo $i;?>"><div align="center"><?php echo $id_deposition?><input type="hidden" name="id<?php echo $i?>" value="<?php echo $id_deposition?>" /></div></td>
												<td id="id_emplo<?php echo $i;?>"> <div align=\"center\"><?php echo $id_employe?></div></td>
												<td id="dtdemande<?php echo $i;?>"> <div align=\"center\"><?php echo $datedemande?></div></td>
												<td id="dtdepart<?php echo $i;?>"> <div align=\"center\"><?php echo $datedepart?></div></td>
												<td id="dtretour<?php echo $i;?>"> <div align=\"center\"><?php echo $dateretour?></div></td>
												<td id="motif<?php echo $i;?>"> <div align=\"center\"><?php echo $motif?></div></td>
											
									 
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

