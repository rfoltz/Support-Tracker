<?php
/* Source File: dbConnection.php
Name:Robert Foltz
Last Modified By: Robert Foltz
Website Name: Support Tracker
File Description: This is the page houses all the database connection stuff.
*/

$username_dbConnection = "robertfo_admin";
$password_dbConnection = "Admin01";

//New way of gaining a db connection
$dsn = 'mysql:host=localhost;dbname=robertfo_stracker';
//Connect to database
	try {
		$db = new PDO($dsn, $username_dbConnection, $password_dbConnection);
	} catch(Exception $e) {
		die(print_r($e->getMessage()));
	}
?>