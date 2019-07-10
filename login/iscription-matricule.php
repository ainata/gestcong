<script>
$(function(){
	$('#ok').click(function(){
				
			$.post("inscription_sql.php",$("#inscription :input").serializeArray(),function(info){$("#resultat").html(info).delay(1000).fadeOut('slow');});

			});
	
	
	});
</script>


<div style="margin:70px auto;border:dashed 1px;border-radius:10px;box-shadow:5px 5px 5px rgba(0,0,0, 0.5);width:500px">
    <form id="inscription" style="padding:20px" method="POST" action="javascript:void(0)">
    <fieldset>
    <div align="center">
        <h6 style="text-align:center;">Entrer le numero matricule</h6>
        <span style="font-size:12px">L'administrateur vous envoyer votre numero matricule dans votre e-mail et veuillez le entrer ci dessous!</span><br />
        <div><label class="misitaka">MATRICULE :</label><input id="txt_matricule" type="text" name="txt_matricule" placeholder="Matricule"/></div>
        <br />
        <div><label>Mot secret:</label><input id="txt_mot_secret" type="text" name="txt_mot_secret" placeholder="Mot secret"/></div><br />
        <div><button id="ok" class="button special" type="submit">OK</button></div>
        
        <span id="resultat"></span>
        </div>

    </fieldset>
    </form>
    </div>