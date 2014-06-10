<?php
include_once("page_struct.php");
/**
 * Main page of the application.
 * It contains the generation interface for users.
 * Copyright (c) 2014 Adrien PAVIE.
 * @author PanierAvide
 */
?>

<?php pageHeader("index"); ?>

	<!-- Main jumbotron for a primary marketing message or call to action -->
	<div class="jumbotron">
		<div class="container">
			<h1>Une touche réellement cubique</h1>
			<div class="col-md-3">
				<img src="img/osmc_512.png" class="img-responsive" />
			</div>
			<div class="col-md-9">
				<p>
					Passionnés de Minecraft, vous en avez assez des mondes virtuels fantaisistes ? Tentez l'expérience OpenStreetMineCraft !
					OpenStreetMineCraft vous propose, à partir des données <a href="http://openstreetmap.org/">OpenStreetMap</a>, de jouer
					dans votre ville ! Vous pouvez télécharger la carte au format Minecraft, et découvrir votre quartier de manière
					entièrement inédite !
				</p>
				<p><a href="create.php" class="btn btn-primary btn-lg" role="button">Démarrer &raquo;</a></p>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<h2>Une expérience inédite</h2>
			<p class="img-home"><img src="img/osmc_blrs.jpg" class="img-thumbnail" /></p>
			<p>Découvrez votre quartier en 3 dimensions à travers le célèbre jeu-vidéo Minecraft. Vous avez la possibilité de vous déplacer au coeur des rues de votre ville chamboulées par le réalisme cubique offert par le jeu. Notre outil permet une génération très simple.</p>
			<p><a role="button" href="about.php" class="btn btn-default">En savoir plus »</a></p>
		</div>
		<div class="col-md-4">
			<h2>Un outil simple</h2>
			<p class="img-home"><img src="img/osmc_web.jpg" class="img-thumbnail" /></p>
			<p>Envie de redécouvrir votre ville ? C'est possible, en 3 étapes : indiquez votre adresse e-mail, choisissez la zone souhaitée, et cliquez sur "Générer". C'est tout. Attendez le message vous annonçant que la carte est prête, puis amusez-vous.</p>
			<p><a role="button" href="create.php" class="btn btn-default">Commencer »</a></p>
		</div>
		<div class="col-md-4">
			<h2>Une source inépuisable</h2>
			<p class="img-home"><img src="img/osm_logo.jpg" class="img-thumbnail" /></p>
			<p>Nous utilisons les données proposées par la communauté OpenStreetMap. Il s'agit d'un projet visant à mettre à disposition de tous l'information géographique, telle que le tracé des routes, les bâtiments, la végétation et bien d'autres.</p>
			<p><a role="button" href="http://openstreetmap.fr" class="btn btn-default">Découvrir »</a></p>
		</div>
	</div>

<?php pageFooter("index"); ?>