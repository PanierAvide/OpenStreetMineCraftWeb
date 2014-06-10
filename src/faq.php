<?php
include_once("page_struct.php");

/**
 * About page.
 * Copyright (c) 2014 Adrien PAVIE.
 * @author PanierAvide
 */

//FUNCTIONS
?>

<?php pageHeader("faq"); ?>

		<div class="well">
			<p>Cette page recense les réponses aux questions les plus fréquemment posées.</p>
		</div>

		<h2 class="type-headings">Qu'est ce qu'OpenStreetMineCraft ?</h2>
		<p>
			Il s'agit d'un logiciel permettant de convertir une zone géographique donnée en carte Minecraft. Ce site web est une interface
			à cet outil. Pour en savoir plus, <a href="about.php">c'est ici</a>.
		</p>

		<a name="install"></a>
		<h2 class="type-headings">Comment installe-t'on une carte ?</h2>
		<p>
			OpenStreetMineCraft va, une fois le rendu de la zone demandée achevée, vous fournir un fichier ZIP. Ce fichier contient la carte
			pour Minecraft. Vous devez vous rendre dans le dossier du jeu pour l'enregistrer. Selon votre système, le dossier est différent.
		</p>
		<dl>
			<dt>Windows</dt>
			<dd>%appdata%\Roaming\.minecraft\saves</dd>
			<dt>Linux</dt>
			<dd>~/.minecraft/saves/</dd>
			<dt>Mac</dt>
			<dd>~/Library/Application Support/minecraft/saves</dd>
		</dl>
		<p>
			Une fois dans ce dossier, créez un sous-dossier avec le nom de votre choix pour la carte. Extrayez le contenu du fichier ZIP
			téléchargé dans ce sous-dossier. Vous pouvez désormais accéder à la carte depuis Minecraft, en mode solo.
			Pour en savoir plus, <a href="http://minecraft.gamepedia.com/Tutorials/Map_downloads">c'est ici (en anglais)</a>.
		</p>

		<h2 class="type-headings">D'où viennent les données des villes ?</h2>
		<p>
			Nous utilisons les données OpenStreetMap, le projet de cartographie libre. Pour en savoir plus, <a href="about.php#osm">c'est ici</a>.
		</p>

		<h2 class="type-headings">Il manque une route/une maison/n'importe quoi, comment l'ajouter ?</h2>
		<p>
			Si vous souhaitez ajouter un élément manquant et le rendre disponible pour tous, vous devez l'ajouter dans le projet OpenStreetMap.
			Pour ce faire, rendez-vous sur le site <a href="http://www.openstreetmap.org">OpenStreetMap</a>, placez-vous sur la carte dans la
			zone concernée, puis cliquez sur "Modifier". L'éditeur vous propose d'ajouter différents objets à travers son interface. Si vous
			ne vous sentez pas à l'aise, vous pouvez consulter le <a href="http://wiki.openstreetmap.org">Wiki</a> ou
			<a href="about.php#contact">nous contacter</a>.
		</p>

		<h2 class="type-headings">Pourquoi avoir créé cet outil ?</h2>
		<p>
			Pour le fun :) À la base, il devait s'agir d'un jeu-vidéo complet de gestion de ville, dans le style SimCity. L'idée de ce jeu
			était de pouvoir gérer sa ville, se prendre pour le maire local. Cependant, réaliser un jeu complet de cette envergure nécessite
			pas mal de ressources, de temps, et des connaissances en graphismes. Le projet fut abandonné, mais une partie du code pouvait être
			utilisée à d'autres fins. Il s'agissait de la projection des informations géographiques sur une grille. Une grille, comme sur les
			cartes Minecraft ! À partir de là, le projet a été adapté pour réaliser des conversions depuis OpenStreetMap vers Minecraft.<br />
			La raison principale est donc le côté amusant de la réalisation technique, mais cela permet en même temps la promotion du projet
			OpenStreetMap en montrant ce qu'il est possible de faire à partir de ces données.
		</p>

		<h2 class="type-headings">Qui a réalisé cet outil ?</h2>
		<p>
			OpenStreetMineCraft a été réalisé par un étudiant en informatique, sur ses heures perdues. Pour en savoir plus,
			<a href="about.php#author">c'est ici</a>.
		</p>

<?php pageFooter("faq"); ?>
