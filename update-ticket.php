<?php require_once('authority.php'); ?>
<?php require_once('dbConnection.php'); ?>

<?php	
	//Select all Categories.
	$stmt = $db->query('select * from category');
	
	// Grab the tickets
	$categories = $stmt->fetchAll();
	
	//Query database for all tickets assigned to the current user.
	$stmt = $db->query('select * from techs');
	
	// Grab the tickets
	$techs = $stmt->fetchAll();
	
	if(isset($_GET['number'])) //Only connect to the database if a ticket is being queried.
	{
		//Query database for all tickets assigned to the current user.
		$stmt = $db->prepare('select *,LPAD(Num,7,"0") as ticket_num from tickets where num = ?');
		$stmt->bindValue(1, $_GET['number']);
		$stmt->execute();
	
		// Grab the ticket
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
                <h1 class="create-heading">Updating Ticket #: <?php echo($ticket_info['ticket_num']); ?></h1>
                <p class="alert" >All Items with a * are required</p>
                <div class="error-message alert"></div>
                <form method="POST" enctype="multipart/form-data" id="update-form">
                
                <input name="ticket-num" id="ticket-num" type="hidden" value="<?php echo($ticket_info['Num']); ?>">
                
                <label for="technician">Technician:</label><br>
				<select name="technician" id="technician">
					<option value=""></option>
					<?php foreach ($techs as $tech) : ?>
						<?php if($tech['UserID'] == $ticket_info['Technician']) {?>
								<option selected value="<?php echo($tech['UserID']); ?>"><?php echo($tech['Firstname']." ".$tech['Lastname']); ?></option>
						<?php } else { ?>
								<option value="<?php echo($tech['UserID']); ?>"><?php echo($tech['Firstname']." ".$tech['Lastname']); ?></option>
						<?php }?>
					<?php endforeach; ?>
				</select><br>
				
				<label for="category"><span class="alert">*</span>Category:</label><br>
				<select name="category" id="category">
					<?php foreach ($categories as $category) : ?>
						<?php if($category['CatID'] == $ticket_info['Category']) {?>
							<option selected value="<?php echo($category['CatID']); ?>"><?php echo($category['Catname']); ?></option>
						<?php } else { ?>
							<option value="<?php echo($category['CatID']); ?>"><?php echo($category['Catname']); ?></option>
						<?php }?>
					<?php endforeach; ?>
				</select><br>
				
				<label for="created">Created:</label><br>
				<label name="created"><?php echo($ticket_info['Created']); ?></label><br>
				
				<label for="updated">Last Updated:</label><br>
				<label name="updated"><?php echo($ticket_info['Updated']); ?></label><br>
                
                <label for="email"><span class="alert">*</span>Customer Email:</label><br>
				<input type="text" name="email" id="email" value="<?php echo($ticket_info['CEmail']); ?>"><br>
				
				<label for="name"><span class="alert">*</span>Customer Name:</label><br>
				<input type="text" name="name" id="name" value="<?php echo($ticket_info['CName']); ?>"><br>
				
				<label for="country"><span class="alert">*</span>Customer Country:</label><br>
				<input type="text" name="country" id="country" value="<?php echo($ticket_info['CCountry']); ?>"><br>
				
				<label for="issue"><span class="alert">*</span>Question/Issue:</label><br>
				<textarea name="issue" id="issue" class="textareas"><?php echo($ticket_info['Issue']); ?></textarea><br>
				
				<!--Holds button the user clicked. Also this defaults to update just incase the user hits enter.-->
				<input type="hidden" name="choice" id="choice" value="update">
				<input type="submit" name="update" id="update" class="spaced" value="Update"><input type="submit" name="delete" id="delete" class="spaced" value="Delete"><input type="submit" name="complete" id="complete" class="spaced" value="Completed">
				</form>
            </div> <!-- #main -->
        </div> <!-- #main-container -->
        <!--<input class="spaced" id="submit" type="submit" value="Completed">-->

		
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
        <script src="js/ticketHandler.js"></script>
    </body>
</html>
