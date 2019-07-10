<?php
session_start();

include ("../jpgraph.php");
include ("../jpgraph_bar.php");
include ("../jpgraph_mgraph.php");

define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASS', '');
define('MYSQL_DATABASE', 'gestion_conger');

$tableauNB_jr = array(); 
$tableauNB_jr1 = array(); 

// *************************************************
// Extraction des données dans la base de données
// *************************************************

$mysqlCnx = @mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS) or die('Pb de connxion mysql');
@mysql_select_db(MYSQL_DATABASE) or die('Pb de sélection de la base');

//POUR AFFICHER NOM DES EMPLOYES SUR HISTOGRAMME 
$sql2 = " SELECT PRENOM FROM employer where ID_DEPARTEMENT='".$_SESSION['departement']."' order by PRENOM ";
$mysqlQuery2 = @mysql_query($sql2, $mysqlCnx) or die('Pb de requête');

$y=0;
while ($row2 = mysql_fetch_array($mysqlQuery2,  MYSQL_ASSOC)) {
	
	$tableauEmployer2[$y] = $row2['PRENOM'];
	//echo $tableauEmployer2[$y];
	$y=$y+1;
}

$sql_date = " SELECT ID_EMPLOYER,MONTH(DATE_DEPART) as MOIS,YEAR(DATE_DEPART) as YEAR,DATE_DEPART,DATE_RETOUR,ID_DEPOSITION,JOURNE_DE_DEPART,JOURNE_DE_RETOUR FROM deposition where ID_DEPOSITION IN (SELECT ID_DEPOSITION from valider WHERE VALIDE_DEPARTEMENT='oui' and VALIDE_RESPONSABLE='oui') order by DATE_DEPART ";
$mysqlQuery_date = @mysql_query($sql_date, $mysqlCnx) or die('Pb de requête');
while ($row_date = mysql_fetch_array($mysqlQuery_date,  MYSQL_ASSOC)){

		$row_year_1 = $row_date['YEAR'];
					$row_year_2 = $row_year_1;
					$row_year_1 = $row_year_2-1;
}

$sql3 = " SELECT ID_EMPLOYER FROM employer where ID_DEPARTEMENT='".$_SESSION['departement']."' order by PRENOM ";
$mysqlQuery3 = @mysql_query($sql3, $mysqlCnx) or die('Pb de requête');

