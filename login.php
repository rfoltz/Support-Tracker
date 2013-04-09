<?php
session_start();

//if the user is already logged in just redirect them to the your tickets page.
if(isset($_SESSION['UserID']) && isset($_SESSION['Firstname']) && isset($_SESSION['Lastname'])) 
{
  header("Location: your-tickets.php");
  exit;
}
?>

<!DOCTYPE html>
<!--Source File: login.php
Name:Robert Foltz
Last Modified By: Robert Foltz
Website Name: Support Tracker
File Description: This is the login page to view, and create tickets.
-->

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Support Tracker</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	
		<!-- CSS -->
        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">
        

        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
	<!--
    Page Header and Menu
    -->
        <div class="header-container">
            <header class="wrapper clearfix">
            	<h1 id="logo" class="title">Support Tracker</h1>
            	<nav class="login-menu">
                    <ul>
                    	<li><a href="index.php">Home</a></li>
                        <li><a href="login.php">Login</a></li>
                    </ul>
                </nav>
            </header>
        </div>

	<!--
    Main Content
    -->
        <div class="main-container">
            <div class="main wrapper clearfix">
            	<h1>Support Tracker Login</h1>
            	<div class="error-message alert"></div>
				<form method="POST" enctype="multipart/form-data" id="login-form">
					<table id="login-table">
						<tr>
							<td>Username: </td>
							<td><input type="text" name="username" id="username"></td>
						</tr>
						<tr>
							<td>Password:</td>
							<td><input type="password" name="password" id="password"></td>
						</tr>
						<tr>
							<td colspan="2"><input id="submit" style="float:right;" type="submit" value="Login"></td>
						</tr>
					</table>
				</form>
            </div> <!-- #main -->
        </div> <!-- #main-container -->

		
        <!--
        Page Footer
        -->
        <div class="footer-container">
            <footer class="wrapper">
                <h5>Copyright of Robert Foltz 2013</h5>
            </footer>
        </div>
        
        <!--
        Scripts/Script Linking
        -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.3.min.js"><\/script>')</script>

        <!-- My Javascript. -->
        <script src="js/login-page.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
