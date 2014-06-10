<?php
include_once("config.php");
include_once("file.php");
require("lib/phpmailer/PHPMailerAutoload.php");

/**
 * Render script of the application.
 * It searches if there is a task to render, and calls OSMC to render it.
 * Copyright (c) 2014 Adrien PAVIE.
 * @author PanierAvide
 */

//FUNCTIONS
	/**
	 * High-level function, which renders one task.
	 * @return True if a task was rendered, false else.
	 */
	function render() {
		$result = false;

		//Find the file corresponding to the next task
		$jobs = ls(constant("BASE_DIR")."req/");
		if(count($jobs) > 0) {
			$job = key($jobs); //The next task ID
			echo "\nStart rendering task #$job\n";

			//Read task metadata
			$jobData = parse_ini_file(constant("BASE_DIR")."req/$job.ini", true);

			//Launch OSMC
			$cmdOutput = array();
			$cmdReturn = -1;
			$cmd = constant("OSMC_CMD").
				" -css ".constant("BASE_DIR")."osmccss/default/style.osmccss -zip -dbhost ".constant("DB_HOST").
				" -dbname ".constant("DB_NAME").
				" -dbpass ".constant("DB_PASS").
				" -dbport ".constant("DB_PORT").
				" -dbuser ".constant("DB_USER").
				" -maxlat ".$jobData["coordinates"]["maxlat"].
				" -maxlon ".$jobData["coordinates"]["maxlon"].
				" -minlat ".$jobData["coordinates"]["minlat"].
				" -minlon ".$jobData["coordinates"]["minlon"].
				" ".constant("BASE_DIR")."map/$job".
				" 2>&1";
			exec($cmd, $cmdOutput, $cmdReturn);

			//Analyse command output
			$cmdOk = ($cmdReturn == 0); $i=0;
			while($i < count($cmdOutput) && $cmdOk) {
				if(preg_match("/(?i)((Error)|(Exception))/", $cmdOutput[$i])) {
					$cmdOk = false;
				}
				$i++;
			}

			//Print command output for debug
			if(constant("DEBUG_MODE")) {
				echo "\n=============== Command ================";
				echo "\n$cmd";
				echo "\n============ Command output ============";
				for($i=0; $i <5 && $i < count($cmdOutput); $i++) {
					echo "\n".$cmdOutput[$i];
				}
				echo "\n========================================\n";
			}

			if($cmdOk) {
				//Create result files in map folder
				$email = $jobData["metadata"]["from"];
				unset($jobData["metadata"]["from"]);
				if(write_ini_file($jobData, constant("BASE_DIR")."map/$job.ini", true)) {
					//Send email to say the result is available
					sendMail($job, $email);
				}

				//Delete request file
				unlink(constant("BASE_DIR")."req/$job.ini");
				echo "\nTask #$job successfully done";
			}
			else {
				//Alert when fail
				echo "\nTask #$job failed";
			}
		}

		return $result;
	}

	function sendMail($job, $email) {
		$mail = new PHPMailer;

		if(constant("DEBUG_MODE")) {
			$mail->SMTPDebug = 2;
			$mail->Debugoutput = "echo";
		}

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Port = constant("MAIL_SMTP_PORT");
		$mail->Host = constant("MAIL_SMTP_HOST");  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = constant("MAIL_SMTP_USER");                 // SMTP username
		$mail->Password = constant("MAIL_SMTP_PASS");                           // SMTP password
		$mail->SMTPSecure = constant("MAIL_SMTP_SECURITY");                            // Enable encryption, 'ssl' also accepted

		$mail->From = constant("MAIL_FROM");
		$mail->FromName = 'OpenStreetMineCraft';
		$mail->addAddress($email);     // Add a recipient
		$mail->addReplyTo(constant("MAIL_FROM"), 'OpenStreetMineCraft');

		$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
		$mail->isHTML(false);                                  // Set email format to HTML

		$mail->Subject = '[OpenStreetMineCraft] Your task #'.$job.' is done';
		$mail->Body    = "Hello,\r\nThe area you wanted in OpenStreetMineCraft is available.\r\n".
					"You can download it here: ".constant("BASE_URL")."map/$job.zip\r\n".
					"Installation guide is here: ".constant("BASE_URL")."faq.php#install\r\n".
					"Regards,\r\n".
					"The OpenStreetMineCraft team.";

		if(!$mail->send()) {
			echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 'Message has been sent';
		}
	}

//MAIN
//To prevent direct access to this file
if(!isset($argv) || !isset($argv[1]) || $argv[1] != "launcher") {
	header("Location: ".constant("BASE_URL")."index.php");
	die();
}

while(true) {
	if(!render()) {
		echo "\nWaiting";
		sleep(30);
	}
}
?>