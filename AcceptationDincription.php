<?php
	session_start();
	require_once "phpmailler/PHPMailer/PHPMailerAutoload.php"; //inclusion du fichier si le dossier "phpmailer" se trouve dans le même dossier que notre page web

		include("phpmailler/PHPMailer/class.phpmailer.php");
		include("phpmailler/PHPMailer/class.smtp.php");
	include("connexion/connexion.php");
	if(isset($_GET['code'])&& isset($_GET['id']))
	{
		$id_emp=$_GET['code'];
		$id=$_GET['id'];
		$m=$_POST['txt_matricule'.$id];
		$d=$_POST['slct_departement'.$id];
		$p=$_POST['slct_poste'.$id];
		$c=$_POST['slct_contrat'.$id];
		$fin=$_POST['txt_fin_contrat'];
		
		$mot=$_POST['txt_mot_secret'.$id];
		/*echo "<script>alert('".$fin."')</script>";*/
		
		
		if(isset($m) && isset($d) && isset($p) && isset($c))
		{
			
			$req_verifie_matricule="select * from employer where MATRICULE='".$m."'";
			$req_verifie_matricule=mysql_query($req_verifie_matricule);
			
			if(!mysql_num_rows($req_verifie_matricule))
				{
					$req_verifier_chef="select * from poste where NOM_POSTE='chef'";
					$req_verifier_chef=mysql_query($req_verifier_chef);
					$row_verifier_chef=mysql_fetch_array($req_verifier_chef);
					
					if($row_verifier_chef['ID_POSTE']==$p)
					{
	
					$req_chef="select * from employer where ID_POSTE=".$row_verifier_chef['ID_POSTE']." and ID_DEPARTEMENT=".$d;
					$req_chef=mysql_query($req_chef);
					
					if(!mysql_num_rows($req_chef))
					{
							$req_verifier_matricule="select * from employer where ID_EMPLOYER=".$id_emp;
							$req_verifier_matricule=mysql_query($req_verifier_matricule);
							$row_verifier_matricule=mysql_query($req_verifier_matricule);
							
							$req_insert_chef="UPDATE departement SET ID_EMPLOYER=".$row_verifier_matricule['ID_EMPLOYER']." WHERE ID_DEPARTEMENT=".$d;
							mysql_query($req_insert_chef);
					}
					else
					{
						$req="select * from departement where ID_DEPARTEMENT=".$d;
						$req=mysql_query($req);
						$row_dep=mysql_fetch_array($req);
						?>
					   <SCRIPT language="javascript">
							alert("IMPOSSIBLE D'ACCEPTER L'INCRIPTION!car le departement  <?php echo $row_dep['NOM_DEPARTEMENT']; ?> diriger par un autre personne");
							document.location = "index.php?id=12";
						</SCRIPT>
						
						<?php
						exit;
					}
					}
					
					$req="update employer set SOLDE_CONGE=0,ID_CONTRAT=".$c.",ID_POSTE=".$p.",ID_DEPARTEMENT=".$d.",MATRICULE='".$m."',MOT_SECRETE='".$mot."' where ID_EMPLOYER=".$id_emp;
					mysql_query($req) or die(mysql_error());
					
					
					
					$req="select * from employer where ID_EMPLOYER=".$id_emp;
					$req=mysql_query($req) or die(mysql_error());
					$ligne=mysql_fetch_array($req);
					$addresse_mail=$ligne['ADRESSEMAIL'];
					//echo $addresse_mail."<br>";
					$mail = new PHPmailer();
					$mail->IsSMTP();
					$mail->SMTPAuth = true;
					//$mail->SMTPDebug=2;   
					
					$mail->Host='smtp.gmail.com';
					$mail->Username = 'stagiaireigexao2014@gmail.com';
					$mail->Password = 'igexao2014';
					$mail->SMTPSecure='ssl';
					$mail->Port = 465;
					$mail->From='stagiaireigexao2014@gmail.com';
					$mail->FromName='L\'Administrateur de gestion de congé IGE+XAO Madagascar';
					$mail->isHTML(true);
					$mail->addReplyTo('mbolasitrakaa@gmail.com','Reply address');
					//$mail->addAddress('stagiaireigexao2014@gmail.com','Reply address');
					$mail->addAddress($addresse_mail,'Reply address');
					
					$mail->Subject='Identifiant pour inscription au gestion de congé IGE+XAO Madagascar'; // l'entête = nom du sujet
					$mail->Body='
					<p>Veuillez vous identifier sur:</p>
					<div>URL : http://10.12.1.176/ige-xao/greymatter%20izy%201/login/login.php?id=4</div>
					<div>Num Matricule : '.$m.'</div>
					<div>Mot secret :'.$mot.'</div>';
					$mail->AltBody="This is text only alternative body.";
					var_dump($mail->Send());
					
							if(isset($fin))
							{
								$req_select_fin="select * from fin_contrat where DATE_FIN_CONTRAT='".$fin."'";
								$req_select_fin=mysql_query($req_select_fin);
								if(!mysql_num_rows($req_select_fin))
									{
									
										$req="insert into fin_contrat(DATE_FIN_CONTRAT) values('".$fin."')";
										$req=mysql_query($req);
										$req="select * from fin_contrat where DATE_FIN_CONTRAT='".$fin."'";
										$req=mysql_query($req);
										$row=mysql_fetch_array($req);
										$id_fin_contrat=$row['ID_FIN_CONTRAT'];
										
										}
									else
									{
										$select_fin=mysql_fetch_array($req_select_fin);
										$id_fin_contrat=$select_fin['ID_FIN_CONTRAT'];
									}
									
									/*echo "<script>alert('id_emp ".$id_emp." ".$c." ".$id_fin_contrat." ')</script>";*/
								$req_insert_finir="insert into finir(ID_EMPLOYER,ID_CONTRAT,ID_FIN_CONTRAT) VALUES(".$id_emp.",".$c.",".$id_fin_contrat.")";
								mysql_query($req_insert_finir);
								/*)echo "<script>alert('ao an')</script>";
								else echo "<script>alert('ts ao an')</script>";*/
							}
							echo "<script>alert('insertion reussie')</script>";
							 ?>
                          <SCRIPT language="javascript">
								document.location ="index.php?id=12";
							</SCRIPT>
                         <?php
							
					}
					else
					{
						 echo "<script>alert('le numero matricule ".$m." exite deja ')</script>";
						 ?>
                          <SCRIPT language="javascript">
								document.location ="index.php?id=12";
							</SCRIPT>
                         <?php
					}

			}
		}
	
	else echo "<script>alert('fonction $_GET invalide')</script>";
?>