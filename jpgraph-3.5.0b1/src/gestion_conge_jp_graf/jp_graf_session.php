<?php
session_start();

require_once ('../jpgraph.php');
require_once ('../jpgraph_bar.php');
include ("../jpgraph_mgraph.php");

define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASS', '');
define('MYSQL_DATABASE', 'gestion_conger');


$tableauMois = array('JAN', 'FEV', 'MAR', 'AVR', 'MAI', 'JUI', 'JUL', 'AOU', 'SEP', 'OCT', 'NOV', 'DEC');
$tableauNombreJours = array(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0);

$tableauMois1 = array('JAN', 'FEV', 'MAR', 'AVR', 'MAI', 'JUI', 'JUL', 'AOU', 'SEP', 'OCT', 'NOV', 'DEC');
$tableauNombreJours1 = array(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0); 

// *************************************************
// Extraction des données dans la base de données
// *************************************************
// recuperation des données du formulaire:

$mysqlCnx = @mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS) or die('Pb de connxion mysql');
@mysql_select_db(MYSQL_DATABASE) or die('Pb de sélection de la base');

$sql_date = " SELECT ID_EMPLOYER,MONTH(DATE_DEPART) as MOIS,YEAR(DATE_DEPART) as YEAR,DATE_DEPART,DATE_RETOUR,ID_DEPOSITION,JOURNE_DE_DEPART,JOURNE_DE_RETOUR FROM deposition where ID_EMPLOYER='".$_SESSION['id']."' and ID_DEPOSITION IN (SELECT ID_DEPOSITION from valider WHERE VALIDE_DEPARTEMENT='oui' and VALIDE_RESPONSABLE='oui') order by DATE_DEPART ";
$mysqlQuery_date = @mysql_query($sql_date, $mysqlCnx) or die('Pb de requête');
while ($row_date = mysql_fetch_array($mysqlQuery_date,  MYSQL_ASSOC)){

		$row_year_1 = $row_date['YEAR'];
					$row_year_2 = $row_year_1;
					$row_year_1 = $row_year_2-1;
}

$sql = " SELECT ID_EMPLOYER,MONTH(DATE_DEPART) as MOIS,YEAR(DATE_DEPART) as YEAR,DATE_DEPART,DATE_RETOUR,ID_DEPOSITION,JOURNE_DE_DEPART,JOURNE_DE_RETOUR FROM deposition where YEAR(DATE_DEPART)='".$row_year_1."' and ID_EMPLOYER='".$_SESSION['id']."' and ID_DEPOSITION IN (SELECT ID_DEPOSITION from valider WHERE VALIDE_DEPARTEMENT='oui' and VALIDE_RESPONSABLE='oui') ";

//echo "".$_SESSION['id'];

$sql1 = " SELECT ID_EMPLOYER,MONTH(DATE_DEPART) as MOIS,YEAR(DATE_DEPART) as YEAR,DATE_DEPART,DATE_RETOUR,ID_DEPOSITION,JOURNE_DE_DEPART,JOURNE_DE_RETOUR FROM deposition where YEAR(DATE_DEPART)='".$row_year_2."' and ID_EMPLOYER='".$_SESSION['id']."' and ID_DEPOSITION IN (SELECT ID_DEPOSITION from valider WHERE VALIDE_DEPARTEMENT='oui' and VALIDE_RESPONSABLE='oui') ";

$mysqlQuery = @mysql_query($sql, $mysqlCnx) or die('Pb de requête');
$mysqlQuery1 = @mysql_query($sql1, $mysqlCnx) or die('Pb de requête');			

$somme1 = 0;$somme2 = 0;$somme3 = 0;$somme4 = 0;$somme5 = 0;$somme6 = 0;$somme7 = 0;$somme8 = 0;$somme9 = 0;$somme10 = 0;$somme11 = 0;$somme12 = 0;
while ($row = mysql_fetch_array($mysqlQuery,  MYSQL_ASSOC)) {
	
	$mois = $row['MOIS'];
	$annee = $row['YEAR'];
	
	$dt_depart = $row['DATE_DEPART'];
	$dt_retour = $row['DATE_RETOUR'];
	$jr_depart = $row['JOURNE_DE_DEPART'];
	$jr_retour = $row['JOURNE_DE_RETOUR'];
	
	$nbSecondes= 60*60*24;
	
	if($mois == 1)
	{

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
		
		}  

	}
	
	if($mois == 2)
	{
	
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
		
		} 
	
	}
	
	if($mois == 3)
	{
	
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
		
		}
	
	}
	
	if($mois == 4)
	{
	
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
		
		}
	
	}
	
	if($mois == 5)
	{
	
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
		
		}
	
	}
	
	if($mois == 6)
	{
	
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
		
		}
	
	}
	
	if($mois == 7)
	{
	
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
		
		}
	
	}
	
	if($mois == 8)
	{
	
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
		
		}
	
	}
	
		if($mois == 9)
	{
	
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
		
		}
	
	}
	
	if($mois == 10)
	{

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
		
		}
	
	}
	
	if($mois == 11)
	{
	
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
		
		}
	
	}
	
	if($mois == 12)
	{
	
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
		
		}
	
	}
}



