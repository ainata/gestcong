<script>
	
	function inscription_accepter(id)
	{
		var m=document.getElementById('txt_matricule'+id).value;
		var d=document.getElementById('slct_departement'+id).value;
		var p=document.getElementById('slct_poste'+id).value;
		var c=document.getElementById('slct_contrat'+id).value;
		var mot=document.getElementById('txt_mot_secret'+id).value;
		
		if( m=='' || d=='' || p=='' || c=='' || mot=='')alert('Vous devez remplir tous les champ');
		
		else {
			if(confirm("Voulez vous accepter cette demande ?"))
			{
				ident=document.getElementById('id_employer'+id).value;
				document.getElementById('form1').action="AcceptationDincription.php?code="+ident+"&id="+id;
			
			}
		}
	}
	
	$(function(i){
		
		
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


 <script>
		$(function() {
		
			
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
		$( "#dialog").dialog( "open" );
		});
		$("#ok").click(function(){
			if($('#safidy_daty').val()<=androany)
			{
				alert("impossible!car la date que vous avez selectionner est anterieur");
				$('#safidy_daty').val('');
				
			}
			else
			{
				$("#txt_fin_contrat").val($("#safidy_daty").val());
				$( "#dialog").dialog( "close" )
			}
		});
		$(".slct_contrat").change(function(){
			if($(this).val()==1)
			$( "#dialog" ).dialog( "open","position","center");
			
			
		});
		
				
		});
	
	
	
	function daty(){
				
				
				
				//if(date_depart!=''){
					if(date_depart < androany)
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
	
	
	</script>
<div class="display_bg" >
        <div class="navback">
            <div id="navigation">
                    <ul>
                        <li><a href="index.php?id=1" title="ACCUEIL">Accueil</a></li>
                        <li><a href="index.php?id=12" title="EMPLOYER">Demande d'inscription</a></li>
                        <!--<li><a href="index.php?id=3" title="DEPOSITION">DEPOSITION</a></li>
                        
                        <li><a href="index.php?id=5" title="MOTIF">MOTIF</a></li>-->
                    </ul>
             </div>
        </div>
    
        
    </div>
<div id="container">
<div id="content_container">
		<div id="content">
			<h1>Demande d'incription</h1>

			<hr />
            <div class="contact_form">
            <?php
			$req="select * from employer where MATRICULE='0' order by DATE_D_ENTREE DESC";
			if($req=mysql_query($req))
			{
				?>
                 <form method="post" id="form1" action="javascript:void(0)">
                 <div class="jquery_miova dialog" align="center" id="dialog" title="Fin de contrat">
                            <p >
                            <input id="safidy_daty" style="margin-left:50px" class="date" type="text" /><br /><p>
                            <input style="margin-left:70px" type="button" value="ok" id="ok" />
                            </p>
                            </p>
                  </div>
                  <input style="display:none" type="text" id="txt_fin_contrat" name="txt_fin_contrat" />
			<?php
				$i=0;
				while($row=mysql_fetch_array($req))
				{
					?>
					 <p>
                           <div class="div_accept" style="border:1px solid #CCCCCC;border-radius:5px;padding:20px; box-shadow:5px 5px 5px #CCCCCC;">
                            <div><span style="color:#00CCFF;"><?php echo $row['NOM']." ".$row['PRENOM'];?></span> veux s'inscrire.</div><br />
                            
                            <div><b>Remplire la formulaire :</b></div>
                            <input id="id_employer<?php echo $i;?>" type="hidden"  value="<?php echo $row['ID_EMPLOYER'];?>" />
                            <table>
                            
                             <tr><td>Matricule : </td><td><input placeholder="Matricule" id="txt_matricule<?php echo $i;?>" name="txt_matricule<?php echo $i;?>" type="text"></td></tr>
                            <tr><td>Departement : </td><td><select id="slct_departement<?php echo $i;?>" name="slct_departement<?php echo $i;?>"><option value="" selected="selected">selectonner</option><?php select_departement()?></select></td></tr>
                           <tr><td>Poste : </td><td><select id="slct_poste<?php echo $i;?>" name="slct_poste<?php echo $i;?>"><option selected="selected" value="">selectonner</option><?php select_poste()?></select></td></tr>
                           <tr><td>Contrat : </td><td><select id="slct_contrat<?php echo $i;?>" class="slct_contrat" name="slct_contrat<?php echo $i;?>"><option value="" selected="selected">selectonner</option><?php select_statut()?></select></td></tr>
                           <tr><td>Mot sécret : </td><td><input placeholder="Mot sécret" id="txt_mot_secret<?php echo $i;?>" name="txt_mot_secret<?php echo $i;?>" type="text"></td></tr>
                           </table>
                            
                            <div style="float:right"><button onclick="inscription_accepter(<?php echo $i?>);" name="accepter" type="submit" >OK</button></div>
                            <br />
                            <br />
                           </div>
                      </p>
                   <?php
				   $i++;
				}?>
                
                </form>
                <?php
			}
			else echo mysql_error();
			?>
                
            
             </div>
		</div>
        
        <div id="sidebar">
        <div class="sidebar_section">
       <h5 align="center">listes de numéro matricule déjà existé:</h5>
       <div align="center">
       <table>
       <?php
	   		$req_liste_matricule="select * from employer where MATRICULE<>'0' order by MATRICULE ASC";
			if($req_liste_matricule=mysql_query($req_liste_matricule))
			{
				?>
                <tr><th>Matricule</th><th align="left">Nom</th><th align="left">Prénom</th></tr>
                <?php
				while($liste_matricule=mysql_fetch_array($req_liste_matricule))
				{
					echo "<tr><td>".$liste_matricule['MATRICULE']."</td><td>".$liste_matricule['NOM']."</td><td>".$liste_matricule['PRENOM']."</td></tr>";
				}
			}
			else echo mysql_error();
			
			
	   ?>
       </table>
       </div>
        </div>
        </div>
		<div class="spacer"></div>
	</div>
</div>