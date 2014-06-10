<?php
include_once("config.php");
include_once("page_struct.php");

/**
 * Page of map creation.
 * It contains the generation interface for users.
 * Copyright (c) 2014 Adrien PAVIE.
 * @author PanierAvide
 */

//FUNCTIONS
	/**
	 * Displays the content of POST variable with the given name
	 * @param $name The name of the variable
	 */
	function showval($name) {
		//echo (isset($_POST[$name])) ? $_POST[$name] : "";
		echo (isset($_GET[$name])) ? $_GET[$name] : "";
	}


?>

<?php pageHeader("create"); ?>

		<div class="well">
			<p>La création d'une carte est très simple : en trois étapes, vous avez fini ! Indiquez votre courriel, choisissez une zone, et validez.</p>
		</div>

		<form action="request.php" method="post">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">1) Votre courriel</h3>
			</div>
			<div class="panel-body">
				<p>Vous allez recevoir un message à votre adresse courriel pour vous indiquer l'avancement de la génération de la zone. Une fois la génération achevée, vous recevrez le lien de téléchargement. Pour une confidentialité garantie, lorsque la zone est créée et que le courriel est envoyé, nous supprimons votre adresse.</p>
				<div class="field"><span class="field_label">Courriel</span> <input type="email" name="email" pattern="[^ @]*@[^ @]*" value="<?php showval("email"); ?>" /></div>
			</div>
		</div>

		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">2) Choix de la zone</h3>
			</div>
			<div class="panel-body">
				<p>
					Sélectionnez la zone souhaitée en zoomant et en déplaçant la carte. Les limites de la zone correspondent à la partie blanche.
					Vous pouvez redimensionner en déplançant les coins de la zone de sélection. Attention : vous ne pouvez pas choisir une ville
					en dehors du rectangle orange.</p>
				<div id="map"></div>
				<input type="hidden" id="coord_sw_lat" name="coord_sw_lat" value="" />
				<input type="hidden" id="coord_sw_lon" name="coord_sw_lon" value="" />
				<input type="hidden" id="coord_ne_lat" name="coord_ne_lat" value="" />
				<input type="hidden" id="coord_ne_lon" name="coord_ne_lon" value="" />

				<!-- Leaflet map setup -->
				<script type="text/javascript">
					// create a map in the "map" div, set the view to a given place and zoom
					var map = L.map('map');

					// add an OpenStreetMap tile layer
					L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
					attribution: '&copy; Les contributeurs <a href="http://osm.org/copyright">OpenStreetMap</a>'
					}).addTo(map);

					//Restrict view to authorized area
					var polygon = L.polygon(
						[
							[<?php echo constant("MAP_MINLAT").", ".constant("MAP_MINLON"); ?>],
							[<?php echo constant("MAP_MINLAT").", ".constant("MAP_MAXLON"); ?>],
							[<?php echo constant("MAP_MAXLAT").", ".constant("MAP_MAXLON"); ?>],
							[<?php echo constant("MAP_MAXLAT").", ".constant("MAP_MINLON"); ?>]
						],
						{ color: 'orange', fillColor: 'orange', fillOpacity: 0.1 }
					).addTo(map);

					map.fitBounds(polygon.getBounds());
					map.setMaxBounds(polygon.getBounds());
					map.options.minZoom = map.getZoom();

					// Display the select box
					var areaSelect = L.areaSelect({width:200, height:250});
					areaSelect.on("change", function() {
						var bounds = this.getBounds();
						document.getElementById("coord_sw_lat").value = bounds.getSouthWest().lat;
						document.getElementById("coord_sw_lon").value = bounds.getSouthWest().lng;
						document.getElementById("coord_ne_lat").value = bounds.getNorthEast().lat;
						document.getElementById("coord_ne_lon").value = bounds.getNorthEast().lng;
					});
					areaSelect.addTo(map);
				</script>
			</div>
		</div>
		<!--div class="chapter">
			<h2>3) Choix du style</h2>
			<input type="radio" name="style" id="style_def" value="default" checked /> <label for="style_def">Par défaut</label>
		</div-->
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">3) Générer</h3>
			</div>
			<div class="panel-body">
				<p>Il ne vous reste plus qu'à cliquer pour valider et lancer la génération.</p>
				<p style="text-align: center;"><button class="btn btn-lg btn-primary" type="submit">Générer la zone</button></p>
			</div>
		</div>
		</form>

<?php pageFooter("create"); ?>
