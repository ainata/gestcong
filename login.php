<?php
		session_start();
		include("connexion/connexion.php");
		if (isset($_POST['login']))
		{
			$login=$_POST['login'];
			$select_login= "SELECT * FROM employer WHERE LOGIN='$login'";
			$query_login=mysql_query($select_login) or die ('diso select '.$query_login.''.mysql_error());
			
			if(mysql_num_rows($query_login)==0){
				echo '<div id="erreur" style="display:none"><p>Identifiant inconnu</p></div>';
				
			}
			else {
			$array_user= mysql_fetch_array($query_login);
				if($array_user['MOT_DE_PASSE']!=$_POST['pass']){
					echo '<div id="erreur" style="display:none"><p>mot de passe incorrect</p></div>';
					
				}
				else {
					$_SESSION['identifiant']=$login;
					$_SESSION['nom']=$array_user['NOM'];
					$_SESSION['prenom']=$array_user['PRENOM'];
					$_SESSION['departement']=$array_user['ID_DEPARTEMENT'];
					$_SESSION['id_emp']=$array_user['ID_EMPLOYER'];
					

					header('location:index.php');
				}
			}
		}
		else 
		{
			$login="";
		}

?>
<link href="css/bootstrap.css" rel="stylesheet">
<body>
  
    <div style="margin: 120px auto;border:solid 1px;border-radius:10px;box-shadow:5px 5px 5px rgba(0,0,0, 0.5);width:600px">
    <form id="authentification" style="padding:20px" method="POST" action="">
    <fieldset style="margin:20px auto;width:500px;" >
    <div class="form-group" id="div_login"><label for="login" style="text-align:center;">LOGIN</label><input class="form-control" type="text" name="login" placeholder="Login"></div>
    <div class="form-group" id="div_pass"><label for="passe">MOT DE PASSE</label><input class="form-control" type="password" name="pass" placeholder="Mot de passe" ></div>
    <button style="position:relative;color:white;right:0;background-color:rgba(0, 0, 0, 0.7)" type="submit" class="btn btn-block" id="connect">Connecter</button>
    <div class="alert alert-block alert-danger" style="display:none"></div>
    </fieldset>
    </form>
    </div>
    
    <script src="js/jquery.js"></script>
    <script>
    $(document).ready(function(){
    
        
        if($("#erreur").html()=='<p>Identifiant inconnu</p>'){
            $("div.alert").html($("#erreur").html());
            $("#div_login").addClass("has-error");
            $("div.alert").show("slow").delay(4000).hide("slow");
        
        };
        if($("#erreur").html()=='<p>mot de passe incorrect</p>'){
            $("div.alert").html($("#erreur").html());
            $("#div_pass").addClass("has-error");
            $("div.alert").show("slow").delay(4000).hide("slow");
        
        };
    
    
    });
    
    </script>
</body>
