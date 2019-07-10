<?php
session_start();

include ("../jpgraph.php");
include ("../jpgraph_line.php");
include ("../jpgraph_mgraph.php");

define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASS', '');
define('MYSQL_DATABASE', 'gestion_conger');

$mysqlCnx = @mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS) or die('Pb de connxion mysql');
@mysql_select_db(MYSQL_DATABASE) or die('Pb de sélection de la base');

$tableauMois = array('JAN', 'FEV', 'MAR', 'AVR', 'MAI', 'JUI', 'JUL', 'AOU', 'SEP', 'OCT', 'NOV', 'DEC');
$color = array("red", "orange", "green", "pink", "teal", "navy", "black", "yellow","darkred","red@0.2", "orange@0.2", "green@0.2", "pink@0.2", "teal@0.2", "navy@0.2", "black@0.2", "yellow@0.2","darkred@0.2", "red@0.4", "orange@0.4", "green@0.4", "pink@0.4", "teal@0.4", "navy@0.4", "black@0.4", "yellow@0.4","darkred@0.4", "red@0.6", "orange@0.6", "green@0.6", "pink@0.6", "teal@0.6", "navy@0.6", "black@0.6", "yellow@0.6","darkred@0.6", "red@0.8", "orange@0.8", "green@0.8", "pink@0.8", "teal@0.8", "navy@0.8", "black@0.8", "yellow@0.8","darkred@0.8");
$tableauNombreJours = array(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0);
$tableauNombreJours1 = array(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0);

$graph = new Graph(1100,270);
$graph1 = new Graph(1100,270);

// nom pour legend
$sql2 = " SELECT PRENOM FROM employer where ID_DEPARTEMENT='".$_SESSION['departement']."' order by PRENOM ";
$mysqlQuery2 = @mysql_query($sql2, $mysqlCnx) or die('Pb de requête');

$y=0;
while ($row2 = mysql_fetch_array($mysqlQuery2,  MYSQL_ASSOC)) {
	
	$tableauEmployer2[$y] = $row2['PRENOM'];
	//echo $tableauEmployer2[$y]."</br>";
	$y=$y+1;
}


$sql_date = " SELECT deposition.ID_EMPLOYER as ID_EMPLOYER_DEPOSITION,MONTH(DATE_DEPART) as MOIS,YEAR(DATE_DEPART) as YEAR,DATE_DEPART,DATE_RETOUR,ID_DEPOSITION,JOURNE_DE_DEPART,JOURNE_DE_RETOUR FROM deposition where ID_DEPOSITION IN (SELECT ID_DEPOSITION from valider WHERE VALIDE_DEPARTEMENT='oui' and VALIDE_RESPONSABLE='oui') ";
$mysqlQuery_date = @mysql_query($sql_date, $mysqlCnx) or die('Pb de requête');
while ($row_date = mysql_fetch_array($mysqlQuery_date,  MYSQL_ASSOC)){

		$row_year_1 = $row_date['YEAR'];
					$row_year_2 = $row_year_1;
					$row_year_1 = $row_year_2-1;
}


$sql3 = " SELECT ID_EMPLOYER,PRENOM FROM employer where ID_DEPARTEMENT='".$_SESSION['departement']."' order by PRENOM ";
$mysqlQuery3 = @mysql_query($sql3, $mysqlCnx) or die('Pb de requête');

