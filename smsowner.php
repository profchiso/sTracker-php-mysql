    <?php
//	session_start();
	$servername = "localhost";
	$dbusername = "root";
	$password = "";
	$dbname = "smarttrackerdb";
	$owner = $_SESSION['owner'];
	$reciever = $_SESSION["recipient"]; 
	// Create connection
	$conn = mysqli_connect($servername, $dbusername, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	 $sql="Select phone from users where staff_no='{$owner}' ";
	$dbresult = mysqli_query($conn, $sql);
    // output data of each row
    while($row = mysqli_fetch_assoc($dbresult)) {
		$recip1 = $row["phone"];
}

	 $sql2="Select phone from users where staff_no='{$reciever}' ";
	$dbresult2 = mysqli_query($conn, $sql);
    // output data of each row
    while($row = mysqli_fetch_assoc($dbresult2)) {
		$recip2 = $row["phone"];
}

$json_url = "http://api.ebulksms.com:8080/sendsms.json";
	$username = 'holyaustin@yahoo.com';
	$apikey = 'ced3877ff304eae5989f4df094a4a5de51b824f2';
    $sendername = 'sTracker';
    $recipients = $recip1;
    $message1 = "Your document have been forwarded to" . $reciever;
    $message2 = "A document have been sent to you on SmartTracker by " . $_SESSION['staff_no'];
    $flash = 0;
	
#sending Alert to owner
    $recipients = $recip1;
    if (get_magic_quotes_gpc()) {
        $message = stripslashes($message1);
    }
    $message = substr($message1, 0, 160);
#Use the next line for HTTP POST with JSON
    $result = useJSON($json_url, $username, $apikey, $flash, $sendername, $message, $recipients);
	if ($result == 'SUCCESS') {
		echo "Success" ;
	}
	else {
		echo "Not Sent" . $result;
	}
# sending Alert to reciever
	    $recipients = $recip2;
    if (get_magic_quotes_gpc()) {
        $message = stripslashes($message2);
    }
    $message = substr($message2, 0, 160);
#Use the next line for HTTP POST with JSON
    $result = useJSON($json_url, $username, $apikey, $flash, $sendername, $message, $recipients);
	if ($result == 'SUCCESS') {
		echo "Success" ;
	}
	else {
		echo "Not Sent" . $result;
	}
	
	
function useJSON($url, $username, $apikey, $flash, $sendername, $messagetext, $recipients) {
    $gsm = array();
    $country_code = '234';
    $arr_recipient = explode(',', $recipients);
    foreach ($arr_recipient as $recipient) {
        $mobilenumber = trim($recipient);
        if (substr($mobilenumber, 0, 1) == '0'){
            $mobilenumber = $country_code . substr($mobilenumber, 1);
        }
        elseif (substr($mobilenumber, 0, 1) == '+'){
            $mobilenumber = substr($mobilenumber, 1);
        }
        $generated_id = uniqid('int_', false);
        $generated_id = substr($generated_id, 0, 30);
        $gsm['gsm'][] = array('msidn' => $mobilenumber, 'msgid' => $generated_id);
    }
    $message = array(
        'sender' => $sendername,
        'messagetext' => $messagetext,
        'flash' => "{$flash}",
    );

    $request = array('SMS' => array(
            'auth' => array(
                'username' => $username,
                'apikey' => $apikey
            ),
            'message' => $message,
            'recipients' => $gsm
    ));
    $json_data = json_encode($request);
    if ($json_data) {
        $response = doPostRequest($url, $json_data, array('Content-Type: application/json'));
        $result = json_decode($response);
        return $result->response->status;
    } else {
        return false;
    }
}
//Function to connect to SMS sending server using HTTP POST
function doPostRequest($url, $arr_params, $headers = array('Content-Type: application/x-www-form-urlencoded')) {
    $response = array();
    $final_url_data = $arr_params;
    if (is_array($arr_params)) {
        $final_url_data = http_build_query($arr_params, '', '&');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $final_url_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $response['body'] = curl_exec($ch);
    $response['code'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $response['body'];
}

?>
