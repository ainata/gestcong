<div id="vertical" style="float:left;height:100%;position:fixed;">
<?php
	include("menu_vertical.html");
?>
</div>
<div style="">
<?php if(isset($_GET['id']))
					$id=$_GET['id'];
					else $id='1';
					switch($id)
					{
						case '1':include("accueil.php");break;
						case '2':include("employer.php");break;
						case '3':include("deposition.php");break;
						case '5':include("motif.php");break;
					
					}
					
?>
</div>