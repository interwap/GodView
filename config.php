<?php
	

	define('DB_NAME', 'godview');

	/** MySQL database username */
	define('DB_USER', 'root');

	/** MySQL database password */
	define('DB_PASSWORD', '');

	/** MySQL hostname */
	define('DB_HOST', 'localhost');

	/** Database Charset to use in creating database tables. */
	define('DB_CHARSET', 'utf-8');

	$phptime = time();
	$realtime = date ("Y-m-d H:i:s", $phptime);

	$conn = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("could not connect to server");
	@mysqli_select_db( $conn, DB_NAME) or die("Error Connecting With Database" . mysqli_connect_error());

?>