$somme11 = 0;$somme21 = 0;$somme31 = 0;$somme41 = 0;$somme51 = 0;$somme61 = 0;$somme71 = 0;$somme81 = 0;$somme91 = 0;$somme101 = 0;$somme111 = 0;$somme121 = 0;
while ($row = mysql_fetch_array($mysqlQuery1,  MYSQL_ASSOC)) {
	
	$mois = $row['MOIS'];
	$annee = $row['YEAR'];
	$dt_depart = $row['DATE_DEPART'];
	$dt_retour = $row['DATE_RETOUR'];
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
		
		}
	
	}
}


$sql2 = " SELECT NOM FROM employer where ID_EMPLOYER=".$_SESSION['id'];
$mysqlQuery2 = @mysql_query($sql2, $mysqlCnx) or die('Pb de requête');
$row2 = mysql_fetch_array($mysqlQuery2,  MYSQL_ASSOC);
$tableauEmployer2 = $row2['NOM'];


/*
printf('<pre>%s</pre>', print_r($tableauAnnees,1));
printf('<pre>%s</pre>', print_r($tableauNombreVentes,1));
*/

// *******************
// Création du graphique
// *******************

// Construction du conteneur
// Spécification largeur et hauteur
$graph = new Graph(1100,300);

// Réprésentation linéaire
$graph->SetScale("textlin");

// Ajouter une ombre au conteneur
$graph->SetShadow();

// Fixer les marges
$graph->img->SetMargin(40,30,25,40);

// Apparence des grilles
$graph->ygrid->SetFill(true,'#DDDDDD@0.5','#BBBBBB@0.5');
$graph->ygrid->SetLineStyle('dashed');
$graph->ygrid->SetColor('gray');

// Création du graphique histogramme
$bplot = new BarPlot($tableauNombreJours);

// Spécification des couleurs des barres
$bplot->SetFillColor(array('red', 'blue', 'green', 'black', 'teal', 'navy@0.4', 'black','yellow','darkred','gray','black@0.3','white'));
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
$graph->title->Set("*** GRAPHIQUE HISTOGRAMME :CONGE D'ANNEE ".$row_year_1." DE :".$tableauEmployer2." ***");
$graph->title->SetFont(FF_FONT1,FS_BOLD);

// Titre pour l'axe horizontal(axe x) et vertical (axe y)
$graph->xaxis->title->Set("MOIS");
$graph->yaxis->title->Set("NOMBRE DE JOURS");

$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Légende pour l'axe horizontal
$graph->xaxis->SetTickLabels($tableauMois);


// Construction du conteneur
// Spécification largeur et hauteur
$graph1 = new Graph(1100,300);

// Réprésentation linéaire
$graph1->SetScale("textlin");

// Ajouter une ombre au conteneur
$graph1->SetShadow();

// Fixer les marges
$graph1->img->SetMargin(40,30,25,40);

// Apparence des grilles
$graph1->ygrid->SetFill(true,'#DDDDDD@0.5','#BBBBBB@0.5');
$graph1->ygrid->SetLineStyle('dashed');
$graph1->ygrid->SetColor('gray');

// Création du graphique histogramme
$bplot1 = new BarPlot($tableauNombreJours1);

// Spécification des couleurs des barres
$bplot1->SetFillColor(array('red', 'blue', 'green', 'black', 'teal', 'navy@0.4', 'black','yellow','darkred','gray','black@0.3','white'));
// Une ombre pour chaque barre
$bplot1->SetShadow();

// Afficher les valeurs pour chaque barre
$bplot1->value->Show();
// Fixer l'aspect de la police
//$bplot->value->SetFont(FF_ARIAL,FS_NORMAL,9);
// Modifier le rendu de chaque valeur
$bplot1->value->SetFormat('%s jours');

// Ajouter les barres au conteneur
$graph1->Add($bplot1);

// Le titre
$graph1->title->Set("*** GRAPHIQUE HISTOGRAMME :CONGE D'ANNEE ".$row_year_2." DE :".$tableauEmployer2." ***");
$graph1->title->SetFont(FF_FONT1,FS_BOLD);

// Titre pour l'axe horizontal(axe x) et vertical (axe y)
$graph1->xaxis->title->Set("MOIS");
$graph1->yaxis->title->Set("NOMBRE DE JOURS");

$graph1->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph1->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Légende pour l'axe horizontal
$graph1->xaxis->SetTickLabels($tableauMois1);


$mgraph = new MGraph(1100,600);
$xpos1=3;$ypos1=0;
$xpos2=3;$ypos2=285;
$mgraph->Add($graph,$xpos1,$ypos1);
$mgraph->Add($graph1,$xpos2,$ypos2);
// Afficher le graphique
$mgraph->Stroke();

?>