$L=0;$Z=0;
while ($row3 = mysql_fetch_array($mysqlQuery3,  MYSQL_ASSOC)) {
	
	$tableauEmployer3[$L] = $row3['ID_EMPLOYER'];
	$tableauEmployer31[$Z] = $row3['ID_EMPLOYER'];
	
	$tableau[$L] = $row3['PRENOM'];
	$tableau[$Z] = $row3['PRENOM'];
	
	//echo "NOM :".$tableau[$L];
	//echo "ID employe :".$tableauEmployer3[$L]."</br>";


$sql = " SELECT deposition.ID_EMPLOYER as ID_EMPLOYER_DEPOSITION,MONTH(DATE_DEPART) as MOIS,YEAR(DATE_DEPART) as YEAR,DATE_DEPART,DATE_RETOUR,ID_DEPOSITION,JOURNE_DE_DEPART,JOURNE_DE_RETOUR FROM deposition where YEAR(DATE_DEPART)='".$row_year_1."' and ID_EMPLOYER='".$tableauEmployer3[$L]."' and ID_DEPOSITION IN (SELECT ID_DEPOSITION from valider WHERE VALIDE_DEPARTEMENT='oui' and VALIDE_RESPONSABLE='oui') ";

$sql1 = " SELECT deposition.ID_EMPLOYER as ID_EMPLOYER_DEPOSITION,MONTH(DATE_DEPART) as MOIS,YEAR(DATE_DEPART) as YEAR,DATE_DEPART,DATE_RETOUR,ID_DEPOSITION,JOURNE_DE_DEPART,JOURNE_DE_RETOUR FROM deposition where YEAR(DATE_DEPART)='".$row_year_2."' and ID_EMPLOYER='".$tableauEmployer3[$Z]."' and ID_DEPOSITION IN (SELECT ID_DEPOSITION from valider WHERE VALIDE_DEPARTEMENT='oui' and VALIDE_RESPONSABLE='oui') ";

$mysqlQuery = @mysql_query($sql, $mysqlCnx) or die('Pb de requête');
$mysqlQuery1 = @mysql_query($sql1, $mysqlCnx) or die('Pb de requête');

if (!mysql_num_rows($mysqlQuery))
								{ 
										$tableauNombreJours['0'] = 0;
										$tableauNombreJours['1'] = 0;
										$tableauNombreJours['2'] = 0;
										$tableauNombreJours['3'] = 0;
										$tableauNombreJours['4'] = 0;
										$tableauNombreJours['5'] = 0;
										$tableauNombreJours['6'] = 0;
										$tableauNombreJours['7'] = 0;
										$tableauNombreJours['8'] = 0;
										$tableauNombreJours['9'] = 0;
										$tableauNombreJours['10'] = 0;
										$tableauNombreJours['11'] = 0;
										
								}

else{

$somme1 = 0;$somme2 = 0;$somme3 = 0;$somme4 = 0;$somme5 = 0;$somme6 = 0;$somme7 = 0;$somme8 = 0;$somme9 = 0;$somme10 = 0;$somme11 = 0;$somme12 = 0;
while ($row = mysql_fetch_array($mysqlQuery,  MYSQL_ASSOC)) {
	
	$mois = $row['MOIS'];
	$annee = $row['YEAR'];
	
	if($mois == 1)
	{
	$dt_depart = $row['DATE_DEPART'];//echo "DATE DE DEPART :".$dt_depart;
	$dt_retour = $row['DATE_RETOUR'];//echo "DATE DE RETOUR :".$dt_retour;
	$jr_depart = $row['JOURNE_DE_DEPART'];
	$jr_retour = $row['JOURNE_DE_RETOUR'];
	
	$nbSecondes= 60*60*24;
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round1 = round($diff / $nbSecondes);
	
	$somme1 = $somme1 + $round1;
	
	//$tableauNombreJours['0'] = $somme1;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours['0'] = $somme1 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours['0'] = $somme1 - 0.5;
		
		}else{
		
			$tableauNombreJours['0'] = $somme1;
			//echo "table :".$tableauNombreJours['0']."</br>";
		
		}  
	}
	
	if($mois == 2)
	{
	$dt_depart = $row['DATE_DEPART'];//echo "DATE DE DEPART :".$dt_depart;
	$dt_retour = $row['DATE_RETOUR'];//echo "DATE DE RETOUR :".$dt_retour;
	$jr_depart = $row['JOURNE_DE_DEPART'];
	$jr_retour = $row['JOURNE_DE_RETOUR'];
	
	$nbSecondes= 60*60*24;
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round2 = round($diff / $nbSecondes);
	
	$somme2 = $somme2 + $round2;
	
	//$tableauNombreJours['1'] = $somme2;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours['1'] = $somme2 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours['1'] = $somme2 - 0.5;
		
		}else{
		
			$tableauNombreJours['1'] = $somme2;
			//echo "table :".$tableauNombreJours['1']."</br>";
		
		} 
	
	}
	
	if($mois == 3)
	{
	$dt_depart = $row['DATE_DEPART'];//echo "DATE DE DEPART :".$dt_depart;
	$dt_retour = $row['DATE_RETOUR'];//echo "DATE DE RETOUR :".$dt_retour;
	$jr_depart = $row['JOURNE_DE_DEPART'];
	$jr_retour = $row['JOURNE_DE_RETOUR'];
	
	$nbSecondes= 60*60*24;
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round3 = round($diff / $nbSecondes);
	
	$somme3 = $somme3 + $round3;
	
	//$tableauNombreJours['2'] = $somme3;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours['2'] = $somme3 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours['2'] = $somme3 - 0.5;
		
		}else{
		
			$tableauNombreJours['2'] = $somme3;
			//echo "table :".$tableauNombreJours['2']."</br>";
		
		}
	
	}
	
	if($mois == 4)
	{
	$dt_depart = $row['DATE_DEPART'];//echo "DATE DE DEPART :".$dt_depart;
	$dt_retour = $row['DATE_RETOUR'];//echo "DATE DE RETOUR :".$dt_retour;
	$jr_depart = $row['JOURNE_DE_DEPART'];
	$jr_retour = $row['JOURNE_DE_RETOUR'];
	
	$nbSecondes= 60*60*24;
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round4 = round($diff / $nbSecondes);
	
	$somme4 = $somme4 + $round4;
	
	//$tableauNombreJours['3'] = $somme4;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours['3'] = $somme4 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours['3'] = $somme4 - 0.5;
		
		}else{
		
			$tableauNombreJours['3'] = $somme4;
			//echo "table :".$tableauNombreJours['3']."</br>";
		
		}
	
	}
	
	if($mois == 5)
	{
	$dt_depart = $row['DATE_DEPART'];//echo "DATE DE DEPART :".$dt_depart;
	$dt_retour = $row['DATE_RETOUR'];//echo "DATE DE RETOUR :".$dt_retour;
	$jr_depart = $row['JOURNE_DE_DEPART'];
	$jr_retour = $row['JOURNE_DE_RETOUR'];
	
	$nbSecondes= 60*60*24;
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round5 = round($diff / $nbSecondes);
	
	$somme5 = $somme5 + $round5;
	
	//$tableauNombreJours['4'] = $somme5;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours['4'] = $somme5 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours['4'] = $somme5 - 0.5;
		
		}else{
		
			$tableauNombreJours['4'] = $somme5;
			//echo "table :".$tableauNombreJours['4']."</br>";
		
		}
	
	}
	
	if($mois == 6)
	{
	$dt_depart = $row['DATE_DEPART'];//echo "DATE DE DEPART :".$dt_depart;
	$dt_retour = $row['DATE_RETOUR'];//echo "DATE DE RETOUR :".$dt_retour;
	$jr_depart = $row['JOURNE_DE_DEPART'];
	$jr_retour = $row['JOURNE_DE_RETOUR'];
	
	$nbSecondes= 60*60*24;
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round6 = round($diff / $nbSecondes);
	
	$somme6 = $somme6 + $round6;
	
	//$tableauNombreJours['5'] = $somme6;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours['5'] = $somme6 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours['5'] = $somme6 - 0.5;
		
		}else{
		
			$tableauNombreJours['5'] = $somme6;
			//echo "table :".$tableauNombreJours['5']."</br>";
		
		}
	
	}
	
	if($mois == 7)
	{
	$dt_depart = $row['DATE_DEPART'];//echo "DATE DE DEPART :".$dt_depart;
	$dt_retour = $row['DATE_RETOUR'];//echo "DATE DE RETOUR :".$dt_retour;
	$jr_depart = $row['JOURNE_DE_DEPART'];
	$jr_retour = $row['JOURNE_DE_RETOUR'];
	
	$nbSecondes= 60*60*24;
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round7 = round($diff / $nbSecondes);
	
	$somme7 = $somme7 + $round7;
	
	//$tableauNombreJours['6'] = $somme7;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours['6'] = $somme7 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours['6'] = $somme7 - 0.5;
		
		}else{
		
			$tableauNombreJours['6'] = $somme7;
			//echo "table :".$tableauNombreJours['6']."</br>";
		
		}
	
	}
	
	if($mois == 8)
	{
	$dt_depart = $row['DATE_DEPART'];//echo "DATE DE DEPART :".$dt_depart;
	$dt_retour = $row['DATE_RETOUR'];//echo "DATE DE RETOUR :".$dt_retour;
	$jr_depart = $row['JOURNE_DE_DEPART'];
	$jr_retour = $row['JOURNE_DE_RETOUR'];
	
	$nbSecondes= 60*60*24;
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round8 = round($diff / $nbSecondes);
	
	$somme8 = $somme8 + $round8;
	
	//$tableauNombreJours['7'] = $somme8;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours['7'] = $somme8 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours['7'] = $somme8 - 0.5;
		
		}else{
		
			$tableauNombreJours['7'] = $somme8;
			//echo "table :".$tableauNombreJours['7']."</br>";
		
		}
	
	}
	
		if($mois == 9)
	{
	$dt_depart = $row['DATE_DEPART'];//echo "DATE DE DEPART :".$dt_depart;
	$dt_retour = $row['DATE_RETOUR'];//echo "DATE DE RETOUR :".$dt_retour;
	$jr_depart = $row['JOURNE_DE_DEPART'];
	$jr_retour = $row['JOURNE_DE_RETOUR'];
	
	$nbSecondes= 60*60*24;
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round9 = round($diff / $nbSecondes);
	
	$somme9 = $somme9 + $round9;
	
	//$tableauNombreJours['8'] = $somme9;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours['8'] = $somme9 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours['8'] = $somme9 - 0.5;
		
		}else{
		
			$tableauNombreJours['8'] = $somme9;
			//echo "table :".$tableauNombreJours['8']."</br>";
		
		}
	
	}
	
	if($mois == 10)
	{
	$dt_depart = $row['DATE_DEPART'];//echo "DATE DE DEPART :".$dt_depart;
	$dt_retour = $row['DATE_RETOUR'];//echo "DATE DE RETOUR :".$dt_retour;
	$jr_depart = $row['JOURNE_DE_DEPART'];
	$jr_retour = $row['JOURNE_DE_RETOUR'];
	
	$nbSecondes= 60*60*24;
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round10 = round($diff / $nbSecondes);
	
	$somme10 = $somme10 + $round10;
	
	//$tableauNombreJours['9'] = $somme10;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours['9'] = $somme10 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours['9'] = $somme10 - 0.5;
		
		}else{
		
			$tableauNombreJours['9'] = $somme10;
			//echo "table :".$tableauNombreJours['9']."</br>";
		
		}
	
	}
	
	if($mois == 11)
	{
	$dt_depart = $row['DATE_DEPART'];//echo "DATE DE DEPART :".$dt_depart;
	$dt_retour = $row['DATE_RETOUR'];//echo "DATE DE RETOUR :".$dt_retour;
	$jr_depart = $row['JOURNE_DE_DEPART'];
	$jr_retour = $row['JOURNE_DE_RETOUR'];
	
	$nbSecondes= 60*60*24;
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round11 = round($diff / $nbSecondes);
	
	$somme11 = $somme11 + $round11;
	
	//$tableauNombreJours['10'] = $somme11;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours['10'] = $somme11 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours['10'] = $somme11 - 0.5;
		
		}else{
		
			$tableauNombreJours['10'] = $somme11;
			//echo "table :".$tableauNombreJours['10']."</br>";
		
		}
	
	}
	
	if($mois == 12)
	{
	$dt_depart = $row['DATE_DEPART'];//echo "DATE DE DEPART :".$dt_depart;
	$dt_retour = $row['DATE_RETOUR'];//echo "DATE DE RETOUR :".$dt_retour;
	$jr_depart = $row['JOURNE_DE_DEPART'];
	$jr_retour = $row['JOURNE_DE_RETOUR'];
	
	$nbSecondes= 60*60*24;
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round12 = round($diff / $nbSecondes);
	
	$somme12 = $somme12 + $round12;
	
	//$tableauNombreJours['11'] = $somme12;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours['11'] = $somme12 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours['11'] = $somme12 - 0.5;
		
		}else{
		
			$tableauNombreJours['11'] = $somme12;
			//echo "table :".$tableauNombreJours['11']."</br>";
		
		}
	
	}
  }
  
  
}

