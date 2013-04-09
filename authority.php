<?php
session_start();

if (!isset($_SESSION) || (!isset($_SESSION['UserID']) && !isset($_SESSION['Firstname']) && !isset($_SESSION['Lastname']))) {
  header("Location: login.php");
  exit;
}

if(isset($_GET["logout"]))
{
	if($_GET["logout"] == true)
	{
		session_unset();
		session_destroy();
		header("Location: login.php");
  		exit;
	}
}
?>