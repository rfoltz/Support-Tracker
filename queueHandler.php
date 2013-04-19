<?php
/* Source File: queueHandler.php
Name:Robert Foltz
Last Modified By: Robert Foltz
Website Name: Support Tracker
File Description: This is the page that handles the queue page when the user clicks the delete or assign buttons
*/

	require_once('authority.php');
	require_once('dbConnection.php');	
	// 
	$json_data = array();
	$json_data['message'] = "";
	
	if(isset($_POST['checked'])){ //check for the check boxes
		if(isset($_POST['choice']) && $_POST['choice'] == "delete") { // if the button choice delete was clicked
			$optionArray = $_POST['checked']; //get the check boxes
			foreach ($optionArray as $ticket => $value) { // loop throught the check boxes
				//Creat a prepared for statement to delete a Ticket.
				$stmt = $db->prepare('DELETE FROM tickets WHERE Num = ?'); // delete the tickets that were selected.
				$stmt->bindValue(1, $value);
	
				$sucessful = $stmt->execute();
	
				//check to see if the statement executed successfully.
				if($sucessful) {
					$json_data['success'] = true;
					$json_data['message'] = $json_data['message']."Ticket Number ".$value." was Deleted!\n"; // tell the user what tickets were deleted.
				} else {
					$json_data['success'] = false;
					$json_data['message'] = 'Hmm Something went wrong...';
				}
				
			}
			
		} else if(isset($_POST['choice']) && $_POST['choice'] == "assign") { // if the button choice was assigned
			$optionArray = $_POST['checked']; //get the check boxes
			foreach ($optionArray as $ticket => $value) { // loop through them.
				//Create a prepared statement to UPDATE a ticket 
				$stmt = $db->prepare('UPDATE tickets SET Updated=?, Technician = ? WHERE Num = ?'); //them assigne said tickets to the user.
				$stmt->bindValue(1, date("Y-m-d H:i:s"));
				$stmt->bindValue(2, $_SESSION['UserID']);
				$stmt->bindValue(3, $value);
	
				$sucessful = $stmt->execute();
	
				//check to see if the statement executed successfully.
				if($sucessful) {
					$json_data['success'] = true;
					$json_data['message'] = $json_data['message']."Ticket Number ".$value." was Assigned to You!\n"; // tell the user what tickets were assigned to them.
				} else {
					$json_data['success'] = false;
					$json_data['message'] = 'Hmm Something went wrong...';
				}
				
			}
		} else if(isset($_POST['choice']) && $_POST['choice'] == "reopen") { // if the button choice was assigned
			$optionArray = $_POST['checked']; //get the check boxes
			
			foreach ($optionArray as $ticket => $value) { // loop through them.
				$rightnow = date("Y-m-d H:i:s");
			
				//Get the tickets log and then append the a message to the log.
				$stmt = $db->prepare('select Log from tickets WHERE Num = ?');
				$stmt->bindValue(1, $value);
				$stmt->execute();

				$ticket_info = $stmt->fetch();
				$log = $ticket_info['Log'].'Reopened at '.$rightnow.' By '.$_SESSION['Firstname']." ".$_SESSION['Lastname']."\n";
			
			
				//Create a prepared statement to UPDATE a ticket 
				$stmt = $db->prepare('UPDATE tickets SET Updated=?, Completed = "N", Log = ? WHERE Num = ?'); //them assigne said tickets to the user.
				$stmt->bindValue(1, $rightnow);
				$stmt->bindValue(2, $log);
				$stmt->bindValue(3, $value);
	
				$sucessful = $stmt->execute();
	
				//check to see if the statement executed successfully.
				if($sucessful) {
					$json_data['success'] = true;
					$json_data['message'] = $json_data['message']."Ticket Number ".$value." was Reopened\n"; // tell the user what tickets were assigned to them.
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