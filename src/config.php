<?php
/**
 * Configuration file.
 * Copyright (c) 2014 Adrien PAVIE.
 * @author PanierAvide
 */

/*
 * Map bounds, corresponding to loaded data in your PostGis database.
 */
define("MAP_MINLAT", 47.07722);		//Minimal latitude
define("MAP_MAXLAT", 49.19312);		//Maximal latitude
define("MAP_MINLON", -5.883925);	//Minimal longitude
define("MAP_MAXLON", -1.0145379);	//Maximal longitude

/*
 * The OpenStreetMineCraft engine command.
 * You should write the absolute path to access it.
 * You can also define some JVM options if you want, but all have to be before the "-jar /path/to/osmc.jar" option.
 */
define("OSMC_CMD", "java -server -XX:+UseConcMarkSweepGC -XX:+UseParNewGC -XX:+CMSIncrementalPacing -XX:ParallelGCThreads=2 -XX:+AggressiveOpts -Xmx2G -jar /path/to/osmc.jar");

/*
 * Your PostGis database connection information.
 */
define("DB_HOST", "localhost");		//The host or IP address
define("DB_USER", "postgres");		//The user of the database
define("DB_PASS", "password");		//The password associated to the given user
define("DB_NAME", "gis");		//The database name
define("DB_PORT", "5432");		//The database port

/*
 * Your SMTP server configuration, to send mails to users
 */
define("MAIL_SMTP_HOST", "smtp.yourmail.net");			//The SMTP hostname
define("MAIL_SMTP_PORT", 465);					//The SMTP port
define("MAIL_SMTP_USER", "me@yourmail.net");			//Your SMTP user name (most of the time your email address)
define("MAIL_SMTP_PASS", "password");				//You SMTP account password
define("MAIL_SMTP_SECURITY", "ssl");				//The security protocol, can be "ssl" or "tls"
define("MAIL_FROM", "me@yourmail.net");				//The sender's email

/*
 * General information about the website
 */
define("BASE_URL", "http://localhost/html/osmc/");	//The URL to access the website
define("BASE_DIR", "/home/user/www/html/osmc/");	//The folder where the website is
define("DEBUG_MODE", false);				//Debug mode allows to display more information in logs
define("MAX_OFFSET_COORDS", 0.1);			//The maximal width and height of a single request (in WGS units)
define("EXAMPLES_AMOUNT", 10);				//Choose the amount of last examples to display
?>