<?php
	require_once('authority.php');
	require_once('dbConnection.php');	
	// 
	$json_data = array();
		
	//Create a prepared INSERT statement
	$stmt = $db->prepare('UPDATE tickets SET Updated=?, CEmail=?, CName=?, CCountry=?, Issue=?, Technician=?, Category=? WHERE Num = ?');
	$stmt->bindValue(1, date("Y-m-d H:i:s"));
	$stmt->bindValue(2, $_POST['email']);
	$stmt->bindValue(3, $_POST['name']);
	$stmt->bindValue(4, $_POST['country']);
	$stmt->bindValue(5, $_POST['issue']);
	// if the technician is empty then use NULL else use the value of the dropdown.
	if($_POST['technician'] == "")
	{
		$stmt->bindValue(6, NULL);
	}else{
		$stmt->bindValue(6, $_POST['technician']);
	}
	$stmt->bindValue(7, $_POST['category']);
	$stmt->bindValue(8, $_POST['ticket-num']);
	
	$sucessful = $stmt->execute();
	
	//check to see if the statement executed successfully.
	if($sucessful) {
		$json_data['success'] = true;
		$json_data['message'] = 'Ticket was updated!';
	} else {
		$json_data['success'] = false;
		$json_data['message'] = 'Hmm Something went wrong...';
	}
	
	// Encode response as JSON
	echo (json_encode($json_data));

?>