$p[$L] = new LinePlot($tableauNombreJours);
$p[$L]->SetColor($color[$L]);
$p[$L]->SetLegend($tableauEmployer2[$L]);
$p[$L]->SetWeight(2);
$p[$L]->value->Show();
$graph->Add($p[$L]);


$L=$L+1;
//echo "b :".$L."</br>";

										$tableauNombreJours['0'] = 0;
										$tableauNombreJours['1'] = 0;
										$tableauNombreJours['2'] = 0;
										$tableauNombreJours['3'] = 0;
										$tableauNombreJours['4'] = 0;
										$tableauNombreJours['5'] = 0;
										$tableauNombreJours['6'] = 0;
										$tableauNombreJours['7'] = 0;
										$tableauNombreJours['8'] = 0;
										$tableauNombreJours['9'] = 0;
										$tableauNombreJours['10'] = 0;
										$tableauNombreJours['11'] = 0;

										
										
										
										
if (!mysql_num_rows($mysqlQuery1))
								{ 
										$tableauNombreJours1['0'] = 0;
										$tableauNombreJours1['1'] = 0;
										$tableauNombreJours1['2'] = 0;
										$tableauNombreJours1['3'] = 0;
										$tableauNombreJours1['4'] = 0;
										$tableauNombreJours1['5'] = 0;
										$tableauNombreJours1['6'] = 0;
										$tableauNombreJours1['7'] = 0;
										$tableauNombreJours1['8'] = 0;
										$tableauNombreJours1['9'] = 0;
										$tableauNombreJours1['10'] = 0;
										$tableauNombreJours1['11'] = 0;
										
								}

