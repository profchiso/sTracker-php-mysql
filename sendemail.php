<?php

	// send email to the recipient
			require_once('/connect.php');
			$query3 = "Select email from users where staff_no='{$_SESSION['recipient']}' ";
			$result2=mysql_query($query3);
			while($row = mysql_fetch_array($result2) ){
			$to = $row['email'];}
			$subject = 'SmartTracker eAlert';
			$message = 'A File have been sent to you from SmartTracker. Login and attend to it. Please do not reply this email, it is an auto-generated email.';
			$headers = 'From: admin@smarttracker.com';
			mail($to, $subject, $message, $headers); 

			//send email to the owner
			require_once('/connect.php');
			$query3 = "Select email from users where staff_no='{$_SESSION['owner']}' ";
			$result2=mysql_query($query3);
			while($row = mysql_fetch_array($result2) ){
			$to = $row['email'];}
			$reciever = $_SESSION["recipient"];
			$subject = 'SmartTracker eAlert';
			$message = $message1 = "Your document titled " . $_SESSION['docname'] ." have been forwarded to " . $reciever;
			$headers = 'From: admin@smarttracker.com';
			mail($to, $subject, $message, $headers);
?>