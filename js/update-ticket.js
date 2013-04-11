/* Source File: update-ticket.js
Name:Robert Foltz
Last Modified By: Robert Foltz
Website Name: Support Tracker
File Description: This is the page does the AJAXing to the update ticket handler.
*/

$(document).ready(function() {
	/** Login Form Submission
	 *		Handles form validation and AJAXing to server.
	 */
	$("#update-form").submit(function () {
		//Check to ensure category is filled.
		if ($("#category").val().length == 0) {
			$(".error-message").text("Please enter a category.");
			$("#category").focus();
			return false;
		}
		
		//Check to ensure email is filled.
		if ($("#email").val().length == 0) {
			$(".error-message").text("Please enter a customer email.");
			$("#email").focus();
			return false;
		}
		
		//Check to ensure name is filled.
		if ($("#name").val().length == 0) {
			$(".error-message").text("Please enter a customer name.");
			$("#name").focus();
			return false;
		}
	
		//Check to ensure country is filled.
		if ($("#country").val().length == 0) {
			$(".error-message").text("Please enter a customers country.");
			$("#country").focus();
			return false;
		}
		
		//Check to ensure issue is filled.
		if ($("#issue").val().length == 0) {
			$(".error-message").text("Please enter the issue or question.");
			$("#issue").focus();
			return false;
		}
	
		// AJAX server to validate login information.
		$.ajax({  
		  type: "POST",
		  url: "updating-ticket.php",  
		  data: $("#update-form").serialize(),
		  success: function(data) {
				var result = JSON.parse(data);
				if (result.success) {
					alert(result.message);
				} else {
					alert(result.message);
				}
		  }
		});  
		return false;	
	});
});