$L=0;$Z=0;
while ($row3 = mysql_fetch_array($mysqlQuery3,  MYSQL_ASSOC)) {
	
	$tableauEmployer3[$L] = $row3['ID_EMPLOYER'];
	$tableauEmployer31[$Z] = $row3['ID_EMPLOYER'];
	//echo "ID employe :".$tableauEmployer3[$L]."</br>";

$sql = " SELECT deposition.ID_EMPLOYER as ID_EMPLOYER_DEPOSITION,MONTH(DATE_DEPART) as MOIS,YEAR(DATE_DEPART) as YEAR,DATE_DEPART,DATE_RETOUR,ID_DEPOSITION,JOURNE_DE_DEPART,JOURNE_DE_RETOUR FROM deposition where YEAR(DATE_DEPART)='".$row_year_1."' and ID_EMPLOYER='".$tableauEmployer3[$L]."' and ID_DEPOSITION IN (SELECT ID_DEPOSITION from valider WHERE VALIDE_DEPARTEMENT='oui' and VALIDE_RESPONSABLE='oui') order by ID_EMPLOYER_DEPOSITION ";

$sql1 = " SELECT deposition.ID_EMPLOYER as ID_EMPLOYER_DEPOSITION,MONTH(DATE_DEPART) as MOIS,YEAR(DATE_DEPART) as YEAR,DATE_DEPART,DATE_RETOUR,ID_DEPOSITION,JOURNE_DE_DEPART,JOURNE_DE_RETOUR FROM deposition where YEAR(DATE_DEPART)='".$row_year_2."' and ID_EMPLOYER='".$tableauEmployer3[$L]."' and ID_DEPOSITION IN (SELECT ID_DEPOSITION from valider WHERE VALIDE_DEPARTEMENT='oui' and VALIDE_RESPONSABLE='oui') order by ID_EMPLOYER_DEPOSITION ";

$mysqlQuery = @mysql_query($sql, $mysqlCnx) or die('Pb de requête');
$mysqlQuery1 = @mysql_query($sql1, $mysqlCnx) or die('Pb de requête');

if (!mysql_num_rows($mysqlQuery))
								{ 
										$tableauNombreJours = 0;
										//echo $tableauNombreJours."</br>";
								}

else{

$somme1 = 0;
while ($row = mysql_fetch_array($mysqlQuery,  MYSQL_ASSOC)) {
	
	$annee = $row['YEAR'];

	$dt_depart = $row['DATE_DEPART'];//echo "DATE DE DEPART :".$dt_depart;
	$dt_retour = $row['DATE_RETOUR'];//echo "DATE DE RETOUR :".$dt_retour."</br>";
	$jr_depart = $row['JOURNE_DE_DEPART'];
	$jr_retour = $row['JOURNE_DE_RETOUR'];
	$id_empl_dep = $row['ID_EMPLOYER_DEPOSITION'];
	
	$nbSecondes= 60*60*24;
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round1 = round($diff / $nbSecondes);
	
	$somme1 = $somme1 + $round1;
	
	//$tableauNombreJours['0'] = $somme1;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours = $somme1 + 0.5;//echo "compte nb jour A/".$tableauNombreJours."</br>";
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours = $somme1 - 0.5;//echo "compte nb jour B/".$tableauNombreJours."</br>";
		
		}else{
		
			$tableauNombreJours = $somme1;//echo " compte nb jour C/".$tableauNombreJours."</br>";
		
		}
		//echo "___".$tableauNombreJours;
		
	 }
  }
	$tableauNB_jr[$L] = $tableauNombreJours;//echo "mm".$tableauNB_jr[$L]."</br>";
	$L=$L+1;
	//echo "b :".$L;
	
if (!mysql_num_rows($mysqlQuery1))
								{ 
										$tableauNombreJours1 = 0;
										//echo $tableauNombreJours1."</br>";
								}

else{

$somme11 = 0;
while ($row = mysql_fetch_array($mysqlQuery1,  MYSQL_ASSOC)) {
	
	$annee = $row['YEAR'];

	$dt_depart = $row['DATE_DEPART'];//echo "DATE DE DEPART :".$dt_depart;
	$dt_retour = $row['DATE_RETOUR'];//echo "DATE DE RETOUR :".$dt_retour."</br>";
	$jr_depart = $row['JOURNE_DE_DEPART'];
	$jr_retour = $row['JOURNE_DE_RETOUR'];
	$id_empl_dep = $row['ID_EMPLOYER_DEPOSITION'];
	
	$nbSecondes= 60*60*24;
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round1 = round($diff / $nbSecondes);
	
	$somme11 = $somme11 + $round1;
	
	//$tableauNombreJours['0'] = $somme1;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours1 = $somme11 + 0.5;//echo "compte nb jour A/".$tableauNombreJours."</br>";
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours1 = $somme11 - 0.5;//echo "compte nb jour B/".$tableauNombreJours."</br>";
		
		}else{
		
			$tableauNombreJours1 = $somme11;//echo " compte nb jour C/".$tableauNombreJours."</br>";
		
		}
		//echo "___".$tableauNombreJours;
		
	 }
  }
	$tableauNB_jr1[$Z] = $tableauNombreJours1;//echo "mm".$tableauNB_jr[$L]."</br>";
	$Z=$Z+1;
	//echo "b :".$L;
}

/*
printf('<pre>%s</pre>', print_r($tableauAnnees,1));
printf('<pre>%s</pre>', print_r($tableauNombreVentes,1));
*/

// *******************
// Création du graphique
// *******************


// Construction du conteneur
// Spécification largeur et hauteur
$graph = new Graph(1100,270);

// Réprésentation linéaire
$graph->SetScale("textlin");

// Ajouter une ombre au conteneur
$graph->SetShadow();

