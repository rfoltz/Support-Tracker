<?php
/* Source File: yourHandler.php
Name:Robert Foltz
Last Modified By: Robert Foltz
Website Name: Support Tracker
File Description: This is the page that handles the delete and complete button on the your-ticket.php page.
*/
	require_once('authority.php');
	require_once('dbConnection.php');	
	// 
	$json_data = array();
	$json_data['message'] = "";
	
	if(isset($_POST['checked'])){ //check to see if a check box was checked
		if(isset($_POST['choice']) && $_POST['choice'] == "delete") { //next get the choice of the button the user clicked.
			$optionArray = $_POST['checked']; //get the array of check boxes
			foreach ($optionArray as $ticket => $value) { //loop throught the check boxes
				//Creat a prepared for statement to delete a Ticket.
				$stmt = $db->prepare('DELETE FROM tickets WHERE Num = ?'); // delete said ticket
				$stmt->bindValue(1, $value);
	
				$sucessful = $stmt->execute();
	
				//check to see if the statement executed successfully.
				if($sucessful) {
					$json_data['success'] = true;
					$json_data['message'] = $json_data['message']."Ticket Number ".$value." was Deleted!\n"; // tell the user what tickets where deleted.
				} else {
					$json_data['success'] = false;
					$json_data['message'] = 'Hmm Something went wrong...';
				}
				
			}
			
		} else if(isset($_POST['choice']) && $_POST['choice'] == "close") { //get the chice of the button.
			$optionArray = $_POST['checked']; //get array of the checked tickets.
			foreach ($optionArray as $ticket => $value) {
				$rightnow = date("Y-m-d H:i:s");
			
				//Get the tickets log and then append the a message to the log.
				$stmt = $db->prepare('select Log from tickets WHERE Num = ?');
				$stmt->bindValue(1, $value);
				$stmt->execute();

				$ticket_info = $stmt->fetch();
				$log = $ticket_info['Log'].'Closed at '.$rightnow.' By '.$_SESSION['Firstname']." ".$_SESSION['Lastname']."\n";
			
			
			
				//Create a prepared statement to UPDATE a ticket 
				$stmt = $db->prepare('UPDATE tickets SET Updated=?, Completed = "Y", Log = ? WHERE Num = ?'); //complete checked tickets
				$stmt->bindValue(1, date("Y-m-d H:i:s"));
				$stmt->bindValue(2, $log);
				$stmt->bindValue(3, $value);
	
				$sucessful = $stmt->execute();
	
				//check to see if the statement executed successfully.
				if($sucessful) {
					$json_data['success'] = true;
					$json_data['message'] = $json_data['message']."Ticket Number ".$value." was Closed!\n"; //tell user what tickets were completed.
				} else {
					$json_data['success'] = false;
					$json_data['message'] = 'Hmm Something went wrong...';
				}
				
			}
		}
	}
	
	// Encode response as JSON
	echo (json_encode($json_data));
?>