else{

$somme11 = 0;$somme21 = 0;$somme31 = 0;$somme41 = 0;$somme51 = 0;$somme61 = 0;$somme71 = 0;$somme81 = 0;$somme91 = 0;$somme101 = 0;$somme111 = 0;$somme121 = 0;
while ($row = mysql_fetch_array($mysqlQuery1,  MYSQL_ASSOC)) {
	
	$mois = $row['MOIS'];
	$annee = $row['YEAR'];
	
	$dt_depart = $row['DATE_DEPART'];//echo "DATE DE DEPART :".$dt_depart;
	$dt_retour = $row['DATE_RETOUR'];//echo "DATE DE RETOUR :".$dt_retour;
	$jr_depart = $row['JOURNE_DE_DEPART'];
	$jr_retour = $row['JOURNE_DE_RETOUR'];
	
	$nbSecondes= 60*60*24;
	
	if($mois == 1)
	{
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round1 = round($diff / $nbSecondes);
	
	$somme11 = $somme11 + $round1;
	
	//$tableauNombreJours['0'] = $somme1;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours1['0'] = $somme11 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours1['0'] = $somme11 - 0.5;
		
		}else{
		
			$tableauNombreJours1['0'] = $somme11;
			//echo "table :".$tableauNombreJours['0']."</br>";
		
		}  
	}
	
	if($mois == 2)
	{
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round2 = round($diff / $nbSecondes);
	
	$somme21 = $somme21 + $round2;
	
	//$tableauNombreJours['1'] = $somme2;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours1['1'] = $somme21 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours1['1'] = $somme21 - 0.5;
		
		}else{
		
			$tableauNombreJours1['1'] = $somme21;
			//echo "table :".$tableauNombreJours['1']."</br>";
		
		} 
	
	}
	
	if($mois == 3)
	{
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round3 = round($diff / $nbSecondes);
	
	$somme31 = $somme31 + $round3;
	
	//$tableauNombreJours['2'] = $somme3;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours1['2'] = $somme31 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours1['2'] = $somme31 - 0.5;
		
		}else{
		
			$tableauNombreJours1['2'] = $somme31;
			//echo "table :".$tableauNombreJours['2']."</br>";
		
		}
	
	}
	
	if($mois == 4)
	{
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round4 = round($diff / $nbSecondes);
	
	$somme41 = $somme41 + $round4;
	
	//$tableauNombreJours['3'] = $somme4;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours1['3'] = $somme41 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours1['3'] = $somme41 - 0.5;
		
		}else{
		
			$tableauNombreJours1['3'] = $somme41;
			//echo "table :".$tableauNombreJours['3']."</br>";
		
		}
	
	}
	
	if($mois == 5)
	{
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round5 = round($diff / $nbSecondes);
	
	$somme51 = $somme51 + $round5;
	
	//$tableauNombreJours['4'] = $somme5;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours1['4'] = $somme51 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		

			$tableauNombreJours1['4'] = $somme51 - 0.5;
		
		}else{
		
			$tableauNombreJours1['4'] = $somme51;
			//echo "table :".$tableauNombreJours['4']."</br>";
		
		}
	
	}
	
	if($mois == 6)
	{
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round6 = round($diff / $nbSecondes);
	
	$somme61 = $somme61 + $round6;
	
	//$tableauNombreJours['5'] = $somme6;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours1['5'] = $somme61 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours1['5'] = $somme61 - 0.5;
		
		}else{
		
			$tableauNombreJours1['5'] = $somme61;
			//echo "table :".$tableauNombreJours['5']."</br>";
		
		}
	
	}
	
	if($mois == 7)
	{
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round7 = round($diff / $nbSecondes);
	
	$somme71 = $somme71 + $round7;
	
	//$tableauNombreJours['6'] = $somme7;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours1['6'] = $somme71 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours1['6'] = $somme71 - 0.5;
		
		}else{
		
			$tableauNombreJours1['6'] = $somme71;
			//echo "table :".$tableauNombreJours['6']."</br>";
		
		}
	
	}
	
	if($mois == 8)
	{
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round8 = round($diff / $nbSecondes);
	
	$somme81 = $somme81 + $round8;
	
	//$tableauNombreJours['7'] = $somme8;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours1['7'] = $somme81 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours1['7'] = $somme81 - 0.5;
		
		}else{
		
			$tableauNombreJours1['7'] = $somme81;
			//echo "table :".$tableauNombreJours['7']."</br>";
		
		}
	
	}
	
		if($mois == 9)
	{
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round9 = round($diff / $nbSecondes);
	
	$somme91 = $somme91 + $round9;
	
	//$tableauNombreJours['8'] = $somme9;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours1['8'] = $somme91 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours1['8'] = $somme91 - 0.5;
		
		}else{
		
			$tableauNombreJours1['8'] = $somme91;
			//echo "table :".$tableauNombreJours['8']."</br>";
		
		}
	
	}
	
	if($mois == 10)
	{
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round10 = round($diff / $nbSecondes);
	
	$somme101 = $somme101 + $round10;
	
	//$tableauNombreJours['9'] = $somme10;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours1['9'] = $somme101 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours1['9'] = $somme101 - 0.5;
		
		}else{
		
			$tableauNombreJours1['9'] = $somme101;
			//echo "table :".$tableauNombreJours['9']."</br>";
		
		}
	
	}
	
	if($mois == 11)
	{
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round11 = round($diff / $nbSecondes);
	
	$somme111 = $somme111 + $round11;
	
	//$tableauNombreJours['10'] = $somme11;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours1['10'] = $somme111 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours1['10'] = $somme111 - 0.5;
		
		}else{
		
			$tableauNombreJours1['10'] = $somme111;
			//echo "table :".$tableauNombreJours['10']."</br>";
		
		}
	
	}
	
	if($mois == 12)
	{
	
	$debut_ts = strtotime($dt_depart);
    $fin_ts = strtotime($dt_retour);
	$diff = $fin_ts - $debut_ts;
	
	$round12 = round($diff / $nbSecondes);
	
	$somme121 = $somme121 + $round12;
	
	//$tableauNombreJours['11'] = $somme12;
	
	if(($jr_depart == 'Matin') && ($jr_retour == 'Apres midi')){
	
			$tableauNombreJours1['11'] = $somme121 + 0.5;
	
		}else if(($jr_depart == 'Apres midi') && ($jr_retour == 'Matin')){
		
			$tableauNombreJours1['11'] = $somme121 - 0.5;
		
		}else{
		
			$tableauNombreJours1['11'] = $somme121;
			//echo "table :".$tableauNombreJours['11']."</br>";
		
		}
	
	}
  }
  
  
}

