<?php
session_start();
include("connexion/connexion.php");
$nom = $_POST["txt_nom"];
$prenom = $_POST["txt_prenom"];
$mail = $_POST["txt_mail"];
$pass = $_POST["txt_mot_de_passe1"];
$pass_actuel = $_POST["txt_mot_de_passe"];
/*echo "<script>alert('mot de passe actuel : ".$nom." ".$prenom." ".$mail." ". $pass." ')</script>";*/
if($pass_actuel==$_SESSION['mot_pass'])
{
$sql="update employer set NOM='$nom',PRENOM='$prenom',ADRESSEMAIL='$mail',MOT_DE_PASSE='$pass' where ID_EMPLOYER=".$_SESSION['id'];
$result = mysql_query($sql) or die (mysql_error());
if($result)
{
	$_SESSION['identifiant']=$login;
	$_SESSION['nom']=$nom;
	$_SESSION['prenom']=$prenom;
	$_SESSION['mail']=$mail;
	$_SESSION['mot_pass']=$pass;
	echo "<script>alert('votre compte a été mis à jour');
	document.location = \"index.php?id=6\"; 
	
	</script>";
}
else echo "<script>alert('modification impossible')</script>";
}
else echo "<script>alert('mot de passe actuel incorrect')</script>";
?>