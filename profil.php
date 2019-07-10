<script>
$(function(){
	$('#ok').click(function(){
		
				$.post("profil_sql.php",$("#profil :input").serializeArray(),function(info){$("#resultat").html(info).delay(1000).fadeOut('slow');});

		});
});
</script>
<div id="container">
<div id="content_container">
		<div id="content" style="width: 45%;">
			<div class="contact_form">
            <div class="main">
            <h1>Changer vos photos</h1><br/>
            <div style="text-align:center;font-size:9px">Taille maximum de fichier : 100ko . Format :jpeg ou jpg ou png</div>
            <hr>
                <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                    <div id="image_preview"><img id="previewing" src="upload/<?php echo $_SESSION['photo']?>" /></div>	
            <hr id="line">    
                <div align="center" id="selectImage">
                  
                    <input type="file" name="file" id="file" required />
                    <input style="color: white;" type="submit" value="Ok" class="ok_sary" />
                </div>                   
                </form>		
            </div> 
            <h4 id='loading' style="display:none;position:absolute;top:50px;left:850px;font-size:25px;">loading...</h4>
            
			</div>		
		</div>
        <div id="message">	
            </div>
        
        
         <link rel="stylesheet" href="style.css" />
		
       
        <script src="js/script.js"></script>
       
        
        
        
        
        
		<div style="width:40%;float:right;margin-right:50px">
<div style="margin:50px auto;border:dashed 1px;border-radius:10px;box-shadow:5px 5px 5px rgba(0,0,0, 0.5);">
    <form id="profil" style="padding:20px" method="POST" action="javascript:void(0)">
    
    
    <fieldset>
    <div align="center">
    
       <!-- <div class="miseho" style="display:none;">
        <h6 style="text-align:center;">Entrer le numero matricule</h6>
        L'administrateur vous envoyer votre numero matricule dans votre e-mail et veuillez le entrer ci dessous!<br />
        <div><label class="misitaka">MATRICULE :</label><input id="txt_matricule" type="text" name="txt_matricule" placeholder="Matricule"/></div>
        <br />
        <div><button id="ok" class="button special" type="submit">OK</button></div>
        </div>-->
     <div class="contact_form">
        
        <h3 style="text-align:center;">Mise à jour de votre compte</h3>
        <div><label  style="text-align:center;">Nom:</label><input value="<?php echo $_SESSION['nom'] ?>" id="txt_nom" type="text" name="txt_nom" placeholder="Nom" /></div>
        
        <div> <label >Prenom :</label><input value="<?php echo $_SESSION['prenom'] ?>" id="txt_prenom" type="text" name="txt_prenom" placeholder="Prenom"/></div>
        <div><label >Adress e-mail :</label><input value="<?php echo $_SESSION['mail'] ?>" id="txt_mail" type="email" name="txt_mail" placeholder="e-mail"/><span id="diso"></span><span id="marina"></span></div>
        <div><label>Mot de passe actuel :</label><input id="txt_mot_de_passe" type="password" name="txt_mot_de_passe" placeholder="Mot de passe"/></div>
         <div><label>Nouvelle mot de passe :</label><input id="txt_mot_de_passe1" type="password" name="txt_mot_de_passe1" placeholder="Mot de passe"/></div>
        <br>
        <div id="btn_miseho" ><button class="button special" type="submit" id="ok" value="ok">ok</button> <button style="margin-left:20px;" class="button special" onClick="return effacer();" type="reset" name="annuler" value="annuler">annuler</button></div>
      </div>
      <span id="resultat"></span>
    </div>
    </fieldset>
    </form>
    </div>
                        
		</div>
		<div class="spacer"></div>
	</div></div>