$p[$Z] = new LinePlot($tableauNombreJours1);
$p[$Z]->SetColor($color[$Z]);
$p[$Z]->SetLegend($tableauEmployer2[$Z]);
$p[$Z]->SetWeight(2);
$p[$Z]->value->Show();
$graph1->Add($p[$Z]);


$Z=$Z+1;
//echo "b :".$L."</br>";

										$tableauNombreJours1['0'] = 0;
										$tableauNombreJours1['1'] = 0;
										$tableauNombreJours1['2'] = 0;
										$tableauNombreJours1['3'] = 0;
										$tableauNombreJours1['4'] = 0;
										$tableauNombreJours1['5'] = 0;
										$tableauNombreJours1['6'] = 0;
										$tableauNombreJours1['7'] = 0;
										$tableauNombreJours1['8'] = 0;
										$tableauNombreJours1['9'] = 0;
										$tableauNombreJours1['10'] = 0;
										$tableauNombreJours1['11'] = 0;
										
										
										
										
										
}										
										

// Setup the graph

$graph->SetMarginColor('white');
$graph->SetScale("textlin");
$graph->SetFrame(false);
$graph->SetMargin(50,500,35,35);

// Le titre
$graph->title->Set("*** GRAPHE DE TOUS LES EMPLOYES PAR DEPARTEMENT AU COURS D'ANNEE ".$row_year_1." ***");
$graph->title->SetFont(FF_FONT1,FS_BOLD);

