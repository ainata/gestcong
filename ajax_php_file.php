<?php
session_start();
 include("connexion/connexion.php");
if(isset($_FILES["file"]["type"]))  
{
    $validextensions = array("jpeg", "jpg", "png");
    $temporary = explode(".", $_FILES["file"]["name"]); 
    $file_extension = end($temporary);

    if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
            ) && ($_FILES["file"]["size"] < 100000)//Approx. 100kb files can be uploaded.
            && in_array($file_extension, $validextensions)) 
	{

        if ($_FILES["file"]["error"] > 0)
		{
            //echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
			echo "<script>alert('Return Code: '" . $_FILES["file"]["error"]." ')</script>";
        } 
		else 
		{ 
				if (file_exists("upload/" . $_FILES["file"]["name"])) {
                //echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
				echo "<script>alert('Le nom d'image : ".$_FILES["file"]["name"]." exit déjà!!')</script>";
				} 
				else 
				{					
					$sourcePath = $_FILES['file']['tmp_name'];   // Storing source path of the file in a variable
					$targetPath = "upload/".$_FILES['file']['name'];  // Target path where file is to be stored
					move_uploaded_file($sourcePath,$targetPath) ; //  Moving Uploaded file						
					echo "<script>alert('Image modifier avec succes!!')</script>";
					//echo "<span id='success'>Image modifier avec succes!!</span><br/>";
					/*echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
					echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
					echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
					echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";*/
					$anarana=$_FILES["file"]["name"];
					//echo $_SESSION['id'];
					
					$req="UPDATE  employer SET PHOTO='".$anarana."' where ID_EMPLOYER=".$_SESSION['id'];
					$req=mysql_query($req) or die(mysql_error());
					$_SESSION['photo']=$anarana;
					?>
                     <SCRIPT language="javascript">
							document.location ="index.php?id=6";
						</SCRIPT>
                    <?php
					
				}				       
        }        
    }   
	else 
	{
        
		echo "<script>alert('taille invalider!!')</script>";
    }
}
?>