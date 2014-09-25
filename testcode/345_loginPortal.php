<?php
// Login Contact
// Validates a contact access to the portal: the contact must have an active portal access with correct access dates
//    and give the correct email and password.
// This method returns a valid logged in session with the internal "portal" user

$email = 'joe@tsolucio.com';
$password = '6zdfda3f';
$params = "operation=loginPortal&username=$email&password=$password";
$response = $httpc->fetch_url("$cbURL?$params");
$dmsg.= debugmsg("Raw response (json) Query",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response loginPortal",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('loginPortal failed: '.$jsonResponse['message']);
	echo 'loginPortal failed!';
} else {
	if (!$jsonResponse['result']) {
		echo 'Contact with email '.$email.' could <b>NOT</b> be logged in correctly!';
	} else {
		echo 'Contact with ID '.$jsonResponse['result'].' has been logged in correctly!';
	}
}
?>