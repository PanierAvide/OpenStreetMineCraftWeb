<?php
/**
 * Utility functions to manage files
 * Copyright (c) 2014 Adrien PAVIE.
 * @author PanierAvide
 */

//FUNCTIONS
	/**
	 * Writes an INI file in filesystem from an array
	 * @param $assoc_arr The array which contains the data
	 * @param $path The file path
	 * @param $has_sections Does the array contains sections or not (default: false)
	 * @return True if it worked
	 */
	function write_ini_file($assoc_arr, $path, $has_sections=FALSE) {
		$content = "";
		if ($has_sections) {
			foreach ($assoc_arr as $key=>$elem) {
			$content .= "[".$key."]\n";
			foreach ($elem as $key2=>$elem2) {
				if(is_array($elem2))
				{
				for($i=0;$i<count($elem2);$i++)
				{
					$content .= $key2."[] = \"".$elem2[$i]."\"\n";
				}
				}
				else if($elem2=="") $content .= $key2." = \n";
				else $content .= $key2." = \"".$elem2."\"\n";
			}
			}
		}
		else {
			foreach ($assoc_arr as $key=>$elem) {
			if(is_array($elem))
			{
				for($i=0;$i<count($elem);$i++)
				{
				$content .= $key2."[] = \"".$elem[$i]."\"\n";
				}
			}
			else if($elem=="") $content .= $key2." = \n";
			else $content .= $key2." = \"".$elem."\"\n";
			}
		}

		if (!$handle = fopen($path, 'w')) {
			return false;
		}
		if (!fwrite($handle, $content)) {
			return false;
		}
		fclose($handle);
		return true;
	}

	/**
	 * List the files and folders contained in a folder.
	 * This function is not recursive.
	 * @param $dir The directory to list
	 * @return An array which contains the files' name. The files are sorted by name.
	 */
	function ls($dir) {
		$result = array();
		$handler = opendir($dir);

		//List files
		while($file = readdir($handler)) {
			if($file != "." && $file != "..") {
				$result[] = $file;
			}
		}

		closedir($handler);

		return sort_files($result);
	}

	/**
	 * Sorts the given file list by ascending names
	 * @param $arr The file list
	 * @return The array with files sorted by name (Indexes: truncated file names), contains only ini files
	 */
	function sort_files($arr) {
		$result = array();
		foreach($arr as $k => $v) {
			if(substr($v, -4) === ".ini") {
				$result[intval(basename($v, ".ini"))] = $v;
			}
		}
		ksort($result);
		return $result;
	}
?>