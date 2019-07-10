<script>
	function annuler(id){
		if(confirm("Voulez vous annuler cette demande ?"))
		{
			ident=document.getElementById('id_deposition'+id).value;
			//ident=document.getElementById('id_employer'+id).value;
			//type_deposition=document.getElementById('id_type_deposition'+id).value;
			document.getElementById('form2').action="AnnulationDeDemande.php?code="+ident;
		
		}
	}
</script>
 <div class="display_bg" >
        <div class="navback">
            <div id="navigation">
                    <ul>
                        <li><a href="index.php?id=1" title="Accueil">Accueil</a></li>
                        <li><a href="index.php?id=7" title="Envoye demande">Envoye demande</a></li>
                    </ul>
             </div>
        </div>
    </div>



<div id="container">
<div id="content_container">
		<div id="content">
			<h1 align="center"><font color="#D80525">DEPOSEZ VOTRE DEMANDE</font> </h1>
			<hr />
			<div class="contact_form">
				
              <form id="Envoye_deposition" method="post" action="javascript:void(0)">
               <table width="90%" border="0px">
               		 <tr>
                        <td><label for="slct_jour_entree">Choix de motif :</label></td>
                        <td><select id="slct_motif" name="slct_motif" >
                        <option value="">selectionner</option>
                                <?php select_motif();?>
                            </select>
                        </td>
                        <td class="information" ></td>
					</tr>
                    <tr class="motif_personnelle motif_raikitra" >
                        <td><label for="txt_date_de_depart">Entrer la date de départ :</label></td>
                        <td><input class="date" type="date" name="txt_date_de_depart" id="txt_date_de_depart"></td>
                        <td><select onfocus="daty();" id="slct_jour_depart" name="slct_jour_depart" >
                                <option selected>Matin</option>
                                <option>Apres midi</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="motif_personnelle" >
                        <td><label for="txt_date_d_entree">Et la date d'entrée :</label></td>
                        <td><input class="date" type="date" name="txt_date_d_entree" id="txt_date_d_entree"></td>
                        <td><select onfocus="comparaisonDate();" id="slct_jour_entree" name="slct_jour_entree" >
                                <option selected>Matin</option>
                                <option>Apres midi</option>
                            </select>
                        </td>
                    </tr>
                    
                     <tr class="motif_personnelle" >
                        <td colspan="3"><label>Votre motif personnelle :</label><br>
                        <textarea name="motif_personnel" cols="70" rows="7"></textarea>
                        </td>
					</tr>
                   
                   <tr>
                   		<td><button type="submit" id="Envoyer" >Envoyer</button></td>
                        <td><button type="reset" >Annuler</button></td>
                  </tr>
               </table>
                    
    			</form>
                <hr />
                
             
                <span id="resultat"></span>
				</div>
				
	</div>
    
    
   <div id="sidebar" align="center">
    <h3 style="color:#FF2D2D;">Demande en cours:</h3>
    <div>
    <form method="post" action="javascript:void(0)" id="form2">
    <?php
	function format_date_enFR($dat)
	{
		List($annee1,$mois1,$jour1)=explode('-',$dat);
		echo $jour1.'-'.$mois1.'-'.$annee1;
	}
	/*function nbJours($debut, $fin) {
					//60 secondes X 60 minutes X 24 heures dans une journée
					$nbSecondes= 60*60*24;
			 
					$debut_ts = strtotime($debut);
					$fin_ts = strtotime($fin);
					$diff = $fin_ts - $debut_ts;
					return round($diff / $nbSecondes);
	}*/
	
		$req="select * from departement where ID_EMPLOYER=".$_SESSION['id'];
		$req=mysql_query($req);
		if(mysql_num_rows($req))
		{
			$re="select * from valider,deposition where valider.ID_DEPOSITION=deposition.ID_DEPOSITION and deposition.ID_EMPLOYER=".$_SESSION['id']."  and VALIDE_RESPONSABLE = 'non vu' order by DATE_DE_DEMANDE DESC";
		}
		else{
		$re="select * from valider,deposition where valider.ID_DEPOSITION=deposition.ID_DEPOSITION and deposition.ID_EMPLOYER=".$_SESSION['id']." and VALIDE_DEPARTEMENT = 'non vu' and VALIDE_RESPONSABLE = 'non vu' order by DATE_DE_DEMANDE DESC";
		}
		if($re=mysql_query($re))
		{
			$i=0;
			while($row=mysql_fetch_array($re))
			{
				$mitady_anarana_motif="select * from motif where ID_MOTIF=".$row['ID_MOTIF'];
				$mitady_anarana_motif=mysql_query($mitady_anarana_motif);
				$req_mitady_anarana_motif=mysql_fetch_array($mitady_anarana_motif);
				$motif=$req_mitady_anarana_motif['ID_TYPE_DEP'];
				$motif_nom=$req_mitady_anarana_motif['MOTIF'];
							
				$conger_perm="select * from type_deposition where ID_TYPE_DEP =".$motif;
				$conger_perm=mysql_query($conger_perm);
				$req_conger_perm=mysql_fetch_array($conger_perm);
				$type_deposition=$req_conger_perm['NOM'];
				
				$nb_jour=nbJours($row['DATE_DEPART'], $row['DATE_RETOUR']);
				if($row['JOURNE_DE_DEPART']=="Matin" && $row['JOURNE_DE_RETOUR']=="Apres midi")
				{
					$nb_jour=$nb_jour+0.5;
				
				}
				if($row['JOURNE_DE_DEPART']=="Apres midi" && $row['JOURNE_DE_RETOUR']=="Matin")
				{
					$nb_jour=$nb_jour-0.5;
					
				}
				?>
               <div class="sidebar_section">
               <!-- <input value="<?php //echo $row['ID_DEPOSITION']?>" type="hidden" name="id_deposition<?php //echo $i?>" id="id_deposition<?php //echo $i?>" />-->
				<div>Date de demande: <?php format_date_enFR($row['DATE_DE_DEMANDE']);?></div>
                <div>Date de depart : <?php format_date_enFR($row['DATE_DEPART']);echo " ".$row['JOURNE_DE_DEPART'];?></div>
                <div>Date de retour : <?php format_date_enFR($row['DATE_RETOUR']);echo " ".$row['JOURNE_DE_RETOUR'];?></div>
                <div>Durré de <?php echo $type_deposition." : ".$nb_jour." jours"?> </div>
                <div >Cause : <?php echo $row['EXPLICATION']?> </div>
                <div style="float:right;padding-bottom:10px;"><button class="btn_annuler_dep" style="background:#1aa5d4;color:white;border-color:#1aa5d4;border-radius:5px" onclick="annuler(<?php echo $i?>)" type="submit">Annuler</button></div>
               
               	
                </div>
				<?php
				
			}
			$i++;
		}
	?>
    </form>
    
    
    </div>
    </div>
        		<div class="spacer"></div>
		
		
  </div>
