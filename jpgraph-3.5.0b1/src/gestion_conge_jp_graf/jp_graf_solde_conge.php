<?php
session_start();

include ("../jpgraph.php");
include ("../jpgraph_bar.php");
include ("../jpgraph_mgraph.php");

define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASS', '');
define('MYSQL_DATABASE', 'gestion_conger');

// *************************************************
// Extraction des données dans la base de données
// *************************************************

$mysqlCnx = @mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS) or die('Pb de connxion mysql');
@mysql_select_db(MYSQL_DATABASE) or die('Pb de sélection de la base');

//affichage nom sur histogramme 
$sql2 = " SELECT PRENOM FROM employer order by PRENOM ";
$mysqlQuery2 = @mysql_query($sql2, $mysqlCnx) or die('Pb de requête');

$y=0;
while ($row2 = mysql_fetch_array($mysqlQuery2,  MYSQL_ASSOC)) {
	
	$tableauEmployer2[$y] = $row2['PRENOM'];
	//echo $tableauEmployer2[$y];
	$y=$y+1;
}

$sql = " SELECT SOLDE_CONGE from employer order by PRENOM ";
$mysqlQuery = @mysql_query($sql, $mysqlCnx) or die('Pb de requête');

$l=0;
while ($row = mysql_fetch_array($mysqlQuery,  MYSQL_ASSOC)) {
	
	$tableauNB_jr[$l] = $row['SOLDE_CONGE'];
	//echo $tableauEmployer2[$y];
	$l=$l+1;
	
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
$graph = new Graph(1100,500);

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
$bplot->value->SetFormat('%s j');

// Ajouter les barres au conteneur
$graph->Add($bplot);

// Le titre
$graph->title->Set("*** GRAPHE SOLDE CONGE RESTANT ***");
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

// Afficher le graphique
$graph->Stroke();
?>
