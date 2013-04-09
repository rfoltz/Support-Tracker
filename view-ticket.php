<?php require_once('authority.php'); ?>
<?php require_once('dbConnection.php'); ?>

<?php
	
	if(isset($_GET['number'])) //Only connect to the database if a ticket is being queried.
	{
		//Query database for all tickets assigned to the current user.
		$stmt = $db->prepare('select *,LPAD(Num,7,"0") as ticket_num from tickets where num = ?');
		$stmt->bindValue(1, $_GET['number']);
		$stmt->execute();
	
		// Grab the tickets
		$ticket_info = $stmt->fetch();
	}
?>

<!DOCTYPE html>
<!--Source File: create-ticket.php
Name:Robert Foltz
Last Modified By: Robert Foltz
Website Name: Support Tracker
File Description: This is the page that people use to create a ticket.
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
            	<h1 class="title">Support Tracker</h1>
            	<nav>
                    <ul>
                        <li><a href="create-ticket.php">Create Ticket</a></li>
                        <li><a href="your-tickets.php">Your Tickets</a></li>
                        <li><a href="queue.php">Ticket Queue</a></li>
                        <li><a href="authority.php?logout=true">Logout</a></li>
                    </ul>
                </nav>
            </header>
        </div>

	<!--
    Main Content
    -->
        <div class="main-container">
            <div class="main wrapper clearfix">
            <?php if(isset($_GET['number'])) { ?>
                <h1 class="create-heading">Veiwing Ticket #: <?php echo($ticket_info['ticket_num']); ?></h1>
                <table class="tables">
					<?php	
						//Check for what category the ticket is in.
						$stmt = $db->prepare('select * from techs where UserID = ?');
						$stmt->bindValue(1, $ticket_info['Technician']);
						$stmt->execute();

						// Check if user provided correct username and password
						$tech = $stmt->fetch();
					?>
					<tr>
						<td><label>Technician:</label></td>
						<td><?php echo($tech['Firstname']." ".$tech['Lastname']); ?></td>
					</tr>
					<?php	
						//Check for what category the ticket is in.
						$stmt = $db->prepare('select Catname from category where CatID = ?');
						$stmt->bindValue(1, $ticket_info['Category']);
						$stmt->execute();

						// Check if user provided correct username and password
						$category = $stmt->fetch();
					?>
					<tr>
						<td><label>Category:</label></td>
						<td><?php echo($category['Catname']); ?></td>
					</tr>
					<tr>
						<td><label>Created:</label></td>
						<td><?php echo($ticket_info['Created']); ?></td>
					</tr>
					<tr>
						<td><label>Last Updated:</label></td>
						<td><?php echo($ticket_info['Updated']); ?></td>
					</tr>
					<tr>
						<td><label>Customer Email:</label></td>
						<td><a href="mailto:<?php echo($ticket_info['CEmail']); ?>"><?php echo($ticket_info['CEmail']); ?></a></td>
					</tr>
					<tr>
						<td><label>Customer Name:</label></td>
						<td><?php echo($ticket_info['CName']); ?></td>
					</tr>
					<tr>
						<td><label>Customer Country:</label></td>
						<td><?php echo($ticket_info['CCountry']); ?></td>
					</tr>
				</table>
				<label>Question/Issue:</label><br>
				<textarea class="textareas" disabled="true"><?php echo($ticket_info['Issue']); ?></textarea><br>
			<?php } else { ?>
				<h1>No Ticket To Display! Sorry...</h1>
				<p>Please Contact Technical Support: <a href="mailto:support@supporttracker.com">support@supporttracker.com</a></p>
			<?php } ?>
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
        <script src="js/main.js"></script>
    </body>
</html>