</div>


<script language="JavaScript" >
function daty(){
				var dat=new Date()
				var taona=dat.getYear()-100+2000
				var jour
				if(dat.getDate()<10)
				{
					jour='0'+dat.getDate();
				}
				else
				{
					jour=dat.getDate();
				}
				if(dat.getMonth()<10)
				{
					mois='0'+dat.getMonth()+1;
				}
				else
				{
					mois=dat.getMonth()+1;
				}
			
				var androany=taona+'-'+mois+'-'+jour;
				var date_depart=document.getElementById('txt_date_de_depart').value;
				var tab_date = date_depart.split('-');
				
				
				//if(date_depart!=''){
					if(date_depart <= androany)
					{
						alert("impossible! verifier d'abord la date de depart");
						document.getElementById('txt_date_de_depart').value='';
						
						return false;
						//date_depart.focus();
						//date_depart.style.borderColor='red';
						
						
					}
				//}*/
				else return true;
				
		}
function comparaisonDate(){
	var dateEntree=document.getElementById('txt_date_d_entree').value;
	var dateDepart=document.getElementById('txt_date_de_depart').value;
	//alert(dateEntree+" "+dateDepart);
	if(dateEntree < dateDepart)
	{
		alert("impossible!la date de retour doit superieur de "+dateDepart);
		dateEntree=document.getElementById('txt_date_d_entree').value='';
		return false;
	}
	else return true
	
}
function slct_motif()
{
	var selt=document.getElementById('slct_motif').value;
	if(selt!="")
	{
		return true;
	}
	else
	{
		alert("impossible!car vous n'a pas selectionner un motif");
		return false;
	}
}
$(function()
	{
		$('#slct_motif').change(function(){
			/*if($(this).val()=='4')
			{
				
				//$('.motif_personnelle').show('slow');
				//$(".information").hide('slow');
			}
			else
			{
				//$('.motif_personnelle').hide();
				*/
				
				$.post("AffichageInformationMotif.php",$("#Envoye_deposition :input").serializeArray(),function(info){$(".information").html(info).show('slow');});
				
			//}
		
		});
		$("#Envoyer").click(function(){
			if(daty() && comparaisonDate() && slct_motif()){
				
			if(confirm("Voulez vous envoyer vraiment?"))//document.getElementById("Envoye_deposition").action="Envoye_depositon.php";
			
			$.post("Envoye_depositon.php",$("#Envoye_deposition :input").serializeArray(),function(info){$("#resultat").html(info);
			//.fadeOut('slow');
			});
			
			}
		});
		
	
	});
</script>

<!--<div id="sidebar">
			<div class="sidebar_section">

				<div class="sidebar_title">
					<h4>Affiliates</h4>
					<small>Subtitle w/ Information</small>
				</div>
				<ul class="ads clearfix">
						<li><a href="http://themeforest.net?ref=jdsans" target="_blank" title="ThemeForest"><img src="images/affiliates/themeforest.jpg" alt="ThemeForest" /></a></li>
						<li><a href="http://graphicriver.net?ref=jdsans" target="_blank" title="GraphicRiver"><img src="images/affiliates/graphicriver.jpg" alt="Graphic River" /></a></li>
						<li><a href="http://videohive.net?ref=jdsans" target="_blank" title="VideoHive"><img src="images/affiliates/videohive.jpg" alt="VideoHive" /></a></li>
						<li><a href="http://flashden.net?ref=jdsans" target="_blank" title="FlashDen"><img src="images/affiliates/flashden.jpg" alt="FlashDen" /></a></li>
				</ul>
			</div>
			<div class="sidebar_section">
				<div class="sidebar_title">

					<h4>About Us</h4>
					<small>Subtitle w/ Information</small>
				</div>
				<p>Sed aliquet, augue at consequat porta, nisl nibh fringilla metus, at rutrum diam mauris nec enim. Curabitur odio leo, lacinia non imperdiet in, mollis id ante. Proin venenatis, metus at tristique ultrices, sapien orci blandit libero, a porta erat mauris quis est. </p>
				<div class="sidebar_link"><a href="aboutus.htm" title="About Us">Learn More About Us</a></div>
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