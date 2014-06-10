<?php
include_once("config.php");
include_once("file.php");

/**
 * This script analyses the POST request from the index, and creates the generation request.
 * Copyright (c) 2014 Adrien PAVIE.
 * @author PanierAvide
 */

//FUNCTIONS
	/**
	 * Tests if the POST request is correct.
	 * Error codes: vars_missing, email_syntax, coords_not_numeric, coords_outside, coords_too_wide.
	 * @return True if correct, an error code if not.
	 */
	function correctRequest() {
		$result = false;

		//Existing vars
		if(isset($_POST) && isset($_POST["email"]) && isset($_POST["coord_sw_lat"])
			&& isset($_POST["coord_sw_lon"]) && isset($_POST["coord_ne_lon"])
			&& isset($_POST["coord_sw_lat"])) {

			//Email syntax
			if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $_POST["email"])) {
				//Numeric values for coordinates
				if(correctFloatValue($_POST["coord_sw_lat"])
					&& correctFloatValue($_POST["coord_sw_lon"])
					&& correctFloatValue($_POST["coord_ne_lat"])
					&& correctFloatValue($_POST["coord_ne_lon"])) {

					//Valid coordinates
					if(abs($_POST["coord_sw_lat"]) <= 90
						&& abs($_POST["coord_ne_lat"]) <= 90
						&& abs($_POST["coord_sw_lon"]) <= 180
						&& abs($_POST["coord_ne_lon"]) <= 180) {

						//Reasonable area
						if(abs($_POST["coord_sw_lat"] - $_POST["coord_ne_lat"]) <= constant("MAX_OFFSET_COORDS")
							&& abs($_POST["coord_sw_lon"] - $_POST["coord_ne_lon"]) <= constant("MAX_OFFSET_COORDS")) {

							$result = true;
						} else { $result = "coords_too_wide"; }
					} else { $result = "coords_outside"; }
				} else { $result = "coords_not_numeric"; }
			} else { $result = "email_syntax"; }
		} else { $result = "vars_missing"; }

		return $result;
	}

	/**
	 * Checks if a given string is a float
	 * @param $val The string to test
	 * @return True if valid float
	 */
	function correctFloatValue($val) {
		return !is_nan($val);
	}

	/**
	 * Redirects the user to the index page, and displays an error
	 * @param $error The error code (see correctRequest())
	 */
	function redirect($error) {
		header("Location: create.php?e=$error&email=".$_POST["email"]);
		die();
	}

	/**
	 * Redirects the user to the status page
	 * @param $id The task ID
	 */
	function redirectStatus($id) {
		header("Location: status.php?id=$id");
		die();
	}

	/**
	 * Get the area name from nominatim service
	 * @param $minlat The minimal latitude
	 * @param $minlon The minimal longitude
	 * @param $maxlat The maximal latitude
	 * @param $maxlon The maximal longitude
	 * @return The area name, or empty string if not found or not available
	 */
	function getAreaNominatim($minlat, $minlon, $maxlat, $maxlon) {
		$result = "";

		//Central coordinates
		$lat = (($maxlat-$minlat) / 2) + $minlat;
		$lon = (($maxlon-$minlon) / 2) + $minlon;

		//URL to call
		$url = "http://nominatim.openstreetmap.org/reverse?format=json&zoom=13&lat=$lat&lon=$lon";
		$geocoding = get_url_contents($url);
		if($geocoding != "") {
			$geocoding = json_decode($geocoding);
			if(!isset($geocoding->error)) {
				$result = $geocoding->display_name;
			}
		}

		return $result;
	}

	/**
	 * Requests a given URL, and gives the result as string
	 * @param $url The URL to request
	 * @result The response, as string
	 */
	function get_url_contents($url){
		$crl = curl_init();
		$timeout = 5;
		curl_setopt ($crl, CURLOPT_URL,$url);
		curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
		$ret = curl_exec($crl);
		curl_close($crl);
		return $ret;
	}

	/**
	 * Creates a render request in req folder.
	 * @return false if an error occurs, else the request ID
	 */
	function createRequest() {
		$result = false;
		$time = time();
		$data = array(
				"metadata" => array(
							"from" => $_POST["email"],
							"time" => $time,
							"area" => getAreaNominatim($_POST["coord_sw_lat"], $_POST["coord_sw_lon"], $_POST["coord_ne_lat"], $_POST["coord_ne_lon"])
						),
				"coordinates" => array(
							"minlon" => $_POST["coord_sw_lon"],
							"minlat" => $_POST["coord_sw_lat"],
							"maxlon" => $_POST["coord_ne_lon"],
							"maxlat" => $_POST["coord_ne_lat"]
						)
			);
		if(write_ini_file($data, "req/$time.ini", true)) {
			$result = $time;
		}
		return $result;
	}

//MAIN
$requestEval = correctRequest();
if($requestEval === true) {
	$id = createRequest();
	if($id !== false) {
		redirectStatus($id);
	} else {
		redirect("req_error");
	}
} else {
	redirect($requestEval);
}
?>