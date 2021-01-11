<?php
/**
 * Sending an email test
 */
$to      = 'chibuikemadubuike@gmail.com';
$subject = 'sTracker Document';
$message = 'Testing sTracker email fuction';
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$result = mail($to, $subject, $message, $headers);
if( $result ) {
   echo 'Success';
}else{
   echo 'Fail';
}
?>