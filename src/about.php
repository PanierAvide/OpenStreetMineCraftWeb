<?php
include_once("page_struct.php");

/**
 * About page.
 * Copyright (c) 2014 Adrien PAVIE.
 * @author PanierAvide
 */

//FUNCTIONS
?>

<?php pageHeader("about"); ?>

		<h2 class="type-headings">OpenStreetMineCraft <small>Outil de conversion</small></h2>
		<p>
			Ce site web repose sur l'outil <a href="" />OpenStreetMineCraft</a>. Il s'agit d'un logiciel permettant de convertir une zone donnée en
			carte Minecraft. Il se connecte à une base de données, effectue un certain nombre de requêtes, et projette ces informations
			sur une grille, afin de se conformer aux dimensions de Minecraft.
		</p>

		<a name="osm"></a>
		<h2 class="type-headings">OpenStreetMap <small>Source de données</small></h2>
		<p>
				OpenStreetMineCraft utilise les données géographiques <a href="http://openstreetmap.org">OpenStreetMap</a>, le projet de cartographie collaborative en ligne.
				Il s'agit d'une carte mondiale, contenant des informations géographiques variées, telles que le réseau routier, l'occupation des sols, l'emprise des bâtiments,
				les commerces et points d'intérêts. Cette carte est crée par une communauté de bénévoles. Le principal objectif d'OpenStreetMap est la mise à disposition du
				public des données géographiques collectées par les bénévoles. Contrairement à la large majorité des cartes en ligne, qui proposent gratuitement la consultation
				de leurs cartes mais pas leur réutilisation, OpenStreetMap offre aux internautes ses données sous licence libre, permettant ainsi leur réutilisation libre et
				gratuite. Cette liberté ouvre de nombreuses possibilités : mise à jour des GPS, réalisation de cartes interactives, génération de plans de villes pour affichage
				extérieur, utilisation pour la réalité augmentée et l'accessibilité aux personnes handicapées et bien d'autres.
		</p>

		<h2 class="type-headings">Licences <small>Libres</small></h2>
		<h3 class="type-headings">OpenStreetMineCraft</h3>
		<dl class="dl-horizontal">
			<dt>Licence</dt>
			<dd><a href="https://gnu.org/licenses/gpl.html">GNU General Public License 3.0</a></dd>
			<dt>Inclus<dt>
			<dd>
				<ul class="list-unstyled">
					<li><a href="https://github.com/LB--/MCModify">MCModify</a> - <a href="https://github.com/LB--/MCModify/blob/java/LICENSE">Licence</a></li>
					<li><a href="https://commons.apache.org/proper/commons-cli/">Apache Commons CLI</a> - <a href="https://www.apache.org/licenses/LICENSE-2.0.html">Apache License 2.0</a></li>
				</ul>
			</dd>
		</dl>

		<h3 class="type-headings">Interface web</h3>
		<dl class="dl-horizontal">
			<dt>Licence</dt>
			<dd><a href="https://gnu.org/licenses/gpl.html">GNU General Public License 3.0</a></dd>
			<dt>Inclus<dt>
			<dd>
				<ul class="list-unstyled">
					<li><a href="http://getbootstrap.com">Bootstrap</a> - <a href="http://getbootstrap.com/getting-started/#license-faqs">MIT License</a></li>
					<li><a href="http://leafletjs.com/">Leaflet</a> - <a href="https://github.com/Leaflet/Leaflet/blob/master/LICENSE">BSD License</a></li>
					<li><a href="https://github.com/heyman/leaflet-areaselect/">Leaflet AreaSelect</a> - MIT License</li>
					<li><a href="http://jquery.com/">jQuery</a> - <a href="https://jquery.org/license/">MIT License</a></li>
					<li><a href="https://github.com/PHPMailer/PHPMailer/">PHPMailer</a> - <a href="https://github.com/PHPMailer/PHPMailer/blob/master/LICENSE">GNU LGPL</a></li>
				</ul>
			</dd>
		</dl>

		<h3 class="type-headings">Logo</h3>
		<dl class="dl-horizontal">
			<dt>Licence</dt>
			<dd><a href="https://creativecommons.org/licenses/by-sa/3.0/">Creative Commons Attribution - Share alike 3.0</a></dd>
			<dt>Inclus<dt>
			<dd>
				<ul class="list-unstyled">
					<li><a href="https://commons.wikimedia.org/wiki/File:Grass_block_stylized.svg">Grass block stylized</a> - <a href="https://creativecommons.org/licenses/by-sa/3.0/">Creative Commons Attribution - Share alike 3.0</a></li>
					<li><a href="https://commons.wikimedia.org/wiki/File:Openstreetmap_logo.svg">OpenStreetMap logo</a> - <a href="https://creativecommons.org/licenses/by-sa/2.0/">Creative Commons Attribution - Share alike 2.0</a></li>
				</ul>
			</dd>
		</dl>

		<a name="author"></a>
		<h2 class="type-headings">L'auteur <small>Adrien Pavie</small></h2>
		<p>
			Contributeur régulier au projet OpenStreetMap, ingénieur en formation, passionné d'informatique et de logiciels libres,
			vous pouvez en savoir plus sur moi <a href="http://www.adrien.pavie.info">cliquez ici</a>.
		</p>

		<a name="contact"></a>
		<h2 class="type-headings">Contact</h2>
		<p>Vous pouvez nous contacter par courriel, à l'adresse suivante : <code>openstreetminecraft@laposte.net</code></p>

<?php pageFooter("about"); ?>
