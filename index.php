<?php
session_start();
if (!$_SESSION['identifiant'])
{
	echo "<SCRIPT language=\"javascript\">document.location = \"login/login.php\";</SCRIPT>";
}
?>

<?php include("connexion/connexion.php");?>

<?php require("fonction.php");?>
<?php
	function nbJours($debut, $fin) {
						//60 secondes X 60 minutes X 24 heures dans une journée
						$nbSecondes= 60*60*24;
				 
						$debut_ts = strtotime($debut);
						$fin_ts = strtotime($fin);
						$diff = $fin_ts - $debut_ts;
						return round($diff / $nbSecondes);
					}
					
					
	function age($naiss)  {
						  list($annee, $mois, $jour) = explode('-', $naiss);
						  $today['mois'] = date('n');
						  $today['jour'] = date('j');
						  $today['annee'] = date('Y');
						  $annees = $today['annee'] - $annee;
						  if ($today['mois'] <= $mois) {
							if ($mois == $today['mois']) {
							  if ($jour > $today['jour'])
								$annees--;
							  }
							else
							  $annees--;
							}
						  return $annees;
						  }

	
	/*$m=date("m");
	$y=date("Y");
    $mois = mktime( 0, 0, 0, 2, 1, $y ); 
   // setlocale('LC_ALL', 'fr_FR');
    echo "<br><br>Le mois de ".date("F Y",$mois)." possède ".date("t",$mois)." jours";*/
	
	$date_aujourd_hui=date('Y-m-d');
	$req_conger_mois="select * from employer";
	$req_conger_mois=mysql_query($req_conger_mois) or die(mysql_error());
	while($employer=mysql_fetch_array($req_conger_mois))
	{
		
		$nb_jour_hafa=nbJours($employer['DERNIER_DATE_AJOUT_AUTO'],$date_aujourd_hui);
		List($annee,$mois,$jour)=explode('-',$employer['DERNIER_DATE_AJOUT_AUTO']);
		List($annee1,$mois1,$jour1)=explode('-',$date_aujourd_hui);
		
		$mois = mktime( 0, 0, 0, $mois, 1,$annee);
		$nbj_du_mois=date("t",$mois);
		
		/*echo $nbj_du_mois;
		echo "<br>".$nb_jour_hafa;*/
		
		if($nb_jour_hafa==$nbj_du_mois){
			
			$solde_initial=$employer['SOLDE_CONGE']+2.5;
			echo "solde : ".$solde_initial;
			$req_changement_dernier_date="update employer set SOLDE_CONGE=".$solde_initial.",DERNIER_DATE_AJOUT_AUTO=now() where ID_EMPLOYER=".$employer['ID_EMPLOYER'];
		mysql_query($req_changement_dernier_date);
			//DERNIER_DATE_AJOUT_AUTO=now(),
		}
		$nb_jour=nbJours($employer['DATE_D_ENTREE'],$date_aujourd_hui);
		if($nb_jour%365==0)
		{
			$req_changement_dernier_date="update employer set SOLDE_PERMISSION=10 where ID_EMPLOYER=".$employer['ID_EMPLOYER'];
		mysql_query($req_changement_dernier_date);
		}
		
		/*if(age($employer['DATE_D_ENTREE'])%3==0)
		{
			$req_changement_dernier_date="update employer set SOLDE_CONGE=0 where ID_EMPLOYER=".$employer['ID_EMPLOYER'];
		mysql_query($req_changement_dernier_date);
		}
		$nb_jour1=nbJours($employer['DATE_D_ENTREE'],$date_aujourd_hui);*/
		
		
		
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		//$dernier_jour = mktime(0, 0, 0,$mois1,0, $annee1);
		
		/*$mois_rep = mktime( 0, 0, 0, $mois1, 1, $annee1 );
		$nb_jour_dans_un_mois=date("t",$mois_rep);*/
		
		/*$dernier_jour = mktime(0, 0, 0,$mois1,0, $annee1);
		$dernier_jour =strftime("%d", $dernier_jour);*/
		
		/*$nb_entre_deux_date=nbJours($annee.'-'.$mois.'-01',$annee1.'-'.$mois1.'-'.$dernier_jour);
		$nb_entre_deux_date+=1;
		$nb_mois=0;
		$nombre_du_jour=0;*/
		/*$reste_mois=$mois1;
		//$nbb=nbJours($annee.'-'.$mois.'-'.$jour,$date_aujourd_hui);
		if($mois>$mois1 && $annee<$annee1)
		{
			
			$mois1=12;
		}
		while($annee<=$annee1)
		{
			if($annee==$annee1)$mois1=$reste_mois;
			while($mois<=$mois1)
			{
				
				$mois_rep = mktime( 0, 0, 0, $mois, 1, $annee );
				$nb_jour_dans_un_mois = date("t",$mois_rep);
				
				//if($nb_jour_dans_un_mois==$nbb)
				//{
					$nb_mois++;
					$nombre_du_jour+=$nb_jour_dans_un_mois;
				//}
				$mois++;
				//if($mois==13)$mois=1;
			}
			if($mois==13 && $annee<$annee1)$mois=01;
			$annee++;
		}
		//$nb_mois--;
		$mois--;
		echo "nb_mois : ".$nb_mois."<br>";
		echo "mois : ".$mois."<br>";
		echo "nb_jour : ".$nombre_du_jour."<br>";
		echo "votre nb_jour : ".$nbb."<br>";
		if($nombre_du_jour==$nbb)
		{
			echo "ao";
		}
		
		/*$req_changement_dernier_date="update employer set DERNIER_DATE_AJOUT_AUTO=now() where ID_EMPLOYER=".$employer['ID_EMPLOYER'];
		mysql_query($req_changement_dernier_date);*/
		
		
	
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	
	<title>Géstion de conge</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="images/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <style type="text/css" title="currentStyle">
	@import "Ajax-tables/media/css/demo_page.css";
	@import "Ajax-tables/media/css/demo_table.css";
    </style>

	<!-- menu ambony-->
    <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<!--<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>-->
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->



	<!--boosterstrap-->
    <!--<meta http-equiv="Refresh" content="10">-->
    <meta name="viewport" content="width=device-width" />
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap-responsive.css" rel="stylesheet" />
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--fin de boosterstrap-->
    

	<link rel="stylesheet" type="text/css" href="css/style1.css" />
    <!--<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
    
    
	<!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" /><![endif]-->

	<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css" /><![endif]-->
    
    <link href="jquery-ui-1.10.4/development-bundle/themes/base/jquery.ui.all.css" rel="stylesheet">
	<script src="jquery-ui-1.10.4/js/jquery-1.10.2.js"></script>
    <script src="jquery-ui-1.10.4/development-bundle/ui/jquery.ui.core.js"></script>
    <script src="jquery-ui-1.10.4/development-bundle/ui/jquery.ui.widget.js"></script>
    <script src="jquery-ui-1.10.4/development-bundle/ui/jquery.ui.datepicker.js"></script>
    <link href="jquery-ui-1.10.4/development-bundle/demos/demos.css" rel="stylesheet">
     <script src="jquery-ui-1.10.4/development-bundle/ui/jquery-ui.js"></script>

	<script src="jquery-ui-1.10.4/development-bundle/ui/jquery.ui.tabs.js"></script>
    
   
	<script>
			$(function() {
				$( ".date" ).datepicker();
				$( ".date" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
				//$( ".date" ).datepicker( "option", "showAnim", "bounce" );
				$( "#tabs" ).tabs();
			});
			
	
		function daty(){
				var dat=new Date()
				var taona=dat.getYear()-100+2000
				document.getElementById("txt_date_de_demande").value=dat.getHours()+ ':'+ dat.getMinutes() + ':'+ dat.getSeconds()+' , '+taona+'-'+dat.getMonth()+'-'+dat.getDate();
				//dat.getHours()+ ':'+ dat.getMinutes() + ':'+ dat.getSeconds()+' le '+dat.getDate()+'/ '+dat.getMonth()+'/ '+taona;
		}
		
		
</script>
	
    

	<!--<link rel="stylesheet" href="css/dialog.css"/>-->
	
	 <!-- including css & jQuery Dialog UI here-->
	<!--<link href="css/jquery-ui.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<!--<script type="text/javascript" src="js/dialog.js"></script>-->
		
        
	
	<!--<script type="text/javascript" src="js/pikachoose.js"></script>
	<script type="text/javascript">
		<!--
		$(document).ready(function(){
			$("#pikame").PikaChoose();
		});
		-->
	<!--</script>-->
    
    
	
	<script type="text/javascript" language="javascript" src="Ajax-tables/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('#example').dataTable();
			$('.example').dataTable();
		} );
	</script>
    

</head>


<body  >


					<?php 
                    include("menu.php");
                 
					if(isset($_GET['id']))
					$id=$_GET['id'];
					else $id='1';
					switch($id)
					{
						case '1':include("accueil.php");break;
						case '2':include("employer.php");break;
						case '3':include("deposition.php");break;
						case '4':include("contrat.php");break;
						case '5':include("motif.php");break;
						case '6':include("profil.php");break;
						case '7':include("Demande_conger.php");break;
						case '8':include("NotificationDemandeAccepter.php");break;
						case '9':include("NotificationDemandeRejete.php");break;
						case '10':include("NotificationDemandeEncours.php");break;
						case '11':include("NotificationDemandeDeposerParEmployer.php");break;
						case '12':include("DemandeDInscription-Admin.php");break;
						case '13':include("poste.php");break;
						case '14':include("type_deposition.php");break;
						case '15':include("departement.php");break;
						case '16':include("Historique.php");break;
						case '17':include("Conge_annuelle.php");break;
					}
					include("footer.php");
					?>

</body>
</html>
