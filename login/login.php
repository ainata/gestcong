<!DOCTYPE HTML>
<!--
	Twenty 1.0 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Gestion de conge</title>
        <link rel="icon" type="image/jpg" href="logo.jpg" />
        <link rel="stylesheet" type="text/css" href="engine1/style.css" />
		<!--<script type="text/javascript" src="engine1/jquery.js"></script>-->
    	<style>
		#diso{
			display:none;color:red;
		}
		#marina{
			display:none;color:green;
		}
		</style>
    
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
			<link rel="stylesheet" href="css/style-noscript.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
        
	</head>
	<body class="right-sidebar loading">
	
		<!-- Header -->
			<header id="header">
				<h1 id="logo"><a href="http://www.ige-xao.com" target="_blank">SOCOBIS MADAGASCAR <span>Societe de Confiserie et de Biscuiterie</span></a></h1>
				<nav id="nav">
					<ul>
						<li class="current"><a href="login.php">Bienvenue</a></li>
						<li class="submenu">
							<a href="">Compte <img src="Untitled-6.jpg"></a>
							<ul>
								<li><a href="login.php?id=2">se connecter</a></li>
								<li><a href="login.php?id=3">s'inscrit</a></li>
							</ul>
						</li>
						<li>                                     
                            <a href="http://www.ige-xao.com" target="_blank"><img src="../slide tena izy/data1/images/socobis - Copie.png"></a>
                        </li>
					</ul>
				</nav>
			</header>
            
            
			<?php
			if(isset($_GET['id']))
					$id=$_GET['id'];
					else $id='1';
					switch($id)
					{
						case '1':include("voalohany.php");break;
						case '2':include("seConnecter.php");break;
						case '3':include("Inscription.php");break;
						case '4':include("iscription-matricule.php");break;
					}
				
            
            ?>
	</body>
</html>