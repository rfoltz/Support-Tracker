<?php require_once('authority.php'); ?>
<?php require_once('dbConnection.php'); ?>

<?php	
	//Query database for all tickets assigned to the current user.
	$stmt = $db->query('select *,LPAD(Num,7,"0") as ticket_num from tickets where technician is null');
	
	//Grab queue of tickets
	$ticket_info = $stmt->fetchAll();
?>

<!DOCTYPE html>
<!--Source File: index.php
Name:Robert Foltz
Last Modified By: Robert Foltz
Website Name: Support Tracker
File Description: This is the page that lists un-assigned tickets.
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
            	<p class="as">Logged In As: <?php echo($_SESSION['Firstname']." ".$_SESSION['Lastname']); ?></p>
                <h1>Ticket Queue</h1>
                <form action="">
					<table id="ticket-queue" border="1">
						<tr>
							<th></th>
							<th>Ticket #</th>
							<th>Category</th>
							<th>Created</th>
							<th>Last Updated</th>
							<th>View</th>
							<th>Update</th>
						</tr>
						<?php foreach ($ticket_info as $ticket) : ?>
						<tr>
							<td><input type="checkbox" name="checked[]" value="<?php echo($ticket['Num']); ?>"></td>
							<td><a href="update-ticket.php?number=<?php echo($ticket['Num']); ?>">#<?php echo($ticket['ticket_num']); ?></a></td>
							
							<?php	
								//Check for what category the ticket is in.
								$stmt = $db->prepare('select Catname from category where CatID = ?');
								$stmt->bindValue(1, $ticket['Category']);
								$stmt->execute();
	
								// Check if user provided correct username and password
								$category = $stmt->fetch();
							?>
							<td><?php echo($category['Catname']); ?></td>
							<td><?php echo($ticket['Created']); ?></td>
							<td><?php echo($ticket['Updated']); ?></td>
							<td><a href="view-ticket.php?number=<?php echo($ticket['Num']); ?>">View</a></td>
							<td><a href="update-ticket.php?number=<?php echo($ticket['Num']); ?>">Update</a></td>
						</tr>
						<?php endforeach; ?>
					</table>
					<input class="spaced" type="submit" name="delete" value="Delete">
					<input class="spaced" type="submit" name="assign" value="Assign">
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
        <script src="js/main.js"></script>
    </body>
</html>
