<?php
// Error variables in case input does not validate
$validName = $validEmail = $validSubject = $validMsgCont = "";

// backup submitted form data, only set if form does not validate
$nameVal = $emailVal = $subjectVal = $messageContentVal = "";

// vars for message content
$name = $email = $subject = $messageContent = "";

// variable to say whether form is valid, 0=true 1=false
$formOK = 0;
//Default Form content
$content = '
<h3>Contact Us</h3>
<!-- Feedback Form -->
<p> You can email us by following this <a href="mailto:inquiries@ybpss.org?Subject=Contact">Email Link</a> or you can use the form below.</p>
<p class="required"> 
	* All Fields Required 
</p>
<form id="contactForm" method="post" name="contactForm" >
	<fieldset>
		<legend>Personal Information:</legend>
		<label id="personNameLabel" for="personName">Your Name: </label> 
		<br>
		<input id="personName" name="personName" type="text" value="" required>
		<br> 
		<br> 
		<label id="personEmailLabel" for="personEmail">
			Your Email: 
		</label> 
		<br> 
		<input id="personEmail" name="personEmail" placeholder="example@example.com" type="text" value="" required>
		<br>
	</fieldset>
	<br>
	<fieldset>
		<legend> Message Details</legend>
		<label id="msgSubjectLabel" for="msgSubject">
			Message Subject:
		</label> 
		<br> 
		<input id="msgSubject" name="msgSubject" placeholder="Subject" type="text" value="" required>
		<br> 
		<label id="msgContentLabel" for="msgContent">
			Your Message: 
		</label>
		<br>
		<textarea id="msgContent" name="msgContent" placeholder="Type your message here..." required ></textarea>
		<br>
	</fieldset>
	<!-- check box that will be  hidden from usrs, but bots will see it and check it. Id the checkbox is checked, email will not send-->
	<input type="checkbox" name="checkBox" value="bot" id="hiddenFormCheckbox" aria-hidden="true"> 
	<br>
	<button id="sendButton" name="submit" type="submit" value="Send Message">
		Send Message
	</button>
	<br> 
	<br>
</form>';

// if the form has been submitted run this code
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	// botcheck, if this element is checked, then must be a bot
	if (! empty ( $_POST ["checkBox"] )) {
		$formOK = 1; // form is not OK
	}
	
	// Check if element is empty, if not get all the message details
	if (empty ( $_POST ["personName"] ) || ctype_space ( $_POST ["personName"] )) {
		$validName = "<span class=\"require\">* required</span>";
		$formOK = 1; // form is not OK
	} else {
		$name = clean_input ( $_POST ['personName'] );
	}
	
	if (! filter_var ( $_POST ['personEmail'], FILTER_VALIDATE_EMAIL )) {
		$validEmail = "<span class=\"require\">* Please enter valid email</span>";
		$formOK = 1; // form is not OK
	} else {
		$email = clean_input ( $_POST ['personEmail'] );
	}
	
	if (empty ( $_POST ["msgSubject"] ) || ctype_space ( $_POST ["msgSubject"] )) {
		$validSubject = "<span class=\"require\">* required</span>";
		$formOK = 1; // form is not OK
	} else {
		$subject = clean_input ( $_POST ['msgSubject'] );
	}
	
	if (empty ( $_POST ["msgContent"] ) || ctype_space ( $_POST ["msgContent"] )) {
		$validMsgCont = "<span class=\"require\">* required</span>";
		$formOK = 1; // form is not OK
	} else {
		$messageContent = wordwrap ( clean_input ( $_POST ['msgContent'], 70 ) ); // lines in the message section cannot exceed 70 characters.
	}
	
	// all checks complete, if form is ok then submit form
	if ($formOK == 0) {
		$finalMessage = "Subject: " . $subject . "\nMessage: " . $messageContent . "\nFrom: " . $name . "\nTheir Email Address: " . $email;
		// send the email.
		mail('inquiries@ybpss.org',$subject,$finalMessage, "From:contactus@YBPSS.org");
		// Echo thankyou message
		$content = '<h3> Thank You For Contacting Us</h3>
		<p>Thank you for your message, we aim to respond to these emails as quickly as possible, so you should hear from us soon.</p>';
	} else {
		//set content that has been entered.
		$nameVal = htmlspecialchars ( $_POST ['personName'] );
		$emailVal = htmlspecialchars ( $_POST ['personEmail'] );
		$subjectVal = htmlspecialchars ( $_POST ['msgSubject'] );
		$messageContentVal = htmlspecialchars ( $_POST ['msgContent'] );
		// place new form with content and error messages
		$content = '
<h3>Contact Us</h3>
<p> You can email us by following this <a href="mailto:inquiries@ybpss.org?Subject=Contact">Email Link</a> or you can use the form below.</p>
<p class="required"> 
	* All Fields Required 
</p>
<!-- Feedback Form -->
<form action="' . htmlspecialchars ( "" ) . '" id="contactForm" method="post" name="contactForm" >
	<fieldset>
		<legend>Personal Information:</legend>
		<label id="personNameLabel" for="personName">
			Your Name: 
		</label> 
		<br>
		<input name="personName" type="text" value="' . $nameVal . '" required>' . $validName . '
		<br> 
		<br> 
		<label id="personEmailLabel" for="personEmail">
			Your Email: 
		</label> 
		<br> 
		<input id="personEmail" name="personEmail" placeholder="example@example.com" type="text" value="' . $emailVal . '" required>' . $validEmail . '
		<br>
	</fieldset>
	<br>
	<fieldset>
		<legend> Message Details</legend>
		<label id="msgSubjectLabel" for="msgSubject">
				Message Subject:
		</label> 
		<br> 
		<input name="msgSubject" placeholder="Subject" type="text" value="' . $subjectVal . '" required>' . $validSubject . ' 
		<br> 
		<label id="msgContentLabel" for="msgContent">Your Message: </label> ' . $validMsgCont . '
		<br>
		<textarea name="msgContent" " placeholder="Type your message here..." required >' . $messageContentVal . '</textarea>
		<br>
	</fieldset>
	<!-- check box that will be  hidden from usrs, but bots will see it and check it. Id the checkbox is checked, email will not send-->
	<input type="checkbox" name="checkBox" value="bot" id="hiddenFormCheckbox" aria-hidden="true"> 
	<br>
	<button id="sendButton" name="submit" type="submit" value="Send Message">Send Message</button>
	<br> 
	<br>
</form>';
	}
	
	// If the form has not been submitted then display the form.
}
// funtion to clean data from inputs to ensure safety
function clean_input($data) {
	$data = trim ( $data );
	$data = stripslashes ( $data );
	$data = htmlspecialchars ( $data );
	return $data;
}
//Display the page content.
echo $content;

?>

