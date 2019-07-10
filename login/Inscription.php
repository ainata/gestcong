<script language="JavaScript" >
 function effacer() 
        { 
		if(confirm("voulez vous annuler?")){

            document.forms[0].elements[0].focus();
			return true
            
		}
		else return false;
        }
</script>

<script>
	$(function()
	{
		$('#txt_mail').keyup(function()
		{
			ADRESSEMAIL=$('#txt_mail').val();
			$.ajax({
				type:"POST",
				url:"verification_mail.php",
				data:'txt_mail='+ADRESSEMAIL,
				success:function(data)
				{
					if(data==1)
					{
						$('#txt_mail').next('#diso').fadeIn().text('e-mail exit deja');
						$('#txt_mail').css('border-color','red');
						$('#diso').next("#marina").fadeOut();
					}
					else
					{
						$('#diso').next('#marina').fadeIn().text("");
						$('#txt_mail').next('#diso').fadeOut();
						$('#txt_mail').css('border-color','inherit');
					}
				}
			})
		});
		$('#envoyer').click(
		function(e){
			var email = $("#txt_mail").val();
			var name = $("#txt_nom").val();
			var pass = $("#txt_mot_de_passe").val();
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			if( email ==='' || name ==='' || pass==='')
			   {
				 alert("Remplir ce formulaire s'il vous plait");
				 e.preventDefault();
			   }
			else if(!(email).match(emailReg))
			   {
				 alert("Email invalide");
				 e.preventDefault();
			   }    
			else 
			   {
				 if(!confirm("ete vous sur de continuer?"))e.preventDefault;
				 else
				 {
					 $.post("Inserer_Inscription.php",$("#inscription :input").serializeArray(),function(info){$("#resultat").html(info).delay(1000).fadeOut('slow');});
					 
					 $("#inscription").submit(function(){
						return false;
					}
					);
	
					 /*$('.misitaka').hide();
					$('.miseho').show();*/
				 }
			   }
			
			
		});
		$('#txt_mot_de_passe1').keyup(function(){
		var pass = $("#txt_mot_de_passe").val();
		if($(this).val()!='')
			{
				if(pass==$(this).val()){
					$('#btn_miseho').show();
				}
				else
				{
					$('#btn_miseho').hide();
				}
			}
			else $('#btn_miseho').hide();
		});
		
		$('#txt_mot_de_passe').keyup(function(){
		var pass = $("#txt_mot_de_passe1").val();
			if($(this).val()!='')
			{
				if(pass==$(this).val()){
					$('#btn_miseho').show();
				}
				else
				{
					$('#btn_miseho').hide();
				}
			}
			else $('#btn_miseho').hide();
		});
		
		/*$('#ok').click(function(){
			
			
			 $.post("inscription_sql.php",$("#inscription :input").serializeArray(),function(info){$("#resultat").html(info).delay(1000).fadeOut('slow');});
			
								//document.location = "login.php?id=2";
				
			});*/
			
	});
	
	
	
	function script_inscription()
		{
			
			  /*
					document.getElementById("inscription").action="inscription_sql.php";
					return true;*/
			
		}
</script>


<div style="margin:70px auto;border:dashed 1px;border-radius:10px;box-shadow:5px 5px 5px rgba(0,0,0, 0.5);width:500px">
    <form id="inscription" style="padding:20px" method="POST" action="javascript:void(0)">
    
    
    <fieldset>
    <div align="center">
    
       <!-- <div class="miseho" style="display:none;">
        <h6 style="text-align:center;">Entrer le numero matricule</h6>
        L'administrateur vous envoyer votre numero matricule dans votre e-mail et veuillez le entrer ci dessous!<br />
        <div><label class="misitaka">MATRICULE :</label><input id="txt_matricule" type="text" name="txt_matricule" placeholder="Matricule"/></div>
        <br />
        <div><button id="ok" class="button special" type="submit">OK</button></div>
        </div>-->
     <div class="misitaka">
        
        <h3 style="text-align:center;">INSCRIPTION</h3>
        <div><label  style="text-align:center;">Nom:</label><input id="txt_nom" type="text" name="txt_nom" placeholder="Nom" /></div>
        
        <div> <label >Prenom :</label><input id="txt_prenom" type="text" name="txt_prenom" placeholder="Prenom"/></div>
        <div><label >Adress e-mail :</label><input id="txt_mail" type="email" name="txt_mail" placeholder="e-mail"/><span id="diso"></span><span id="marina"></span></div>
        <div><label>Mot de passe :</label><input id="txt_mot_de_passe" type="password" name="txt_mot_de_passe" placeholder="Mot de passe"/></div>
         <div><label>Retaper votre mot de passe :</label><input id="txt_mot_de_passe1" type="password" name="txt_mot_de_passe1" placeholder="Mot de passe"/></div>
        <br>
        <div id="btn_miseho" style="display:none"><input class="button special" type="submit" id="envoyer" value="Envoyer"> <input style="margin-left:20px;" class="button special" onClick="return effacer();" type="reset" name="annuler" value="annuler"></div>
      </div>
      <span id="resultat"></span>
    </div>
    </fieldset>
    </form>
    </div>
                        