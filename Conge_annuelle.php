<div class="display_bg" >
        <div class="navback">
            <div id="navigation">
                    <ul>
                        <li><a href="index.php?id=1" title="Accueil">Accueil</a></li>
                        <li><a href="#" title="Plus">Plus</a></li>
                        <li><a href="index.php?id=17" title="Congé annuelle">Congé annuelle</a></li>
                        
                        <!--<li><a href="index.php?id=8" title="MOTIF">MOTIF</a></li>-->
                    </ul>
             </div>
        </div>
    </div>

<div id="container">
<div id="content_container">
		<div id="content">
			<h1 align="center">CONGE ANNUELLE</h1>

			<hr />
            <div class="contact_form">
            <div align="center">
            <form method="post" action="javascript:void(0)" id="conger_annuel">
            <label for="date_de_depart">Date de départ : </label><input type="date" class="date" name="date_de_depart" id="date_de_depart" />
            <label for="date_de_retour">Date de rétour : </label><input type="date" class="date" name="date_de_retour" id="date_de_retour" />
            <br /><button type="submit" id="ok">OK</button>
            </form>
            <div id="resultat"></div>
            </div>
            </div>
		</div>
		<div class="spacer"></div>
	</div>
</div>

<script>
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
				var date_depart=document.getElementById('date_de_depart').value;
				var tab_date = date_depart.split('-');
				
				
				//if(date_depart!=''){
					if(date_depart < androany)
					{
						alert("impossible! verifier d'abord la date de depart");
						document.getElementById('date_de_depart').value='';
						
						return false;
						//date_depart.focus();
						//date_depart.style.borderColor='red';
						
						
					}
				//}*/
				else return true;
				
		}
function comparaisonDate(){
	var dateEntree=document.getElementById('date_de_retour').value;
	var dateDepart=document.getElementById('date_de_depart').value;
	//alert(dateEntree+" "+dateDepart);
	if(dateEntree < dateDepart)
	{
		alert("impossible!la date de retour doit superieur de "+dateDepart);
		dateEntree=document.getElementById('date_de_retour').value='';
		return false;
	}
	else return true
	
}


$(function(){
	$('#ok').click(function(){
		
		if( $('#date_de_depart').val()!='' && $('#date_de_retour').val()!='')
		{
			if( daty() && comparaisonDate())
			{
				if(confirm("est ce que ce conffirmer ?"))
				{
				 $.post("Conger_annuel_sql.php",$("#conger_annuel :input").serializeArray(),function(info){$("#resultat").html(info).delay(1000).fadeOut('slow');});
				 alert('io');
				
				
				}
			}
			
		}
		else
		{
			alert('veuilliez rzmplir la formulaire');
		}
	});
});
</script>
