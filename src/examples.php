<?php
include_once("config.php");
include_once("page_struct.php");
include_once("file.php");

/**
 * Page of latest maps download.
 * Copyright (c) 2014 Adrien PAVIE.
 * @author PanierAvide
 */

//FUNCTIONS
	/**
	 * Get the informations of a given map
	 * @param $mapsArray The array which contain the list of maps (result of ls)
	 * @return The maps informations (ie the read ini file)
	 */
	function getMapsInfos($mapsArray) {
		$result = array();
		foreach($mapsArray as $id => $name) {
			$result[$id] = parse_ini_file("map/$name");
		}
		return $result;
	}
?>

<?php pageHeader("examples"); ?>

		<div class="well">
			<p>Pour savoir comment installer une carte, consultez la <a href="faq.php#install">foire aux questions</a>.</p>
		</div>

		<div class="row">
<?php
//Examples generation
	//Get maps list
	$maps = getMapsInfos(array_reverse(ls("map/"), true)); //Reverse to get last creations
	$id = 0;
	$maxId = min(constant("EXAMPLES_AMOUNT"), count($maps)) -1;

	if($maxId == -1) {
?>
		<div class="container">
			<div class="alert alert-info">
				Il n'y a aucun exemple récent. Vous pouvez <a href="create.php">créer votre propre carte dès maintenant</a>.
			</div>
		</div>
<?php
	}
	while($id >=0 && $id <= $maxId) {
		//Display current example
		$map = current($maps);
?>
			<div class="col-sm-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo $map["area"]; ?></h3>
					</div>
					<div class="panel-body">
						<div class="map-examples" id="map<?php echo $id; ?>"></div>

						<script type="text/javascript">
							// create a map in the "map" div, set the view to a given place and zoom
							var map<?php echo $id; ?> = L.map('map<?php echo $id; ?>');

							// add an OpenStreetMap tile layer
							L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
							attribution: '&copy; Les contributeurs <a href="http://osm.org/copyright">OpenStreetMap</a>'
							}).addTo(map<?php echo $id; ?>);

							//Restrict view to authorized area
							var polygon = L.polygon(
								[
									[<?php echo $map["minlat"].", ".$map["minlon"]; ?>],
									[<?php echo $map["minlat"].", ".$map["maxlon"]; ?>],
									[<?php echo $map["maxlat"].", ".$map["maxlon"]; ?>],
									[<?php echo $map["maxlat"].", ".$map["minlon"]; ?>]
								],
								{ color: 'orange', fillColor: 'orange', fillOpacity: 0.1 }
							).addTo(map<?php echo $id; ?>);

							map<?php echo $id; ?>.fitBounds(polygon.getBounds());
							map<?php echo $id; ?>.setMaxBounds(polygon.getBounds());
							map<?php echo $id; ?>.options.minZoom = map<?php echo $id; ?>.getZoom();
						</script>
						<p class="map-info"><a href="map/<?php echo $map["time"]; ?>.zip"><button class="btn btn-default" type="button">Télécharger</button></a></p>
					</div>
				</div>
			</div>
<?php
		//Start a new row
		if(($id % 2) == 1 && $id < $maxId) {
?>
		</div>
		<div class="row">
<?php
		}
		if($id < $maxId) {
			next($maps);
		}
		$id++;
	}
?>
<?php
?>
		</div>


<?php pageFooter("examples"); ?>
