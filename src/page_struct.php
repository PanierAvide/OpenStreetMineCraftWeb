<?php
/**
 * Contains the header and footer functions.
 * Copyright (c) 2014 Adrien PAVIE.
 * @author PanierAvide
 */
//FUNCTIONS

	/**
	 * Translates an error code into a comprehensive message
	 * @param $error The error code
	 * @return The message, or a generic message if the given code is unknown
	 */
	function errorToMessage($error) {
		$messages = array(
				"vars_missing" => "Erreur lors de l'envoi des données",
				"email_syntax" => "Le courriel indiqué est invalide",
				"coords_not_numeric" => "Les coordonnées indiquées ne sont pas des nombres réels",
				"coords_outside" => "La zone de sélection est en dehors de la carte",
				"coords_too_wide" => "La zone de sélection est trop grande.",
				"req_error" => "Une erreur s'est produite lors de la création de la requête. Veuillez réessayer plus tard.",
				"id_invalid" => "Le numéro de tâche est invalide."
				);
		return (isset($messages[$error])) ? $messages[$error] : "Erreur inconnue: $error";
	}

	function pageToTitle($page) {
		$title = array(
				"index" => "",
				"create" => "Création de votre ville",
				"about" => "À propos",
				"status" => "",
				"examples" => "Dernières créations",
				"faq" => "Foire aux questions"
				);
		return $title[$page];
	}

//----------------------------------------------------------

	/**
	 * Prints the page header
	 * @param $page The page ID
	 */
	function pageHeader($page) {
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>OpenStreetMineCraft</title>
	<link rel="icon" type="image/x-icon" href="favicon.ico">

	<!-- jQuery includes -->
	<script src="js/jquery-1.11.1.min.js"></script>

	<!-- Leaflet includes -->
	<link rel="stylesheet" href="css/leaflet.css" />
	<script src="js/leaflet.js"></script>
	<!-- Leaflet AreaSelect includes -->
	<link rel="stylesheet" href="css/leaflet-areaselect.css" />
	<script src="js/leaflet-areaselect.js"></script>

	<!-- Bootstrap includes -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="css/bootstrap-theme.min.css" />
	<script src="js/bootstrap.min.js"></script>
	<link href="css/jumbotron.css" rel="stylesheet" />
	<link href="css/docs.min.css" rel="stylesheet" />
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- OSMC Style, to override some rules -->
	<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body role="document">
	<div role="navigation" class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="index.php" class="navbar-brand"><img src="img/osmc_64.png" height="25px" /> OpenStreetMineCraft</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<!--li<?php if($page == "index") { echo ' class="active"'; } ?>><a href="index.php">Accueil</a></li-->
					<li<?php if($page == "create") { echo ' class="active"'; } ?>><a href="create.php">Créer votre ville</a></li>
					<li<?php if($page == "examples") { echo ' class="active"'; } ?>><a href="examples.php">Exemples</a></li>
					<li<?php if($page == "status") { echo ' class="active"'; } ?>><a href="status.php">État du serveur</a></li>
					<li<?php if($page == "faq") { echo ' class="active"'; } ?>><a href="faq.php">FAQ</a></li>
					<li<?php if($page == "about") { echo ' class="active"'; } ?>><a href="about.php">À propos</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>

	<div class="container theme-jumbotron" role="main">
<?php
		if(pageToTitle($page) != "") {
?>
		<div class="page-header">
			<h1><?php echo pageToTitle($page); ?></h1>
		</div>
<?php
		} else {
?>
		<div class="container container-bordered">
		</div>
<?php
		}

		//Errors display
		if(isset($_GET["e"])) {
			pageError($_GET["e"]);
		}
		if(isset($GLOBALS["error"])) {
			pageError($GLOBALS["error"]);
			unset($GLOBALS["error"]);
		}
	}

//----------------------------------------------------------

	function pageError($code) {
?>
		<div class="alert alert-danger"><?php echo errorToMessage($code); ?></div>
<?php
	}

//----------------------------------------------------------

	function pageFooter($code) {
?>
		<hr />
		<footer>
			<p>Moteur : &copy; OpenStreetMineCraft 2014 | Données : &copy; Les contributeurs <a href="http://osm.org/copyright">OpenStreetMap</a></p>
		</footer>
	</div>
</body>
</html>

<?php
	}

//----------------------------------------------------------

?>