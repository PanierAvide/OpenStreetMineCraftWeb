<?php
include_once("file.php");
include_once("page_struct.php");

/**
 * Status page for a rendering.
 * Copyright (c) 2014 Adrien PAVIE.
 * @author PanierAvide
 */

//FUNCTIONS
	/**
	 * Returns the position of a given key in the array
	 * @param $arr The array to search in
	 * @param $key The key
	 * @return The position of the key in the array, -1 if not found.
	 */
	function positionKey($arr, $key) {
		$pos = 0;
		$found = false;
		foreach($arr as $k => $v) {
			if(!$found && $k != $key) {
				$pos++;
			} else {
				$found = true;
			}
		}

		if(!$found) { $pos = -1; }
		return $pos;
	}

	/**
	 * Translates the state code into a comprehensive message
	 * @param $st The current state
	 * @param $id The task ID
	 * @param $pl The task place in jobs list
	 * @return The message
	 */
	function stateToMessage($st, $id, $pl) {
		$messages = array(
				"task_running" => "La tâche est en cours de rendu. Vous serez alerté par courriel lorsqu'elle sera achevée.<br />Si vous ne recevez pas de courriel, vous pouvez actualiser cette page pour voir la progression.",
				"task_waiting" => "La tâche est dans la file d'attente, en ".$pl."e position. Vous serez alerté par courriel lorsqu'elle sera achevée.",
				"task_done" => "La tâche est achevée, vous pouvez la <a href=\"map/$id.zip\">télécharger ici</a>.<br />Pour savoir comment installer une carte, consultez la <a href=\"faq.php#install\">foire aux questions</a>."
				);
		return (isset($messages[$st])) ? $messages[$st] : "Erreur: la tâche est dans un état inconnu ($st)";
	}

	/**
	 * Is the rendering daemon running ?
	 * @return True if running
	 */
	function renderRunning() {
		$cmdOutput = array();
		$cmdReturn = -1;

		exec("ps ax | grep 'render.php launcher' | grep -v 'grep'", $cmdOutput, $cmdReturn);

		return (count($cmdOutput) > 0 && $cmdReturn == 0);
	}

//MAIN
if(isset($_GET["id"])) {
	$jobs = ls("req/");
	$id = intval($_GET["id"]);

	//Is the task in waiting state, or done ?
	if(isset($jobs[$id])) {
		//Is it the first job in list ?
		if($id == key($jobs)) {
			$state = "task_running";
		} else {
			$state = "task_waiting";
			$place = positionKey($jobs, $id);
		}
	} else {
		$maps = ls("map/");
		if(isset($maps[$id])) {
			$state = "task_done";
		} else {
			$GLOBALS["error"] = "id_invalid";
		}
	}
}
/*else {
	//Redirect to index
	header("Location: index.php");
	die();
}*/
?>

<?php pageHeader("status"); ?>

<?php
	if(isset($state)) {
?>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">État de votre demande</h3>
			</div>
			<div class="panel-body">
				<p><?php echo stateToMessage($state, $id, isset($place) ? $place : 0); ?></p>
			</div>
		</div>
		<hr />
<?php
	}
?>

<?php
	if(renderRunning()) {
?>
		<div class="alert alert-success">
			Serveur de rendu actif
		</div>
<?php
	} else {
?>
		<div class="alert alert-warning">
			Serveur de rendu inactif
		</div>
<?php
	}
?>

<?php pageFooter("status"); ?>