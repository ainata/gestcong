<?php
//recuperation des données du formulaire:
	include("connexion/connexion.php");
	function ajout_employer()
	{
			
			$id = $_POST['txt_id_employer'];
			$matricule = $_POST['txt_matricule'];
			$nom = $_POST['txt_nom'];
			$prenom = $_POST['txt_prenom'];
			$mail = $_POST['txt_mail'];
			$date_d_entre = $_POST['txt_date_d_entree'];
			$solde_conger = $_POST['txt_solde_de_conge'];
			$mot_pass = $_POST['txt_mot_de_passe'];
			$departement = $_POST['slct_departement'];
			$poste = $_POST['slct_poste'];
			$status = $_POST['slct_contrat'];
			//$date_fin_contrat=$_POSTE['txt_date_contrat'];
			
			
			$req_matricule="select * from employer where MATRICULE='".$matricule."'";
			$req_matricule=mysql_query($req_matricule);
			if(!mysql_num_rows($req_matricule))
			{
				$req="select * from employer where ADRESSEMAIL='".$mail."'";
				$req=mysql_query($req);
				if(!mysql_num_rows($req))
				{
					$req_verifier_chef="select * from poste where NOM_POSTE='chef'";
					$req_verifier_chef=mysql_query($req_verifier_chef);
					$row_verifier_chef=mysql_fetch_array($req_verifier_chef);
					
					if($row_verifier_chef['ID_POSTE']==$poste)
					{
	
					$req_chef="select * from employer where ID_POSTE=".$row_verifier_chef['ID_POSTE']." and ID_DEPARTEMENT=".$departement;
					$req_chef=mysql_query($req_chef);
					
					if(!mysql_num_rows($req_chef))
					{
							$req_verifier_matricule="select * from employer where MATRICULE=".$matricule;
							$req_verifier_matricule=mysql_query($req_verifier_matricule);
							$row_verifier_matricule=mysql_fetch_array($req_verifier_matricule);
							
							$req_insert_chef="UPDATE departement SET ID_EMPLOYER=".$row_verifier_matricule['ID_EMPLOYER']." WHERE ID_DEPARTEMENT=".$departement;
							mysql_query($req_insert_chef);
					}
					else
					{
						$req="select * from departement where ID_DEPARTEMENT=".$departement;
						$req=mysql_query($req);
						$row_dep=mysql_fetch_array($req);
						?>
					   <SCRIPT language="javascript">
							alert("IMPOSSIBLE D'AJOUTER!car le departement  <?php echo $row_dep['NOM_DEPARTEMENT']; ?> diriger par un autre personne");
							document.location = "index.php?id=2";
						</SCRIPT>
						
						<?php
					}
					
					}
						
					$req = "INSERT INTO  employer(ID_CONTRAT,ID_POSTE,ID_DEPARTEMENT,MATRICULE,NOM,PRENOM,ADRESSEMAIL,DATE_D_ENTREE,SOLDE_CONGE,MOT_DE_PASSE,MOT_SECRETE) VALUES (".$status."," .$poste.",".$departement.",'".$matricule."','".$nom."','".$prenom."','".$mail."','".$date_d_entre."',".$solde_conger.",'".$mot_pass."','deja')";
				
					if (mysql_query($req)) 
					{
						
						
						
						
						if(isset($_POST['txt_date_contrat']))
							{
								
								$fin=$_POST['txt_date_contrat'];
								if($fin!="")
								{
								$req_recherche_id_emp="select * from employer where MATRICULE='".$matricule."'";
								$req_recherche_id_emp=mysql_query($req_recherche_id_emp);
								$row_emp=mysql_fetch_array($req_recherche_id_emp);
								$id_emp=$row_emp['ID_EMPLOYER'];
								
								$req_select_fin="select * from fin_contrat where DATE_FIN_CONTRAT='".$fin."'";
								$req_select_fin=mysql_query($req_select_fin);
								if(!mysql_num_rows($req_select_fin))
									{
										/*echo "<script>alert('aaaaaaaaaaa')</script>";*/
										$req="insert into fin_contrat(DATE_FIN_CONTRAT) values('".$fin."')";
										$req=mysql_query($req);
										$req="select * from fin_contrat where DATE_FIN_CONTRAT='".$fin."'";
										$req=mysql_query($req);
										$row=mysql_fetch_array($req);
										$id_fin_contrat=$row['ID_FIN_CONTRAT'];
										
										/*echo "<script>alert('".$id_fin_contrat."  ".$id_emp."')</script>";*/
										
										}
									else
									{
										$select_fin=mysql_fetch_array($req_select_fin);
										$id_fin_contrat=$select_fin['ID_FIN_CONTRAT'];
									}
									
									/*echo "<script>alert('id_emp ".$id_emp." ".$c." ".$id_fin_contrat." ')</script>";*/
								$req_insert_finir="insert into finir(ID_EMPLOYER,ID_CONTRAT,ID_FIN_CONTRAT) VALUES(".$id_emp.",".$status.",".$id_fin_contrat.")";
								mysql_query($req_insert_finir);
								/*)echo "<script>alert('ao an')</script>";
								else echo "<script>alert('ts ao an')</script>";*/
							}
							}
						//echo "insertion reussie";
						?>
					   <SCRIPT language="javascript">
							document.location = "index.php?id=2";
						</SCRIPT>
						
						<?php
					}else echo mysql_error();
					
					
				
				}
				else
					{
						?>
					   <SCRIPT language="javascript">
							alert("IMPOSSIBLE D'AJOUTER!l'address mail <?php echo $mail; ?> existe deja");
							document.location = "index.php?id=2";
						</SCRIPT>
						
						<?php
					}
			}
			else
			{
				?>
               <SCRIPT language="javascript">
			   		alert("IMPOSSIBLE D'AJOUTER!Numero matricule <?php echo $matricule;?> mail existe deja");
					document.location = "index.php?id=2";
				</SCRIPT>
                
				<?php
			}
	}
$mode=$_GET['mode'];
switch($mode)
{
	case 1:ajout_employer();break;
}
?>