// Fixer les marges
$graph->img->SetMargin(40,30,25,70);

// Apparence des grilles
$graph->ygrid->SetFill(true,'#DDDDDD@0.5','#BBBBBB@0.5');
$graph->ygrid->SetLineStyle('dashed');
$graph->ygrid->SetColor('gray');


// Création du graphique histogramme
$bplot = new BarPlot($tableauNB_jr);

// Spécification des couleurs des barres
$bplot->SetFillColor(array('red', 'blue', 'green', 'pink', 'teal', 'navy@0.4', 'black','yellow','darkred','gray','black@0.3','white'));
// Une ombre pour chaque barre
$bplot->SetShadow();

// Afficher les valeurs pour chaque barre
$bplot->value->Show();
// Fixer l'aspect de la police
//$bplot->value->SetFont(FF_ARIAL,FS_NORMAL,9);
// Modifier le rendu de chaque valeur
$bplot->value->SetFormat('%s jours');

// Ajouter les barres au conteneur
$graph->Add($bplot);

// Le titre
$graph->title->Set("*** GRAPHE DE TOUS LES CONGES PRIS PAR LES EMPLOYES AU COURS D'ANNEE ".$row_year_1." ***");
$graph->title->SetFont(FF_FONT1,FS_BOLD);

// Titre pour l'axe horizontal(axe x) et vertical (axe y)
$graph->xaxis->title->Set("NOM DES EMPLOYES");
$graph->yaxis->title->Set("NOMBRE DE JOURS");

$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Légende pour l'axe horizontal
$graph->xaxis->SetTickLabels($tableauEmployer2);

//$graph->xaxis->SetTextLabelInterval(2);
$graph->xaxis->SetLabelAngle(30);


// Construction du conteneur
// Spécification largeur et hauteur
$graph1 = new Graph(1100,270);

// Réprésentation linéaire
$graph1->SetScale("textlin");

// Ajouter une ombre au conteneur
$graph1->SetShadow();

// Fixer les marges
$graph1->img->SetMargin(40,30,25,70);

// Apparence des grilles
$graph1->ygrid->SetFill(true,'#DDDDDD@0.5','#BBBBBB@0.5');
$graph1->ygrid->SetLineStyle('dashed');
$graph1->ygrid->SetColor('gray');


// Création du graphique histogramme
$bplot1 = new BarPlot($tableauNB_jr1);

// Spécification des couleurs des barres
$bplot1->SetFillColor(array('red', 'blue', 'green', 'pink', 'teal', 'navy@0.4', 'black','yellow','darkred','gray','black@0.3','white'));
// Une ombre pour chaque barre
$bplot1->SetShadow();

// Afficher les valeurs pour chaque barre
$bplot1->value->Show();
// Fixer l'aspect de la police
//$bplot->value->SetFont(FF_ARIAL,FS_NORMAL,9);
// Modifier le rendu de chaque valeur
$bplot1->value->SetFormat('%s j');

// Ajouter les barres au conteneur
$graph1->Add($bplot1);

// Le titre
$graph1->title->Set("*** GRAPHE DE TOUS LES CONGES PRIS PAR LES EMPLOYES AU COURS D'ANNEE ".$row_year_2." ***");
$graph1->title->SetFont(FF_FONT1,FS_BOLD);

// Titre pour l'axe horizontal(axe x) et vertical (axe y)
$graph1->xaxis->title->Set("NOM DES EMPLOYES");
$graph1->yaxis->title->Set("NOMBRE DE JOURS");

$graph1->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph1->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Légende pour l'axe horizontal
$graph1->xaxis->SetTickLabels($tableauEmployer2);

//$graph->xaxis->SetTextLabelInterval(2);
$graph1->xaxis->SetLabelAngle(30);

$mgraph = new MGraph(1100,600);
$xpos1=3;$ypos1=0;
$xpos2=3;$ypos2=300;
$mgraph->Add($graph,$xpos1,$ypos1);
$mgraph->Add($graph1,$xpos2,$ypos2);

// Afficher le graphique
$mgraph->Stroke();

//kano.cc
//rhaspberry_pi

?>