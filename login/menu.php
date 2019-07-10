<script type="text/javascript">
/*$(document).ready( function () {

	$(".navback").hide();

$("#option").click( function () {

			if ($('.navback:visible').length != 0) {
			$('.navback').slideUp("normal");
			}
			
			else {
			$('.navback').slideDown("normal");
			}
			
			return false;
		});
} ) ;*/
</script>
<body class="right-sidebar loading">
<!--<div id="titleheader_bg">
<a class="logo" href="index.html" title="Home"></a>
</div>-->

<!-- Header -->
			<!--<header id="header">
				<h1 id="logo"><a class:"lien_ambony" href="ige-xao.com">IGE-<span>XAO</span></a></h1>
				<nav id="nav">
					<ul>
						<li class="current"><a href="index.php?id=1"><span>Bonjour!<?php echo " ".$_SESSION['nom']." ".$_SESSION['prenom']; ?></span></a></li>
						<li class="submenu">
							<a class:"lien_ambony" href="">Compte <img src="Untitled-6.jpg"></a>
							<ul style="z-index:2000;list-style-type: none;" >
								<li><a class:"lien_ambony" href="login.php?id=2">se connecter</a></li>
								<li><a class:"lien_ambony" href="login.php?id=3">s'inscrit</a></li>
							</ul>
						</li>
                        <li class="submenu">
							<a class:"lien_ambony" href="">Compte <img src="Untitled-6.jpg"></a>
							<ul style="z-index:2000;" >
								<li><a class:"lien_ambony" href="login.php?id=2">se connecter</a></li>
								<li><a class:"lien_ambony" href="login.php?id=3">s'inscrit</a></li>
							</ul>
						</li>
						<li>                                     
                            <a class:"lien_ambony" href="ige-xao.com"><img src="Untitled-7.jpg"></a>
                        </li>
                        <a href="#"><span id="option" style="border:solid white 1px;border-radius:5px;box-shadow:2px 2px 2px black;">Chemin<img src="images/fleche.jpg" /></span></a>
					</ul>
				</nav>
			</header>-->
            
            
            <div class="navbar">
			<div class="navbar-inner" >
				<div class="container">
					<button class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse" type="button">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="brand" href="index.php?id=6">
						<span>Bonjour!<?php echo " ".$_SESSION['nom']." ".$_SESSION['prenom']; ?></span>
					</a>
					<nav style="float:right;" class="nav-collapse" role="navigation">
						<ul class="nav">
							<li><a href="#">Accueil</a></li>
							<li class="divider-vertical"></li>
							<li class="dropdown">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">Notification <span style="color:red;border:black 1px solid;border-radius:100px,padding:10px;">0</span> <b class="caret"></b></a>
								<ul class="dropdown-menu">
                                	
									<li><a href="#">Demande accepté</a></li>
									<li><a href="#">Demande rejeté</a></li>
								</ul>
							</li>
                            <li class="divider-vertical"></li>
                            <li class="dropdown">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">Plus <b class="caret"></b></a>
								<ul class="dropdown-menu">
                                	<li><a href="#">Historique</a></li>
									<li><a href="#">Graphe</a></li>
								</ul>
							</li>
                            <li class="divider-vertical"></li>
							<li><a href="#">Envoyede Demande</a></li>
							<li class="divider-vertical"></li>
							 <li class="dropdown">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#"><b class="caret"></b></a>
								<ul class="dropdown-menu">
                                	<li><a href="#">Historique</a></li>
									<li><a href="#">Graphe</a></li>
								</ul>
							</li>
						</ul>
                        </nav>
				</div><!-- end of .container -->
			</div><!-- end of .navbar-inner -->
		</div><!-- end of .navbar .navbar -->

    <div class="display_bg" style="z-index:1;">
        <div class="navback">
            <div id="navigation">
                    <ul>
                        <li><a href="index.php?id=1" title="ACCUEIL">ACCUEIL</a></li>
                        <li><a href="index.php?id=2" title="EMPLOYER">EMPLOYER</a></li>
                        <li><a href="index.php?id=3" title="DEPOSITION">DEPOSITION</a></li>
                        <li><a href="#" title="CONTRAT">CONTRAT</a></li>
                        <li><a href="index.php?id=5" title="MOTIF">MOTIF</a></li>
                    </ul>
                    <span style="float:right; margin:2px;">
                    
                    <a href="detruire_session.php"><button class="deconnection">Deconnexion</button></a>
                    </span>
             </div>
        </div>
    
        
    </div>


<div id="display">
		<!--<ul id="pikame">
			<li><img src="images/display/thumbs/creative_sessions.jpg" ref="images/display/creative_sessions.jpg" alt="FreelanceSwitch" /><span>Creative Sessions<br /><small>Interface Design</small></span></li>

			<li><img src="images/display/thumbs/appstorm.jpg" ref="images/display/appstorm.jpg" alt="AppStorm" /><span>AppStorm<br /><small>Mac Applications Blog</small></span></li>
			<li><img src="images/display/thumbs/nettuts.jpg" ref="images/display/nettuts.jpg" alt="NetTuts" /><span>NetTuts<br /><small>Web Development &amp; Design Tutorials</small></span></li>
			<li><img src="images/display/thumbs/tutsplus.jpg" ref="images/display/tutsplus.jpg" alt="VideoHive" /><span>Tutsplus<br /><small>Power Up Your Skill Set</small></span></li>
			<li><img src="images/display/thumbs/envato.jpg" ref="images/display/envato.jpg" alt="Creattica" /><span>Envato<br /><small>Learn Creative Skills</small></span></li>

		</ul>-->
	</div>





</body>
</html>