// Titre pour l'axe horizontal(axe x) et vertical (axe y)
$graph->xaxis->title->Set("MOIS");
$graph->yaxis->title->Set("NOMBRE DE JOURS");

$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Setup the legend box colors and font
$graph->legend->SetShadow('darkgray@0.4',5);
$graph->legend->Pos(0.05,0.05,"right","top");

$graph->yaxis->HideZeroLabel();
$graph->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');
$graph->xgrid->Show();

//$graph->xaxis->SetTickLabels($gDateLocale->GetShortMonth());
$graph->xaxis->SetTickLabels($tableauMois);


// Setup the graph

$graph1->SetMarginColor('white');
$graph1->SetScale("textlin");
$graph1->SetFrame(false);
$graph1->SetMargin(50,500,35,35);

// Le titre
$graph1->title->Set("*** GRAPHE DE TOUS LES EMPLOYES PAR DEPARTEMENT AU COURS D'ANNEE ".$row_year_2." ***");
$graph1->title->SetFont(FF_FONT1,FS_BOLD);

// Titre pour l'axe horizontal(axe x) et vertical (axe y)
$graph1->xaxis->title->Set("MOIS");
$graph1->yaxis->title->Set("NOMBRE DE JOURS");

$graph1->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph1->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Setup the legend box colors and font
$graph1->legend->SetShadow('darkgray@0.4',5);
$graph1->legend->Pos(0.05,0.05,"right","top");

$graph1->yaxis->HideZeroLabel();
$graph1->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');
$graph1->xgrid->Show();

//$graph->xaxis->SetTickLabels($gDateLocale->GetShortMonth());
$graph1->xaxis->SetTickLabels($tableauMois);


$mgraph = new MGraph(1100,600);
$xpos1=3;$ypos1=0;
$xpos2=3;$ypos2=300;
$mgraph->Add($graph,$xpos1,$ypos1);
$mgraph->Add($graph1,$xpos2,$ypos2);


// Output line
$mgraph->Stroke();

?>